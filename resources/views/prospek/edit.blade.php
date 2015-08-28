@extends('layouts.master')

@section('page_title', 'Edit Prospek')

@section('content')

        <section class="content-header">
            <h1>Data Prospek</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model(
                        $prospek,
                        [
                            'method' => 'PATCH',
                            'url' => ['prospek/' . $prospek->kode]
                        ]
                    ) !!}
                        <div class="box box-widget">
                            <div class="box-header">
                                <h4>Form Edit Prospek</h4>
                            </div>
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <span class="text-danger">
                                                <i class="fa fa-fw fa-times"></i> {{ $error }}
                                            </span>
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                @include('prospek._form')
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
