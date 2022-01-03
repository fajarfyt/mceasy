<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class KaryawanModel extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'nomor_induk';
    public $incrementing = false;
    protected $keyType = 'string';
    // use HasFactory;
    const NOMOR_INDUK = 'nomor_induk';
    const NAMA = 'nama';
    const ALAMAT = 'alamat';
    const TANGGAL_LAHIR = 'tanggal_lahir';
    const TANGGAL_BERGABUNG = 'tanggal_bergabung';

    protected $table = 'karyawan';

    protected $fillable = [
        self::NOMOR_INDUK,
        self::NAMA,
        self::ALAMAT,
        self::TANGGAL_LAHIR,
        self::TANGGAL_BERGABUNG
    ];

    public static function generate_nomor_induk()
    {
        $kode       = 'IP06';
        $cur_max    = KaryawanModel::whereNotNull('nomor_induk');
        $padding    = 3;
        $max        = $cur_max->count() ? (int) $cur_max->max(DB::raw("REPLACE(nomor_induk,'{$kode}','')")) : 0;
        $new_code   = $max + 1;
        $new_padd   = strlen($new_code) <= $padding ? $padding : strlen($new_code);
        return $kode . str_pad($new_code, $new_padd, '0', STR_PAD_LEFT);
    }
}
