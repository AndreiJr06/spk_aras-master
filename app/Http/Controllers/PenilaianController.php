<?php

namespace App\Http\Controllers;

use App\Imports\NilaiImport;
use App\Models\DataAtlet;
use App\Models\Kriteria;
use App\Models\Nilai;
use App\Models\Periode;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all();
        $data_atlet = DataAtlet::all();

        return view('penilaian', compact('periode', 'data_atlet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_atlet = $request->id_atlet;
        $id_periode = $request->id_periode;

        // $id = array();

        // foreach ($request->nilai as $key => $value) {
        //     $a = explode('+', $value);

        //     if (!in_array($a[1], $id)) {
        //         $id[] =
        //     }

        //     dd($a[0]);
        // }

        // foreach ($request->id_kriteria as $key => $id_kriteria) {
        //     $nilai = $request->nilai[$key];

        //     $data = [
        //         'id_atlet' => $id_atlet,
        //         'id_periode' => $id_periode,
        //         'id_kriteria' => $id_kriteria,
        //         'nilai' => (float) $nilai[$key],
        //     ];

        //     $insert[] = $data;
        // }

        $nilaiCount = [];

        foreach ($request->nilai as $nilai) {
            $nilaiParts = explode('+', $nilai);
            $nilaiValue = (float) $nilaiParts[0]; // Mengubah nilai menjadi float atau integer
            $nilaiId = $nilaiParts[1]; // ID kriteria

            // Inisialisasi nilai count jika belum ada
            if (!isset($nilaiCount[$nilaiId])) {
                $nilaiCount[$nilaiId] = 0;
            }

            // Menambahkan nilai ke ID kriteria yang sesuai
            $nilaiCount[$nilaiId] += $nilaiValue;
        }

        foreach ($request->id_kriteria as $key => $id_kriteria) {
            $nilai = $nilaiCount[$id_kriteria];

            $data = [
                'id_atlet' => $id_atlet,
                'id_periode' => $id_periode,
                'id_kriteria' => $id_kriteria,
                'nilai' => (float) $nilai,
            ];

            $insert[] = $data;
        }

        Nilai::insert($insert);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periode_pilihan = Periode::findOrFail($id);

        $kriteria = Kriteria::all();
        $guru = DataAtlet::whereIn('id', function ($query) use ($id) {
            $query->select('id_atlet')->from('nilai')->where('id_periode', $id);
        })->get();

        $data_guru = DataAtlet::whereNotIn('id', function ($query) use ($id) {
            $query->select('id_atlet')->from('nilai')->where('id_periode', $id);
        })->get();

        $guru->each(function ($item) use ($kriteria, $periode_pilihan) {
            $item->kriteria = $kriteria->map(function ($kriteria) use ($item, $periode_pilihan) {
                $nilai = Nilai::where('id_atlet', $item->id)
                    ->where('id_kriteria', $kriteria->id)
                    ->where('id_periode', $periode_pilihan->id)
                    ->first();

                if (!empty($nilai)) {
                    return [
                        'id' => $kriteria->id,
                        'nama_kriteria' => $kriteria->nama_kriteria,
                        'nilai' => $nilai->nilai,
                    ];
                }
            });
        });

        return view('penilaian', compact('periode_pilihan', 'kriteria', 'guru', 'data_guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guru = DataAtlet::findOrFail($id);

        foreach ($request->id_kriteria as $key => $id_kriteria) {
            $nilai = $request->nilai[$key];

            Nilai::updateOrCreate(
                [
                    'id_atlet' => $guru->id,
                    'id_periode' => $request->id_periode,
                    'id_kriteria' => $id_kriteria,
                ],
                [
                    'nilai' => is_null($nilai) ? 0 : (float) $nilai,
                ]
            );
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $guru = DataAtlet::findOrFail($id);

        Nilai::where('id_atlet', $guru->id)
            ->where('id_periode', $request->id_periode)
            ->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');

        return back();
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
            'id_periode' => 'required',
        ]);

        $file = $request->file('file');
        $id_periode = $request->id_periode;

        Excel::import(new NilaiImport($id_periode), $file);

        Alert::success('Berhasil', 'Data Berhasil Diimport');

        return back();
    }
}
