@extends('layouts.master')

@section('page_title', 'Buat RPD')

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
                            <h6 class="page-header"><small>Participants</small></h6>

                            <div class="row peserta">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('list_peserta', 'Nama Peserta') !!}
                                        {!! Form::select('list_peserta', $list_pegawai, null, ['class' => 'form-control list-peserta', 'placeholder' => 'Pilih peserta...']) !!}
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

    <script>
        $(document).ready(function(){
            $('.button-tambah-peserta').on('click', function() {
                var element = $(this).parent()
                var list_peserta = $('.list-peserta').html()

                var block =
                    '<div class="row peserta">' +
                        '<div class="col-md-4">' +
                            '<div class="form-group">' +
                                '<label for="list_peserta">Nama Peserta</label>' +
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
                    var element = $(this).parent().parent()
                    element.remove()
                })
            })


        })
    </script>
@endsection
