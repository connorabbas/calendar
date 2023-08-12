<nav class="navbar navbar-expand-md shadow-sm border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            FullCalendar App
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto d-flex align-items-center">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('events.calendar') }}"
                            href="{{ route('events.calendar') }}">Events</a>
                    </li>
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <div class="">
                <ul class="navbar-nav me-auto d-flex align-items-center">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link {{ is_active_route('login') }}" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link {{ is_active_route('register') }}"
                                    href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logoutForm').submit();"><i
                                        class="bi bi-box-arrow-left"></i>&nbsp;Logout</a>
                                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <!-- Theme toggle -->
                    <li class="nav-item dropdown ms-md-3">
                        <input type="hidden" name="theme" id="themeValue" value="light">
                        <button id="themeDropdown" class="text-warning btn btn-sm btn-secondary" href="#"
                            type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i id="themeIcon" class="bi bi-circle-half"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                            <a id="lightThemeOption" class="dropdown-item theme-dd-option" href="#"
                                onclick="window.setTheme('light')">
                                <i class="bi bi-brightness-high-fill"></i>&nbsp;Light
                            </a>
                            <a id="darkThemeOption" class="dropdown-item theme-dd-option" href="#"
                                onclick="window.setTheme('dark')">
                                <i class="bi bi-moon-stars-fill"></i>&nbsp;Dark
                            </a>
                            <a id="osThemeOption" class="dropdown-item theme-dd-option" href="#"
                                onclick="window.setTheme('os')">
                                <i class="bi bi-circle-half"></i>&nbsp;Auto
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
