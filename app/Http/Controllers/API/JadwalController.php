<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JadwalScan;
use App\Http\Resources\JadwalCollection;
use App\Scan;
use App\Aset;
use Illuminate\Support\Facades\Date;

class JadwalController extends Controller
{
    //index data jadwal yang belum berlalu
    public function index()
    {
        $jadwal = JadwalScan::orderBy('created_at', 'DESC')->where('tanggal', '>=', date('Y-m-d'));
        if (request()->q != '') {
            $jadwal = $jadwal->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('divisi', 'LIKE', '%' . request()->q . '%')
                ->orWhere('tanggal', 'LIKE', '%' . request()->q . '%');
        }
        return new JadwalCollection($jadwal->paginate(10));
    }

    //index data jadwal yang telah berlalu
    public function indexPast()
    {
        $jadwal = JadwalScan::orderBy('created_at', 'DESC')->where('tanggal', '<', date('Y-m-d'));
        if (request()->q != '') {
            $jadwal = $jadwal->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('divisi', 'LIKE', '%' . request()->q . '%')
                ->orWhere('tanggal', 'LIKE', '%' . request()->q . '%');
        }
        return new JadwalCollection($jadwal->paginate(10));
    }

    //index Divisi Hari ini
    public function indexDiv($divisi)
    {
        $jadwal = JadwalScan::orderBy('created_at', 'DESC')->where('divisi', $divisi)->where('tanggal', date('Y-m-d'));
        if (request()->q != '') {
            $jadwal = $jadwal->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('divisi', 'LIKE', '%' . request()->q . '%')
                ->orWhere('tanggal', 'LIKE', '%' . request()->q . '%')
                ->where('divisi', $divisi);
        }
        return new JadwalCollection($jadwal->paginate(10));
    }

    //index Divisi akan datang
    public function indexDivFuture($divisi)
    {
        $jadwal = JadwalScan::orderBy('created_at', 'DESC')->where('divisi', $divisi)->where('tanggal', '>',date('Y-m-d'));
        if (request()->q != '') {
            $jadwal = $jadwal->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('divisi', 'LIKE', '%' . request()->q . '%')
                ->orWhere('tanggal', 'LIKE', '%' . request()->q . '%')
                ->where('divisi', $divisi);
        }
        return new JadwalCollection($jadwal->paginate(10));
    }

    // index Divisi past
    public function indexDivPast($divisi)
    {
        $jadwal = JadwalScan::orderBy('created_at', 'DESC')->where('divisi', $divisi)->where('tanggal', '<',date('Y-m-d'));
        if (request()->q != '') {
            $jadwal = $jadwal->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('divisi', 'LIKE', '%' . request()->q . '%')
                ->orWhere('tanggal', 'LIKE', '%' . request()->q . '%')
                ->where('divisi', $divisi);
        }
        return new JadwalCollection($jadwal->paginate(10));
    }

    // simpan data
    public function store()
    {
        // Validasi
        request()->validate([
            'judul' => 'required',
            'divisi' => 'required',
            'tanggal' => 'required'
        ]);

        // parsing data
        $data = [
            'judul' => request('judul'),
            'divisi' => request('divisi'),
            'tanggal' => request('tanggal')
        ];

        // Insert Into database
        $jadwal = JadwalScan::create($data);

        // Return pesan sukses
        return response()->json([
            'message' => 'Jadwal Pemindaian Aset telah berhasil dibuat',
            'jadwal' => $data,
        ]);
    }

    // Delete data
    public function destroy($id)
    {
        $jadwal = JadwalScan::find($id);
        $jadwal->delete();
        return response()->json(['status' => 'success'], 200);
    }

    // cekJadwal Divisi
    public function checkDivisi($divisi)
    {
        $tgl = Date('Y-m-d');
        $jadwal = JadwalScan::where('divisi', $divisi);
        $jadwal = $jadwal->Where('tanggal', $tgl)->get();

        return response()->json([
            'divisi' => $divisi,
            'data' => $jadwal,
            'tanggal' => $tgl
        ]);
    }

    
}
