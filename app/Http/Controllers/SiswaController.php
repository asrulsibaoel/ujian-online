<?php

namespace App\Http\Controllers;

use Request;

use App\Siswa;
use App\kelas;
use App\Jurusan;
use App\Http\Requests\CreateSiswaRequest;
use Hash;
use App\nilai;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::orderBy('nis','asc')->paginate(5);
        $jurusan = Jurusan::all()->lists('nama_jurusan', 'id_jurusan'); // get semua jurusan yang ada di db
        return view('backend.admin.siswa.index', compact('siswa','jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all()->lists('nama_jurusan', 'id_jurusan'); // get semua jurusan yang ada di db

        return view('backend.admin.siswa.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSiswaRequest $request)
    {

        $input = $request->all();
        $kelas = $request->get('kelas');
        $jurusan =$request->get('id_jurusan');
        $semester = $request->get('semester');

        $id = Siswa::all()->last();

        if(is_null($id)) {
            $id_siswa = 1;
        }
        else {
            $id_siswa = $id->id_siswa + 1;
        }
        /*
        id login = ex: 127-2072-098-11
         */
        $dateY = date('Y');

        $nis = $dateY.'-'. $jurusan."-".$id_siswa."-".$request->get('kelas');
        $passwd = $request->get('password');
        $input['nis'] = $nis;
        $input['password'] = Hash::make($passwd);
        $input['alamat'] = $request->get('alamat');
        $input['id_jurusan'] = $jurusan;
        $input['kelas'] = $kelas;
        $input['semester'] = $semester;
        //create user
        Siswa::create($input);
        flash()->success('Siswa berhasil dibuat');
        return Redirect('index/manajemen/siswa');

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

        return Siswa::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = User::find($id);
        if(is_null($siswa)) {
            abort(404);
        }
        $jurusan = jurusan::all()->lists('jurusan', 'id_jurusan'); // get semua jurusan yang ada di db
        $kelas = kelas::all()->lists('kelas', 'id_kelas'); // get semua kelas yang ada didb
        return view('backend.admin.siswa.edit', compact('jurusan','kelas','siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSiswaRequest $request, $id)
    {
        $siswa = Siswa::find($id);
        if(is_null($siswa)) {
            abort(404);
        }

        $input = $request->all();
        $kelas = $request->get('kelas');
        $jurusan =$request->get('id_jurusan');
        $semester = $request->get('semester');

        $id = Siswa::all()->last();

        if(is_null($id)) {
            $id_siswa = 1;
        }
        else {
            $id_siswa = $id->id_siswa + 1;
        }
        /*
        id login = ex: 127-2072-098-11
         */
        $dateY = date('Y');

        $nis = $dateY.'-'. $jurusan."-".$id_siswa."-".$request->get('kelas');
        $passwd = $request->get('password');
        $input['nis'] = $nis;
        $input['password'] = Hash::make($passwd);
        $input['alamat'] = $request->get('alamat');
        $input['id_jurusan'] = $jurusan;
        $input['kelas'] = $kelas;
        $input['semester'] = $semester;

        //update user
        $siswa->update($input);
        flash()->info('Siswa berhasil diupdate');
        return Redirect('index/manajemen/siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if(is_null($siswa)) {
            abort(404);
        }
        $siswa->delete();
        $nilai = nilai::find($id);
        if(!is_null($nilai)) {
            $nilai->delete();
        }
        flash()->warning('siswa berhasil dihapus');
        Return Redirect('index/manajemen/siswa');
    }


     public function search(Request $request) {
        $kelas = $request->get('kelas');
        $jurusan = $request->get('jurusan');
        $siswa = Siswa::whereRaw("kelas = $kelas and id_jurusan = $jurusan")->get();
        if(empty($siswa)) {
            echo "<p color=red>Data Kosong!</p>";
        }
        else {
                    ?>
            <table class="table table-hover text-center" id="result">

                <tr style="background-color:#346357; color: white;">
                    <td width="10%">NIS</td>
                    <td>Nama</td>
                    <td>Alamat</td>
                    <td>Semester</td>
                    <td>Kelas</td>
                    <td>Jurusan</td>
                    <td width="15%"></td>
                </tr>
                <?php
                foreach($siswa as $daftar_siswa){
                                    echo "<tr>

                                    <td>$daftar_siswa->nis</td>
                                    <td>$daftar_siswa->nama_siswa</td>
                                    <td>$daftar_siswa->alamat</td>
                                    <td>$daftar_siswa->semester</td>
                                    <td>".$daftar_siswa->kelas."</td>
                                    <td>".$daftar_siswa->jurusan->jurusan."</td>
                                    <tr>";
                                    ?>
                                    <form action="<?php echo url('index/manajemen/siswa/'.$daftar_siswa->nis); ?>" method=POST>
                                    <input type=hidden value=delete name=_method>
                                   <button type="submit" onclick="return confirm('Are you sure you want to delete <?php echo $daftar_siswa->nama_siswa?> ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
                                    <span class="fa fa-remove"></span>
                                    </button>
                                    
                                    <a href="siswa/<?php echo $daftar_siswa->nis; ?>/edit" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn color2 pull-right">
                                      <span class="fa fa-edit"></span>
                                    </a>

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

