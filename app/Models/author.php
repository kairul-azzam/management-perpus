<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    protected $fillable = [
        'nama_author',
    ];

    public function buku()
    {
        return $this->hasMany(buku::class);
        //pakai hasmany karena satu kategori bisa memiliki banyak baku
    }
}

