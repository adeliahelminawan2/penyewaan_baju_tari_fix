<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaan';

    protected $primaryKey = 'id_penyewaan';

    protected $fillable = [
        'kode_sewa',
        'id_pelanggan',
        'tanggal_sewa',
        'tanggal_kembali_rencana',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function details()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_penyewaan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_penyewaan', 'id_penyewaan');
    }
}
