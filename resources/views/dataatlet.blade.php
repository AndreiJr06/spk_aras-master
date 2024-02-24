@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="modal fade" id="tambahDataAtlet" tabindex="-1" aria-labelledby="tambahDataAtletLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataAtletLabel">Tambah Data Atlet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('data-guru') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Atlet">
                            </div>
														<div class="form-group mb-2">
															<label for="bb">Berat Badan <sup>kg</sup></label>
															<input type="number" class="form-control" id="bb" name="bb" placeholder="Masukkan Berat Badan Atlet">
														</div>
														<div class="form-group mb-2">
															<label for="tb">Tinggi Badan <sup>cm</sup></label>
															<input type="number" class="form-control" id="tb" name="tb" placeholder="Masukkan Tinggi Badan Atlet">
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

        <div class="modal fade" id="ubahDataAtlet" tabindex="-1" aria-labelledby="ubahDataAtletLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahDataAtletLabel">Ubah Data Atlet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('data-guru') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Atlet">
                            </div>
														<div class="form-group mb-2">
															<label for="bb">Berat Badan <sup>kg</sup></label>
															<input type="number" class="form-control" id="bb" name="bb" placeholder="Masukkan Berat Badan Atlet">
														</div>
														<div class="form-group mb-2">
															<label for="tb">Tinggi Badan <sup>cm</sup></label>
															<input type="number" class="form-control" id="tb" name="tb" placeholder="Masukkan Tinggi Badan Atlet">
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
                <h2 class="main-title my-auto">Data Atlet</h2>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#tambahDataAtlet">
                    Tambah
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-stripped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tinggi Badan</th>
                                        <th>Berat Badan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $datas)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $datas->nama }}</td>
                                            <td>{{ $datas->tb }} cm</td>
                                            <td>{{ $datas->bb }} kg</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm text-white"
                                                    onclick="fungsiEdit('{{ $datas->id }}|{{ $datas->nama }}|{{ $datas->bb }}|{{ $datas->tb }}')"
                                                    data-bs-toggle="modal" data-bs-target="#ubahDataAtlet">
                                                    <i class="fa fa-edit">Edit</i>
                                                </button>

                                                <form action="{{ url('data-guru/' . $datas->id) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                        <i class="fa fa-trash">Hapus</i>
                                                    </button>
                                                </form>
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
    @endsection

    @section('script')
        <script>
            function fungsiEdit(data) {
                var data = data.split('|');
                console.log(data);
                $('#ubahDataAtlet form').attr('action', "{{ url('data-guru') }}/" + data[0]);
                $('#ubahDataAtlet .modal-body #nama').val(data[1]);
                $('#ubahDataAtlet .modal-body #bb').val(data[2]);
                $('#ubahDataAtlet .modal-body #tb').val(data[3]);
                $('.selectpicker').selectpicker('refresh');
            }
        </script>
    @endsection
