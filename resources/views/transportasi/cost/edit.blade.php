@extends('layouts.master')

@section('page_title', 'Edit Biaya Transportasi')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css" />
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Transportasi</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit Biaya Transportasi {{ $transportasi->nama_transportasi }}</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::model($biayaTransportasi, ['method' => 'PATCH', 'url' => '/transportasi/' . $transportasi->id . '/biaya/' . $biayaTransportasi->id]) !!}
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                @include('transportasi.cost._form')
                            </div>
                            <div class="box-footer">
                                {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Simpan', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('script')
    @parent

    <script src="/vendor/select2/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select[name=id_kota_asal], select[name=id_kota_tujuan]').select2({ width: '100%' })
        });
    </script>
@endsection
