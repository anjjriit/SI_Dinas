@extends('layouts.master')

@section('page_title', 'Buat RPD')

@section('stylesheet')
    @parent
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')
        <section class="content-header">
            <h1>Rencana Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Pengajuan RPD</h4>
                        </div>
                        <div class="box-body">
                            <h6 class="page-header"><small>Basic Info</small></h6>

                            <div class="form-group">
                                {!! Form::label('kategori', 'Status') !!}
                                <div class="row">
                                    <div class="col-md-2">
                                        <label style="font-weight: normal;">
                                            {!! Form::radio('kategori', 'trip') !!} Trip
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label style="font-weight: normal;">
                                            {!! Form::radio('kategori', 'non_trip') !!} Non-trip
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::label('jenis_perjalanan', 'Jenis Perjalanan') !!}
                                        {!! Form::select('jenis_perjalanan', ['dalam_kota' => 'Dalam Kota', 'luar_kota' => 'Luar Kota'],null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <h6 class="page-header"><small>Time</small></h6>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::label('tanggal_mulai', 'Mulai') !!}
                                        {!! Form::text('tanggal_mulai', null, ['class' => 'form-control datepicker']) !!}
                                    </div>

                                    <div class="col-md-4">
                                        {!! Form::label('tanggal_selesai', 'Selesai') !!}
                                        {!! Form::text('tanggal_selesai', null, ['class' => 'form-control datepicker']) !!}
                                    </div>
                                </div>
                            </div>

                            <h6 class="page-header"><small>Destination</small></h6>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::label('kode_kota_asal', 'Kota Asal') !!}
                                        {!! Form::select('kode_kota_asal', $list_kota, null, ['class' => 'form-control', 'placeholder' => 'Pilih kota asal...']) !!}
                                        <br>
                                        {!! Form::label('kode_kota_tujuan', 'Kota Tujuan') !!}
                                        {!! Form::select('kode_kota_tujuan', $list_kota, null, ['class' => 'form-control', 'placeholder' => 'Pilih kota tujuan...']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::label('sarana_transportasi', 'Sarana Transportasi') !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label style="font-weight:normal">
                                                    {!! Form::checkbox('sarana_transportasi[]', 'Mobil Dinas') !!} Mobil Dinas
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="font-weight:normal">
                                                    {!! Form::checkbox('sarana_transportasi[]', 'kereta') !!} Kereta
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="font-weight:normal">
                                                    {!! Form::checkbox('sarana_transportasi[]', 'travel') !!} Travel
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="font-weight:normal">
                                                    {!! Form::checkbox('sarana_transportasi[]', 'pesawat') !!} Pesawat
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 1px">
                                            <div class="col-md-8">
                                                {!! Form::label('sarana_penginapan', 'Sarana Penginapan') !!}
                                                {!! Form::select('sarana_penginapan', ['kost' => 'Kost', 'guest_house' => 'Guest House', 'hotel' => 'Hotel'], null, ['class' => 'form-control'])!!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <h6 class="page-header"><small>Participants</small></h6>

                            <div class="row row-peserta">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('list_peserta', 'Peserta') !!}
                                        {!! Form::select('list_peserta', $list_pegawai, null, ['class' => 'form-control list-peserta']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::label('tujuan_kegiatan', 'Tujuan Kegiatan') !!}
                                        {!! Form::select('tujuan_kegiatan', ['project' => 'Project', 'prospek' => 'Prospek', 'pelatihan' => 'Pelatihan'], null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::button('<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan', ['type' => 'button', 'class' => 'btn btn-success button-tambah-kegiatan', 'style' => 'margin-top: 24px;']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right">
                            {!! Form::button('<i class="fa fa-fw fa-plus"></i> Tambah Peserta', ['type' => 'button', 'class' => 'btn btn-success button-tambah-peserta']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('script')
    @parent

    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.button-tambah-peserta').on('click', function() {
                var element = $(this).parent()
                var list_peserta = $('.list-peserta').html()

                var block =
                    '<div class="row row-peserta">' +
                        '<div class="col-md-4">' +
                            '<div class="form-group">' +
                                '<label for="list_peserta">Peserta</label>' +
                                '<select class="form-control list-peserta" id="list_peserta" name="list_peserta">' +
                                    list_peserta +
                                '</select>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<div class="form-group">' +
                                '<label for="tujuan_kegiatan">Tujuan Kegiatan</label>' +
                                '<select class="form-control" id="tujuan_kegiatan" name="tujuan_kegiatan"><option value="project">Project</option><option value="prospek">Prospek</option><option value="pelatihan">Pelatihan</option></select>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-6" style="margin-top: 23px;">' +
                            '<button type="button" class="btn btn-success button-tambah-kegiatan"><i class="fa fa-fw fa-plus"></i> Tambah Kegiatan</button> ' +
                            '<button type="button" class="btn btn-danger button-hapus-peserta"><i class="fa fa-fw fa-minus"></i></button>' +
                        '</div>' +
                    '</div>'

                $('.box-body').append(block)

                $('.button-hapus-peserta').on('click', function() {
                    var element = $(this).closest('.row-peserta')
                    element.remove()
                })

                $('.button-tambah-kegiatan').on('click', function() {
                    var element = $(this).closest('.row-peserta')
                    element.find('.list-peserta').attr('disabled', 'disabled')
                })
            })

            $('.button-tambah-kegiatan').on('click', function(event) {
                var element = $(this).closest('.row-peserta')

                element.find('.list-peserta').attr('disabled', 'disabled')
                console.log(element.find('.list-peserta').val())
            })

            // Datepicker
            $('.datepicker').datepicker({
                autoclose: true,
                beforeShowMonth: function (date){
                        switch (date.getMonth()){
                          case 8:
                            return false;
                        }
                    },
                format: 'yyyy-mm-dd',
            })
        })


    </script>
@endsection
