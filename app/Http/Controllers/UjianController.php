<?php

namespace App\Http\Controllers;

use Request;
use App\ujian;
use App\soal;
use App\kelas;
use App\jurusan;
use App\mapel;
use App\nilai;
use Auth;
use App\Http\Requests;
use App\Http\Requests\CreateUjianRequest;
use App\Http\Controllers\Controller;

class ujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jurusan = Ujian::all()->lists('jurusan', 'id_jurusan'); // get semua jurusan yang ada di db
        $kelas = kelas::all()->lists('kelas', 'id_kelas'); // get semua kelas yang ada didb
        $ujian = ujian::orderBy('id_ujian', 'asc')->paginate(5); // get semua ujian yg ada di db *paginate 5*

        return view('backend.admin.ujian.index', compact('ujian', 'kelas', 'jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = kelas::all()->lists('kelas', 'id_kelas'); // get semua kelas di db
        $jurusan = jurusan::all()->lists('jurusan', 'id_jurusan'); // get semua jurusan di db
        $mapel = mapel::all()->lists('mapel', 'id_mapel'); // get semua mapel di db
        $soal = soal::all()->lists('kode_soal', 'id_soal');
        $kkm = array(); // kkm?

        for ($i = 0; $i <= 100; $i++) { // kkm = nilai 1 - 100
            $kkm[] = $i;
        }

        return view('backend.admin.ujian.create', compact('kelas', 'jurusan', 'mapel', 'kkm', 'soal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUjianRequest $request)
    {
        $mapel = Request::get('id_mapel'); // get id mapel
        $kelas = Request::get('id_kelas'); // get id kelas
        $jurusan = Request::get('id_jurusan'); // get id jurusan
        $cek = ujian::whereRaw("id_mapel = $mapel and id_kelas = $kelas and id_jurusan = $jurusan")->get(); // query search ujian yg dibuat

        if ($cek != '[]') { // ujian sama?
            return Redirect('index/manajemen/ujian/create')->witherrors('Ujian sudah ada!'); // return ujian sudah dibuat
        }

        $waktu = Request::get('waktu'); // get waktu
        $input = Request::all(); // get semua request
        $input['waktu'] = $waktu * 60; // konversi waktu dari menit ke detik
        $input['id_user'] = Auth::admin()->get()->id_user;
        $input['postdate'] = date('Y-m-d');
        ujian::create($input);
        flash()->success('ujian berhasil dibuat!');
        return Redirect('index/manajemen/ujian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ujian = ujian::find($id);
        if (is_null($ujian)) {
            abort(404);
        }
        $soal = soal::all()->lists('kode_soal', 'id_soal');
        $kelas = kelas::all()->lists('kelas', 'id_kelas');
        $jurusan = jurusan::all()->lists('jurusan', 'id_jurusan');
        $mapel = mapel::all()->lists('mapel', 'id_mapel');
        $ujian['waktu'] = $ujian->waktu / 60;
        $kkm = array();

        for ($i = 0; $i <= 100; $i++) {
            $kkm[] = $i;
        }
        return view('backend.admin.ujian.edit', compact('ujian', 'kelas', 'jurusan', 'mapel', 'kkm', 'soal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUjianRequest $request, $id)
    {
        $ujian = ujian::find($id);
        if (is_null($ujian)) {
            abort(404);
        }
        $input = Request::all();
        $waktu = Request::get('waktu');
        $input['id_user'] = Auth::admin()->get()->id_user;
        $input['waktu'] = $waktu * 60;
        $input['postdate'] = date("Y-m-d");
        $ujian->update($input);
        flash()->info('Ujian has been updated!');
        return Redirect('index/manajemen/ujian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ujian = ujian::find($id);
        if (is_null($id)) {
            abort(404);
        }
        $ujian->delete();
        flash()->warning('Ujian berhasil dihapus');
        return Redirect('index/manajemen/ujian');
    }

    public function lihatNilai($id)
    {
        $idujian = nilai::where('id_ujian', $id)->first();
        $ujian = ujian::find($id);
        if (is_null($ujian)) {
            abort(404);
        }


        $keterangan = nilai::where('id_ujian', $id)->get();
        $mapel = ujian::find($id)->mapel->mapel;
        return view('backend.admin.ujian.lihatnilai', compact('keterangan', 'mapel'));
    }


    public function updateSoal($id)
    {
        $soal = soal::find($id);
        $jumlah_soal = soal::where('id_ujian', $id)->get()->count();
        $soal->delete();
        $gambar = Request::file('gambar');
        $hidden = Request::get('hidden');
        $pertanyaan = Request::get('pertanyaan');
        $a = Request::get('a');
        $b = Request::get('b');
        $c = Request::get('c');
        $d = Request::Get('d');
        $jawaban = Request::get('jawaban');
        for ($i = 0; $i < $jumlah_soal; $i++) {
            $input['gambar'] = $gambar[$i];
            $gambarlama = $hidden[$i];
            $input['id_ujian'] = $id;
            $input['pertanyaan'] = $pertanyaan[$i];
            $input['a'] = $a[$i];
            $input['b'] = $b[$i];
            $input['c'] = $c[$i];
            $input['d'] = $d[$i];
            $input['jawaban'] = $jawaban[$i];


            if (!is_null($input['gambar'])) { //jika gambar tidak null
                if ($input['gambar']->isValid()) {
                    $path = 'public/admin/img/uploads';
                    if ($gambarlama != "") {
                        unlink($path . '/' . $gambarlama);
                    }
                    $ekstensi = $input['gambar']->getClientOriginalExtension();
                    $filename = 'img' . rand(1111, 9999) . '.' . $ekstensi;
                    $input['gambar']->move($path, $filename);
                    $input['gambar'] = $filename;
                    soal::create($input);
                }
            } else { // jika gambar null
                $input['gambar'] = $gambarlama;
                soal::create($input);
            }


        }

        // Redirect setelah looping selesai
        flash()->info('Soal telah selesai diupdate!');
        return Redirect('index/manajemen/ujian');
    }


    public function search()
    {
        $kelas = Request::get('kelas');
        $jurusan = Request::get('jurusan');
        $ujian = ujian::whereRaw("id_kelas = $kelas and id_jurusan = $jurusan")->get();
        if ($ujian == "[]") {
            echo "<p color=red>Belum ada ujian yang dibuat!</p>";
        } else {
            ?>
            <table class="table table-hover text-center" id="result">

                <tr style="background-color:#346357; color: white;">
                    <td width="10%">Id Ujian</td>
                    <td>Mapel</td>
                    <td>Waktu</td>
                    <td>KKM</td>
                    <td>Publisher</td>
                    <td>Status</td>
                    <td>Last Updated</td>
                    <td width="15%"></td>
                </tr>
                <?php
                foreach ($ujian as $ulangan) {
                    $waktu = $ulangan->waktu / 60;
                    echo "<tr>

                                    <td>$ulangan->id_ujian</td>
                                    <td>" . $ulangan->mapel->mapel . "</td>
                                    <td>$waktu Menit</td>
                                    <td>$ulangan->kkm</td>
                                    <td>" . $ulangan->user_admin->fullname . "</td>
                                    <td>";

                    if ($ulangan->status == 1) {
                        echo "<i style='color:green;font-weight:bolder'>Active</i>";
                    } else {
                        echo "<i style='color:red;font-weight:bolder'>Not Active</i>";
                    }
                    echo "
                                    </td>
                                    <td>" . indonesiaDate($ulangan->postdate) . "</td><td>";
                    ?>
                    <form action="ujian/<?php echo $ulangan->id_ujian; ?>" method=POST>
                        <input type=hidden value=delete name=_method>
                        <a href="ujian/view/<?php echo $ulangan->id_ujian; ?>" id="edit-user" data-toggle="tooltip"
                           data-placement="top" title="Lihat hasil ujian" class="btn btn-primary pull-right"
                           style="margin-left:5px">
                            <span class="fa fa-eye"></span>
                        </a>
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete ujian <?php echo $ulangan->mapel->mapel; ?> ?');"
                                data-toggle="tooltip" data-placement="top" title="Delete"
                                class="btn btn-danger pull-right" style="margin-left:5px">
                            <span class="fa fa-remove"></span>
                        </button>


                        <a href="ujian/<?php echo $ulangan->id_ujian; ?>/edit" id="edit-user" data-toggle="tooltip"
                           data-placement="top" title="Edit" class="btn color2 pull-right">
                            <span class="fa fa-edit"></span>
                        </a>

                        <!--
                                    <a href="ujian/view/<?php echo $ulangan->id_ujian; ?>" id="edit-user" data-toggle="tooltip" data-placement="top" title="Lihat Hasil" class="btn btn-block color1 pull-right">
                                      <span class="fa fa-eye"></span>
                                    </a>-->
                    </form>
                    <?php
                    echo "</td></tr>
                                    ";
                }
                ?>

            </table>
            <?php
        }
    }
}
