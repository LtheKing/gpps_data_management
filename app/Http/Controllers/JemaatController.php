<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Arr;
use Intervention\Image\ImageManagerStatic as Image;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jemaats = Jemaat::all();
        return view('index', compact('jemaats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'NoAnggota' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Tlp' => 'required',
            'Status' => 'required',
            'NamaAyah' => 'required',
            'NamaIbu' => 'required',
            'TanggalBaptis' => 'required',
            'PelaksanaBaptis' => 'required',
            'FileName' => 'required|file|max:2048',
        ]);

        if ($request->hasFile('FileName')) {
            $image      = $request->file('FileName');
            $fileName   = $request->Nama . '.' . $image->getClientOriginalExtension();
            $toSave = Arr::add($request->all(), 'ImageName', $fileName);

            $img = Image::make($image->getRealPath());
            // $img->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            // });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/'.$fileName, $img, 'public');

            Jemaat::create($toSave);
            return redirect()->route('jemaat_index')->with('Success', 'Data Jemaat Berhasil Ditambahkan');
        }

        return back()->with('error', 'Gagal Menyimpan Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jemaat = Jemaat::find($id);
        return view('detail', compact('jemaat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jemaat = Jemaat::find($id);
        return view('edit', compact('jemaat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NoAnggota' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Tlp' => 'required',
            'Status' => 'required',
            'NamaAyah' => 'required',
            'NamaIbu' => 'required',
            'TanggalBaptis' => 'required',
            'PelaksanaBaptis' => 'required',
            'FileName' => 'required|file|max:2048',
        ]);
        
        $data = Jemaat::find($id);
        if ($request->hasFile('FileName')){
            // $existingImage = storage_path('public/images/'. $data->Nama);
            // File::delete($existingImage);
            Storage::disk('public')->delete('/images/' . $data->ImageName);

            $image      = $request->file('FileName');
            $fileName   = $request->Nama . '.' . $image->getClientOriginalExtension();
            $toUpdate = Arr::add($request->all(), 'ImageName', $fileName);

            $img = Image::make($image->getRealPath());
            // $img->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            // });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/'.$fileName, $img, 'public');

            $data->update($toUpdate);
            return redirect()->route('jemaat_index')->with('Success', 'Data Jemaat Berhasil Diubah');

        } else {
            $data->update($request->all());
            return redirect()->route('jemaat_index')->with('Success', 'Data Jemaat Berhasil Diubah');
        }
        
        return back()->with('error', 'Gagal update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jemaat = Jemaat::find($id);
        $jemaat->delete();
        Storage::disk('public')->delete('/images/' . $jemaat->ImageName);
        return back()->with('error', 'data berhasil dihapus');
    }
}
