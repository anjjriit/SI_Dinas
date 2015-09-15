@extends('layouts.master')

@section('page_title', 'Edit Pengajuan RPD')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css" />
@endsection

@section('content')
    <section class="content-header">
        <h1>Rencana Perjalanan Dinas</h1>
    </section>

    <section class="content">
        <div class="box box-widget">
            <div class="box-header">
                <h4>Form Pengajuan RPD</h4>
            </div>

            {!! Form::model($rpd, ['method' => 'PATCH', 'url' => ['/administrasi/rpd/' . $rpd->id]]) !!}
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="row">
                             <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <ul class="nav nav-tabs text-center" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab">
                                    <i class="fa fa-fw fa-info"></i> Basic Info
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab">
                                    <i class="fa fa-fw fa-calendar"></i> Time &amp; Destination
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                                    <i class="fa fa-fw fa-users"></i> Participants
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab">
                                    <i class="fa fa-fw fa-file-text-o"></i> Additional Information
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <div class="box-body box-basic-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('kategori', 'Kategori') !!}

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label style="font-weight: normal;">
                                                            {!! Form::radio('kategori', 'trip') !!} Trip
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label style="font-weight: normal;">
                                                            {!! Form::radio('kategori', 'non_trip') !!} Non-trip
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('jenis_perjalanan', 'Jenis Perjalanan') !!}
                                                {!! Form::select(
                                                    'jenis_perjalanan', [
                                                        'dalam_kota' => 'Dalam Kota',
                                                        'luar_kota' => 'Luar Kota'
                                                    ],
                                                    null,
                                                    ['class' => 'form-control']
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline text-right">
                                    <li>
                                        {!! Form::button(
                                            'Next <i class="fa fa-fw fa-angle-right"></i>',
                                            [
                                                'type' => 'button',
                                                'class' => 'btn btn-success next-step'
                                            ]
                                        ) !!}
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step2">
                                <div class="box-body box-destination">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('tanggal_mulai', 'Tanggal Mulai') !!}
                                                {!! Form::text('tanggal_mulai', null, ['class' => 'form-control datepicker']) !!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('tanggal_selesai', 'Tanggal Selesai') !!}
                                                {!! Form::text('tanggal_selesai', null, ['class' => 'form-control datepicker']) !!}
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!! Form::label('lama_hari', 'Lama Hari Dinas') !!}
                                                        {!! Form::text('lama_hari', null, ['class' => 'form-control', 'readonly']) !!}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('kode_kota_asal', 'Kota Asal') !!}
                                                {!! Form::select('kode_kota_asal', $list_kota, null, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('kode_kota_tujuan', 'Kota Tujuan') !!}
                                                {!! Form::select('kode_kota_tujuan', $list_kota, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('id_penginapan', 'Sarana Penginapan') !!}
                                                {!! Form::select(
                                                    'id_penginapan',
                                                    $list_penginapan,
                                                    null,
                                                    ['class' => 'form-control'])
                                                !!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('id_transportasi', 'Sarana Transportasi') !!}

                                                <div class="row">
                                                    @foreach ($list_transportasi as $transportasi)
                                                        <div class="col-md-6">
                                                            <label style="font-weight:normal">
                                                                {!! Form::checkbox(
                                                                    'id_transportasi[]',
                                                                    $transportasi->id,
                                                                    in_array(
                                                                        $transportasi->id,
                                                                        $rpd->saranaTransportasi()->lists('id_transportasi')->all()
                                                                    )
                                                                ) !!} {{ $transportasi->nama_transportasi }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline text-right">
                                    <li>
                                        {!! Form::button(
                                            '<i class="fa fa-fw fa-angle-left"></i> Prev',
                                            [
                                                'type' => 'button',
                                                'class' => 'btn btn-default prev-step'
                                            ]
                                        ) !!}
                                    </li>
                                    <li>
                                        {!! Form::button(
                                            'Next <i class="fa fa-fw fa-angle-right"></i>',
                                            [
                                                'type' => 'button',
                                                'class' => 'btn btn-success next-step'
                                            ]
                                        ) !!}
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step3">
                                <div class="box-body box-participants">
                                    @if (count(old('id_peserta')) > 0)
                                        @foreach (array_unique(old('id_peserta')) as $peserta)
                                            <div class="row peserta">
                                                @if ($peserta != old('id_peserta')[0])
                                                    <div class="col-md-12"><hr></div>
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="list_peserta">Peserta</label>
                                                        <select name="list_peserta" id="list_peserta">
                                                            @foreach ($list_pegawai as $nik => $nama_pegawai)
                                                                <option value="{{ $nik }}"{{ ($nik == $peserta) ? ' selected' : '' }}>{{ $nama_pegawai }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        {!! Form::label('list_tujuan_kegiatan', 'Tujuan Kegiatan') !!}
                                                        {!! Form::select(
                                                            'list_tujuan_kegiatan',
                                                            [
                                                                'project' => 'Project',
                                                                'prospek' => 'Prospek',
                                                                'pelatihan' => 'Pelatihan'
                                                            ],
                                                            null,
                                                            ['class' => 'form-control'])
                                                        !!}
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="margin-top: 24px;">
                                                    {!! Form::button(
                                                        '<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan',
                                                        [
                                                            'type' => 'button',
                                                            'class' => 'btn btn-default btn-tambah-kegiatan',
                                                            'data-loading-text' => 'Loading...'
                                                        ]
                                                    ) !!}
                                                    @if ($peserta != old('id_peserta')[0])
                                                        {!! Form::button(
                                                            '<i class="fa fa-fw fa-minus"></i>',
                                                            [
                                                                'type' => 'button',
                                                                'class' => 'btn btn-danger btn-hapus-peserta pull-right',
                                                            ]
                                                        ) !!}
                                                    @endif
                                                </div>

                                                @for ($i = 0;$i < count(old('id_peserta'));$i++)
                                                    @if (old('id_peserta')[$i] == $peserta)
                                                        @if (old('tujuan_kegiatan')[$i] == 'project')
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="hidden" name="id_peserta[]" value="{{ old('id_peserta')[$i] }}">
                                                                    <input type="hidden" name="tujuan_kegiatan[]" value="{{ old('tujuan_kegiatan')[$i] }}">
                                                                    <div class="form-group">
                                                                        <label for="kode_kegiatan">Nama Project</label>
                                                                        <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                                                            @foreach ($list_project as $project)
                                                                                <option value="{{ $project->kode }}"{{ ($project->kode == old('kode_kegiatan')[$i]) ? ' selected' : '' }}>{{ $project->nama_project . ' (' . $project->nama_lembaga . ')' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="kode_kegiatan">Kegiatan</label>
                                                                        <select class="form-control" id="kode_kegiatan" name="kegiatan[]">
                                                                            <option value="REQUIREMENT_GATHERING"{{ (old('kegiatan')[$i] == "REQUIREMENT_GATHERING") ? ' selected' : '' }}>Requirement Gathering</option>
                                                                            <option value="UAT"{{ (old('kegiatan')[$i] == "UAT") ? ' selected' : '' }}>UAT</option>
                                                                            <option value="REVIEW"{{ (old('kegiatan')[$i] == "REVIEW") ? ' selected' : '' }}>Review</option>
                                                                            <option value="TRAINING_USER"{{ (old('kegiatan')[$i] == "TRAINING_USER") ? ' selected' : '' }}>Training User</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif (old('tujuan_kegiatan')[$i] == 'prospek')
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="hidden" name="id_peserta[]" value="{{ old('id_peserta')[$i] }}">
                                                                    <input type="hidden" name="tujuan_kegiatan[]" value="{{ old('tujuan_kegiatan')[$i] }}">
                                                                    <div class="form-group">
                                                                        <label for="kode_kegiatan">Nama Prospek</label>
                                                                        <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                                                            @foreach ($list_prospek as $prospek)
                                                                                <option value="{{ $prospek->kode }}"{{ ($prospek->kode == old('kode_kegiatan')[$i]) ? ' selected' : '' }}>{{ $prospek->nama_prospek . ' (' . $prospek->nama_lembaga . ')' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8" style="margin-top: 24px;">
                                                                    <input type="hidden" name="kegiatan[]" value="-">
                                                                    <button type="button" class="btn btn-default btn-modal-prospek">
                                                                        <i class="fa fa-fw fa-plus"></i> Prospek Baru
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif (old('tujuan_kegiatan')[$i] == 'pelatihan')
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="hidden" name="id_peserta[]" value="{{ old('id_peserta')[$i] }}">
                                                                    <input type="hidden" name="tujuan_kegiatan[]" value="{{ old('tujuan_kegiatan')[$i] }}">
                                                                    <div class="form-group">
                                                                        <label for="kode_kegiatan">Nama Pelatihan</label>
                                                                        <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                                                            @foreach ($list_pelatihan as $pelatihan)
                                                                                <option value="{{ $pelatihan->kode }}"{{ ($pelatihan->kode == old('kode_kegiatan')[$i]) ? ' selected' : '' }}>{{ $pelatihan->nama_pelatihan . ' (' . $pelatihan->nama_lembaga . ')' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8" style="margin-top: 24px;">
                                                                    <input type="hidden" name="kegiatan[]" value="-">
                                                                    <button type="button" class="btn btn-default btn-modal-pelatihan">
                                                                        <i class="fa fa-fw fa-plus"></i> Pelatihan Baru
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </div>
                                        @endforeach
                                    @else
                                        @if (count($rpd->peserta) > 0)
                                            @foreach ($rpd->peserta as $peserta)
                                                <div class="row peserta">
                                                    @if ($peserta != $rpd->peserta[0])
                                                        <div class="col-md-12"><hr></div>
                                                    @endif
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            {!! Form::label('list_peserta', 'Peserta') !!}
                                                            {!! Form::select(
                                                                'list_peserta',
                                                                $list_pegawai,
                                                                $peserta->nik,
                                                                [
                                                                    'class' => 'form-control list-peserta'
                                                                ]
                                                            ) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            {!! Form::label('list_tujuan_kegiatan', 'Tujuan Kegiatan') !!}
                                                            {!! Form::select(
                                                                'list_tujuan_kegiatan',
                                                                [
                                                                    'project' => 'Project',
                                                                    'prospek' => 'Prospek',
                                                                    'pelatihan' => 'Pelatihan'
                                                                ],
                                                                null,
                                                                ['class' => 'form-control'])
                                                            !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" style="margin-top: 24px;">
                                                        {!! Form::button(
                                                            '<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan',
                                                            [
                                                                'type' => 'button',
                                                                'class' => 'btn btn-default btn-tambah-kegiatan',
                                                                'data-loading-text' => 'Loading...'
                                                            ]
                                                        ) !!}
                                                        @if ($peserta != $rpd->peserta[0])
                                                            {!! Form::button(
                                                                '<i class="fa fa-fw fa-minus"></i>',
                                                                [
                                                                    'type' => 'button',
                                                                    'class' => 'btn btn-danger btn-hapus-peserta pull-right',
                                                                ]
                                                            ) !!}
                                                        @endif
                                                    </div>

                                                    @foreach ($rpd->kegiatan as $kegiatan)
                                                        @if ($kegiatan['nik_peserta'] == $peserta['nik'])
                                                            @if ($kegiatan->jenis_kegiatan == 'project')
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        {!! Form::hidden('id_peserta[]', $peserta['nik']) !!}
                                                                        {!! Form::hidden('tujuan_kegiatan[]', $kegiatan->jenis_kegiatan) !!}
                                                                        <div class="form-group">
                                                                            <label for="kode_kegiatan">Nama Project</label>
                                                                            <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                                                                @foreach ($list_project as $project)
                                                                                    <option value="{{ $project->kode }}"{{ ($project->kode == $rpd->kode_kegiatan) ? ' selected' : '' }}>{{ $project->nama_project . ' (' . $project->nama_lembaga . ')' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            {!! Form::label('kegiatan', 'Kegiatan') !!}
                                                                            {!! Form::select(
                                                                                'kegiatan[]',
                                                                                [
                                                                                    'REQUIREMENT_GATHERING' => 'Requirement Gathering',
                                                                                    'UAT' => 'UAT',
                                                                                    'REVIEW' => 'Review',
                                                                                    'TRAINING_USER' => 'Training User'
                                                                                ],
                                                                                $kegiatan->kegiatan,
                                                                                ['class' => 'form-control']
                                                                            ) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @elseif ($kegiatan->jenis_kegiatan == 'prospek')


                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        {!! Form::hidden('id_peserta[]', $peserta['nik']) !!}
                                                                        {!! Form::hidden('tujuan_kegiatan[]', $kegiatan->jenis_kegiatan) !!}
                                                                        <div class="form-group">
                                                                            <label for="kode_kegiatan">Nama Prospek</label>
                                                                            <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                                                                @foreach ($list_prospek as $prospek)
                                                                                    <option value="{{ $prospek->kode }}"{{ ($prospek->kode == $rpd->kode_kegiatan) ? ' selected' : '' }}>{{ $prospek->nama_prospek . ' (' . $prospek->nama_lembaga . ')' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8" style="margin-top: 24px;">
                                                                        <input type="hidden" name="kegiatan[]" value="-">
                                                                        <button type="button" class="btn btn-default btn-modal-prospek">
                                                                            <i class="fa fa-fw fa-plus"></i> Prospek Baru
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @elseif ($kegiatan->jenis_kegiatan == 'pelatihan')
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        {!! Form::hidden('id_peserta[]', $peserta['nik']) !!}
                                                                        {!! Form::hidden('tujuan_kegiatan[]', $kegiatan->jenis_kegiatan) !!}
                                                                        <div class="form-group">
                                                                            <label for="kode_kegiatan">Nama Pelatihan</label>
                                                                            <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                                                                @foreach ($list_pelatihan as $pelatihan)
                                                                                    <option value="{{ $pelatihan->kode }}"{{ ($pelatihan->kode == $rpd->kode_kegiatan) ? ' selected' : '' }}>{{ $pelatihan->nama_pelatihan . ' (' . $pelatihan->nama_lembaga . ')' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8" style="margin-top: 24px;">
                                                                        <input type="hidden" name="kegiatan[]" value="-">
                                                                        <button type="button" class="btn btn-default btn-modal-pelatihan">
                                                                            <i class="fa fa-fw fa-plus"></i> Pelatihan Baru
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row peserta">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        {!! Form::label('list_peserta', 'Peserta') !!}
                                                        {!! Form::select(
                                                            'list_peserta',
                                                            $list_pegawai,
                                                            null,
                                                            [
                                                                'class' => 'form-control list-peserta'
                                                            ]
                                                        ) !!}
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        {!! Form::label('list_tujuan_kegiatan', 'Tujuan Kegiatan') !!}
                                                        {!! Form::select(
                                                            'list_tujuan_kegiatan',
                                                            [
                                                                'project' => 'Project',
                                                                'prospek' => 'Prospek',
                                                                'pelatihan' => 'Pelatihan'
                                                            ],
                                                            null,
                                                            ['class' => 'form-control'])
                                                        !!}
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="margin-top: 24px;">
                                                    {!! Form::button(
                                                        '<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan',
                                                        [
                                                            'type' => 'button',
                                                            'class' => 'btn btn-default btn-tambah-kegiatan',
                                                            'data-loading-text' => 'Loading...'
                                                        ]
                                                    ) !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="box-body box-add-participants">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::button(
                                                '<i class="fa fa-fw fa-plus"></i> Tambah Peserta',
                                                [
                                                    'type' => 'button',
                                                    'class' => 'btn btn-default btn-tambah-peserta pull-right'
                                                ])
                                            !!}
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline text-right">
                                    <li>
                                        {!! Form::button(
                                            '<i class="fa fa-fw fa-angle-left"></i> Prev',
                                            [
                                                'type' => 'button',
                                                'class' => 'btn btn-default prev-step'
                                            ]
                                        ) !!}
                                    </li>
                                    <li>
                                        {!! Form::button(
                                            'Next <i class="fa fa-fw fa-angle-right"></i>',
                                            [
                                                'type' => 'button',
                                                'class' => 'btn btn-success next-step'
                                            ]
                                        ) !!}
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step4">
                                <div class="box-body box-finish">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('akomodasi_awal', 'Akomodasi Awal') !!}
                                                {!! Form::text('akomodasi_awal', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline text-right">
                                    <li>
                                        {!! Form::button(
                                            '<i class="fa fa-fw fa-angle-left"></i> Prev',
                                            [
                                                'type' => 'button',
                                                'class' => 'btn btn-default prev-step'
                                            ]
                                        ) !!}
                                    </li>
                                    <li>
                                        {!! Form::button(
                                            '<i class="fa fa-fw fa-check"></i> Update',
                                            [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success',
                                                'name' => 'action',
                                                'value' => 'simpan'
                                            ]
                                        ) !!}
                                    </li>
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

        <div class="modal fade" id="modal-tambah-prospek" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Form Tambah Prospek</h4>
                    </div>

                    {!! Form::open(
                        [
                            'method' => 'POST',
                            'route' => 'prospek.ajax.store',
                            'name' => 'tambah-prospek'
                        ]
                    ) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::label('nama_prospek', 'Nama Prospek') !!}
                                {!! Form::text('nama_prospek', null, ['class' => 'form-control', 'autofocus', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                                {!! Form::text('nama_lembaga', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('alamat', 'Alamat') !!}
                                {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-tambah-pelatihan" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Form Tambah Pelatihan</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'route' => 'pelatihan.store', 'name' => 'tambah-pelatihan']) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::label('nama_pelatihan', 'Nama Pelatihan') !!}
                                {!! Form::text('nama_pelatihan', null, ['class' => 'form-control', 'autofocus', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                                {!! Form::text('nama_lembaga', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('tanggal_mulai', 'Tanggal Mulai') !!}
                                {!! Form::text('tanggal_mulai', null, ['class' => 'form-control datepicker', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('tanggal_selesai', 'Tanggal Selesai') !!}
                                {!! Form::text('tanggal_selesai', null, ['class' => 'form-control datepicker', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('alamat', 'Alamat') !!}
                                {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @parent

    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/vendor/select2/js/select2.min.js"></script>
    <script src="/js/form-rpd.js"></script>
@endsection
