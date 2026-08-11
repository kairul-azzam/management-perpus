<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $fillable = [
        'namakelas',
        'tingkat',
    ];

    public function siswa()
    {
        return $this->hasMany(siswa::class);
        //pakai hasmany karena satu kategori bisa memiliki banyak baku
    }
}
