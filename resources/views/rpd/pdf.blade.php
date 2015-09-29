<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        html {font-family: sans-serif; /* 1 */-ms-text-size-adjust: 100%; /* 2 */-webkit-text-size-adjust: 100%; /* 2 */}body {margin: 0;}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary {display: block;}audio,canvas,progress,video {display: inline-block; /* 1 */vertical-align: baseline; /* 2 */}audio:not([controls]) {display: none;height: 0;}[hidden],template {display: none;}a {background-color: transparent;}a:active,a:hover {outline: 0;}abbr[title] {border-bottom: 1px dotted;}b,strong {font-weight: bold;}dfn {font-style: italic;}h1 {font-size: 2em;margin: 0.67em 0;}mark {background: #ff0;color: #000;}small {font-size: 80%;}sub,sup {font-size: 75%;line-height: 0;position: relative;vertical-align: baseline;}sup {top: -0.5em;}sub {bottom: -0.25em;}img {border: 0;}svg:not(:root) {overflow: hidden;}figure {margin: 1em 40px;}hr {box-sizing: content-box;height: 0;}pre {overflow: auto;}code,kbd,pre,samp {font-family: monospace, monospace;font-size: 1em;}button,input,optgroup,select,textarea {color: inherit; /* 1 */font: inherit; /* 2 */margin: 0; /* 3 */}button {overflow: visible;}button,select {text-transform: none;}button,html input[type="button"], /* 1 */input[type="reset"],input[type="submit"] {-webkit-appearance: button; /* 2 */cursor: pointer; /* 3 */}button[disabled],html input[disabled] {cursor: default;}button::-moz-focus-inner,input::-moz-focus-inner {border: 0;padding: 0;}input {line-height: normal;}input[type="checkbox"],input[type="radio"] {box-sizing: border-box; /* 1 */padding: 0; /* 2 */}input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button {height: auto;}input[type="search"] {-webkit-appearance: textfield; /* 1 */box-sizing: content-box; /* 2 */}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration {-webkit-appearance: none;}fieldset {border: 1px solid #c0c0c0;margin: 0 2px;padding: 0.35em 0.625em 0.75em;}legend {border: 0; /* 1 */padding: 0; /* 2 */}textarea {overflow: auto;}optgroup {font-weight: bold;}table {border-collapse: collapse;border-spacing: 0;}td,th {padding: 0;}

        body { font-size: 14px; padding: 20px 30px;} .table { font-size: 14px; } .table-bordered th, .table-bordered td { padding: 2px 4px;border: 1px solid #999;} th { text-align: left; } .kop { border-bottom: 3px double #999;margin-bottom: 30px;} th, td { vertical-align: top;} th, .active { background-color: #ccc; } .kop td { font-size: 12px; }
    </style>
</head>
<body>
    <table width="100%" class="kop">
        <tr>
            <td rowspan="4" width="25%" style="padding-top: 5px;text-align: center;"><img src="{{ base_path('public/images/logo-kop.png') }}"></td>
            <td><h4 style="margin-top:5px;margin-bottom:5px;">JAVAN CIPTA SOLUSI</h4></td>
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
    <h4>RENCANA PERJALANAN DINAS (RPD)</h4>
    <br>
    <table width="100%">
        <tr>
            <td width="25%">Kode RPD</td>
            <td>{{ $rpd->kode }}</td>
        </tr>
        <tr>
            <td>Penanggung Jawab</td>
            <td>{{ $rpd->pegawai->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
        </tr>
        <tr>
            @if($dataKategori == "Trip")
                <td>Tanggal Mulai</td>
            @else
                <td>Tanggal</td>
            @endif
            <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
        </tr>
        @if($dataKategori == "Trip")
            <tr>
                <td>Tanggal Selesai</td>
                <td>
                    {{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
                </td>
            </tr>
        @endif
        <tr>
            <td>Jumlah Hari Dinas</td>
            <td>
                {{ $rpd->lama_hari }} hari
            </td>
        </tr>
        <tr>
            <td>Asal Kota</td>
            <td>{{ $rpd->kotaAsal->nama_kota }}</td>
        </tr>
        <tr>
            <td>Tujuan Kota</td>
            <td>{{ $rpd->kotaTujuan->nama_kota }}</td>
        </tr>
        <tr>
            <td class="col-md-3" style="vertical-align: top;">Sarana Transportasi</td>
            <td>
                @foreach($rpd->saranaTransportasi as $saranaTransportasi)
                    {{ $saranaTransportasi->nama_transportasi }}@if ($saranaTransportasi != $rpd->saranaTransportasi[$rpd->saranaTransportasi->count() - 1]), @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Sarana Penginapan</td>
            <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
        </tr>
        <tr>
            <td>Akomodasi Awal</td>
            <td>Rp {{ number_format($rpd->akomodasi_awal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
        </tr>
    </table>

    <br>
    <h4>Peserta dan Tujuan Kegiatan</h4>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th width="25%">Nama</th>
                <th width="30%">Judul Project/Prospek/Pelatihan</th>
                <th width="20%">Kegiatan</th>
                <th width="25%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rpd->peserta as $peserta)
                @foreach($rpd->kegiatan()->where('nik_peserta', $peserta->nik)->get() as $kegiatan)
                    <tr>
                        @if ($rpd->kegiatan()->where('nik_peserta', $peserta->nik)->first() == $kegiatan)
                            <td rowspan="{{ $rpd->kegiatan()->where('nik_peserta', $peserta->nik)->count() }}" style="vertical-align: top;">
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
                        <td style="vertical-align: top;">
                            @if ($kegiatan->kegiatan == 'UAT')
                                UAT
                            @else
                                {{ ucwords(strtolower(str_replace('_', ' ', $kegiatan->kegiatan))) }}
                            @endif
                        </td>
                        <td style="vertical-align: top;">
                            {{ $kegiatan->deskripsi }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <br>
    <!--Bagian Action History-->
    <h4>Action History</h4>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th width="25%">Date Time</th>
                <th width="30%">Nama</th>
                <th width="20%">Action Taken</th>
                <th width="25%">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rpd->actionHistory as $action)
                <tr>
                    <td>{{ date_format( date_create($action->created_at), 'd/m/Y H:i') }}</td>
                    <td>{{ $action->pegawai->nama_lengkap }}</td>
                    <td>{{ $action->action }}</td>
                    <td>{{ $action->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
