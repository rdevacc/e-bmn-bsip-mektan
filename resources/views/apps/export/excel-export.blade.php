<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-BMN | BSIP Mektan</title>
</head>
<body>
    <table class="table table-hover" id="barangTable">
        <thead>
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Jenis Barang</th>
            <th scope="col" class="text-center">Kode Barang</th>
            <th scope="col" class="text-center">Uraian Barang</th>
            <th scope="col" class="text-center">NUP</th>
            <th scope="col" class="text-center">Tahun Perolehan</th>
            <th scope="col" class="text-center">Merk/Tipe</th>
            <th scope="col" class="text-center">Kuantitas</th>
            <th scope="col" class="text-center">Lokasi</th>
            <th scope="col" class="text-center" >Nilai (Rp)</th>
            <th scope="col" class="text-center">Keterangan</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($dataExport as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->jenis->nama }}</td>
                    <td>{{ $data->kode_barang }}</td>
                    <td>{{ $data->uraian->nama }}</td>
                    <td>{{ $data->nup }}</td>
                    <td>{{ $data->tahun }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->kuantitas }}</td>
                    <td>{{ $data->lokasi }}</td>
                    <td>{{ $data->nilai }}</td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>                    
</body>
</html>