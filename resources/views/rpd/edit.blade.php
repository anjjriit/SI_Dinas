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

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                        <br>
                    @endforeach
                </div>
            @endif

            {!! Form::open(['method' => 'POST', 'route' => 'rpd.action']) !!}
                <div class="wizard">
                    <div class="wizard-inner">
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
                                                {!! Form::label('sarana_penginapan', 'Sarana Penginapan') !!}
                                                {!! Form::select(
                                                    'sarana_penginapan',
                                                    [
                                                        'kost' => 'Kost',
                                                        'guest_house' => 'Guest House',
                                                        'hotel' => 'Hotel'
                                                    ],
                                                    null,
                                                    ['class' => 'form-control'])
                                                !!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('sarana_transportasi', 'Sarana Transportasi') !!}

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label style="font-weight:normal">
                                                            {!! Form::checkbox('sarana_transportasi[]', 'Mobil Dinas') !!} Mobil Dinas
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label style="font-weight:normal">
                                                            {!! Form::checkbox('sarana_transportasi[]', 'Kereta') !!} Kereta
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label style="font-weight:normal">
                                                            {!! Form::checkbox('sarana_transportasi[]', 'Travel') !!} Travel
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label style="font-weight:normal">
                                                            {!! Form::checkbox('sarana_transportasi[]', 'Pesawat') !!} Pesawat
                                                        </label>
                                                    </div>
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
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                {!! Form::label('keterangan', 'Keterangan') !!}
                                                {!! Form::textarea(
                                                    'keterangan',
                                                    null,
                                                    [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Isi dengan keterangan tambahan (bila diperlukan)',
                                                        'rows' => 3
                                                    ]
                                                ) !!}
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
                                            '<i class="fa fa-fw fa-floppy-o"></i> Save as Draft',
                                            [
                                                'type' => 'submit',
                                                'class' => 'btn btn-default',
                                                'name' => 'action',
                                                'value' => 'draft'
                                            ]
                                        ) !!}
                                    </li>
                                    <li>
                                        {!! Form::button(
                                            '<i class="fa fa-fw fa-check"></i> Submit',
                                            [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success',
                                                'name' => 'action',
                                                'value' => 'submit'
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
