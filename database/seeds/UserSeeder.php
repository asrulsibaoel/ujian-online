<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->delete();
        $user = array(
        	array('nis' => 1, 'fullname' => 'Rifki Alfaridzi', 'id' => '127-2072-098-11', 'password' => Hash::make("9RQWjeFZ"), 'pwd' => '9RQWjeFZ', 'id_kelas' => 3, 'id_jurusan' => 1, 'status' => 1)
        	);
        DB::table('tbl_siswa')->insert($user);
    }
}
