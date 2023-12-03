<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSubKriteria extends Model
{
    use HasFactory;

    protected $table = 'nilai_sub_kriteria';

    protected $fillable = [
        'sub_kriteria_id',
        'nama',
        'nilai',
    ];

    public function sub_kriteria()
    {
        return $this->hasOne(SubKriteria::class, 'kode_sub_kriteria', 'kode_sub_kriteria');
    }
}
