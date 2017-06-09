<?php

namespace App\Http\Controllers\siswa;

use Request;

use App\Http\Requests;
use App\soal;
use App\nilai;
use App\ujian;
use Input;
use Cookie;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use App\ListSoal;

class ujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        /*
        *   jika status ujian tidak aktif
        *   atau ujian yg diget bukan untuk kelas dan jurusan user
        *   atau ujian null tampilkan 404
         */
        $idkelas = Auth::user()->get()->id_kelas;
        $idjurusan = Auth::user()->get()->id_jurusan;
        $ujian = ujian::where(['id_ujian' => $id, 'id_kelas' => $idkelas,'id_jurusan' => $idjurusan])->first();
        $id_ujian = $id;
        if(is_null($ujian)) {
            abort(404);
        }
        else if($ujian->status == 0) {
                abort(404);
            }

        /*
        *   tampilkan seluruh soal secara random
         */
        $soal = ListSoal::where('id_soal',$ujian->id_soal)->orderByRaw("RAND()")->get();

        /*
        *   jika soal item kosong tampilkan pesan kesalahan
         */
        if($soal == "[]"){
            return 'Errorr.. tidak ada soal untuk ulangan ini... silahkan hubungi petugas';
        }

        /*
        *   jika peserta sudah mengikuti ujian
        *   peserta tidak boleh mengikuti lagi
         */
        $cek = nilai::where(['id_siswa' => Auth::user()->get()->id_siswa,'id_ujian' => $id])->first();
        if(!is_null($cek)) {
            return Redirect('dashboard')->withErrors('anda sudah mengikuti ujian ini!');
        }

        // passing lama ujian
        $waktu = $ujian->waktu;
        return view('frontend.soal', compact('soal', 'id_ujian','waktu'));
    }

    /**
     * Show the form for creating ap new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submit($id_ujian) {
        $ujian = ujian::find($id_ujian);
        $jumlahsoal = soal::find($ujian->id_soal)->jumlah_soal;
        $input = Request::get('soal');

        $nilai = 0;
        $salah = 0;
        $benar = 0;


        /*
        *   jika user tidak mengisi jawaban sama sekali
        *   benar = 0
        *   salah = semuanya
         */
        if(is_null($input)) {
            $benar = 0;
            $salah = $jumlahsoal;
        }


        /*
        *   foreach semua jawaban yang telah diisi user
        *   lalu cek jawabannya satu per satu
        *   jika jawaban sama variable benar ditambah 1
        *   jika jawaban salah variable salah ditambah 1
         */
        else {
            foreach($input as $id_soal => $jawaban) {
                $soal = ListSoal::where('id_listsoal', $id_soal)->first();
                Cookie::queue(Cookie::forget('soal['.$id_soal.']'));
                if($jawaban == $soal->jawaban) {
                    $benar++;
                }
                else {
                    $salah++;
                 }
            }
        }


        /*
        *   jawaban yang tidak diisi dikategorikan salah
         */
        $tidak_diisi = $jumlahsoal - $benar - $salah;
        $salah = $salah + $tidak_diisi;

        $kkm = $ujian->kkm;

        /*
        *   jika tidak ada jawaban yang benar
        *   nilai otomatis 0
         */
        if($benar == 0) {
            $nilaiakhir = 0;
        }

        /*
        *   nilai = jumlah benar * 100 / jumlah soal
        *   
        *   ex: 20 * 100 / 40
        *   nilai = 50
        *   
         */
        else {
            $nilaiakhir = $benar * 100 / $jumlahsoal;
        }


        /*
        *   jika nilai dibawah kkm
        *   keterangan = tidak lulus
        *
        *   jika nilai diatas kkm
        *   keterangan = lulus
         */
        if($nilaiakhir < $kkm) {
            $input['keterangan'] = 'Tidak lulus';
        }
        else {
            $input['keterangan'] = 'Lulus';
        }


        $input['nilai'] = substr($nilaiakhir, 0,4); // agar angka di blkg koma tidak terlalu banyak
        $input['id_ujian'] = $ujian->id_ujian;
        $input['id_siswa'] = Auth::user()->get()->id_siswa;
        nilai::create($input);
        //Session::flush();
        Session::forget('mulai_waktu');
        Auth::user()->logout();
        return view('frontend.hasil', compact('nilaiakhir', 'kkm','benar','salah'));
    }
}
