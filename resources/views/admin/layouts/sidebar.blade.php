<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
                <div class="nav-profile-image">
                    <img src="{{ asset('avatar-laki-laki.webp') }}" alt="profile">
                </div>
                <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                    <span class="fw-semibold mb-1 mt-2 text-center">{{ Auth::user()->name }}</span>
                    <span class="text-secondary icon-sm text-center">{{ Auth::user()->email }}</span>
                </div>
            </a>
        </li>

        <li class="nav-item pt-3">
            <a class="nav-link d-block" href="#!">

                <img class="sidebar-brand-logo img-fluid" src="{{ asset('logo_jkpi_2026.png') }}" alt="">
                <img class="sidebar-brand-logomini img-fluid" src="{{ asset('logo_jkpi_2026.png') }}" alt="">
                {{-- <div class="small fw-light pt-1">Responsive Dashboard</div> --}}
            </a>
            {{-- <form class="d-flex align-items-center" action="#">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="Search">
                </div>
            </form> --}}
        </li>

        <li class="pt-2 pb-1">
            <span class="nav-item-head"> Pages</span>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#!">
                <i class="mdi mdi-clipboard-check-outline menu-icon"></i>
                <span class="menu-title">Daftar Hadir</span>
            </a>
        </li>
    </ul>
</nav>
