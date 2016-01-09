@extends('layouts.master')

@section('page_title', 'Tambah Proyek')

@section('stylesheet')
    @parent
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')

        <section class="content-header">
            <p>Tambah Proyek</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> <a href="/project">Data Proyek</a>
                <i class="fa fa-angle-right fa-fw"></i> Tambah
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Formulir Tambah Proyek</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::open(['method' => 'POST', 'route' => 'project.store']) !!}
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                @include('project._form')
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
    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script>
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
    </script>

@endsection
