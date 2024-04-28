@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Selamat Datang di Sistem Pemilihan Atlet Gulat PraPON Terbaik PPLP Provinsi Bengkulu
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card text-bg-primary">
                    <h5 class="card-header">Atlet</h5>
                    <div class="card-body">
                        <p class="card-text">Total : {{ $atlet }} orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card text-bg-secondary">
                    <h5 class="card-header">Kriteria</h5>
                    <div class="card-body">
                        <p class="card-text">Jumlah : {{ $kriteria }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card text-bg-warning">
                    <h5 class="card-header text-white">Sub Kriteria</h5>
                    <div class="card-body">
                        <p class="card-text text-white">Jumlah : {{ $subkriteria }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card text-bg-danger">
                    <h5 class="card-header">Periode</h5>
                    <div class="card-body">
                        <p class="card-text">Jumlah : {{ $periode }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
