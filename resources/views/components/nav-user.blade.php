    <nav class="p-2 ps-3 mb-3
                navbar navbar-expand-md navbar-light
                border border-2 border-top-0 border-success
                bg-gradient-to-right"
         style="border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;">

        <a class="navbar-brand ms-2 fs-2" href="{{ route('home') }}">Snake</a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#toggleMobileMenu"
            aria-controls="toggleMobileMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="toggleMobileMenu">
            <ul class="navbar-nav text-center ms-auto fs-4">

                <li>
                    <a class="nav-link me-3" href="{{ route('download') }}">Pobierz grę</a>
                </li>

                <li>
                    <a class="nav-link me-3 mb-1" href="{{ route('login') }}">Ranking</a>
                </li>

                <!-- Profil d-md-none -->
                <li class="d-md-none">
                    <a class="nav-link me-3 mb-1" href="{{ route('profile', Auth::user()->name) }}">Profil</a>
                </li>

                <!-- Ustawienia d-md-none -->
                <li class="d-md-none">
                    <a class="nav-link me-3 mb-1" href="{{ route('login') }}">Ustawienia</a>
                </li>

                <!-- Wyloguj d-md-none -->
                <li class="d-md-none">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm
                                       mt-md-2
                                       ms-md-2
                                       me-md-2 me-sm-2 me-3
                                       border border-2 border-success
                                       border-radius-25 bg-lightblue" type="submit">
                        Wyloguj</button>
                    </form>
                </li>

                <!-- Nazwa użytkownika oraz awatar na większych ekranach -->
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle color-user mt-1 p-0" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong>{{ Auth::user()->name }}</strong> <img style="height:50px; width: 50px; border-radius: 50%;"
                                class="border border-2 border-dark" src="{{ asset(Auth::user()->avatar) }}">
                            </a>
                            <ul class="dropdown-menu bg-bright" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item bg-dropdown-btn-user color-black" href="{{ route('profile', Auth::user()->name) }}"><i class="bi bi-person-circle me-1"></i>Profil</a></li>
                                <li><a class="dropdown-item bg-dropdown-btn-user color-black" href="#"><i class="bi bi-gear-fill me-1"></i>Ustawienia</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" }}>
                                        @csrf
                                        <button type="submit" class="dropdown-item bg-dropdown-btn-user color-black" ><i class="bi bi-box-arrow-right me-1"></i>Wyloguj</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </ul>
        </div>

    </nav>