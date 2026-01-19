<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    protected $table = 'detail_penyewaan';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_penyewaan',
        'id_baju',
        'jumlah',
        'harga_sewa', 
        'subtotal',
    ];

    public function baju()
    {
        return $this->belongsTo(Baju::class, 'id_baju');
    }
}
