@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Payroll Configuration</h3>
                <p class="text-subtitle text-muted"></p>
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
                    Tambah Data
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Jabatan</th>
                            <th>Bonus</th>
                            <th>PPH</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->position }}</td>
                                <td>{{ $parameter->bonus_percentage . '%' }}</td>
                                <td>{{ $parameter->pph_percentage . '%' }}</td>
                                <td>
                                    <a href="{{ url('employees', $parameter->id) }}" class="btn btn-info"><i class="bi-pencil"></i></a>
                                    <form action="{{ url('employees' . $parameter->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus {{ $parameter->name }}')">
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
                    <h5 class="modal-title white" id="myModalLabel160">Tambah Data Konfigurasi Payroll
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('parameter.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="position" class="col-form-label">Jabatan:</label>
                            <select class="form-select" id="position" name="position" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="MANAGER">Manager</option>
                                <option value="SUPERVISOR">Supervisor</option>
                                <option value="STAFF">Staff</option>
                            </select>
                        </div>
                      <div class="form-group">
                            <label for="bonus_percentage" class="col-form-label">Bonus (%):</label>
                            <input type="text" class="form-control" id="bonus_percentage" name="bonus_percentage" required>
                        </div>
                        <div class="form-group">
                            <label for="pph_percentage" class="col-form-label">PPH (%):</label>
                            <input type="text" class="form-control" id="pph_percentage" name="pph_percentage" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Konfigurasi</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
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