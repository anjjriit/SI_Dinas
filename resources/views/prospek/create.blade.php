@extends('layouts.master')

@section('page_title', 'Tambah Prospek')

@section('content')

        <section class="content-header">
            <h1>Data Prospek</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Tambah Prospek</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'route' => 'prospek.store']) !!}
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
                                {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Simpan', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

@endsection
