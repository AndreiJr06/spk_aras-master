@extends('layouts.admin')

@section('content')
    <div class="container">
        @forelse ($items as $item)
            <div class="modal fade" id="tambahDataSubKriteria{{ $item->kode_kriteria }}" tabindex="-1" aria-labelledby="tambahDataKriteriaLabel"
            aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataKriteriaLabel">Tambah Data Sub Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('data-sub-kriteria') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label class="form-label" for="kode_kriteria">Nama Kriteria</label>
                                    <input type="hidden" class="form-control" id="kode_kriteria" name="kode_kriteria" value="{{ $item->kode_kriteria }}" readonly>
                                    <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="{{ $item->nama_kriteria }}" readonly>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label" for="nama_sub_kriteria">Nama Sub Kriteria</label>
                                    <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria" placeholder="Masukkan Nama Sub Kriteria">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty

        @endforelse

        <div class="modal fade" id="ubahDataSubKriteria" tabindex="-1" aria-labelledby="ubahDataKriteriaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahDataKriteriaLabel">Ubah Data Sub Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('data-sub-kriteria') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label class="form-label" for="kode_kriteria">Nama Kriteria</label>
                                <input type="hidden" class="form-control" id="kode_kriteria" name="kode_kriteria" readonly>
                                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label" for="nama_sub_kriteria">Nama Sub Kriteria</label>
                                <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria" placeholder="Masukkan Nama Sub Kriteria" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <h2 class="main-title my-auto">Data Sub Kriteria</h2>
            </div>
        </div>

        @forelse ($items as $item)
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="">Kriteria : {{ $item->nama_kriteria }}</h5>
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#tambahDataSubKriteria{{ $item->kode_kriteria }}">
                                Tambah
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-stripped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sub Kriteria</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($item->subkriteria as $sub)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $sub->nama_sub_kriteria }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm text-white"
                                                    onclick="fungsiEdit('{{ $sub->id }}|{{ $sub->kode_kriteria }}|{{ $sub->nama_sub_kriteria }}|{{ $sub->kriteria->nama_kriteria }}')"
                                                    data-bs-toggle="modal" data-bs-target="#ubahDataSubKriteria">
                                                    <i class="fa fa-edit">Edit</i>
                                                </button>
                                                <form action="{{ url('data-sub-kriteria/' . $sub->id) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                        <i class="fa fa-trash">Hapus</i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('nilai-sub-kriteria.show', $sub->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye">Lihat</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="row mt-3 justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>-- Data Kriteria Masih Kosong --</h5>
                        <a href="{{ route('data-kriteria.index') }}" class="btn btn-primary mt-2">Klik tombol ini untuk ke halaman kriteria</a>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    @endsection

    @section('script')
        <script>
            function fungsiEdit(data) {
                var data = data.split('|');
                $('#ubahDataSubKriteria form').attr('action', "{{ url('data-sub-kriteria') }}/" + data[0]);
                $('#ubahDataSubKriteria .modal-body #kode_kriteria').val(data[1]);
                $('#ubahDataSubKriteria .modal-body #nama_sub_kriteria').val(data[2]);
                $('#ubahDataSubKriteria .modal-body #nama_kriteria').val(data[3]);
                $('.selectpicker').selectpicker('refresh');
            }
        </script>
    @endsection
