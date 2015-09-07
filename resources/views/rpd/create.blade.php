@extends('layouts.master')

@section('page_title', 'Buat RPD')

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
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Pengajuan RPD</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'route' => 'rpd.store']) !!}
                        <div class="box-body">
                            <h6 class="page-header"><small>Basic Info</small></h6>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::label('kategori', 'Status') !!}
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label style="font-weight: normal;">
                                                    {!! Form::radio('kategori', 'trip') !!} Trip
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <label style="font-weight: normal;">
                                                    {!! Form::radio('kategori', 'non_trip') !!} Non-trip
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::label('jenis_perjalanan', 'Jenis Perjalanan') !!}
                                                {!! Form::select('jenis_perjalanan', ['dalam_kota' => 'Dalam Kota', 'luar_kota' => 'Luar Kota'],null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::label('tanggal_mulai', 'Tanggal Mulai') !!}
                                        {!! Form::text('tanggal_mulai', null, ['class' => 'form-control datepicker']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::label('tanggal_selesai', 'Tanggal Selesai') !!}
                                        {!! Form::text('tanggal_selesai', null, ['class' => 'form-control datepicker']) !!}
                                    </div>
                                </div>
                            </div>

                            <h6 class="page-header"><small>Destination</small></h6>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::label('kode_kota_asal', 'Kota Asal') !!}
                                        {!! Form::select('kode_kota_asal', $list_kota, null, ['class' => 'form-control', 'placeholder' => 'Pilih kota asal...']) !!}
                                        <br>
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
                                            <div class="col-md-12">
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
                                        {!! Form::label('list_tujuan_kegiatan', 'Tujuan Kegiatan') !!}
                                        {!! Form::select('list_tujuan_kegiatan', ['project' => 'Project', 'prospek' => 'Prospek', 'pelatihan' => 'Pelatihan'], null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 24px;">
                                    {!! Form::button('<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan', ['type' => 'button', 'class' => 'btn btn-default btn-tambah-kegiatan',  'data-loading-text' => 'Loading...']) !!}
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Simpan', ['type' => 'submit', 'class' => 'btn btn-success pull-left']) !!}
                            {!! Form::button('<i class="fa fa-fw fa-plus"></i> Tambah Peserta', ['type' => 'button', 'class' => 'btn btn-default btn-tambah-peserta pull-right']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-tambah-prospek" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Form Tambah Prospek</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'route' => 'prospek.store']) !!}
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('nama_prospek', 'Nama Prospek') !!}
                                            {!! Form::text('nama_prospek', null, ['class' => 'form-control', 'autofocus']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                                            {!! Form::text('nama_lembaga', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('alamat', 'Alamat') !!}
                                            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-success">Simpan</button>
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
                        {!! Form::open(['method' => 'POST', 'route' => 'pelatihan.store']) !!}
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('nama_prospek', 'Nama Prospek') !!}
                                            {!! Form::text('nama_prospek', null, ['class' => 'form-control', 'autofocus']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                                            {!! Form::text('nama_lembaga', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('alamat', 'Alamat') !!}
                                            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-success">Simpan</button>
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
    <script>
        $(document).ready(function(){
            $('.btn-tambah-peserta').on('click', function() {
                var element = $(this).closest('.row-peserta');
                var list_peserta = $('.list-peserta').html();

                var block =
                    '<div class="row row-peserta">' +
                        '<div class="col-md-12"><hr></div>' +
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
                                '<select class="form-control" id="tujuan_kegiatan" name="list_tujuan_kegiatan"><option value="project">Project</option><option value="prospek">Prospek</option><option value="pelatihan">Pelatihan</option></select>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-6" style="margin-top: 24px;">' +
                            '<button type="button" class="btn btn-default btn-tambah-kegiatan" data-loading-text="Loading..."><i class="fa fa-fw fa-plus"></i> Tambah Kegiatan</button> ' +
                            '<button type="button" class="btn btn-danger btn-hapus-peserta pull-right"><i class="fa fa-fw fa-minus"></i></button>' +
                        '</div>' +
                    '</div>';

                $('.box-body').append(block);

                $('.btn-hapus-peserta').off('click').on('click', function() {
                    var element = $(this).closest('.row-peserta');
                    element.remove();
                });

                attachTambahKegiatanClickEvent();
                attachListPesertaChangeEvent();

            });

            $('select[name=list_peserta]').on('change', function () {
                var element = $(this).closest('.row-peserta');

                element.find('input[name="id_peserta[]"]').val(element.find('select[name=list_peserta]').val());
            });

            attachTambahKegiatanClickEvent();
            attachListPesertaChangeEvent();

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
            });

            $('select[name=kode_kota_asal]').select2();
            $('select[name=kode_kota_tujuan]').select2();
        });

        function attachListPesertaChangeEvent() {
            $('select[name=list_peserta]').off('change.list_peserta').on('change.list_peserta', function () {
                var element = $(this).closest('.row-peserta');

                element.find('input[name="id_peserta[]"]').val(element.find('select[name=list_peserta]').val());
            });
        }

        function attachTambahKegiatanClickEvent() {
            $('.btn-tambah-kegiatan').off('click').on('click', function() {
                var $btn = $(this).button('loading');

                var element = $(this).closest('.row-peserta');

                var id_peserta = element.find('select[name=list_peserta]').val();
                var tujuan = element.find('select[name=list_tujuan_kegiatan]').val();

                if (tujuan == 'project') {
                    $.ajax({
                        type : 'GET',
                        url : '/json/project',
                        dataType : 'json',
                    })
                    .done(function(response) {
                        var total = response.length;
                        var list_data = '';

                        $.each(response, function(total, list) {
                            list_data +=
                                '<option value="' + list.kode + '">' +
                                    list.nama_project + ' (' + list.nama_lembaga + ')' +
                                '</option>';
                        })

                        form_kegiatan =
                            '<div class="col-md-12">' +
                                '<div class="row">' +
                                    '<div class="col-md-4">' +
                                        '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                                        '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                                        '<div class="form-group">' +
                                            '<label for="kode_kegiatan">Nama Project</label>' +
                                            '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                                list_data +
                                            '</select>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-4">' +
                                        '<div class="form-group">' +
                                            '<label for="kode_kegiatan">Nama Project</label>' +
                                            '<select class="form-control" id="kode_kegiatan" name="kegiatan[]">' +
                                                '<option value="REQUIREMENT_GATHERING">Requirement Gathering</option>' +
                                                '<option value="UAT">UAT</option>' +
                                                '<option value="REVIEW">Review</option>' +
                                                '<option value="TRAINING_USER">Training User</option>' +
                                            '</select>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-4">' +
                                        '<button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                        element.append(form_kegiatan);

                        $('select[name="kode_kegiatan[]"]').select2();

                        $('.btn-hapus-kegiatan').off('click').on('click', function() {
                            var element = $(this).closest('.col-md-12');
                            element.remove();
                        });

                        $btn.button('reset');
                    });
                } else if (tujuan == 'prospek') {
                    $.ajax({
                        type : 'GET',
                        url : '/json/prospek',
                        dataType : 'json',
                    })

                    .done(function(response) {
                        var total = response.length;
                        var list_data = '';

                        $.each(response, function(total, list) {
                            list_data +=
                                '<option value="' + list.kode + '">' +
                                    list.nama_prospek + ' (' + list.nama_lembaga + ')' +
                                '</option>';
                        })

                        form_kegiatan =
                            '<div class="col-md-12">' +
                                '<div class="row">' +
                                    '<div class="col-md-4">' +
                                        '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                                        '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                                        '<div class="form-group">' +
                                            '<label for="kode_kegiatan">Nama Prospek</label>' +
                                            '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                                list_data +
                                            '</select>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-8" style="margin-top: 24px;">' +
                                        '<input type="hidden" name="kegiatan" value="-">' +
                                        '<button type="button" class="btn btn-default btn-modal-prospek">' +
                                          '<i class="fa fa-fw fa-plus"></i> Prospek Baru' +
                                        '</button>' +
                                        '<button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                        element.append(form_kegiatan);

                        $('select[name="kode_kegiatan[]"]').select2();

                        $('.btn-hapus-kegiatan').off('click').on('click', function() {
                            var element = $(this).closest('.col-md-12');
                            element.remove();
                        });

                        $('.btn-modal-prospek').on('click', function() {
                            console.log('tes')
                            $('#modal-tambah-prospek').modal('show');
                        });

                        $btn.button('reset');
                    });
                } else {
                    $.ajax({
                        type : 'GET',
                        url : '/json/pelatihan',
                        dataType : 'json',
                    })

                    .done(function(response) {
                        var total = response.length;
                        var list_data = '';
                        $.each(response, function(total, list) {
                            list_data +=
                                '<option value="' + list.kode + '">' +
                                    list.nama_pelatihan + ' (' + list.nama_lembaga + ')' +
                                '</option>';
                        })

                        form_kegiatan =
                            '<div class="col-md-12">' +
                                '<div class="row">' +
                                    '<div class="col-md-4">' +
                                        '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                                        '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                                        '<div class="form-group">' +
                                            '<label for="kode_kegiatan">Nama Pelatihan</label>' +
                                            '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                                list_data +
                                            '</select>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-8">' +
                                        '<input type="hidden" name="kegiatan" value="-">' +
                                        '<button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';
                        element.append(form_kegiatan);

                        $('select[name="kode_kegiatan[]"]').select2();

                        $('.btn-hapus-kegiatan').off('click').on('click', function() {
                            var element = $(this).closest('.col-md-12');
                            element.remove();
                        });

                        $('.btn-modal-prospek').on('click', function() {
                            console.log('tes')
                            $('#modal-tambah-prospek').modal('show');
                        });

                        $btn.button('reset');
                    });
                }


            });



            $('select[name=list_peserta]').select2();
        }


    </script>
@endsection
