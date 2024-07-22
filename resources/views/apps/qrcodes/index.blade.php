@extends('apps.layouts.app')

@section('content')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Card Body -->
                    @if (session()->has('success'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h4 class="card-title mr-4 pr-4">Generate QR Code</h4>

                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <label for="jenis_filter" class="fw-semibold pb-1">Generate Berdasarkan Jenis</label>
                            <select class="form-select" id="jenis_filter" name="jenis_filter">
                                <option selected disabled>Pilih Jenis</option>
                                @foreach ($jenis_barang as $item )
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="uraian_filter" class="fw-semibold pb-1">Generate Berdasarkan Uraian</label>
                            <select class="form-select" id="uraian_filter" name="uraian_filter">
                                <option selected disabled>Pilih Uraian</option>
                                @foreach ($uraian_barang as $item )
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="#" class="btn btn-primary py-2 px-4">Generate QR Code</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body d-flex" id="qr-card">
                           <div class="row">
                               @foreach ($all_data as $item)
                                <div class="col-2">
                                    <div class="ms-2 mb-2">
                                        {{-- {!! QrCode::size(100)->generate('https://google.com') !!} --}}
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->merge('/public/admin/assets/img/logo-kementan.png')->errorCorrection('M')->generate('http://localhost:8000/app/bmn/qr-code/' . $item->id)) !!} ">
                                        <span>{{ $item->kode_barang }}</span>
                                    </div>
                                </div>
                                @endforeach
                                {{ $all_data->links() }}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endpush