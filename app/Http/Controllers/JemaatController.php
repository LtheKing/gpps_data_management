<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $jemaat = new Jemaat;

        $jemaat->NoAnggota = $request->NoAnggota;
        $jemaat->Nama = $request->Nama;
        $jemaat->Alamat = $request->Alamat;
        $jemaat->Tlp = $request->Tlp;
        $jemaat->Status = $request->Status;
        $jemaat->NamaIbu = $request->NamaIbu;
        $jemaat->NamaAyah = $request->NamaAyah;
        $jemaat->TanggalBaptis = $request->TanggalBaptis;
        $jemaat->PelaksanaBaptis = $request->PelaksanaBaptis;

        if ($request->hasFile('FileName')) {
            $image      = $request->file('FileName');
            $fileName   = $request->Nama . '.' . $image->getClientOriginalExtension();
            $jemaat->FileName = $fileName;

            // dd($jemaat->all());

            $img = Image::make($image->getRealPath());
            // $img->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            // });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('images/'.$fileName, $img, 'public');
            
            // Jemaat::create($request->all());
            $jemaat->save();
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
    public function show(Jemaat $jemaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function edit(Jemaat $jemaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jemaat $jemaat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jemaat $jemaat)
    {
        //
    }
}
