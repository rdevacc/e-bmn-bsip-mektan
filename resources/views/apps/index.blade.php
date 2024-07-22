<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BMN App | BSIP Mektan</title>

    <!-- Bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-body-secondary">
    <div class="container-xl d-flex justify-content-center py-2">
        <div class="card py-4" style="width: 90%;">
            <div class="card-body">
                <h5 class="card-title"><strong>Data BMN</strong></h5>
                <div class="row align-items-start px-3 pt-2">
                    <div class="col-6">
                        <p class="card-text">NUP</p>
                        <p class="card-text">Nama barang</p>
                        <p class="card-text">Jenis Barang</p>
                        <p class="card-text">Tahun</p>
                        <p class="card-text">Lokasi</p>
                        <p class="card-text">Keterangan</p>
                    </div>
                    <div class="col-6">
                        <p class="card-text">0123456789</p>
                        <p class="card-text">Laptop</p>
                        <p class="card-text">BMN</p>
                        <p class="card-text">2017</p>
                        <p class="card-text">Ruang Rapat</p>
                        <p class="card-text">Kondisi Baik</p>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col d-flex justify-content-center">
                        <img src="{{ asset("admin/assets/img/product-3.jpg") }}" class="img-fluid">
                    </div>
                </div>
        </div>
    </div>

    <!-- Bootstrap Script CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>