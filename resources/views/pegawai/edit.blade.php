@extends('layouts.master')

@section('page_title', 'Edit User')

@section('content')

        <section class="content-header">
            <h1>Manage Users</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model(
                        $pegawai,
                        [
                            'method' => 'PATCH',
                            'url' => ['user/' . $pegawai->nik]
                        ]
                    ) !!}
                        <div class="box box-widget">
                            <div class="box-header">
                                <h4>Form Edit User</h4>
                            </div>
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                                @include('pegawai._form')
                            </div>
                            <div class="box-footer">
                                {!! Form::button('<i class="fa fa-fw fa-check"></i> Update', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>

@endsection
