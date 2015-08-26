@extends('layouts.app')

@section('page_title', 'Edit Pegawai')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h4>Edit Pegawai</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Form Edit Pegawai
                    </div>
                    <div class="panel-body">
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">
                                {{ $error }}
                            </span>
                        @endforeach

                        {!! Form::model(
                            $pegawai,
                            [
                                'method' => 'PATCH',
                                'url' => ['pegawai/' . $pegawai->nik]
                            ]
                        ) !!}
                            @include('pegawai._form')

                            {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Update', ['type' => 'submit', 'class' => 'btn pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
