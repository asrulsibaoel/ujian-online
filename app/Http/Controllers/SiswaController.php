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
        $jurusan = Jurusan::all()->lists('jurusan', 'id_jurusan'); // get semua jurusan yang ada di db
        return view('backend.admin.siswa.index', compact('siswa','kelas','jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all()->lists('jurusan', 'id_jurusan'); // get semua jurusan yang ada di db
        $kelas = Kelas::all()->lists('kelas', 'id_kelas'); // get semua kelas yang ada didb

        return view('backend.admin.siswa.create', compact('jurusan','kelas'));
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

        /*
        fungsi random password
         */
        function randpass($length){
            $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $len = strlen($string);
            $pass = '';
            for($i=1;$i<=$length; $i++){
                $start = rand(0, $len);
                $pass .= substr($string, $start, 1);
            }
            return $pass;
        }

        /*
        id 1 = RPL
        id 2 = MM
        id 3 = TKJ
        id 4 = PTV
         */
        if($jurusan == 1) {
            $jurusan_siswa = 2071;
        }
        else if($jurusan == 2) {
            $jurusan_siswa = 2072;
        }
        else if($jurusan == 3) {
            $jurusan_siswa = 2073;
        }
        else if($jurusan == 4) {
            $jurusan_siswa = 2074;
        }

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

        $nis = $dateY.$jurusan_siswa."-".$id_siswa."-".$request->get('kelas');
        $passwd = $request->get('password');
        $input['nis'] = $nis;
        $input['password'] = $passwd;
        $input['alamat'] = Hash::make($passwd);
        $input['id_jurusan'] = $jurusan;
        $input['kelas'] = $kelas;
        $input['semester'] = $semester;
        //create user
        User::create($input);
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
        $siswa = User::find($id);
        if(is_null($siswa)) {
            abort(404);
        }

        $input = Request::all();
        $kelas = Request::get('id_kelas');
        $jurusan = Request::get('id_jurusan');

        /*
        id 1 = kelas 10
        id 2 = kelas 11
        id 3 = kelas 12
         */
        if($kelas == 1) {
            $kelas_siswa = 10;
        }
        else if($kelas == 2) {
            $kelas_siswa = 11;
        }
        else if($kelas == 3) {
            $kelas_siswa = 12;
        }

        /*
        id 1 = RPL
        id 2 = MM
        id 3 = TKJ
        id 4 = PTV
         */
        if($jurusan == 1) {
            $jurusan_siswa = 2071;
        }
        else if($jurusan == 2) {
            $jurusan_siswa = 2072;
        }
        else if($jurusan == 3) {
            $jurusan_siswa = 2073;
        }
        else if($jurusan == 4) {
            $jurusan_siswa = 2074;
        }

        $id_siswa = $siswa->id_siswa;

        /*
        id login = ex: 127-2072-098-11
         */
        $id_login = "127-".$jurusan_siswa."-".$id_siswa."-".$kelas_siswa;
        $input['id'] = $id_login;
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
        $siswa = user::find($id);
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


     public function search() {
        $kelas = Request::get('kelas');
        $jurusan = Request::get('jurusan');
        $siswa = User::whereRaw("id_kelas = $kelas and id_jurusan = $jurusan")->get();
        if($siswa == "[]") {
            echo "<p color=red>Belum ada Siswa yang dibuat!</p>";
        }
        else {
                    ?>
            <table class="table table-hover text-center" id="result">
      
      <tr style="background-color:#346357; color: white;">
        <td width="10%">Id Siswa</td>
        <td>Fullname</td>
        <td>User ID</td>
        <td>Password</td>
        <td>kelas</td>
        <td>jurusan</td>
        <td>Status</td>
        <td width="15%"></td>
      </tr>
                <?php
                foreach($siswa as $daftar_siswa){
                                    echo "<tr>

                                    <td>$daftar_siswa->id_siswa</td>
                                    <td>$daftar_siswa->fullname</td>
                                    <td>$daftar_siswa->id</td>
                                    <td>$daftar_siswa->pwd</td>
                                    <td>".$daftar_siswa->kelas->kelas."</td>
                                    <td>".$daftar_siswa->jurusan->jurusan."</td>
                                    <td>";
                                    if($daftar_siswa->status == 1) {
                                        echo "<i style='color:green;font-weight:bolder'>Active</i>";
                                    }
                                    else {
                                        echo "<i style='color:red;font-weight:bolder'>Not Active</i>";
                                    }
                                    echo "
                                    </td><td>";
                                    ?>
                                    <form action="<?php echo url('index/manajemen/siswa/'.$daftar_siswa->id_siswa); ?>" method=POST>
                                    <input type=hidden value=delete name=_method>
                                   <button type="submit" onclick="return confirm('Are you sure you want to delete <?php echo $daftar_siswa->fullname?> ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
                                    <span class="fa fa-remove"></span>
                                    </button>
                                    
                                    <a href="siswa/<?php echo $daftar_siswa->id_siswa; ?>/edit" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn color2 pull-right">
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

