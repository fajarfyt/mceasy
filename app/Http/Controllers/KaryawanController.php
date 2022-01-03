<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\KaryawanModel;
use App\Models\TransCutiModel;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    public function index()
    {
        $datas = [
            'page' => 'Karyawan'
        ];
        return view('master_karyawan', $datas);
    }

    public function getById($nomor_induk)
    {
        $get = KaryawanModel::where('nomor_induk', $nomor_induk)->get();
        return $get;
    }

    public function get()
    {
        $get = KaryawanModel::orderBy('nomor_induk','DESC');

        return DataTables::of($get)
                ->addColumn('aksi', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->nomor_induk.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEmployee">Edit</a>
                             <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->nomor_induk.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteEmployee">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function save(Request $request)
    {
        $datas = KaryawanModel::updateOrCreate([
            'nomor_induk' => ($request->nomor_induk) ? $request->nomor_induk : KaryawanModel::generate_nomor_induk()
        ],[
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_bergabung' => $request->tanggal_bergabung
        ]);

        return response()->json(
            [
                'status'    => true,
                'message'   => "Data Berhasil Disimpan!",
                'data'    => $datas
            ]
        );
    }

    public function delete($nomor_induk)
    {

        $data = KaryawanModel::where('nomor_induk',$nomor_induk)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Terhapus',
            'data' => $data,
        ]);

    }
}
