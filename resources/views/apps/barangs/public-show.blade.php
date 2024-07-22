<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-BMN | BPSI Mektan</title>
    <!-- Favicons -->
    <link href="{{ asset('admin/assets/img/logo-kementan.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        @media (max-width: 500px) {
            #card-barang{
                width: 20rem;
            }
        }

        @media (min-width: 501px) {
            #card-barang{
                width: 30rem;
            }
        }
    </style>

  </head>
  <body>
    <div class="container py-3">
      <div class="row pb-2">
          <div class="col d-flex align-items-center justify-content-center">
            <img width="40" height="40" src="{{asset('admin/assets/img/logo-kementan.png')}}" alt="Logo Kementan">
            <h1 class="fw-semibold">E-BMN BBPSI Mektan</h1>
          </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card mx-auto" id="card-barang">
            <img src="{{ asset('admin/assets/img/product-2.jpg') }}" class="card-img-top" alt="">
            <div class="card-body">
            <div class="row" id="title">
              <div class="col">
                <p style="margin-bottom: 0"><strong class="fs-4">{{ $data->nama }}</strong></p>
                <p>Rp.{{ formatRupiahAngka($data->nilai) }}</p>
              </div>
            </div>
            <div class="row">
               <div class="col-sm-4">
                  <small>
                    <b>Jenis Barang</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->jenis->nama}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>Uraian Barang</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->uraian->nama}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>Kode Barang</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->kode_barang}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>Tahun Perolehan</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->tahun}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>NUP</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->nup}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>Kuantitas Barang</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->kuantitas}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>Lokasi Barang</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->lokasi}}
                  </small>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <small>
                    <b>Keterangan</b>
                  </small>
                </div>
                <div class="col">
                  <small>
                    {{$data->keterangan}}
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>