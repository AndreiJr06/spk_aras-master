<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Kriteria::all();

        return view('subkriteria', compact('items'));
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
        //
        request()->validate([
            'kode_kriteria' => 'required',
            'nama_sub_kriteria' => 'required',
            'nilai' => 'required',
        ]);

        $sub_kriteria = new SubKriteria();
        $sub_kriteria->kode_kriteria = $request->kode_kriteria;
        $sub_kriteria->nama_sub_kriteria = $request->nama_sub_kriteria;
        $sub_kriteria->nilai = $request->nilai;
        $sub_kriteria->save();

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
        //
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
        request()->validate([
            'kode_kriteria' => 'required',
            'nama_sub_kriteria' => 'required',
            'nilai' => 'required',
        ]);

        $sub_kriteria = SubKriteria::findOrFail($id);
        $sub_kriteria->kode_kriteria = $request->kode_kriteria;
        $sub_kriteria->nama_sub_kriteria = $request->nama_sub_kriteria;
        $sub_kriteria->nilai = $request->nilai;
        $sub_kriteria->save();

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_kriteria = SubKriteria::findOrFail($id);
        $sub_kriteria->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return back();
    }
}
