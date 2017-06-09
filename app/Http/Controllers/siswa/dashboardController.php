<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;
use App\ujian;
use App\User;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*
        *   jika status akun tidak aktif
        *   redirect ke halaman login dengan error info
         */
        if(Auth::user()->get()->status == 0) {
            Auth::user()->logout();
            flash()->error('Akun Anda tidak Aktif!');
            return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
        }


        /*
        *   mengambil data ulangan apa saja
        *   yang tersedia untuk user yang saat ini
        *   sedang login (ulangan daengan status aktif)
         */
        
        $idkelas = Auth::user()->get()->id_kelas;
        $idjurusan = Auth::user()->get()->id_jurusan;
        $ujian = ujian::where(['id_kelas' => $idkelas,'id_jurusan' => $idjurusan,'status' => 1])->get();
        return view('frontend.dashboard', compact('ujian'));
    }
    
    /**
     * Show the form for creating a new resource.
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
}
