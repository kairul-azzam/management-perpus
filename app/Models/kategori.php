<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $fillable = [
        'nama_kategori',
        
    ];

    public function buku()
    {
        return $this->hasMany(buku::class, 'kategori_id');
        //pakai hasmany karena satu kategori bisa memiliki banyak baku
    }
}
