<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aset;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Aset::class, function (Faker $faker) {
    $qr = Str::random(16);
    $jenis = $faker->randomElement(['Elektronik', 'Dokumen', 'Furniture', 'Kendaraan']); 
    $divisi = $faker->randomElement(['IT Support', 'Finance', 'Production', 'Human Resource']);

    $sn = null;
    if($jenis == 'Elektronik'){
        if($divisi == 'IT Support'){
            $sn = 'IT'. date('Ymd') . 'E00' . rand(1,200);
        }else if($divisi == 'Finance'){
            $sn = 'FI'. date('Ymd') . 'E00' . rand(1,200);
        }else if($divisi == 'Production'){
            $sn = 'PR'. date('Ymd') . 'E00' . rand(1,200);
        }else{
            $sn = 'HR'. date('Ymd') . 'E00' . rand(1,200);
        }
    }

    return [
        'nama_aset' => $faker->word(2),
        'serial_number' => $sn,
        'jenis' => $jenis,
        'merk' => $faker->word(),
        'deskripsi' => $faker->sentence(14),
        'divisi' => $divisi,
        'status' => $faker->randomElement(['baik', 'rusak']),
        'qr' => $qr,
        'gambar' => $jenis . '.jpg',
    ];
});
