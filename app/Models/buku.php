<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $fillable = [
        'judul_buku',
        'author_id',
        'kategori_id',
        'stock',
        
    ];

    public function author()
    {
        return $this->belongsTo(author::class);
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
}
