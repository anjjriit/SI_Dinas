@extends('layouts.master')

@section('page_title', 'Tambah Jenis Biaya Pengeluaran Standar')

@section('content')

        <section class="content-header">
            <p>Tambah Jenis Biaya Pengeluaran Standar</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> <a href="/jenis-biaya">Data Jenis Biaya</a>
                <i class="fa fa-angle-right fa-fw"></i> Tambah
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Formulir Tambah Jenis Biaya Pengeluaran Standar</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::open(['method' => 'POST', 'route' => 'jenis-biaya.store']) !!}
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                @include('biaya._form')
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
