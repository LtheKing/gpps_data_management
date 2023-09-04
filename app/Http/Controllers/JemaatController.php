<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Attendance;
use App\Models\Cabang;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;
use QrCode;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JemaatExport;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jemaats = DB::table('jemaats')->paginate(15);
        $jemaats = DB::table('jemaats')->get();
        // dd($jemaats);
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
            'JenisKelamin' => 'required',
            'StatusBaptis' => 'required',
            'StatusKematian' => 'required',
            'Segment' => 'required',
            'TempatLahir' => 'required',
            'TanggalLahir' => 'required',
            'GolonganDarah' => 'required',
            'FileName' => 'required|file|max:2048',
        ]);

        if ($request->Status == "Menikah" && $request->JenisKelamin == "Pria") {
            $request->validate([
                'NamaIstri' => 'required',
                'TanggalPernikahan' => 'required',
                'PelaksanaPemberkatan' => 'required',
            ]);
        }

        if ($request->Status == "Menikah" && $request->JenisKelamin == "Wanita") {
            $request->validate([
                'NamaSuami' => 'required',
                'TanggalPernikahan' => 'required',
                'PelaksanaPemberkatan' => 'required',
            ]);
        }

        if ($request->StatusBaptis == "Sudah") {
            $request->validate([
                'TanggalBaptis' => 'required',
                'PelaksanaBaptis' => 'required',
            ]);
        }

        if ($request->StatusKematian == "Ya") {
            $request->validate([
                'TanggalKematian' => 'required',
            ]);
        }

        if ($request->hasFile('FileName')) {
            $image = $request->file('FileName');
            $fileName = $request->Nama . '.' . $image->getClientOriginalExtension();
            $toSave = Arr::add($request->all(), 'ImageName', $fileName);

            $img = Image::make($image->getRealPath());
            // $img->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            // });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');

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
        $qrcode = QrCode::size(125)->generate(route('jemaat_detail', $id));
        return view('detail', compact('jemaat', 'qrcode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jemaat  $jemaat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Artisan::call('cache:clear');
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
        // dd($request->all());
        $request->validate([
            'NoAnggota' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Tlp' => 'required',
            'Status' => 'required',
            'NamaAyah' => 'required',
            'NamaIbu' => 'required',
            'JenisKelamin' => 'required',
            'StatusBaptis' => 'required',
            'StatusKematian' => 'required',
            'Segment' => 'required',
            'FileName' => 'file|max:2048',
        ]);

        if ($request->Status == "Menikah" && $request->JenisKelamin == "Pria") {
            $request->validate([
                'NamaIstri' => 'required',
                'TanggalPernikahan' => 'required',
                'PelaksanaPemberkatan' => 'required',
            ]);
        }

        if ($request->Status == "Menikah" && $request->JenisKelamin == "Wanita") {
            $request->validate([
                'NamaSuami' => 'required',
                'TanggalPernikahan' => 'required',
                'PelaksanaPemberkatan' => 'required',
            ]);
        }

        if ($request->StatusBaptis == "Sudah") {
            $request->validate([
                'TanggalBaptis' => 'required',
                'PelaksanaBaptis' => 'required',
            ]);
        }

        if ($request->StatusKematian == "Ya") {
            $request->validate([
                'TanggalKematian' => 'required',
            ]);
        }

        $data = Jemaat::find($id);
        if ($request->hasFile('FileName')) {
            // $existingImage = storage_path('public/images/'. $data->Nama);
            // File::delete($existingImage);
            Storage::disk('public')->delete('/images/' . $data->ImageName);

            $image = $request->file('FileName');
            $fileName = $request->Nama . '.' . $image->getClientOriginalExtension();
            $toUpdate = Arr::add($request->all(), 'ImageName', $fileName);

            $img = Image::make($image->getRealPath());
            // $img->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            // });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');

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

    public function testingPrint()
    {
        $jemaats = DB::table('jemaats')->get();
        view()->share('index', $jemaats);
        $pdf = PDF::loadView('index', ['jemaats' => $jemaats]);
        return $pdf->download('data jemaat.pdf');
    }

    public function absen($id, Request $request) {
        $jemaat = Jemaat::find($id);
        $session = Session::all();
        $absen = [
            'jemaat_id' => $id,
            'tgl_kehadiran' => now(),
            'cabang_id' => $session['cabang'],
            'ibadah_ke' => $request->IbadahKe
        ];

        Attendance::create($absen);
    }

    public function export() 
    {
        return Excel::download(new JemaatExport, 'jemaat.xlsx');
    }

    //API

    public function getJemaatArray()
    {
        $jemaats = DB::table('jemaats')->get();
        $data = (object) [
            'data' => $jemaats,
        ];
        // array_push($data->data, $jemaats);
        return $data;
    }

    public function api_delete($id)
    {
        $jemaat = Jemaat::find($id);
        $jemaat->delete();
        Storage::disk('public')->delete('/images/' . $jemaat->ImageName);
        return response('Data Deleted', 200);
    }

    public function getAyah($nama)
    {
        $data = Jemaat::where('Nama', $nama)->get();
        if (count($data) > 0) {
            return redirect()->route('jemaat_detail', $data[0]->id)->with('Success', 'Data Ayah Berhasil Ditemukan');
        }
        return back()->with('error', 'Data Ayah Tidak Ditemukan');
    }

    public function getIbu($nama)
    {
        $data = Jemaat::where('Nama', $nama)->get();
        if (count($data) > 0) {
            return redirect()->route('jemaat_detail', $data[0]->id)->with('Success', 'Data Ibu Berhasil Ditemukan');
        }
        return back()->with('error', 'Data Ibu Tidak Ditemukan');
    }

    public function filter($field, $value)
    {
        $data = Jemaat::where($field, $value)->get();
        return $data;
    }

    public function getSuami($nama)
    {
        $data = Jemaat::where('Nama', $nama)->get();
        if (count($data) > 0) {
            return redirect()->route('jemaat_detail', $data[0]->id)->with('Success', 'Data Suami Berhasil Ditemukan');
        }
        return back()->with('error', 'Data Suami Tidak Ditemukan');
    }

    public function getIstri($nama)
    {
        $data = Jemaat::where('Nama', $nama)->get();
        if (count($data) > 0) {
            return redirect()->route('jemaat_detail', $data[0]->id)->with('Success', 'Data Istri Berhasil Ditemukan');
        }
        return back()->with('error', 'Data Istri Tidak Ditemukan');
    }
}