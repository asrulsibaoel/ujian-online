<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru')->delete();
        $user = [
            'nip' => '12345',
            'nama_guru' => 'Abdullah Subhi',
            'password' =>  Hash::make("abdullah"),
            'alamat' => 'Jalan Jakarta, Malang',

        ];
        DB::table('guru')->insert($user);
    }
}
