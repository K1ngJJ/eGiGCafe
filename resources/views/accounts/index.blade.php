@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/accountCreation.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'accountCreation' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<style>

.btn-danger {
    background-color: black; 
    color: white;
    border: gray;
}

.btn-complete {
    background-color: red; 
    color: white;
    border: gray;
} 

.btn-warning {
    background-color: orange; 
    color: white;
    border: gray;
} 

.btn-success {
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}



</style>
<section class="min-vh-100 d-flex flex-column align-items-start mt-5 pt-18vh">
    <div class="container-fluid px-3 px-md-5">
        <h2 class="mt-2 mb-4" style="font-size: 1.0rem; font-style: italic;">Manage Accounts</h2>
        <div class="row my-5 justify-content-between">
            <div class="col-12 pt-3 h-100 shadow rounded bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-md-end align-items-start align-items-md-center mb-4">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <small>{{ session('success') }}</small>
                        </div>
                    @endif
                    <a href="{{ route('accountCreation') }}" class="my-md-1 px-2 py-1 btn-sm primary-btn">+ Create Account</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Role</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                                <tr>
                                    <th scope="row"><a type="button" class="my-md-1 px-2 py-1 btn-sm primary-btn primary-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $users->id }}">
                                        {{ $users->id }}</a>
                                    </th>
                                    <td>{{ $users->role }}</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->mobile_number }}</td>
                                    <td>
                                        <a href="{{ route('user.update', ['id' => $users->id]) }}" class="btn btn-{{ $users->status ? 'success' : 'danger' }}">
                                            @if ($users->status)
                                                <i class="fas fa-check-circle"></i>
                                            @else
                                                <i class="fas fa-times-circle"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $users->id }}">
                                            <i class="fa fa-trash" style="font-size: 17px;"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $users->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $users->id }}">Edit Account</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user.saveChanges', ['id' => $users->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mobile_number" class="form-label">Contact Number</label>
                                                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $users->mobile_number }}">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('user.saveChanges', ['id' => $users->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Modal -->

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $users->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $users->id }}">Delete Reservation</h5>
                                            
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this <strong>account #{{ $users->id }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('user.delete', ['id' => $users->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" style="font-size: 20px;"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection