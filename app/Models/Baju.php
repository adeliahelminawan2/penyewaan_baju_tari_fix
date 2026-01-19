<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    use HasFactory;

    protected $table = 'baju';

    protected $primaryKey = 'id_baju';

    protected $fillable = [
        'nama_baju',
        'stok',
        'harga_sewa',
        'foto',
    ];

   
    public function details()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_baju', 'id_baju');
    }
}
