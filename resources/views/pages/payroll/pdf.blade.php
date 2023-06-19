<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Salary Report PT. Baroqah TBK</title>
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    td, h1, p {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <h1 class="text-center">Payroll Report PT. Baroqah TBK</h1>
          <hr>
          <p class="text-center">Laporan pada tanggal {{ $date_start }} s.d. {{ $date_end }}</p>
          @php
              $total_amount = 0;
          @endphp
          <table class="table table-bordered table-hover" width="100%">
              <thead>
                  <tr>
                      <th>NIP</th>
                      <th>Nama Karyawan</th>
                      <th>Jabatan</th>
                      <th>Gaji Pokok</th>
                      <th>Bonus</th>
                      <th>Gaji Bersih</th>
                      <th>Tanggal Pembayaran</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($payrolls as $payroll)
                      <tr>
                        <td>{{ $payroll->nip }}</td>
                          <td>{{ $payroll->name }}</td>
                          <td>{{ Str::title($payroll->position) }}</td>
                          <td>{{ $payroll->salary }}</td>
                          <td>{{ $payroll->bonus }}</td>
                          <td>{{ $payroll->amount }}</td>
                          <td>{{ $payroll->date }}</td>
                      </tr>
                      @php
                          $total_amount += $payroll->amount;
                      @endphp
                  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                      <th colspan="5" class="text-center">Total</th>
                      <th>{{ $total_amount }}</th>
                      <th>{{ $date_start }} - {{ $date_end }}</th>
                  </tr>
          </table>
        </div>
    </div>
  </div>
</body>
</html>