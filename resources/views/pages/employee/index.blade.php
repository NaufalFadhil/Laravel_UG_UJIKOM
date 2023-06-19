@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            <p class="mb-0">{{ session()->get('success') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">{{ session()->get('error') }}</p>
        </div>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#primary">
                    Tambah Data Karyawan
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->nip }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    <a href="{{ url('employees', $employee->id) }}" class="btn btn-info"><i class="bi-pencil"></i></a>
                                    <form action="{{ url('employees' . $employee->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus {{ $employee->name }}')">
                                            <i class="bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection

@section('modal')
    <!--primary theme Modal -->
    <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Tambah Data Karyawan
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('employees') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIP* :</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nama* :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="position" class="col-form-label">Jabatan* :</label>
                            <select class="form-select" id="position" name="position" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="MANAGER">Manager</option>
                                <option value="SUPERVISOR">Supervisor</option>
                                <option value="STAFF">Staff</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Jenis Kelamin* :</label> 
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="MALE">Laki-laki</option>
                                <option value="FEMALE">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email* :</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Nomor HP :</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Alamat :</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ url('assets/vendors/simple-datatables/style.css') }}">
<style>
    .form-select {
        padding: 0.3rem 2.7rem;
        border-radius: 0.5rem;
    }
    .pager {
        margin-top: 0px;
    }
</style>
@endpush

@push('addon-script')
<script src="{{ url('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
    // Simple Datatable
    let table = document.querySelector('#table');
    let dataTable = new simpleDatatables.DataTable(table);
</script>
@endpush