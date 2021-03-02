<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aset;
use App\JadwalScan;
use App\Scan;

class ScanController extends Controller
{
    // Cek detail pemindaian aset
    public function detail($id)
    {

        $jadwal = JadwalScan::find($id);
        $div = $jadwal->divisi;
        $jml_aset = Aset::whereDivisi($div)->whereStatus('baik')->count();

        $scan = Scan::join('asets', 'scans.id_aset', 'asets.id')
            ->select('scans.*', 'asets.nama_aset', 'asets.qr', 'asets.merk', 'asets.jenis', 'asets.gambar')
            ->where('scans.id_jadwal', $id)
            ->where('scans.status', 'telah discan')
            ->orderBy('scans.created_at', 'DESC');

        return response()->json([
            'data_jadwal' => $jadwal,
            'data_scan' => $scan->get(),
            'telah_discan' => $scan->count(),
            'belum_discan' => ($jml_aset - $scan->count()),
            'jml_aset' => $jml_aset,
        ]);
    }

    // scan Aset
    public function store()
    {
        // validasi
        request()->validate([
            'id_jadwal' => 'required',
            'id_aset' => 'required'
        ]);

        // check aset telah di scan atau tidak
        $jml = Scan::whereId_jadwal(request('id_jadwal'))->whereId_aset(request('id_aset'))->count();

        if ($jml == 0) {
            // parsing data scan
            $scan = [
                'id_jadwal' => request('id_jadwal'),
                'id_aset' => request('id_aset'),
                'status' => 'telah discan'
            ];

            // insert ke table Scan
            Scan::create($scan);

            // Return pesan sukses
            return response()->json([
                'message' => 'Aset telah berhasil discan',
                'scan' => $scan,
                'status' => 'success',
                'jml' => $jml
            ]);
        } else {
            // Return pesan sukses
            return response()->json([
                'message' => 'Error! aset sudah pernah discan',
                'status' => 'error',
                'jml' => $jml
            ]);
        }
    }
}
