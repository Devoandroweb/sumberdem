<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link py-4">
      <img src="{{asset('image/setting/'.$setting->favicon)}}" alt="{{$setting->nama}}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{$setting->nama}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-uppercase">{{Auth::user()->name}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">DASHBOARD</li>
          <li class="nav-item">
            <a href="{{url('admin/home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-header">MENU UTAMA</li>
          <li class="nav-item">
            <a href="{{route('admin.pages.index')}}" class="nav-link">
              <i class="nav-icon fas fa-pager"></i>
              <p>
                Halaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.perangkat_desa.index')}}" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Perangkat Desa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galery
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.foto.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Foto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/vidio')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vidio</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.kritiksaran.index')}}" class="nav-link">
              <i class="nav-icon far fa-comments"></i>
              <p>
                Kritik/Saran
              </p>
            </a>
          </li>
          <li class="nav-header">LAINNYA</li>
          <li class="nav-item">
            <a href="{{route('admin.menu.index')}}" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.pengguna.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/pengaturan')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>