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
                <li>
                    <a href="/dashboard">
                        <i class="fa fa-fw fa-th"></i> <span>Dashboard</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="/homepage">
                        <i class="fa fa-fw fa-home"></i> <span>Homepage</span>
                    </a>
                </li>
            @endif

            <!--List Untuk Admin  -->
            @if(auth()->user()->role == 'administration')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-list-alt"></i> <span>Approval RPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="/rpd/submitted/all">
                            <i class="fa fa-fw fa-list"></i> <span>Submitted RPD</span>
                        </a>
                    </li>
                    <li>
                        <a href="/rpd/approved">
                            <i class="fa fa-fw fa-list"></i> <span>Approved RPD</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-files-o"></i> <span>Approval LPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="/lpd/processed">
                            <i class="fa fa-fw fa-list"></i> <span>Processed LPD</span>
                        </a>
                    </li>
                    <li>
                        <a href="/lpd/approved">
                            <i class="fa fa-fw fa-list"></i> <span>Approved LPD</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!-- List Menu untuk Finance-->
            @if(auth()->user()->role == 'finance')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-files-o"></i> <span>Approval LPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="/lpd/submitted/all">
                            <i class="fa fa-fw fa-list"></i> <span>Submitted LPD</span>
                        </a>
                    </li>
                    <li>
                        <a href="/lpd/processed">
                            <i class="fa fa-fw fa-list"></i> <span>Processed LPD</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!--List Dropdown RPD-->
            <li class="treeview">
                    <a href="#">
                        <i class="fa fa-fw fa-list-alt"></i> <span>RPD</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li>
                            <a href="/rpd/create">
                                <i class="fa fa-fw fa-file-text"></i> <span>Create RPD</span>
                            </a>
                        </li>
                        <li>
                            <a href="/rpd/draft">
                                <i class="fa fa-fw fa-edit"></i> <span>Draft RPD</span>
                            </a>
                        </li>
                        <li>
                            <a href="/rpd/submitted">
                                <i class="fa fa-fw fa-list"></i> <span>Submitted RPD</span>
                            </a>
                        </li>
                        <li>
                            <a href="/rpd/log">
                                <i class="fa fa-fw fa-history"></i> <span>Log RPD</span>
                            </a>
                        </li>
                    </ul>
            </li>

            <!-- List Dropdown LPD-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-files-o"></i> <span>LPD</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="/lpd">
                            <i class="fa fa-fw fa-file-text"></i> <span>Create LPD</span>
                        </a>
                    </li>
                    <li>
                        <a href="/lpd/draft">
                            <i class="fa fa-fw fa-edit"></i> <span>Draft LPD</span>
                        </a>
                    </li>
                    <li>
                        <a href="/lpd/submitted">
                            <i class="fa fa-fw fa-list"></i> <span>Submitted LPD</span>
                        </a>
                    </li>
                    <li>
                        <a href="/lpd/log">
                            <i class="fa fa-fw fa-history"></i> <span>Log LPD</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if (auth()->user()->role == 'finance')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-fw fa-calendar"></i> <span>Reporting</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li>
                            <a href="/report/bulanan">
                                <i class="fa fa-fw fa-calendar-o"></i> <span>Per Bulan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/report/tahunan">
                                <i class="fa fa-fw fa-calendar-check-o"></i> <span>Per Tahun</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Manage Data-->
            @if (auth()->user()->role == 'super_admin')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-fw fa-database"></i> <span>Manage Data</span> <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li>
                            <a href="/user"><i class="fa fa-fw"></i>Data User</a>
                        </li>
                        <li>
                            <a href="/kota"><i class="fa fa-fw"></i>Data Kota</a>
                        </li>
                        <li>
                            <a href="/prospek"><i class="fa fa-fw"></i>Data Prospek</a>
                        </li>
                        <li>
                            <a href="/project"><i class="fa fa-fw"></i>Data Project</a>
                        </li>
                         <li>
                            <a href="/pelatihan"><i class="fa fa-fw"></i>Data Pelatihan</a>
                        </li>
                        <li>
                            <a href="/jenis-biaya"><i class="fa fa-fw"></i>Data Jenis Biaya</a>
                       </li>
                       <li>
                            <a href="/transportasi"><i class="fa fa-fw"></i>Data Transportasi</a>
                       </li>
                       <li>
                            <a href="/penginapan"><i class="fa fa-fw"></i>Data Penginapan</a>
                       </li>
                        <li>
                            <a href="/tipepengeluaran"><i class="fa fa-fw"></i>Data Tipe Pengeluaran</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/setting">
                        <i class="fa fa-fw fa-cog"></i> <span>Setting</span>
                    </a>
                </li>
            @endif

        </ul>
    </section>
</aside>
