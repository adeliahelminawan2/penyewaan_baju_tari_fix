<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaan';

    protected $primaryKey = 'id_penyewaan';

    protected $fillable = [
        'kode_sewa',
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'jaminan',
        'foto_identitas',
        'tanggal_sewa',
        'tanggal_kembali_rencana',
        'total_harga',
        'total_bayar',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_penyewaan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_penyewaan', 'id_penyewaan');
    }
}
