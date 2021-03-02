<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aset;
use App\JadwalScan;
use App\Scan;
use App\Http\Resources\ScanCollection;

class ScanController extends Controller
{
    // Cek detail pemindaian aset
    public function index($id)
    {

        $scan = Scan::join('asets', 'scans.id_aset', 'asets.id')
            ->select('scans.*', 'asets.nama_aset','asets.divisi', 'asets.status', 'asets.qr', 'asets.merk', 'asets.jenis', 'asets.gambar')
            ->where('scans.id_jadwal', $id)
            ->where('scans.status', 'telah discan')
            ->orderBy('scans.created_at', 'DESC');

        if (request()->q != '') {
            $scan = $scan->where('asets.nama_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('asets.qr', 'LIKE', '%' . request()->q . '%')
                ->orWhere('asets.merk', 'LIKE', '%' . request()->q . '%');
        }

        return new ScanCollection($scan->paginate(10));
    }

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

        if (request()->q != '') {
            $scan = $scan->where('asets.nama_aset', 'LIKE', '%' . request()->q . '%')
                ->orWhere('asets.qr', 'LIKE', '%' . request()->q . '%')
                ->orWhere('asets.merk', 'LIKE', '%' . request()->q . '%');
        }

        $res =  new ScanCollection($scan->paginate(10));

        return response()->json([
            'data_jadwal' => $jadwal,
            'data_scan' => $res,
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

        // check aset rusak atau tidak
        $aset = Aset::whereId(request('id_aset'))->first();

        // check aset telah di scan atau tidak
        $jml = Scan::whereId_jadwal(request('id_jadwal'))->whereId_aset(request('id_aset'))->count();

        if ($aset->status == 'rusak') {
            return response()->json([
                'message' => 'Anda tidak dapat scan aset yang rusak',
                'status' => 'error',
                'jml' => $jml
            ]);
        } else {
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
                    'scan' => $aset,
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
}
