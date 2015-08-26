@extends('layouts.app')

@section('page_title', 'Tambah Pegawai')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h4>Tambah Pegawai</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Form Tambah Pegawai
                    </div>
                    <div class="panel-body">
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">
                                {{ $error }}
                            </span>
                        @endforeach

                        {!! Form::open(['method' => 'POST', 'route' => 'pegawai.store']) !!}
                            @include('pegawai._form')

                            {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Simpan', ['type' => 'submit', 'class' => 'btn']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
