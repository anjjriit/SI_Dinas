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
            @if (auth()->user()->role == 'super_admin') 
                <li{{ (Request::is('dashboard') ? ' class=item-active' : '')}}>
                    <a href="/dashboard">
                        <i class="fa fa-fw fa-th"></i> <span>Dashboard</span>
                    </a>
                </li>
            @endif
            <li{{ (Request::is('create-rpd') ? ' class=item-active' : '')}}>
                <a href="/rpd/create">
                    <i class="fa fa-fw fa-file-text"></i> <span>Create RPD</span>
                </a>
            </li>
            <li{{ (Request::is('rpd-draft') ? ' class=item-active' : '')}}>
                <a href="/rpd/draft">
                    <i class="fa fa-fw fa-edit"></i> <span>RPD Drafts</span>
                </a>
            </li>
            <li{{ (Request::is('rpd-submitted') ? ' class=item-active' : '')}}>
                <a href="/rpd/submitted">
                    <i class="fa fa-fw fa-list"></i> <span>RPD Submitted</span>
                </a>
            </li>
            <li{{ (Request::is('create-lpd') ? ' class=item-active' : '')}}>
                <a href="/lpd/create">
                    <i class="fa fa-fw fa-file-text"></i> <span>Create LPD</span>
                </a>
            </li>
            <li{{ (Request::is('lpd-draft') ? ' class=item-active' : '')}}>
                <a href="/lpd/draft">
                    <i class="fa fa-fw fa-edit"></i> <span>LPD Drafts</span>
                </a>
            </li>
            <li{{ (Request::is('lpd-submitted') ? ' class=item-active' : '')}}>
                <a href="/lpd/submitted">
                    <i class="fa fa-fw fa-list"></i> <span>LPD Submitted</span>
                </a>
            </li>
            <li{{ (Request::is('log-lpd') ? ' class=item-active' : '')}}>
                <a href="/lpd/log">
                    <i class="fa fa-fw fa-history"></i> <span>Logs LPD</span>
                </a>
            </li>
            @if (auth()->user()->role == 'super_admin')
                <li class="treeview{{ (
                            Request::is('user*') ||
                            Request::is('kota*') ||
                            Request::is('prospek*') ||
                            Request::is('project*') ||
                            Request::is('pelatihan*') ||
                            Request::is('jenisbiayapengeluaranstandard*')
                        )
                        ? ' item-active' : ''
                    }}"
                >
                    <a href="#">
                        <i class="fa fa-fw fa-database"></i> <span>Manage Data</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: block;">
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
                            <a href="/pelatihan"><i class="fa fa-fw"></i>Data Pelatihan</a>
                        </li>
                        <li{{ (Request::is('jenis-biaya*') ? ' class=item-active' : '')}}>
                            <a href="/jenis-biaya"><i class="fa fa-fw"></i>Data Jenis Biaya</a>
                       </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>
