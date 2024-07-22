@extends('apps.layouts.app')

@section('content')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title mr-4 pr-4">Detail data barang</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="barangTable">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Jenis Barang</th>
                                                <th scope="col" class="text-center">Kode Barang</th>
                                                <th scope="col" class="text-center" style="width: 10%">Uraian Barang</th>
                                                <th scope="col" class="text-center">NUP</th>
                                                <th scope="col" class="text-center" style="width: 5%">Tahun Perolehan</th>
                                                <th scope="col" class="text-center" style="width: 10%">Merk/Tipe</th>
                                                <th scope="col" class="text-center">Kuantitas</th>
                                                <th scope="col" class="text-center">Lokasi</th>
                                                <th scope="col" class="text-center" >Nilai (Rp)</th>
                                                <th scope="col" class="text-center">Keterangan</th>
                                                <th scope="col" class="text-center">Tanggal Pembuatan</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $dataShow->jenis->nama }}</td>
                                                    <td>{{ $dataShow->kode_barang }}</td>
                                                    <td>{{ $dataShow->uraian->nama }}</td>
                                                    <td>{{ $dataShow->nup }}</td>
                                                    <td>{{ $dataShow->tahun }}</td>
                                                    <td>{{ $dataShow->nama }}</td>
                                                    <td>{{ $dataShow->kuantitas }}</td>
                                                    <td>{{ $dataShow->lokasi }}</td>
                                                    <td>{{ formatRupiahAngka($dataShow->nilai) }}</td>
                                                    <td>{{ $dataShow->keterangan }}</td>
                                                    <td>{{ $localDateTime }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            {{-- @canany(['update-kegiatan'], $dataShow) --}}
                                                            <a class="btn btn-warning mx-1" href="{{ route('barang-edit', $dataShow->id) }}" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Edit Pengaduan">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            {{-- @endcan
                                                            @canany(['delete-kegiatan'], $dataShow) --}}
                                                            <form action="{{ route('barang-delete', $dataShow->id) }}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-danger"
                                                                    onclick="return confirm('Apakah anda ingin menghapus pengaduan?')"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Hapus Pengaduan" >
                                                                    <i class="bi bi-trash text-body-secondary"></i>
                                                                </button>
                                                            </form>
                                                            {{-- @endcanany --}}
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-end mb-2">
                                        <form method="POST" action="{{ route('qrcode-generate') }}">
                                            @csrf
                                            <input type="hidden" name="qr_data_id" id="qr_data_id" value="{{ $dataShow->id}} ">
                                            <button type="submit" class="btn btn-success" id="generate_qr">Cetak QR Code</button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex text-center justify-content-center">
                                                <img width="200" height="200" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->merge('/public/admin/assets/img/logo-kementan.png')->errorCorrection('M')->generate(Request::root() . '/app/bmn/get-data/' . $dataShow->id)) !!} ">                                            
                                            </div>
                                            <div class="text-center">
                                                <p class="mb-0"><b>BBPSI Mektan</b></p>                                            
                                                <p class="mb-0"><b>{{ $dataShow->nama }}</b></p>                                            
                                                <p class="mb-0"><b>{{ $dataShow->kode_barang }}</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    {{-- <script>
        $(document).ready(function(){
            $('#generate_qr').on("click", function(){
                var url = window.location.href;
                $("#qr_data").val(url);
            })
        });
    </script> --}}
@endpush