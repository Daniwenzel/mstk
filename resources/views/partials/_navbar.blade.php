<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Imagem logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img class="img-xs rounded-circle" src="{{ asset('images/auth/logo.png') }}" alt="Imagem perfil">
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center ">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown nav-profile cursor-pointer">
                <a class="nav-link dropdown-toggle d-none d-xl-inline-block" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text">Olá, {{ Auth::user()->name  }} !</span>
                    @if(Auth::user()->getFirstMedia('profile'))
                        <img class="img-xs rounded-circle" src="{{ Auth::user()->getFirstMedia('profile')->getUrl('avatar') }}" alt="Imagem perfil">
                    @else
                        <img class="img-xs rounded-circle" src="{{ asset('images/faces-clipart/pic-1.png') }}" alt="Imagem perfil">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item mt-2" href="{{ route('show.config', Auth::user()->id) }}">
                        Manage Account
                    </a>
                    <a class="dropdown-item" href="{{ route('user.password') }}">
                        Change Password
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <a class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit()">
                            Sign Out
                        </a>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>