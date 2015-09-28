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
            @if(auth()->user()->role == 'super_admin')
                <li {{ (Request::is('dashboard') ? ' class=item-active' : '')}}>
                    <a href="/dashboard">
                        <i class="fa fa-fw fa-th"></i> <span>Dashboard</span>
                    </a>
                </li>
            @else
                <li {{ (Request::is('homepage') ? ' class=item-active' : '')}}>
                    <a href="/homepage">
                        <i class="fa fa-fw fa-home"></i> <span>Homepage</span>
                    </a>
                </li>
            @endif

            <!--List Untuk Admin  -->
            @if(auth()->user()->role == 'administration')
            <li class="treeview{{ (
                            Request::is('rpd.admin*')
                        )
                        ? ' item-active' : ''
                    }}">
                <a href="#">
                    <i class="fa fa-fw fa-list-alt"></i><span>Approval RPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li {{ (Request::is('rpd/submitted/all') ? ' class=item-active' : '')}}>
                        <a href="/rpd/submitted/all">
                            <i class="fa fa-fw fa-list"></i> <span>Submitted RPD</span>
                        </a>
                    </li>
                    <li {{ (Request::is('rpd/approved') ? ' class=item-active' : '')}}>
                        <a href="/rpd/approved">
                            <i class="fa fa-fw fa-list"></i> <span>Approved RPD</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview{{ (
                            Request::is('lpd.admin*')
                        )
                        ? ' item-active' : ''
                    }}">
                <a href="#">
                    <i class="fa fa-fw fa-files-o"></i><span>Approval LPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li {{ (Request::is('lpd/processed') ? ' class=item-active' : '')}}>
                        <a href="/lpd/processed">
                            <i class="fa fa-fw fa-list"></i> <span>Processed LPD</span>
                        </a>
                    </li>
                    <li {{ (Request::is('lpd/approved') ? ' class=item-active' : '')}}>
                        <a href="/lpd/approved">
                            <i class="fa fa-fw fa-list"></i> <span>Approved LPD</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!-- List Menu untuk Finance-->
            @if(auth()->user()->role == 'finance')
            <li class="treeview{{ (
                            Request::is('lpd.admin*')
                        )
                        ? ' item-active' : ''
                    }}">
                <a href="#">
                    <i class="fa fa-fw fa-files-o"></i><span>Approval LPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li {{ (Request::is('lpd/submitted*') ? ' class=item-active' : '')}}>
                        <a href="/lpd/submitted/all">
                            <i class="fa fa-fw fa-list"></i> <span>Submitted LPD</span>
                        </a>
                    </li>
                    <li {{ (Request::is('lpd/processed') ? ' class=item-active' : '')}}>
                        <a href="/lpd/processed">
                            <i class="fa fa-fw fa-list"></i> <span>Processed LPD</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!--List Dropdown RPD-->
            <li class="treeview{{ (
                            Request::is('rpd*')
                        )
                        ? ' item-active' : ''
                    }}">

                    <a href="#">
                        <i class="fa fa-fw fa-list-alt"></i> <span>RPD</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li{{ (Request::is('rpd/create') ? ' class=item-active' : '')}}>
                            <a href="/rpd/create">
                                <i class="fa fa-fw fa-file-text"></i> <span>Create RPD</span>
                            </a>
                        </li>
                        <li{{ (Request::is('rpd/draft') ? ' class=item-active' : '')}}>
                            <a href="/rpd/draft">
                                <i class="fa fa-fw fa-edit"></i> <span>RPD Drafts</span>
                            </a>
                        </li>
                        <li{{ (Request::is('rpd/submitted') ? ' class=item-active' : '')}}>
                            <a href="/rpd/submitted">
                                <i class="fa fa-fw fa-list"></i> <span>Submitted RPD</span>
                            </a>
                        </li>
                        <li{{ (Request::is('rpd/log') ? ' class=item-active' : '') }}>
                            <a href="/rpd/log">
                                <i class="fa fa-fw fa-history"></i> <span>Logs RPD</span>
                            </a>
                        </li>
                    </ul>
            </li>

            <!-- List Dropdown LPD-->
            <li class="treeview{{ (
                        Request::is('lpd*')
                    )
                    ? ' item-active' : ''
                }}">

                <a href="#">
                    <i class="fa fa-fw fa-files-o"></i> <span>LPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li {{ (Request::is('lpd') ? ' class=item-active' : '')}}>
                        <a href="/lpd">
                            <i class="fa fa-fw fa-file-text"></i> <span>Create LPD</span>
                        </a>
                    </li>
                    <li {{ (Request::is('lpd/draft') ? ' class=item-active' : '')}}>
                        <a href="/lpd/draft">
                            <i class="fa fa-fw fa-edit"></i> <span>LPD Drafts</span>
                        </a>
                    </li>
                    <li {{ (Request::is('lpd/submitted') ? ' class=item-active' : '')}}>
                        <a href="/lpd/submitted">
                            <i class="fa fa-fw fa-list"></i> <span>LPD Submitted</span>
                        </a>
                    </li>
                    <li {{ (Request::is('lpd/log') ? ' class=item-active' : '')}}>
                        <a href="/lpd/log">
                            <i class="fa fa-fw fa-history"></i> <span>Logs LPD</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Manage Data-->
            @if (auth()->user()->role == 'super_admin')
                <li class="treeview{{ (
                            Request::is('user*') ||
                            Request::is('kota*') ||
                            Request::is('prospek*') ||
                            Request::is('project*') ||
                            Request::is('pelatihan*') ||
                            Request::is('jenisbiayapengeluaranstandard*') ||
                            Request::is('transportasi*')||
                            Request::is('tipepengeluaran*')
                        )
                        ? ' item-active' : ''
                    }}"
                >
                    <a href="#">
                        <i class="fa fa-fw fa-database"></i> <span>Manage Data</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li {{ (Request::is('user*') ? ' class=item-active' : '')}}>
                            <a href="/user"><i class="fa fa-fw"></i>Data User</a>
                        </li>
                        <li {{ (Request::is('kota*') ? ' class=item-active' : '')}}>
                            <a href="/kota"><i class="fa fa-fw"></i>Data Kota</a>
                        </li>
                        <li {{ (Request::is('prospek*') ? ' class=item-active' : '')}}>
                            <a href="/prospek"><i class="fa fa-fw"></i>Data Prospek</a>
                        </li>
                        <li {{ (Request::is('project*') ? ' class=item-active' : '')}}>
                            <a href="/project"><i class="fa fa-fw"></i>Data Project</a>
                        </li>
                         <li {{ (Request::is('pelatihan*') ? 'class=item-active' : '') }} >
                            <a href="/pelatihan"><i class="fa fa-fw"></i>Data Pelatihan</a>
                        </li>
                        <li {{ (Request::is('jenis-biaya*') ? ' class=item-active' : '')}}>
                            <a href="/jenis-biaya"><i class="fa fa-fw"></i>Data Jenis Biaya</a>
                       </li>
                       <li {{ (Request::is('transportasi*') ? ' class=item-active' : '')}}>
                            <a href="/transportasi"><i class="fa fa-fw"></i>Data Transportasi</a>
                       </li>
                       <li {{ (Request::is('penginapan') ? ' class=item-active' : '') }}>
                            <a href="/penginapan"><i class="fa fa-fw"></i>Data Penginapan</a>
                       </li>
                        <li {{ (Request::is('tipepengeluaran*') ? ' class=item-active' : '') }}>
                            <a href="/tipepengeluaran"><i class="fa fa-fw"></i>Data Tipe Pengeluaran</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>
