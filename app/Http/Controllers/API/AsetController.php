<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aset;
use App\Http\Resources\AsetCollection;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    //index
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
        $asets = Aset::orderBy('created_at', 'DESC')->where('divisi',$divisi);
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

        if (request('gambar') !== null) {
            $explode = explode(',', request('gambar'));
            $gambar = base64_decode($explode[1]);

            if (str_contains($explode[0], 'png')) {
                $extension = 'png';
            }
            $path = public_path() . '\gambar\asets\\' . $random . '.' . $extension;

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
        ]);

        // Return pesan sukses
        return response()->json([
            'message' => 'Aset telah berhasil didaftarkan',
            'aset' => $aset,
        ]);
    }


    public function edit($id)
    {
        $aset = Aset::whereQr($id)->first();
        return response()->json(['status' => 'success', 'data' => $aset], 200);
    }

    public function update($id)
    {
        // Form Validasi
        request()->validate([
            'nama_aset' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
            'divisi' => 'required',
        ]);

        $data = [
            'nama_aset' => request('nama_aset'),
            'jenis' => request('jenis'),
            'merk' => request('merk'),
            'divisi' => request('divisi'),
        ];

        if (request('gambar') !== null) {
            $explode = explode(',', request('gambar'));
            $gambar = base64_decode($explode[1]);

            $extension = 'jpg';
            $path = public_path() . '\gambar\asets\\' . $id . '.' . $extension;

            file_put_contents($path, $gambar);
        }

        $aset = Aset::whereQr($id)->first();
        $aset->update($data);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function destroy($id)
    {
        $aset = Aset::find($id);
        if (file_exists(public_path('\gambar\asets\\' . $aset->gambar))) {
            unlink(public_path('\gambar\asets\\' . $aset->gambar));
        }
        $aset->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
