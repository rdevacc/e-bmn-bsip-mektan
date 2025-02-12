@extends('apps.layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Card Body -->
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
                        <h4 class="card-title mr-4 pr-4">Data Users / PJ</h4>
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('user-create') }}" class="btn btn-primary py-2 px-4">Tambah
                                User</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Auth::user()->id == 1)
                                    @foreach ($dataAdminUsers as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->nama }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-warning mx-1"
                                                    href="{{ route('user-edit', $user->id) }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Edit User {{ $user->nama }}">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $user->id }}"
                                                    data-name="{{ $user->nama }}">
                                                    <i class="bi bi-trash text-body-secondary"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                    Item</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete user <span
                                                                    id="itemName"></span>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form id="deleteForm"
                                                                    action="{{ route('user-delete', $user->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    @foreach ($dataUsers as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->nama }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-warning mx-1"
                                                    href="{{ route('user-edit', $user->id) }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Edit User {{ $user->nama }}">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $user->id }}"
                                                    data-name="{{ $user->nama }}">
                                                    <i class="bi bi-trash text-body-secondary"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                    Item</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete user <span
                                                                    id="itemName"></span>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form id="deleteForm"
                                                                    action="{{ route('user-delete', $user->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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
    <script>
        // Update modal content when the button is clicked
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var itemId = button.data('id');
            var itemName = button.data('name');
            var modal = $(this);

            console.log(itemId);
            console.log(itemName);

            modal.find('#itemName').text(itemName);
            modal.find('#deleteForm').attr('action', '/app/bmn/users/' + itemId);
        });
    </script>
@endpush
