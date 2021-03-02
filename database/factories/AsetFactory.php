<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aset;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Aset::class, function (Faker $faker) {
    $qr = Str::random(16);
    $jenis = $faker->randomElement(['Elektronik', 'Dokumen', 'Furnitur', 'Kendaraan']); 

    return [
        'nama_aset' => $faker->word(2),
        'jenis' => $jenis,
        'merk' => $faker->word(),
        'deskripsi' => $faker->sentence(14),
        'divisi' => $faker->randomElement(['IT Support', 'Finance', 'Production', 'Human Resource']),
        'status' => $faker->randomElement(['baik', 'rusak']),
        'qr' => $qr,
        'gambar' => $jenis . '.jpg',
    ];
});
