@extends('layouts.master')

@section('page_title', 'Edit Prospek')

@section('content')

        <section class="content-header">
            <p>Edit Prospek</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Dashboard</a>
                <i class="fa fa-angle-right fa-fw"></i> <a href="/prospek">List Prospek</a>
                <i class="fa fa-angle-right fa-fw"></i> {{ $prospek->nama_prospek }}
                <i class="fa fa-angle-right fa-fw"></i> Edit
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit Prospek</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::model(
                            $prospek,
                            [
                                'method' => 'PATCH',
                                'route' => ['prospek.update', $prospek->kode]
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

                                @include('prospek._form')
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
