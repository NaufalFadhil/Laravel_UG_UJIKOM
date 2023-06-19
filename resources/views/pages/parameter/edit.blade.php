@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Payroll Parameter</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('payroll-configuration.update', $parameter->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="position" class="col-form-label">Jabatan* :</label>
                        <select class="form-select" id="position" name="position" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="MANAGER" @if ($parameter->position == 'MANAGER') selected @endif>Manager</option>
                            <option value="SUPERVISOR" @if ($parameter->position == 'SUPERVISOR') selected @endif>Supervisor</option>
                            <option value="STAFF" @if ($parameter->position == 'STAFF') selected @endif>Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bonus_percentage" class="col-form-label">Bonus:</label>
                        <input type="text" class="form-control" id="bonus_percentage" name="bonus_percentage" value="{{ $parameter->bonus_percentage }}" required>
                    </div>
                    <div class="form-group">
                        <label for="pph_percentage" class="col-form-label">Bonus:</label>
                        <input type="text" class="form-control" id="pph_percentage" name="pph_percentage" value="{{ $parameter->pph_percentage }}" required>
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