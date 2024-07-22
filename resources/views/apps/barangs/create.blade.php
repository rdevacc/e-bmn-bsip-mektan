@extends('apps.layouts.app')

@section('content')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title mr-4 pr-4">Tambah Data Barang</h4>
                    <form action="{{ route('barang-create-submit') }}" method="POST">
                        @csrf
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="jenis_id" class="col form-label">Jenis Barang</label>
                            </div>
                            <div class="col-7">
                                <select class="form-select @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis_id"
                                    required>
                                    <option selected disabled>Pilih Jenis Barang</option>
                                    @foreach ($jenis_barang as $jenis)
                                        @if (old('jenis_id') == $jenis->id)
                                            <option value="{{ $jenis->id }}" selected>{{ $jenis->nama }}</option>
                                        @else
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jenis_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="uraian_id" class="col form-label">Uraian Barang</label>
                            </div>
                            <div class="col-7">
                                <select class="form-select @error('uraian_id') is-invalid @enderror" name="uraian_id" id="uraian_id"
                                    required>
                                    <option selected disabled>Pilih Uraian Barang</option>
                                    @foreach ($uraian_barang as $uraian)
                                        @if (old('uraian_id') == $uraian->id)
                                            <option value="{{ $uraian->id }}" selected>{{ $uraian->nama }}</option>
                                        @else
                                            <option value="{{ $uraian->id }}">{{ $uraian->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('uraian_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="kode_barang" class="col-form-label">Kode Barang</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="kode_barang" name="kode_barang"
                                    class="form-control @error('kode_barang') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('kode_barang') }}" required>
                                @error('kode_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="nup" class="col-form-label">NUP</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="nup" name="nup"
                                    class="form-control @error('nup') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('nup') }}" required>
                                @error('nup')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="nama" class="col-form-label">Merk/Tipe</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="nama" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('nama') }}" required>
                                @error('nama')
                                    {{-- <span class="help-block text-danger fs-6">
                                            {{ $message }}
                                        </span> --}}
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="tahun" class="col-form-label">Tahun Perolehan</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="tahun" name="tahun"
                                    class="form-control @error('tahun') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('tahun') }}" required>
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="kuantitas" class="col-form-label">Kuantitas</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="kuantitas" name="kuantitas"
                                    class="form-control @error('kuantitas') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('kuantitas') }}" required>
                                @error('kuantitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="lokasi" class="col-form-label">Lokasi</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="lokasi" name="lokasi"
                                    class="form-control @error('lokasi') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('lokasi') }}" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="nilai" class="col-form-label">Nilai</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="nilai" name="nilai"
                                    class="form-control @error('nilai') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('nilai') ? formatRupiahAngka(old('nilai')) : '' }}" required>
                                @error('nilai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <label for="keterangan" class="col-form-label">Keterangan</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="keterangan" name="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror" autofocus
                                    autocomplete="off" value="{{ old('keterangan') }}" required>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="mt-5 mb-2 me-2 text-end">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#kode_barang').on('input', function() {
                $(this).val($(this).val().replace(/\D/g, ''));
                var amount = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
                if (amount.length > 0) {
                    amount = parseInt(amount, 10); // Convert to integer
                }
            });
            $('#nilai').on('input', function() {
                $(this).val($(this).val().replace(/\D/g, ''));
                var amount = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
                if (amount.length > 0) {
                    amount = parseInt(amount, 10); // Convert to integer
                    $(this).val(formatRupiah(amount)); // Format as Rupiah
                }
            });

            function formatRupiah(angka) {
                var number_string = angka.toString();
                var split = number_string.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }
        });
    </script>
@endpush