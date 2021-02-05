<nav class="navbar navbar-expand navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img
          src="{{ asset('source/images/logo.png') }}"
          width="30"
          height="30"
          loading="lazy"
        />
      </a>

      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item px-2{{ request()->is('/') ? ' active' : '' }}">
          <a class="nav-link" href="/"><i class="fas fa-home"></i></a>
        </li>
        <li class="nav-item px-2{{ request()->is('blog/explore*') ? ' active' : '' }}">
          <a class="nav-link" href="/blog/explore"
            ><i class="fas fa-search"></i
          ></a>
        </li>
        <li class="nav-item px-2{{ request()->is('blog/create') ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('blog.create') }}"
            ><i class="fas fa-plus"></i
          ></a>
        </li>
        <li class="nav-item px-2 dropdown">
          <a
            class="nav-link"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <img
              src="{{ auth()->user()->profile_image ? asset('profiles/' . auth()->user()->profile_image ) : asset('source/images/default-profile.png') }}"
              width="32"
              height="32"
              loading="lazy"
              class="rounded-circle"
              style="object-fit: cover; object-position: center;"
            />
          </a>
          <div
            class="dropdown-menu dropdown-menu-right"
            aria-labelledby="navbarDropdown"
          >
            <a class="dropdown-item{{ request()->is('profile/' . auth()->user()->username ) ? ' active' : '' }}" href="{{ '/profile/' . auth()->user()->username }}">Profile</a>
            <a class="dropdown-item{{ request()->is('profile/settings') ? ' active' : '' }}" href="/profile/settings">Settings</a>
            @if (auth()->user()->role == "admin")
            <a class="dropdown-item{{ request()->is('admin*') ? ' active' : '' }}" href="/admin/dashboard">Dashboard</a>
            @endif
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger" href="#">Logout</button>
            </form>
          </div>
        </li>
      </ul>
    </div>
</nav>
