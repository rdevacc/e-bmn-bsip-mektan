@extends('apps.layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.css">
@endpush

@section('content')
<main id="main" class="main">
    <!-- Session Alert -->
    @if (session('success'))
        <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
            <div class="d-flex text-center align-middle">
                {{ session('success') }}
            </div>
            <div class="justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <label for="jenis_filter" class="fw-semibold pb-1">Cari Berdasarkan Jenis</label>
                            <select class="form-select" id="jenis_filter" name="jenis_filter">
                                <option selected disabled>Cari Jenis</option>
                                @foreach ($jenis_barang as $item )
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="uraian_filter" class="fw-semibold pb-1">Cari Berdasarkan Uraian</label>
                            <select class="form-select" id="uraian_filter" name="uraian_filter">
                                <option selected disabled>Cari Uraian</option>
                                @foreach ($uraian_barang as $item )
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="d-flex">
                            <div class="me-1">
                                <a href="{{ route('barang-create') }}" class="btn btn-primary">Tambah</a>
                            </div>
                            <div class="me-1">
                                <form action="{{ route('export.excel') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Excel</button>
                                    <input type="hidden" name="export_by_jenis" id="export_by_jenis" value="">
                                    <input type="hidden" name="export_by_uraian" id="export_by_uraian" value="">
                                    <input type="hidden" name="export_by_search" id="export_by_search" value="">
                                </form>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-warning" id="resetFilter">Reset Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            </tbody>
                        </table>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function(){
            // First state for load data
            $('#jenis_filter option').prop("selected", function () {
              // return defaultSelected property of the option
              return this.defaultSelected;
            });
            $('#uraian_filter option').prop("selected", function () {
              // return defaultSelected property of the option
              return this.defaultSelected;
            });

            var jenis_id = '';
            var uraian_id ='';
            var export_by_jenis = $('#export_by_jenis').val('');
            var export_by_uraian = $('#export_by_uraian').val('');
            var export_by_search = $('#export_by_search').val('');

            
            load_data(jenis_id, uraian_id);
            
            // Jenis Filter
            $('#jenis_filter').change(function(){
                $('#barangTable').DataTable().destroy();
                jenis_id = $('#jenis_filter').val();
                uraian_id = $('#uraian_filter').val();
                export_by_jenis = $('#export_by_jenis').val(jenis_id);
                load_data(jenis_id, uraian_id);
            });

            // Uraian Filter
            $('#uraian_filter').change(function(){
                $('#barangTable').DataTable().destroy();
                jenis_id = $('#jenis_filter').val();
                uraian_id = $('#uraian_filter').val();   
                export_by_uraian = $('#export_by_uraian').val(uraian_id);
                load_data(jenis_id, uraian_id);
            });

            // Search Filter
            $('#dt-search-0').keyup(function(){
                var s = $('#dt-search-0').val();
                export_by_search = $('#export_by_search').val(s)
                // load_data();
            });

            function load_data(jenis_id, uraian_id){
                var table = $('#barangTable').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('barang-index') }}",
                        data: function(data){
                            data.jenis_id = jenis_id;
                            data.uraian_id = uraian_id;
                        }
                    },
                    pageLength: 25,
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            width: '10px',
                            orderable: false,
                            searchable: false,
                            targets: 0,
                        },
                        {
                            data: 'jenis_id',
                            name: 'jenis_id'
                        },
                        {
                            data: 'kode_barang',
                            name: 'kode_barang'
                        },
                        {
                            data: 'uraian_id',
                            name: 'uraian_id'
                        },
                        {
                            data: 'nup',
                            name: 'nup'
                        },
                        {
                            data: 'tahun',
                            name: 'tahun'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'kuantitas',
                            name: 'kuantitas'
                        },
                        {
                            data: 'lokasi',
                            name: 'lokasi'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    order: [
                        // [11, 'desc'],   
                        [5, 'asc'],   
                    ]
                });
                console.log(jenis_id);
                console.log(uraian_id);
            };

            $('#resetFilter').click(function(){
                // First state for load data
                $('#jenis_filter option').prop("selected", function () {
                // return defaultSelected property of the option
                return this.defaultSelected;
                });
                $('#uraian_filter option').prop("selected", function () {
                // return defaultSelected property of the option
                return this.defaultSelected;
                });

                $('#dt-search-0').val(null);

                var jenis_id = '';
                var uraian_id = '';
                var export_by_jenis = $('#export_by_jenis').val('');
                var export_by_uraian = $('#export_by_uraian').val('');
                var export_by_search = $('#export_by_search').val('');

                console.log(jenis_id);
                console.log(uraian_id);

                $('#barangTable').DataTable().destroy();
                load_data(jenis_id, uraian_id);
            });
        });
    </script>
@endpush