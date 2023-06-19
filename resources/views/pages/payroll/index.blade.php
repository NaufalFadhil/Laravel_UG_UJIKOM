@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Payroll</h3>
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
                    Rekam Data Gaji
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Gaji Pokok</th>
                            <th>Bonus</th>
                            <th>Gaji Bersih</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                            <tr>
                                <td>{{ $payroll->nip }}</td>
                                <td>{{ $payroll->name }}</td>
                                <td>{{ $payroll->salary }}</td>
                                <td>{{ $payroll->bonus }}</td>
                                <td>{{ $payroll->amount }}</td>
                                <td>{{ $payroll->date }}</td>
                                <td>
                                    <a href="{{ route('payroll.edit', $payroll->salary_id)  }}" class="btn btn-info"><i class="bi-pencil"></i></a>
                                    <form action="{{ route('payroll.destroy', $payroll->salary_id)  }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus {{ $payroll->name }}')">
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
                    <h5 class="modal-title white" id="myModalLabel160">Rekam Data Gaji
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payroll.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_nip" class="col-form-label">Karyawan:</label>
                            <select class="form-select" id="employee_nip" name="employee_nip" required>
                                <option value="" disabled>Pilih Karyawan</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->nip }}">{{ $employee->name}} ({{ $employee->nip }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salary" class="col-form-label">Gaji Pokok:</label>
                            <input type="text" class="form-control" id="salary" name="salary" required>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-form-label">Tanggal Pembayaran:</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Hitung dan Tambah</button>
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