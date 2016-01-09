@extends('layouts.master')

@section('page_title', 'RPD yang Disetujui')

@section('content')



        <section class="content-header">
            <p>RPD yang Disetujui</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Halaman Utama</a>
                @else
                    <a href="/homepage">Halaman Utama</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Rencana Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Setujui
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/rpd/approved',
                        'class' => 'form-inline pull-right'
                    ])!!}
                        <div class="form-group">
                            @if ($request->has('query'))
                                {!! Form::hidden('searchBy') !!}
                                {!! Form::hidden('query') !!}
                            @endif

                            {!! Form::select(
                                'orderBy',
                                [
                                    'kode' => 'No. RPD',
                                    'updated_at' => 'Terakhir Diperbarui'
                                ],
                                null,
                                ['class' => 'form-control', 'placeholder' => 'Kategori', 'required']
                            ) !!}

                            {!! Form::select(
                                'order',
                                [
                                    'asc' => 'Menaik',
                                    'desc' => 'Menurun'
                                ],
                                null,
                                ['class' => 'form-control', 'required']
                            ) !!}

                            {!! Form::button(
                                '<i class="fa fa-fw fa-sort-amount-asc"></i> Urutkan',
                                [
                                    'type' => 'submit', 'class' => 'btn btn-success'
                                ]
                            ) !!}
                        </div>
                    {!! Form::close() !!}

                    {!! Form::model($request,
                        [
                            'method' => 'GET',
                            'url' => '/rpd/approved',
                            'class' => 'form-inline pull-left'
                        ]
                    )!!}
                        <div class="form-group">
                            @if ($request->has('orderBy'))
                                {!! Form::hidden('orderBy') !!}
                                {!! Form::hidden('order') !!}
                            @endif

                            {!! Form::select(
                                'searchBy',
                                [
                                    'kode' => 'No. RPD',
                                    'updated_at' => 'Terakhir Diperbarui'
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Kategori',
                                    'required'
                                ]
                            ) !!}
                            {!! Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Kata Kunci...']) !!}
                            {!! Form::button(
                                '<i class="fa fa-fw fa-search"></i> Cari',
                                ['type' => 'submit', 'class' => 'btn btn-success', 'style' => 'margin-left: 3px;']
                            ) !!}
                        </div>
                    {!! Form::close() !!}

                    @if ($request->has('query'))
                        {!! Form::model($request,
                            [
                                'method' => 'GET',
                                'url' => '/rpd/approved',
                                'class' => 'form-inline pull-left',
                                'style' => 'margin-left: 5px;'
                            ]
                        )!!}
                            <div class="form-group">
                                @if ($request->has('orderBy'))
                                    {!! Form::hidden('orderBy') !!}
                                    {!! Form::hidden('order') !!}
                                @endif

                                {!! Form::button(
                                    '<i class="fa fa-fw fa-times"></i> Kosongkan Pencarian',
                                    [
                                        'type' => 'submit',
                                        'class' => 'btn btn-info',
                                        'style' => 'margin-top: 1px;'
                                    ]
                                ) !!}
                            </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($approvedRpds->count() != 0)
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No. RPD</th>
                                            <th>Pengaju</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approvedRpds as $approvedRpd)
                                            <tr>
                                                <td>
                                                    {{ $approvedRpd->kode }}
                                                </td>
                                                <td>
                                                    {{ $approvedRpd->pegawai->nama_lengkap }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($approvedRpd->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailRPD-{{ $approvedRpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-fw fa-share"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        @if ($request->has('query'))
                            <div class="alert alert-warning">
                                Hasil tidak ditemukan untuk kata kunci "<strong>{{ $request->input('query') }}</strong>".
                            </div>
                        @else
                            <div class="alert alert-warning">
                                List RPD yang telah disetujui belum tersedia.
                            </div>
                        @endif
                    @endif

                    {!! $approvedRpds->render() !!}
                </div>
            </div>
        </section>

        <!-- Bagian Modal Detail RPD -->
        @foreach ($approvedRpds as $rpd)
            <div class="modal fade" id="detailRPD-{{ $rpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><strong>Rencana Perjalanan Dinas (RPD)</strong></h4>
                        </div>
                        <div class="modal-body">
                            <!-- Info basic dari RPD -->
                            <div class="page-header"><strong>Detail</strong></div>
                            <a href="/rpd/{{$rpd->id}}/pdf" class="btn btn-xs btn-primary pull-right" style="margin-top: 12px;" target="_blank"><i class="fa fa-fw fa-print"></i> Ekspor PDF</a>
                            <table class="table table-plain table-responsive">
                                <tbody>
                                    <tr>
                                        <td class="col-md-3">Nomor RPD</td>
                                        <td>{{ $rpd->kode }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Penanggung Jawab</td>
                                        <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Kategori</td>
                                        <td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Jenis</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Tanggal Mulai</td>
                                        <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Tanggal Selesai</td>
                                        <td>
                                            {{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Jumlah Hari Dinas</td>
                                        <td>
                                            {{ $rpd->lama_hari }} hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Asal Kota</td>
                                        <td>{{ $rpd->kotaAsal->nama_kota }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Tujuan Kota</td>
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
                                        <td class="col-md-3">Sarana Penginapan</td>
                                        <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
                                    </tr>
                                    @if ($rpd->status == 'APPROVED' || auth()->user()->role == 'administration')
                                    <tr>
                                        <td class="col-md-3">Akomodasi Awal</td>
                                        <td>Rp {{ number_format($rpd->akomodasi_awal, 2, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="col-md-3">Status</td>
                                        <td>{{ $rpd->status }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Daftar Peserta RPD-->
                            <div class="page-header"><strong>Peserta &amp; Tujuan Kegiatan</strong></div>
                            <table class="table table-bordered table-condensed" width="100%">
                                <thead>
                                    <tr class="active">
                                        <th width="25%">Nama</th>
                                        <th width="30%">Judul Proyek/Prospek/Pelatihan</th>
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
                                                <td>
                                                    @if ($kegiatan->kegiatan == 'UAT')
                                                        UAT
                                                    @else
                                                        {{ ucwords(strtolower(str_replace('_', ' ', $kegiatan->kegiatan))) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($kegiatan->deskripsi == '')
                                                        -
                                                    @else
                                                        {{ $kegiatan->deskripsi }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>

                            <!--Bagian Action History-->
                            <div class="page-header"><strong>Histori</strong></div>
                            <table class="table table-bordered table-condensed" width="100%">
                                <thead>
                                    <tr class="active">
                                        <th width="25%">Tanggal & Waktu</th>
                                        <th width="30%">Nama</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="25%">Komentar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rpd->actionHistory as $action)
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Tutup</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Akhir Bagian Modal detail RPD-->
        @endforeach

@endsection

@section('script')
    @parent

    <script>
        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>
@endsection
