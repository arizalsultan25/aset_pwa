<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aset;
use App\Http\Resources\AsetCollection;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    //Tampil seluruh data aset
    public function index()
    {
        $asets = Aset::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $asets = $asets->where('nama_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('qr', 'LIKE', '%' . request()->q . '%')
                ->orWhere('merk', 'LIKE', '%' . request()->q . '%')
                ->orWhere('jenis', 'LIKE', '%' . request()->q . '%')
                ->orWhere('status', 'LIKE', '%' . request()->q . '%')
                ->orWhere('divisi', 'LIKE', '%' . request()->q . '%');
        }
        return new AsetCollection($asets->paginate(10));
    }

    //index data aset divisi
    public function index_div($divisi)
    {
        $asets = Aset::orderBy('created_at', 'DESC')->where('divisi', $divisi);
        if (request()->q != '') {
            $asets = $asets->where('nama_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('qr', 'LIKE', '%' . request()->q . '%')
                ->orWhere('merk', 'LIKE', '%' . request()->q . '%')
                ->orWhere('jenis', 'LIKE', '%' . request()->q . '%')
                ->orWhere('status', 'LIKE', '%' . request()->q . '%')
                ->where('divisi', '=', $divisi);
        }
        return new AsetCollection($asets->paginate(10));
    }

    // Simpan data aset
    public function store()
    {
        // Generate random string 16 digit
        $random = Str::random(16);
        $extension = 'jpg';

        // Form Validasi
        request()->validate([
            'nama_aset' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
            'divisi' => 'required',
            // 'gambar' => 'image'
        ]);

        // Jika ada upload gambar
        if (request('gambar') !== null) {
            $explode = explode(',', request('gambar'));
            $gambar = base64_decode($explode[1]);

            if (str_contains($explode[0], 'png')) {
                $extension = 'png';
            }
            // Letak file
            $path = public_path() . '\gambar\asets\\' . $random . '.' . $extension;

            // Pindahkan gambar ke directory yang ditentukan
            file_put_contents($path, $gambar);
        }

        // Insert into database
        $aset = Aset::create([
            'nama_aset' => request('nama_aset'),
            'jenis' => request('jenis'),
            'merk' => request('merk'),
            'deskripsi' => request('deskripsi'),
            'divisi' => request('divisi'),
            'qr' => $random,
            'gambar' => $random . '.' . $extension,
            'serial_number' => request('serial_number'),
        ]);

        // Return pesan sukses
        return response()->json([
            'message' => 'Aset telah berhasil didaftarkan',
            'aset' => $aset,
        ]);
    }


    // ambil data aset berdasarkan Kode QR
    public function edit($id)
    {
        $aset = Aset::whereQr($id)->first();
        return response()->json(['status' => 'success', 'data' => $aset], 200);
    }

    // Ubah data aset
    public function update($id)
    {
        // Form Validasi
        request()->validate([
            'nama_aset' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
            'divisi' => 'required',
        ]);

        // Parsing data aset
        $data = [
            'nama_aset' => request('nama_aset'),
            'jenis' => request('jenis'),
            'merk' => request('merk'),
            'divisi' => request('divisi'),
        ];

        // Jika ada gambar
        if (request('gambar') !== null) {
            $explode = explode(',', request('gambar'));
            $gambar = base64_decode($explode[1]);

            $extension = 'jpg';
            $path = public_path() . '\gambar\asets\\' . $id . '.' . $extension;

            file_put_contents($path, $gambar);
        }

        // Update data
        $aset = Aset::whereQr($id)->first();
        $aset->update($data);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    // Delete data
    public function destroy($id)
    {
        $aset = Aset::find($id);
        if (file_exists(public_path('\gambar\asets\\' . $aset->gambar))) {
            unlink(public_path('\gambar\asets\\' . $aset->gambar));
        }
        $aset->delete();
        return response()->json(['status' => 'success'], 200);
    }

    // Data untuk Dashboard Staf
    public function homeStaf($divisi)
    {
        $total = Aset::whereDivisi($divisi)->count();
        $ok = Aset::whereDivisi($divisi)->whereStatus('baik')->count();
        $rusak = Aset::whereDivisi($divisi)->whereStatus('rusak')->count();

        $elektronik = Aset::whereDivisi($divisi)->whereJenis('elektronik')->count();
        $furniture = Aset::whereDivisi($divisi)->whereJenis('furniture')->count();
        $kendaraan = Aset::whereDivisi($divisi)->whereJenis('kendaraan')->count();
        $dokumen = Aset::whereDivisi($divisi)->whereJenis('dokumen')->count();

        return response()->json([
            'jumlah' => [
                'total' => $total,
                'ok' => $ok,
                'rusak' => $rusak,
            ],

            'category' => [
                'elektronik' => $elektronik,
                'furniture' => $furniture,
                'kendaraan' => $kendaraan,
                'dokumen' => $dokumen,
            ],
        ]);
    }

    // Data Dashboard Admin
    public function home()
    {
        $total = Aset::count();
        $ok = Aset::whereStatus('baik')->count();
        $rusak = Aset::whereStatus('rusak')->count();

        $it = Aset::whereDivisi('IT Support')->count();
        $fin = Aset::whereDivisi('Finance')->count();
        $hr = Aset::whereDivisi('Human Resource')->count();
        $prod = Aset::whereDivisi('Production')->count();

        $elektronik = Aset::whereJenis('elektronik')->count();
        $furniture = Aset::whereJenis('furniture')->count();
        $kendaraan = Aset::whereJenis('kendaraan')->count();
        $dokumen = Aset::whereJenis('dokumen')->count();

        return response()->json([
            'jumlah' => [
                'total' => $total,
                'ok' => $ok,
                'rusak' => $rusak,
            ],

            'category' => [
                'elektronik' => $elektronik,
                'furniture' => $furniture,
                'kendaraan' => $kendaraan,
                'dokumen' => $dokumen,
            ],

            'divisi' => [
                'it' => $it,
                'fin' => $fin,
                'hr' => $hr,
                'prod' => $prod
            ],

            'total' => $total,
        ]);
    }
}
