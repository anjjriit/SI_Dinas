@extends('layouts.master')

@section('page_title', 'Ubah Data Penginapan')

@section('content')

        <section class="content-header">
            <p>Ubah Penginapan</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> <a href="/penginapan">Data Penginapan</a>
                <i class="fa fa-angle-right fa-fw"></i> {{ $penginapan->nama_penginapan }}
                <i class="fa fa-angle-right fa-fw"></i> Ubah
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Formulir Ubah Data Penginapan</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::model(
                                $penginapan,
                                [
                                    'method' => 'PATCH',
                                    'route' => ['penginapan.update', $penginapan->id]
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
                                @include('penginapan._form')
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
