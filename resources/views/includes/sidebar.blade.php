<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <h3>PT. Baroqah TBK</h3>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

      <div class="sidebar-menu">
          <ul class="menu">
              <li class="sidebar-title"><b>Menu</b></li>

              {{-- <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                  <a href="{{ route('dashboard') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Dashboard</span>
                  </a>
              </li> --}}
              <li class="sidebar-item {{ Request::routeIs('employee.*') ? 'active' : '' }}">
                  <a href="{{ route('employee.index') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Karyawan</span>
                  </a>
              </li>
              <li class="sidebar-item {{ Request::routeIs('payroll.*') ? 'active' : '' }}">
                  <a href="{{ url('/payroll') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Laporan Gaji</span>
                  </a>
              </li>
              <li class="sidebar-item {{ Request::routeIs('payroll-configuration.*') ? 'active' : '' }}">
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