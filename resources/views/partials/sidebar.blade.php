<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="info text-center">
                <p>{{ auth()->user()->nama_lengkap }}</p>

                @if (auth()->user()->role == 'super_admin')
                    <span class="role">Super Admin</span>
                @elseif (auth()->user()->role == 'finance')
                    <span class="role">Finance</span>
                @elseif (auth()->user()->role == 'administration')
                    <span class="role">Administration</span>
                @else
                    <span class="role">Employee</span>
                @endif
            </div>
        </div>
        <ul class="sidebar-menu">
            <li{{ (Request::is('dashboard') ? ' class=active' : '')}}>
                <a href="/dashboard">
                    <i class="fa fa-fw fa-th"></i> <span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 'super_admin')
                <li class="treeview{{ (
                            Request::is('user*') ||
                            Request::is('kota*') ||
                            Request::is('prospek*') ||
                            Request::is('project*') ||
                            Request::is('pelatihan*')
                        )
                        ? ' item-active' : ''
                    }}"
                >
                    <a href="#">
                        <i class="fa fa-fw fa-database"></i> <span>Manage Data</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu menu-open" style="display: block;">
                        <li{{ (Request::is('user*') ? ' class=item-active' : '')}}>
                            <a href="/user"><i class="fa fa-fw"></i>Data User</a>
                        </li>
                        <li{{ (Request::is('kota*') ? ' class=item-active' : '')}}>
                            <a href="/kota"><i class="fa fa-fw"></i>Data Kota</a>
                        </li>
                        <li{{ (Request::is('prospek*') ? ' class=item-active' : '')}}>
                            <a href="/prospek"><i class="fa fa-fw"></i>Data Prospek</a>
                        </li>
                        <li{{ (Request::is('project*') ? ' class=item-active' : '')}}>
                            <a href="/project"><i class="fa fa-fw"></i>Data Project</a>
                        </li>
                        <li {{ (Request::is('pelatihan*') ? 'class=item-active' : '') }} >
                            <a href="/pelatihan"><i class="fa fa-fw"></i> Data Pelatihan</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>
