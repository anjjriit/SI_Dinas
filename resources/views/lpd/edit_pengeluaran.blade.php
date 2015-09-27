@extends('layouts.master')

@section('page_title', 'Edit Pengeluaran')

@section('stylesheet')
    @parent
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
        <p>Edit Pengeluaran</p>
        <span class="bcumb">
            <i class="fa fa-fw fa-bookmark"></i>
            @if (Auth::user()->role == 'super_admin')
                <a href="/dashboard">Dashboard</a>
            @else
                <a href="/homepage">Homepage</a>
            @endif
            <i class="fa fa-angle-right fa-fw"></i> <a href="/lpd/{{ $lpd->id }}/edit">Laporan Perjalanan Dinas</a>
            <i class="fa fa-angle-right fa-fw"></i> Edit Pengeluaran
        </span>
    </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit Pengeluaran</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::model(
                            $pengeluaran,
                            [
                                'method' => 'PATCH',
                                'url' => '/lpd/'. $lpd->id .'/pengeluaran/' . $pengeluaran->id
                            ]
                        ) !!}
                            <div class="box-body">

                                <div class="page-header alt"><strong>Pengeluaran</strong></div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @include('lpd._form_pengeluaran')
                            </div>
                            <div class="box-footer text-right">
                                {!! Form::button('<i class="fa fa-fw fa-check"></i> Update', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
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
