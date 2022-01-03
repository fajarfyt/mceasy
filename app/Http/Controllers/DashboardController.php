<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\KaryawanModel;
use App\Models\TransCutiModel;

class DashboardController extends Controller
{
    public function index()
    {
        $jml_karyawan = count(KaryawanModel::all());
        $karyawan_cuti_hari_ini = count(TransCutiModel::where('tanggal_cuti', date('Y-m-d'))->get());

        $karyawan_terbaru = KaryawanModel::orderBy('tanggal_bergabung', 'DESC')->limit('3')->get();

        // dd($karyawan_terbaru);die();

        $datas = [
            'page' => 'Home',
            'jml_karyawan' => $jml_karyawan,
            'karyawan_cuti_hari_ini' => $karyawan_cuti_hari_ini,
            'karyawan_terbaru' => $karyawan_terbaru
        ];

        return view('Home', $datas);
    }

    public function KaryawanCuti()
    {
        $get = KaryawanModel::join('trans_cuti', 'trans_cuti.nomor_induk', '=', 'karyawan.nomor_induk')
                ->select('karyawan.nomor_induk','karyawan.nama','trans_cuti.tanggal_cuti','trans_cuti.keterangan')->get();

        //  dd($get);die();

        return $get;
    }

    public function KaryawanCutiLebih()
    {
        $get = KaryawanModel::join('trans_cuti', 'trans_cuti.nomor_induk', '=', 'karyawan.nomor_induk')
        ->whereIn('karyawan.nomor_induk', function($query){
            $query->select('nomor_induk')
            ->from('trans_cuti')
            ->groupBy('nomor_induk')
            ->havingRaw('count(nomor_induk) > 1');
        })
        ->select('karyawan.nomor_induk','karyawan.nama','trans_cuti.tanggal_cuti','trans_cuti.keterangan')
        ->get();

        //  dd($get);die();

        return $get;
    }

    public function SisaCuti()
    {
        $get = KaryawanModel::selectRaw('nomor_induk, nama, (12 - (select count(a.nomor_induk) from trans_cuti a where a.nomor_induk = karyawan.nomor_induk)) as sisa_cuti ')
        ->get();

        //  dd($get);die();

        return $get;
    }
}
