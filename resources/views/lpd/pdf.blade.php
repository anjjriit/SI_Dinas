<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        html {font-family: sans-serif; /* 1 */-ms-text-size-adjust: 100%; /* 2 */-webkit-text-size-adjust: 100%; /* 2 */}body {margin: 0;}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary {display: block;}audio,canvas,progress,video {display: inline-block; /* 1 */vertical-align: baseline; /* 2 */}audio:not([controls]) {display: none;height: 0;}[hidden],template {display: none;}a {background-color: transparent;}a:active,a:hover {outline: 0;}abbr[title] {border-bottom: 1px dotted;}b,strong {font-weight: bold;}dfn {font-style: italic;}h1 {font-size: 2em;margin: 0.67em 0;}mark {background: #ff0;color: #000;}small {font-size: 80%;}sub,sup {font-size: 75%;line-height: 0;position: relative;vertical-align: baseline;}sup {top: -0.5em;}sub {bottom: -0.25em;}img {border: 0;}svg:not(:root) {overflow: hidden;}figure {margin: 1em 40px;}hr {box-sizing: content-box;height: 0;}pre {overflow: auto;}code,kbd,pre,samp {font-family: monospace, monospace;font-size: 1em;}button,input,optgroup,select,textarea {color: inherit; /* 1 */font: inherit; /* 2 */margin: 0; /* 3 */}button {overflow: visible;}button,select {text-transform: none;}button,html input[type="button"], /* 1 */input[type="reset"],input[type="submit"] {-webkit-appearance: button; /* 2 */cursor: pointer; /* 3 */}button[disabled],html input[disabled] {cursor: default;}button::-moz-focus-inner,input::-moz-focus-inner {border: 0;padding: 0;}input {line-height: normal;}input[type="checkbox"],input[type="radio"] {box-sizing: border-box; /* 1 */padding: 0; /* 2 */}input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button {height: auto;}input[type="search"] {-webkit-appearance: textfield; /* 1 */box-sizing: content-box; /* 2 */}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration {-webkit-appearance: none;}fieldset {border: 1px solid #c0c0c0;margin: 0 2px;padding: 0.35em 0.625em 0.75em;}legend {border: 0; /* 1 */padding: 0; /* 2 */}textarea {overflow: auto;}optgroup {font-weight: bold;}table {border-collapse: collapse;border-spacing: 0;}td,th {padding: 0;} .clearfix:before, .clearfix:after { content: " ";display: table; } .clearfix:after { clear: both;}

        body { font-size: 14px; padding: 20px 30px;} .table { font-size: 14px; } .table-bordered th, .table-bordered td { padding: 2px 4px;border: 1px solid #999;} th { text-align: center; } .kop { border-bottom: 3px double #999;margin-bottom: 30px;} th, td { vertical-align: top;} th, .active { background-color: #ccc; }
    </style>
</head>
<body>
    <table width="100%" class="kop">
        <tr>
            <td rowspan="4" width="25%" style="padding-top: 5px;text-align: center;"><img src="{{ base_path('public/images/logo-kop.png') }}"></td>
            <td><h4 style="margin-top:0;margin-bottom:5px;">JAVAN CIPTA SOLUSI</h4></td>
        </tr>
        <tr>
            <td>Terusan Jl. Jakarta Komplek Daichi No. 55</td>
        </tr>
        <tr>
            <td>Bandung 40282, Jawa Barat, Indonesia</td>
        </tr>
        <tr>
            <td>
                (022) 87831878 | info@javan.co.id | http://www.javan.co.id
            </td>
        </tr>
    </table>
    <h4>LAPORAN PERJALANAN DINAS (RPD)</h4>
    <br>
    <table class="table table-bordered" width="60%" style="float: left;">
        <thead>
            <tr class="active">
                <th width="50%">Penanggung Jawab Akomodasi</th>
                <th width="50%">Tanggal Laporan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $lpd->pegawai->nama_lengkap }}</td>
                <td>
                    {{ date_format(date_create($lpd->tanggal_laporan), 'd/m/Y') }}
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered" width="20%" style="float: right;">
        <thead>
            <tr class="active">
                <th width="100%">No. Akomodasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $lpd->rpd->kode }}</td>
            </tr>
        </tbody>
    </table>

    <div class="clearfix"></div>
    <br>
    <table class="table table-bordered" width="60%">
        <thead>
            <tr class="active">
                <th width="50%">Personel</th>
                <th width="50%">Proyek / Keperluan Lainnya</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lpd->rpd->peserta as $peserta)
                @foreach($lpd->rpd->kegiatan()->where('nik_peserta', $peserta->nik)->get() as $kegiatan)
                    <tr>
                        @if ($lpd->rpd->kegiatan()->where('nik_peserta', $peserta->nik)->first() == $kegiatan)
                            <td rowspan="{{ $lpd->rpd->kegiatan()->where('nik_peserta', $peserta->nik)->count() }}" style="vertical-align: top;">
                                {{ $peserta->nama_lengkap }}
                            </td>
                        @endif
                        <td>
                            @if ($kegiatan->jenis_kegiatan == 'project')
                                {{ $kegiatan->project->nama_project }}
                            @elseif ($kegiatan->jenis_kegiatan == 'prospek')
                                {{ $kegiatan->prospek->nama_prospek }}
                            @elseif ($kegiatan->jenis_kegiatan == 'pelatihan')
                                {{ $kegiatan->pelatihan->nama_pelatihan }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <br>
    <table class="table table-bordered" width="60%">
        <tbody>
            <tr>
                <td width="50%" class="active"><strong>Akomodasi Awal</strong></td>
                <td width="50%">{{ 'Rp ' . number_format($lpd->rpd->akomodasi_awal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="active"><strong>Total Pengeluaran</strong></td>
                <td>Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="active"><strong>Pengembalian (Reimburse)</strong></td>
                <td>Rp {{ number_format($lpd->rpd->akomodasi_awal - $lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h4>Pengeluaran</h4>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="active">
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Keterangan</th>
                <th>Struk</th>
                <th>Personel</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lpd->pengeluaran as $pengeluaran)
                <tr>
                    <td style="vertical-align: top;">
                        <?php
                            $hari = date_format(date_create($pengeluaran->tanggal), 'N');
                        ?>

                        @if ($hari == 1)
                            {{ 'Senin, ' }}
                        @elseif($hari == 2)
                            {{ 'Selasa, ' }}
                        @elseif($hari == 3)
                            {{ 'Rabu, ' }}
                        @elseif($hari == 4)
                            {{ 'Kamis, ' }}
                        @elseif($hari == 5)
                            {{ 'Jum\'at, ' }}
                        @elseif($hari == 6)
                            {{ 'Sabtu, ' }}
                        @else
                            {{ 'Minggu, ' }}
                        @endif

                        {{ date_format(date_create($pengeluaran->tanggal), 'd/m/Y') }}
                    </td>
                    <td style="vertical-align: top;">{{ $pengeluaran->tipe->nama_kategori }}</td>
                    <td style="vertical-align: top;">{{ $pengeluaran->keterangan }}</td>
                    <td style="vertical-align: top;">{{ $pengeluaran->struk }}</td>
                    <td style="vertical-align: top;">
                            @foreach ($pengeluaran->personel as $personel)
                                {{ $personel->nama_lengkap }}@if ($personel != $pengeluaran->personel[$pengeluaran->personel->count() - 1]), @endif
                            @endforeach
                        </ul>
                    </td>
                    <td style="vertical-align: top;">Rp {{ number_format($pengeluaran->biaya, 0, '.', ',' ) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="active" style="text-align: center;">Total</td>
                <td>Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h4>Action History</h4>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="active">
                <th width="25%">Date Time</th>
                <th width="30%">Nama</th>
                <th width="20%">Action Taken</th>
                <th width="25%">Comment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lpd->actionHistory as $action)
                @if ($action->action != 'DRAFT')
                    <tr>
                        <td>{{ date_format( date_create($action->created_at), 'd/m/Y H:i') }}</td>
                        <td>{{ $action->pegawai->nama_lengkap }}</td>
                        <td>{{ ucwords(strtolower($action->action)) }}</td>
                        <td>{{ $action->comment }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
