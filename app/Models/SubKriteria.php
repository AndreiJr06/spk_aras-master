<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_sub_kriteria',
    ];

    public function kriteria()
    {
        return $this->hasOne(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
    }

    public function nilai()
    {
        return $this->hasMany(NilaiSubKriteria::class, 'sub_kriteria_id', 'id');
    }
}
