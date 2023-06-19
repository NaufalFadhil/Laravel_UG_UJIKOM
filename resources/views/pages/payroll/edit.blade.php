@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Payroll</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('payroll.update', $payroll->salary_id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="employee_nip" class="col-form-label">Karyawan:</label>
                        <select class="form-select" id="employee_nip" name="employee_nip" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->nip }}" @if ($employee->nip == $payroll->nip) selected @endif>{{ $employee->name}} ({{ $employee->nip }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="salary" class="col-form-label">Gaji Pokok:</label>
                        <input type="text" class="form-control" id="salary" name="salary" value="{{ $payroll->salary }}" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>
@endsection