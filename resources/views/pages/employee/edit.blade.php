@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Karyawan</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('employee.update', $employee->nip) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nip" class="col-form-label">Nomor Induk Pegawai (NIP)* :</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $employee->nip }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama* :</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-form-label">Jabatan* :</label>
                        <select class="form-select" id="position" name="position" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="MANAGER" @if ($employee->position == 'MANAGER') selected @endif>Manager</option>
                            <option value="SUPERVISOR" @if ($employee->position == 'SUPERVISOR') selected @endif>Supervisor</option>
                            <option value="STAFF" @if ($employee->position == 'STAFF') selected @endif>Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label">Jenis Kelamin* :</label> 
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="MALE" @if ($employee->gender == 'MALE') selected @endif>Laki-laki</option>
                            <option value="FEMALE" @if ($employee->gender == 'FEMALE') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email* :</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $employee->email }}"  required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Nomor HP :</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" >
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-form-label">Alamat :</label>
                        <textarea type="text" class="form-control" id="address" name="address"
                        >{{ $employee->address }}</textarea>
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