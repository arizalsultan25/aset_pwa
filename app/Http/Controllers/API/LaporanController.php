<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Laporan;
use App\Http\Resources\LaporanCollection;

class LaporanController extends Controller
{
    //index
    public function index()
    {
        $laporan = Laporan::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $laporan = $laporan->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('detail', 'LIKE', '%' . request()->q . '%')
                ->orWhere('status', 'LIKE', '%' . request()->q . '%');
        }
        return new LaporanCollection($laporan->paginate(10));
    }

    public function indexDiv($divisi)
    {
        $laporan = Laporan::orderBy('created_at', 'DESC')->where('divisi', $divisi);
        if (request()->q != '') {
            $laporan = $laporan->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('detail', 'LIKE', '%' . request()->q . '%')
                ->orWhere('status', 'LIKE', '%' . request()->q . '%')
                ->andWhere('divisi', $divisi);
        }
        return new LaporanCollection($laporan->paginate(10));
    }

    public function store()
    {
        // Form Validasi
        request()->validate([
            'id' => 'required',
            // 'judul' => 'required',
            // 'gambar' => 'image'
        ]);

        $extension = 'jpg';
        if (request('gambar') !== null) {
            $explode = explode(',', request('gambar'));
            $gambar = base64_decode($explode[1]);

            
            $path = public_path() . '\gambar\laporan\\' . request('qr') . '.' . $extension;
            file_put_contents($path, $gambar);
        }

        // Insert into database
        $laporan = Laporan::create([
            'id_aset' => request('id'),
            'divisi' => request('divisi'),
            'judul' => request('judul'),
            'detail' => request('detail_laporan'),
            'gambar' => request('qr') . '.' . $extension,
        ]);

        // Return pesan sukses
        return response()->json([
            'message' => 'Aset telah berhasil dilaporkan',
            'data' => $laporan,
        ]);
    }
}
