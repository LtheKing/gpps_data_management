<?php

namespace App\Http\Controllers;

use App\Charts\JemaatsChart;
use App\Charts\MonthlyUsersChart;
use App\Exports\JemaatExport;
use App\Models\Attendance;
use App\Models\Cabang;
use App\Models\Jemaat;
use App\Models\Tamu;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use QrCode;
use Session;

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
        $session = Session::all();
        $cabang_id = $session['cabang_id'];
        $jemaats = DB::table('jemaats')
            ->where('cabang_id', $cabang_id)
            ->get();
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
        $cabangs = DB::table('cabangs')->select()->get();
        // dd($cabangs);
        return view('create', compact('cabangs'));
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
        $cabang = Cabang::find($jemaat->cabang_id);
        return view('detail', compact('jemaat', 'qrcode', 'cabang'));
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
        $cabangsObj = DB::table('cabangs')->select()->get();
        return view('edit', compact('jemaat', 'cabangsObj'));
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

    public function absensi(MonthlyUsersChart $chart)
    {
        return view('absen', ['chart' => $chart->build()]);
    }

    public function absen($id, Request $request)
    {
        $jemaat = Jemaat::find($id);
        $session = Session::all();
        $absen = [
            'jemaat_id' => $id,
            'tgl_kehadiran' => now(),
            'cabang_id' => $session['cabang_id'],
            'ibadah_ke' => $request->IbadahKe,
        ];

        Attendance::create($absen);
    }

    public function export()
    {
        return Excel::download(new JemaatExport, 'jemaat.xlsx');
    }

    public function tamuPage()
    {
        $qrcode = QrCode::size(125)->generate(route('jemaat_tamu_qr'));
        return view('tamu', compact('qrcode'));
    }

    public function tamuInserted()
    {
        return view('tamu-inserted');
    }

    public function tamuEdit($id)
    {
        $tamu = Tamu::find($id);
        $cabangsObj = DB::table('cabangs')->select()->get();
        return view('tamu-edit', compact('tamu', 'cabangsObj'));
    }

    public function tamuUpdate(Request $request, $id)
    {
        $tamu = Tamu::find($id);
        $message = '';
        $qrcode = QrCode::size(125)->generate(route('jemaat_tamu_qr'));

        try {
            $tamu->update($request->all());
            $message = 'Data tamu berhasil diupdate !';
            return redirect()->route('jemaat_tamu')
                ->with('message', $message)
                ->with('message_type', 'success');
        } catch (\Throwable $th) {
            $message = $th->message;
            return redirect()->route('jemaat_tamu')
                ->with('message', $message)
                ->with('message_type', 'error');
        }

        //    return view('tamu', compact('message', 'qrcode'));
    }

    //API

    public function getJemaatArray()
    {
        $session = Session::all();
        $cabang_id = $session['cabang_id'];
        $jemaats = DB::table('jemaats')
            ->where('cabang_id', $cabang_id)
            ->get();

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

    public function absensiFilter(JemaatsChart $chart, Request $request)
    {
        // dd($request->all());
        return view('absen', ['chart' => $chart->build($request->all())]);
    }

    public function getTamu()
    {
        $session = Session::all();
        $cabang_id = $session['cabang_id'];
        $tamu = DB::table('tamu')
            ->where('cabang_id', $cabang_id)
            ->get();

        $data = (object) [
            'data' => $tamu,
        ];
        return $data;
    }

    public function qrTamu()
    {
        //get latest data
        $latest = Tamu::orderBy('id', 'DESC')->first();
        $tamuSeq = substr($latest->Alias, 4);
        $seq = intval($tamuSeq);
        $session = Session::all();
        $cabang_id = $session['cabang_id'];

        //isi data
        $data = [
            'NamaTamu' => '-',
            'Alias' => 'tamu' . $seq + 1,
            'Alamat' => '-',
            'Email' => '-',
            'NoTelp' => '-',
            'cabang_id' => $cabang_id,
            'IbadahKe' => '-',
        ];

        //store to db
        $message = '';
        try {
            $response = Tamu::create($data);
        } catch (\Throwable $th) {
            $message = $th->message;
        }

        if ($message != '') {
            return view('tamu-inserted', compact('message'));
        } else {
            $message = 'Data tamu berhasil diinput, silahkan kembali';
            return view('tamu-inserted', compact('message'));
        }
    }

}
