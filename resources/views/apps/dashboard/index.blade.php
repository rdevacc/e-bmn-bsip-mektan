@extends('apps.layouts.app')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <!-- Total Barang Card -->
              <div class="col-xxl-3 col-xl-12">
                <div class="card info-card total-barang-card">  
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="{{route('barang-index')}}" style="text-decoration: none; color: black">Total Barang</a>
                    </h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-database"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $jumlahTotalBarang }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Total Kegiatan Card -->
  
              <!-- Total Barang BMN Card -->
              <div class="col-xxl-3 col-xl-12">
                <div class="card info-card sudah-dikerjakan-card">
                  <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{route('barang-index')}}" style="text-decoration: none; color: black">Barang BMN</a>
                      </h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-database-check"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalBmn }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Total Barang BMN Card -->
  
              <!-- Total Barang Royalti Card -->
              <div class="col-xxl-3 col-xl-12">
                <div class="card info-card sudah-dikerjakan-card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="{{route('barang-index')}}" style="text-decoration: none; color: black">Barang Royalti</a>
                    </h5>
                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-database-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalRoyalti }}</h6>
                    </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Total Barang Royalti Card -->
              
              <!-- Total Barang Inventaris Card -->
              <div class="col-xxl-3 col-xl-12">
                <div class="card info-card sudah-dikerjakan-card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="{{route('barang-index')}}" style="text-decoration: none; color: black">Barang Inventaris</a>
                    </h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-database-check"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalInventaris }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Total Barang Inventaris Card -->

              <!-- Total Barang Pribadi Card -->
              <div class="col-xxl-3 col-xl-12">
                <div class="card info-card sudah-dikerjakan-card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="{{route('barang-index')}}" style="text-decoration: none; color: black">Barang Pribadi</a>
                    </h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-database-check"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalPribadi }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Total Barang Pribadi Card -->
            </div>
          </div><!-- End Left side columns -->
        </div>

          <div class="row pb-4">
              <div class="col-lg-12">
                  <!-- Total Kegiatan Chart -->
                  <div class="p-6 m-20 bg-white rounded shadow">
                      {{-- {!! $chart->container() !!} --}}
                  </div>     
              </div>
          </div>
          
          <div class="row pb-4">
              <div class="col-lg-12">
                  <!-- Total Kegiatan Sudah Chart -->
                  <div class="p-6 m-20 bg-white rounded shadow">
                      {{-- {!! $chartSudahdanBelum->container() !!} --}}
                  </div>     
              </div>
          </div>
      </div>
    </section>
</main>
@endsection

@push('scripts')

    {{-- Script for call Charts --}}
    {{-- <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <script src="{{ $chartSudahdanBelum->cdn() }}"></script>
    {{ $chartSudahdanBelum->script() }} --}}

@endpush()