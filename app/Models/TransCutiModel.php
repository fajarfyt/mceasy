<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use App\Models\KaryawanModel;

class TransCutiModel extends Model
{
    // use HasFactory;
    const NOMOR_INDUK = 'nomor_induk';
    const TANGGAL_CUTI = 'tanggal_cuti';
    const ALAMAT = 'alamat';
    const LAMA_CUTI = 'lama_cuti';
    const KETERANGAN = 'keterangan';

    protected $table = 'trans_cuti';

    protected $fillable = [
        self::NOMOR_INDUK,
        self::TANGGAL_CUTI,
        self::ALAMAT,
        self::LAMA_CUTI,
        self::KETERANGAN
    ];

    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, TransCuti::NOMOR_INDUK);
    }

}
