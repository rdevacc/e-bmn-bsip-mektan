<div class="d-flex">
    <a class="btn btn-info" href="{{ route('barang-show', $model->id) }}" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-custom-class="custom-tooltip" data-bs-title="Lihat Detail">
        <i class="bi bi-qr-code"></i>
        {{-- <i class="bi bi-eye"></i> --}}
    </a>
    {{-- @canany(['update-kegiatan'], $model) --}}
    <a class="btn btn-warning mx-1" href="{{ route('barang-edit', $model->id) }}" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Edit Pengaduan">
        <i class="bi bi-pencil"></i>
    </a>
    {{-- @endcan
    @canany(['delete-kegiatan'], $model) --}}
    <form action="{{ route('barang-delete', $model->id) }}" method="POST">
        @method('delete')
        @csrf
        <button class="btn btn-danger"
            onclick="return confirm('Apakah anda ingin menghapus data barang?')"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
            data-bs-title="Hapus Pengaduan" >
            <i class="bi bi-trash text-body-secondary"></i>
        </button>
    </form>
    {{-- @endcanany --}}
</div>
