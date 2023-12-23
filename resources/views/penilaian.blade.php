@extends('layouts.app')

@section('content')
    @if (empty($periode_pilihan))
        <div class="container">
            <div class="row mb-3">
                <div class="col text-center">
                    <h2 class="my-auto">Periode Penilaian</h2>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                @forelse ($periode as $item)
                    <a href="{{ url('penilaian/' . $item->id) }}" class="text-decoration-none d-inline col-4 mb-3">
                        <div class="card">
                            <div class="card-body p-5 text-center">
                                <h5>{{ $item->nama_periode }}</h3>
                            </div>
                        </div>
                    </a>
                @empty
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body p-5 text-center">
                            <h5>Belum Ada Periode Aktif</h3>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    @else
        <div class="modal fade" id="tambahPenilaian" tabindex="-1" aria-labelledby="tambahPenilaianLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPenilaianLabel">Tambah Penilaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('penilaian') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id_periode" value="{{ $periode_pilihan->id }}">
                            <div class="form-group mb-2">
                                <label class="form-label" for="id_guru">Nama Guru</label>
                                <input class="form-control" list="nama_guru" placeholder="Ketik untuk mencari..."
                                    id="id_guru">
                                <datalist id="nama_guru">
                                    @foreach ($data_guru as $item)
                                        <option data-value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </datalist>
                                <input type="hidden" name="id_guru" id="id_guru-hidden">
                            </div>
                            @foreach ($kriteria as $item)
                                <div class="form-group mb-2">
                                    <label class="form-label font-weight-bold" for="nilai_bobot">{{ $item->nama_kriteria }} ({{ $item->kode_kriteria }})
                                    </label><br>
                                    <input type="hidden" name="id_kriteria[]" value="{{ $item->id }}">
                                    @forelse ($item->subkriteria as $item2)
                                        <label class="form-label" for="nilai_bobot">{{ $item2->nama_sub_kriteria }}
                                        <input type="hidden" name="id_sub_kriteria[]" value="{{ $item->id }}">
                                        <select name="nilai[]" id="nilai_bobot" class="form-control">
                                            <option hidden>-- Pilih Jawaban Anda --</option>
                                            @forelse ($item2->nilai as $item3)
                                            <option value="{{ $item3->nilai }}+{{ $item->id }}">{{ $item3->nama }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    @empty

                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="importNilai" tabindex="-1" aria-labelledby="importNilaiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importNilaiLabel">Import Penilaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('import-nilai') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id_periode" value="{{ $periode_pilihan->id }}">
                            <p class="mb-2">
                                <small>
                                    Download contoh template <a href="{{ url('template.xlsx') }}" class="">disini</a>
                                </small>
                            </p>
                            <div class="form-group mb-2">
                                <label class="form-label" for="nilai_bobot">File Excel</label>
                                <input type="file" class="form-control" name="file" id="file">
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

        <div class="modal fade" id="ubahPenilaian" tabindex="-1" aria-labelledby="ubahPenilaianLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahPenilaianLabel">Ubah Penilaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('penilaian') }}" method="POST" id="ubahPenilaianForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="id_periode" value="{{ $periode_pilihan->id }}">
                            <div class="form-group mb-2">
                                <label class="form-label" for="id_guru">Nama Atlet</label>
                                <select class="form-select" name="id_guru">
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="tampung">

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

        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <h2 class="main-title my-auto">Periode {{ $periode_pilihan->nama_periode }}</h2>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#tambahPenilaian">
                        Tambah
                    </button>

                    {{-- <button type="button" class="btn btn-success float-end me-3" data-bs-toggle="modal"
                        data-bs-target="#importNilai">
                        Import
                    </button> --}}
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
                                            <th class="text-center">Nama Atlet</th>
                                            @foreach ($kriteria as $item)
                                                <th class="text-center">{{ $item->kode_kriteria }}</th>
                                            @endforeach
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guru as $item)
                                            @if (isset($item->kriteria))
                                                <tr>
                                                    <td>{{ $item->nama }}</td>
                                                    @foreach ($item->kriteria as $kriteria)
                                                        <td>{{ $kriteria['nilai'] }}</td>
                                                    @endforeach
                                                    <td>
                                                        <form action="{{ url('penilaian/' . $item->id) }}"
                                                            class="d-inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id_periode"
                                                                value="{{ $periode_pilihan->id }}">


                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger btn-delete">
                                                                <i class="fa fa-trash">Hapus</i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        document.querySelector('input[list]').addEventListener('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
                inputValue = input.value;

            hiddenInput.value = inputValue;

            for (var i = 0; i < options.length; i++) {
                var option = options[i];

                if (option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
            }
        });
    </script>
@endsection
