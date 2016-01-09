<header class="main-header">
    <a href="/" class="logo">
        <img src="/images/logo.png" alt="Logo">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <p class="navbar-text">Selamat datang, <strong>{{ auth()->user()->nama_lengkap }}</strong></p>
                </li>
                <li>
                    <a href="/user/password"><i class="fa fa-fw fa-lock"></i> Ubah Kata Sandi</a>
                </li>
                <li>
                    <a href="/logout"><i class="fa fa-fw fa-sign-out"></i> Keluar</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
