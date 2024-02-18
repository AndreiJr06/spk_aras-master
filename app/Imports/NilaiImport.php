<?php

namespace App\Imports;

use App\Models\DataAtlet;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToCollection, WithHeadingRow
{

    protected $id_periode;

    public function __construct($id_periode)
    {
        $this->id_periode = $id_periode;
    }

    public function collection(Collection $rows)
    {
        $idperiode = $this->id_periode;
        $kriteria = Kriteria::all();

        foreach ($rows as $row) {
            $cekExist = DataAtlet::where('nama', $row['nama'])->first();

            if (empty($cekExist)) {
                $guru = DataAtlet::create([
                    'nama' => $row['nama'],
                ]);

                $id_atlet = $guru->id;

                $kriteria->each(function ($item) use ($row, $id_atlet, $idperiode) {
                    Nilai::updateOrCreate([
                        'id_atlet' => $id_atlet,
                        'id_kriteria' => $item->id,
                        'id_periode' => $idperiode,
                    ], [
                        'nilai' => $row[strtolower($item->kode_kriteria)],
                    ]);
                });

            } else {
                $id_atlet = $cekExist->id;

                $kriteria->each(function ($item) use ($row, $id_atlet, $idperiode) {
                    Nilai::updateOrCreate([
                        'id_atlet' => $id_atlet,
                        'id_kriteria' => $item->id,
                        'id_periode' => $idperiode,
                    ], [
                        'nilai' => $row[strtolower($item->kode_kriteria)],
                    ]);
                });
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
