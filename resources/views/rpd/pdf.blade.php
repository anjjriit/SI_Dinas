<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <h4>RENCANA PERJALANAN DINAS (RPD)</h4>
    <table>
        <tr>
            <td>Kode RPD</td>
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
                <td>Tanggal </td>
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
            <td><strong>Tujuan Kota</strong></td>
            <td>{{ $rpd->kotaTujuan->nama_kota }}</td>
        </tr>
        <tr>
            <td><strong>Sarana Transportasi</strong></td>
            <td>
                <ul>
                    @foreach($rpd->saranaTransportasi as $saranaTransportasi)
                        <li>{{ $saranaTransportasi->nama_transportasi }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td><strong>Sarana Penginapan</strong></td>
            <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
        </tr>
        <tr>
            <td><strong>Akomodasi Awal</strong></td>
            <td>Rp {{ number_format($rpd->akomodasi_awal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
        </tr>
    </table>

    <br>
    <h3>Peserta dan Tujuan Kegiatan</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Judul Project/Prospek/Pelatihan</th>
                <th>Kegiatan</th>
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
                        <td>
                            @if ($kegiatan->kegiatan == 'UAT')
                                'UAT'
                            @else
                                {{ ucwords(strtolower(str_replace('_', ' ', $kegiatan->kegiatan))) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

            <!--Bagian Komentar atau Keterangan-->
    <h4>Komentar</h4>
    <p>
        {{ $rpd->keterangan }}
    </p>

    <!--Bagian Action History-->
    <h4>Action History</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date Time</th>
                <th>Nama</th>
                <th>Action Taken</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rpd->actionHistory as $action)
                <tr>
                    <td>{{ date_format( date_create($action->created_at), 'd/m/Y H:i') }}</td>
                    <td>{{ $action->pegawai->nama_lengkap }}</td>
                    <td>{{ $action->action }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
