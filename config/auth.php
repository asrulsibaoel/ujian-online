<?php

return [
    'multi-auth' => [
        'admin' => [
            'driver' => 'eloquent',
            'model'  => App\Guru::class
        ],
        'user' => [
            'driver' => 'eloquent',
            'model'  => App\Siswa::class
        ]
    ]
];
