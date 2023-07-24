<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Salary Report PT. Baroqah TBK</title>
  <style>
    /* table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    } */

    .table-bordered {
      border: 1px solid black;
      border-collapse: collapse;
    }

    h1 {
      text-align: center;
    }

    h4 {
      margin-bottom: 0px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <h1 class="text-center">Payroll Report PT. Baroqah TBK</h1>
          <hr>
          <p>Tanggal Pembayaran: {{ $payroll->date }} <br>Tanggal Cetak: {{ date('Y-m-d') }}</p>

          <h4>Detail Pegawai</h4>
          <table class="table table-hover">
            <tr>
              <td width="250px">Nama Karyawan</td>
              <td>: {{ $payroll->name }}</td>
            </tr>
            <tr>
              <td width="250px">Jabatan</td>
              <td>: {{ Str::title($payroll->position) }}</td>
            </tr>
            <tr>
              <td width="250px">No. HP</td>
              <td>: {{ Str::title($payroll->phone) }}</td>
            </tr>
            <tr>
              <td width="250px">Alamat</td>
              <td>: {{ Str::title($payroll->address) }}</td>
            </tr>
          </table>

          <h4>Detail gaji</h4>
          <table class="table table-hover">
            <tr>
              <td width="250px">Gaji Pokok</td>
              <td>: Rp. @currency($payroll->salary)</td>
            </tr>
            <tr>
              <td width="250px">Bonus</td>
              <td>: Rp. @currency($payroll->bonus)</td>
            </tr>
            <tr>
              <td width="250px">Potongan PPh</td>
              <td>: Rp. @currency($payroll->amount - ($payroll->salary + $payroll->bonus))</td>
            </tr>
            <tr>
              <td width="250px">Gaji Bersih</td>
              <td>: Rp. @currency($payroll->amount)</td>
            </tr>
          </table>
        </div>
    </div>
  </div>
</body>
</html>