<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Laporan;
use App\Aset;
use App\Http\Resources\LaporanCollection;

class LaporanController extends Controller
{
    //index
    public function index()
    {
        $laporan = Laporan::join('asets', 'laporans.id_aset', '=', 'asets.id')
            ->select('laporans.*', 'asets.nama_aset', 'asets.qr', 'asets.merk', 'asets.jenis')
            ->orderBy('laporans.updated_at', 'DESC');
        if (request()->q != '') {
            $laporan = $laporan->where('laporans.id', 'LIKE', '%' . request()->q . '%')
                ->orWhere('laporans.id_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('asets.nama_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('laporans.divisi', 'LIKE', '%' . request()->q . '%')
                ->orWhere('asets.jenis', 'LIKE', '%' . request()->q . '%');
        }
        return new LaporanCollection($laporan->paginate(10));
    }

    public function indexDiv($divisi)
    {
        $laporan = Laporan::join('asets', 'laporans.id_aset', '=', 'asets.id')
            ->select('laporans.*', 'asets.nama_aset', 'asets.qr', 'asets.merk', 'asets.jenis')
            ->orderBy('laporans.updated_at', 'DESC')
            ->where('laporans.divisi', $divisi);
        if (request()->q != '') {
            $laporan = $laporan->where('laporans.id', 'LIKE', '%' . request()->q . '%')
                
                ->orWhere('laporans.id_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('laporans.judul', 'LIKE', '%' . request()->q . '%')
                ->where('laporans.divisi', $divisi);
                
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

    public function edit($id)
    {
        $report = Laporan::join('asets', 'laporans.id_aset', '=', 'asets.id')
            ->select('laporans.*', 'asets.nama_aset', 'asets.qr', 'asets.merk', 'asets.jenis')
            ->orderBy('laporans.created_at', 'DESC')
            ->where('laporans.id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $report], 200);
    }

    public function update($id)
    {
        // parsing data
        $data = [
            'status' => request('status'),
            'keterangan' => request('keterangan')
        ];

        // update
        $report = Laporan::whereId($id);
        $report->update($data);

        $q = Laporan::whereId($id)->get();
        $id_aset = $q[0]->id_aset;
        if (request('status') == 'diterima') {
            // Update status aset menjadi rusak
            $aset = Aset::whereId($id_aset);
            $aset->update([
                'status' => 'rusak'
            ]);
        }

        // Return pesan sukses
        return response()->json([
            'message' => 'Data laporan telah berhasil ditanggapi',
            'data' => $report,
        ]);
    }
}
