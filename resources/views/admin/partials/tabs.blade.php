<ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/dashboard') ? ' active' : ''  }}" href="/admin/dashboard">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/users') ? ' active' : ''  }}" href="/admin/users">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/tags') ? ' active' : ''  }}" href="/admin/tags">Tags</a>
    </li>
</ul>
