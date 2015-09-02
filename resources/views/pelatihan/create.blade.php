@extends('layouts.master')

@section('page_title', 'Tambah Pelatihan')

@section('stylesheet')
    @parent
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Pelatihan</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Tambah Pelatihan</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'route' => 'pelatihan.store']) !!}
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                @include('pelatihan._form')
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
