<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\soal;
use App\mapel;
use App\kelas;
use App\ListSoal;
use Auth;

class soalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soal = soal::orderBy('id_soal','asc')->paginate(5);
        return view('backend.admin.soal.index', compact('soal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mapel = mapel::all()->lists('mapel','mapel');
        $kelas = kelas::all()->lists('kelas','kelas');
        return view('backend.admin.soal.create', compact('mapel','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input['kode_soal'] = Request::get('mapel').' - '.Request::get('kelas');
        $input['mapel'] = Request::get('mapel');
        $input['kelas'] = Request::get('kelas');
        $kode_soal = soal::where('kode_soal', $input['kode_soal'])->first();
        if(!is_null($kode_soal)) {
            return Redirect('index/manajemen/soal/create')->withErrors('Soal sudah ada!');
        }
        $input['jumlah_soal'] = Request::get('jumlah_soal');
        $input['id_user'] = Auth::admin()->get()->id_user;
        $input['postdate'] = date('Y-m-d');
        soal::create($input);
        flash()->success('Soal berhasil dibuat');
        return Redirect('index/manajemen/soal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soal = soal::find($id);
        if(is_null($soal)) {
            abort(404);
        }
        $mapel = mapel::all()->lists('mapel','mapel');
        $kelas = kelas::all()->lists('kelas','kelas');
        return view('backend.admin.soal.edit', compact('soal','mapel','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $soal = soal::find($id);
        if(is_null($soal)) {
            abort(404);
        }

        $input['kode_soal'] = Request::get('mapel').' - '.Request::get('kelas');
        $input['mapel'] = Request::get('mapel');
        $input['kelas'] = Request::get('kelas');
        $input['jumlah_soal'] = Request::get('jumlah_soal');
        $input['id_user'] = Auth::admin()->get()->id_user;
        $input['postdate'] = date('Y-m-d');
        $soal->update($input);
        flash()->info('Soal berhasil diupdate');
        return Redirect('index/manajemen/soal');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soal = soal::find($id);
        $listsoal = ListSoal::find($id);
        if(is_null($soal)) {
            abort(404);
        }
        if(!is_null($listsoal)) {
            $listsoal->delete();
        }
        $soal->delete();
        flash()->warning('Soal berhasil dihapus');
        return Redirect('index/manajemen/soal');
    }

    /**
     * List soal
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
        public function soal($id) {
            $soal = soal::find($id);
            if(is_null($soal)) {
                abort(404);
            }

            $jumlahsoal = $soal->jumlah_soal;
            $listsoal = ListSoal::where('id_soal', $id)->get();
            if($listsoal == "[]") { // jika ListSoal item kosong
                return view('backend.admin.soal.tambahsoal', compact('jumlahsoal','soal'));
            }
            
            else {
                return view('backend.admin.soal.editsoal', compact('jumlahsoal', 'soal','listsoal'));
            }
        }

        /**
         * [storeSoal description]
         * @param  [type] $id [description]
         * @return [type]     [description]
         */
        public function storeSoal($id) {
        $soal = soal::find($id);
        if(is_null($soal)) {
            abort(404);
        }
        $jumlah_soal = $soal->jumlah_soal;
        $gambar = Request::file('gambar');
        $pertanyaan = Request::get('pertanyaan');
        $a = Request::get('a');
        $b = Request::get('b');
        $c = Request::get('c');
        $d = Request::get('d');
        $jawaban = Request::get('jawaban');
        for($i=0;$i<$jumlah_soal;$i++) {
            $input['gambar'] = $gambar[$i];
            $input['id_soal'] = $id;
            $input['pertanyaan'] = $pertanyaan[$i];
            $input['a'] = $a[$i];
            $input['b'] = $b[$i];
            $input['c'] = $c[$i];
            $input['d'] = $d[$i];
            $input['jawaban'] = $jawaban[$i];

            if(!is_null($input['gambar'])) { //jika gambar tidak null
                    if($input['gambar']->isValid()) {
                        $path = 'public/admin/img/uploads';
                        $ekstensi = $input['gambar']->getClientOriginalExtension();
                        $filename = 'img'.rand(1111,9999).'.'.$ekstensi;
                        $input['gambar']->move($path,$filename);
                        $input['gambar'] = $filename;
                        ListSoal::create($input);
                    }
            }
            else { // jika gambar null
                ListSoal::create($input);
            }

        }

        // Redirect setelah looping selesai
        flash()->success('Soal telah selesai dibuat!');
        return Redirect('index/manajemen/soal');
    }
        public function updateSoal($id) {
        $soal = ListSoal::find($id);
        $jumlah_soal = ListSoal::where('id_soal',$id)->get()->count();
        $soal->delete();
        $gambar = Request::file('gambar');
        $hidden = Request::get('hidden');
        $pertanyaan = Request::get('pertanyaan');
        $a = Request::get('a');
        $b = Request::get('b');
        $c = Request::get('c');
        $d = Request::Get('d');
        $jawaban = Request::get('jawaban');
        for($i=0;$i<$jumlah_soal;$i++) {
            $input['gambar'] = $gambar[$i];
            $gambarlama = $hidden[$i];
            $input['id_soal'] = $id;
            $input['pertanyaan'] = $pertanyaan[$i];
            $input['a'] = $a[$i];
            $input['b'] = $b[$i];
            $input['c'] = $c[$i];
            $input['d'] = $d[$i];
            $input['jawaban'] = $jawaban[$i];

            
            if(!is_null($input['gambar'])) { //jika gambar tidak null
                    if($input['gambar']->isValid()) {
                        $path = 'public/admin/img/uploads';
                        if($gambarlama != "") {
                            unlink($path.'/'.$gambarlama);
                        }
                        $ekstensi = $input['gambar']->getClientOriginalExtension();
                        $filename = 'img'.rand(1111,9999).'.'.$ekstensi;
                        $input['gambar']->move($path,$filename);
                        $input['gambar'] = $filename;
                        ListSoal::create($input);
                    }
            }
            else { // jika gambar null
                $input['gambar'] = $gambarlama;
                ListSoal::create($input);
            }
            

        }

        // Redirect setelah looping selesai
        flash()->info('Soal telah selesai diupdate!');
        return Redirect('index/manajemen/soal');
    }
}
