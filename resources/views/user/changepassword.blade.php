@extends('layouts.master')

@section('page_title', 'Ubah Password')

@section('content')

        <section class="content-header">
            <h1>Ubah Password</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <i class="fa fa-fw fa-exclamation"></i> Anda baru pertama kali melakukan login, harap ubah password terlebih dahulu untuk melanjutkan
                    </div>

                    <div class="box box-widget">
                        {!! Form::open(['method' => 'PATCH', 'url' => 'change/password']) !!}
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-times"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::label('password', 'Password Baru') !!}
                                            {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::label('password_confirmation', 'Konfirmasi Password Baru') !!}
                                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
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
