<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">

      <div class="sidebar-menu">
          <ul class="menu">
              <li class="sidebar-title"><b>PT. Baroqah TBK</b></li>

              <li class="sidebar-item {{ Request::is('*') ? 'active' : '' }}">
                  <a href="{{ route('dashboard') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Dashboard</span>
                  </a>
              </li>
              <li class="sidebar-item {{ Request::is('employee') ? 'active' : '' }}">
                  <a href="{{ url('/employee') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Karyawan</span>
                  </a>
              </li>
              <li class="sidebar-item {{ Request::is('payroll-report') ? 'active' : '' }}">
                  <a href="{{ url('/payroll-configuration') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Laporan Gaji</span>
                  </a>
              </li>
              <li class="sidebar-item {{ Request::is('payroll-configuration') ? 'active' : '' }}">
                  <a href="{{ url('/payroll-configuration') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Konfigurasi Bonus & PPh</span>
                  </a>
              </li>
          </ul>
      </div>
      <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>