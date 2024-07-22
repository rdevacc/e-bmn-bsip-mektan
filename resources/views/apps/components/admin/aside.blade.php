  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('dashboard-index') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('barang-index') }}">
                  <i class="bi bi-menu-button-wide"></i><span>Data Barang</span></i>
              </a>
          </li><!-- End Kegiatan Page Nav -->

          <li class="nav-heading">Manajemen User</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('user-index')}}">
                  <i class="bi bi-people"></i>
                  <span>Users</span>
              </a>
          </li><!-- End Users -->
          @can('isSuperAdmin')
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('role-index')}}">
                  <i class="bi bi-shield-check"></i>
                  <span>Roles</span>
              </a>
          </li><!-- End Roles -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('qrcode-index') }}">
                  <i class="bi bi-qr-code"></i><span>QR Code</span></i>
              </a>
          </li><!-- End Report Page Nav -->
          @endcan
         
      </ul>
  </aside><!-- End Sidebar-->
