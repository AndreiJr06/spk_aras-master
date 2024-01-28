<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataGuru;
use App\Models\Hasil;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\SubKriteria;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	function dashboard() : View {
		$atlet = DataGuru::count();
		$kriteria = Kriteria::count();
		$subkriteria = SubKriteria::count();
		$periode = Periode::count();

		return view('dashboard', compact('atlet', 'kriteria', 'subkriteria', 'periode'));
	}
	function home() : View {
		$periode = Periode::where('nama_periode', Carbon::now()->year)->first();
		$tahunPeriode = Periode::all();

		if ($periode) {
			$items = Hasil::where('id_periode', $periode->id)->orderBy('rank', 'ASC')->get();
			$tahun = Carbon::now()->year;
		} else {			
			$tahun = Periode::orderBy('nama_periode', 'ASC')->first();
			if ($tahun) {
				$items = NULL;
				$tahun = $tahun->nama_periode;
			} else {
				$items = NULL;
				$tahun = NULL;
			}
		}    
    return view('layouts.home', compact('items', 'tahunPeriode', 'tahun'));
	}

	function tahun($tahun) : View {
		$periode = Periode::where('nama_periode', $tahun)->first();
		$tahunPeriode = Periode::all();

		if ($periode) {
			$items = Hasil::where('id_periode', $periode->id)->orderBy('rank', 'ASC')->get();
		} else {
			$items = NULL;
		}    

		return view('layouts.home', compact('items', 'tahunPeriode', 'tahun'));
	}
}
