<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';

    protected $guraded = [
        'id',
    ];

    public function bobot()
    {
        return $this->hasOne(Bobot::class, 'id_kriteria');
    }

    public function subkriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
