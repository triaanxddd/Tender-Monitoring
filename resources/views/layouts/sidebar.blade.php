<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" {{ route('home')}} " target="_blank">
        <img src="{{ asset('logo') }}/energia-64x64.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Kegiatan Energia</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? ' active' : '' }}" href="{{ route('home')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('task*') ? ' active' : '' }}" href="{{ route('tasks.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pekerjaan</span>
          </a>
        </li>
        @if(auth()->user()->role == 1)
          <li class="nav-item">
            <a class="nav-link {{ Request::is('management*') ? ' active' : '' }}" href="{{ route('management') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-gavel text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Pimpinan</span>
            </a>
          </li>
        @endif
        @if(auth()->user()->role == 1)
          <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Settings</h6>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('goods*') ? ' active' : '' }}" href="{{ route('goods.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-dropbox text-danger text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Barang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('categories*') ? ' active' : '' }}" href="{{ route('categories.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Kategori</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-app text-info text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Member</span>
            </a>
          </li>
        @endif
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}" href="{{ route('profile') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">

          <div class="nav-link">
            <form action="{{ route('logout') }}" method="post">
              @csrf
                <button type="submit" class="btn btn-warning mt-3" onclick="return confirm('Yakin ingin Keluar?')"><i class="fa fa-user me-sm-1"></i> Log Out</button>
              </form>
          </div>
        </li>
      </ul>
    </div>
  </aside>