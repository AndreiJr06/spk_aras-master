<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Kriteria;
use App\Models\Periode;

class PerangkinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all();

        return view('perangkingan', compact('periode'));
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

        $hasil_perhitungan = Hasil::where('id_periode', $periode_pilihan->id)
            ->orderBy('id_atlet', 'asc')
            ->get();

        $hasil_perangkingan = Hasil::where('id_periode', $periode_pilihan->id)
            ->orderBy('rank', 'asc')
            ->get();

        return view('perangkingan', compact('periode_pilihan', 'hasil_perangkingan', 'hasil_perhitungan'));
    }

	public function cetak($id)
	{
		$periode_pilihan = Periode::findOrFail($id);

		$items = Hasil::where('id_periode', $periode_pilihan->id)
            ->orderBy('rank', 'asc')
            ->get();

		return view('pdf', compact('items', 'periode_pilihan'));
	}
}
