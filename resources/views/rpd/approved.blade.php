@extends('layouts.master')

@section('page_title', 'RPD Approved')

@section('content')
        
         @if (session('success'))
            <div class="content">
                <div class="row">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="content">
                <div class="row">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="content-header">
            <h1>Data Rencana Perjalanan Dinas</h1>
            <label>Yang telah diapproved</label>
        </div>

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
                                ['class' => 'form-control', 'placeholder' => 'Order by', 'required']
                            ) !!}

                            {!! Form::select(
                                'order',
                                [
                                    'asc' => 'Ascending',
                                    'desc' => 'Descending'
                                ],
                                null,
                                ['class' => 'form-control', 'required']
                            ) !!}

                            {!! Form::button(
                                '<i class="fa fa-fw fa-sort-amount-asc"></i> Sort',
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
                                    'placeholder' => 'Search By',
                                    'required'
                                ]
                            ) !!}
                            {!! Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Query...']) !!}
                            {!! Form::button(
                                '<i class="fa fa-fw fa-search"></i> Search',
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
                                    '<i class="fa fa-fw fa-times"></i> Clear Search',
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
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No. RPD</th>
                                            <th>Pengaju</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Action</th>
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
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $approvedRpd->id }}">
                                                        <i class="fa fa-fw fa-share"></i>Detail
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
                                List RPD yang telah diapproved belum tersedia.
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
                            <h4 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Info basic dari RPD -->
                            <table class="table table-modal table-responsive table-condensed">
                                <tbody>
                                    <tr>
                                        <tr>
                                        <th class="col-md-4">No. RPD</th>
                                        <td>{{ $rpd->kode }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Penanggung Jawab</th>
                                        <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Kategori</th>
                                        <td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Jenis</th>
                                        <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Tanggal Mulai</th>
                                        <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                                    </tr>
                                    @if($dataKategori == "Trip")
                                        <tr>
                                            <th class="col-md-4">Tanggal Selesai</th>
                                            <td>
                                                {{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
                                            </td>
                                            @else
                                            <th class="col-md-4">Tanggal Selesai</th>
                                            <td>
                                                {{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-4">Jumlah Hari Dinas</th>
                                        <td>
                                            {{ $rpd->lama_hari }} hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Asal Kota</th>
                                        <td>{{ $rpd->kotaAsal->nama_kota }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4"><strong>Tujuan Kota</strong></td>
                                        <td>{{ $rpd->kotaTujuan->nama_kota }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4"><strong>Sarana Transportasi</strong></td>
                                        <td>
                                            <ul style="margin-top: 10px;">
                                                @foreach($rpd->saranaTransportasi as $saranaTransportasi)
                                                    <li>{{ $saranaTransportasi->nama_transportasi }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4"><strong>Sarana Penginapan</strong></td>
                                        <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
                                    </tr>
                                    @if ($rpd->status == 'APPROVED' || auth()->user()->role == 'administration')
                                    <tr>
                                        <td class="col-md-4"><strong>Akomodasi Awal</strong></td>
                                        <td>Rp {{ number_format($rpd->akomodasi_awal, 2, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-4">Status</th>
                                        <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Daftar Peserta RPD-->
                            <h4>Peserta dan Tujuan Kegiatan</h4>
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

                            <!--Bagian Action History-->
                            <div class="page-header"><strong>Action History</strong></div>
                            <table class="table table-bordered table-condensed" width="100%">
                                <thead>
                                    <tr class="active">
                                        <th width="25%">Date Time</th>
                                        <th width="30%">Nama</th>
                                        <th width="20%">Action Taken</th>
                                        <th width="25%">Comment</th>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Akhir Bagian Modal detail RPD-->
        @endforeach

@endsection