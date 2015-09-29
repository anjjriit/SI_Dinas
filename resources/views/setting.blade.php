@extends('layouts.master')

@section('page_title', 'Edit Setting')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>Edit Setting</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Dashboard</a>
                <i class="fa fa-angle-right fa-fw"></i> Setting
                <i class="fa fa-angle-right fa-fw"></i> Edit
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit Setting</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::model(
                                $settings,
                                [
                                    'method' => 'PATCH',
                                    'url' => '/setting'
                                ]
                            ) !!}
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('company_name', 'Nama Perusahaan') !!}
                                            {!! Form::text('company_name', null, ['class' => 'form-control', 'autofocus']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('address_line_1', 'Alamat (baris 1)') !!}
                                            {!! Form::text('address_line_1', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('address_line_2', 'Alamat (baris 2)') !!}
                                            {!! Form::text('address_line_2', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('phone_number', 'No. Telepon') !!}
                                            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'E-mail') !!}
                                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('website', 'Website') !!}
                                            {!! Form::text('website', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
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
