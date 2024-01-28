<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory;
    protected $table = 'data_atlet';

    protected $fillable = [
        'nama', 'bb', 'tb'
    ];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_guru');
    }
}
