@extends('layouts.master')

@section('page_title', 'Edit Jenis Biaya Pengeluaran Standard')

@section('content')

        <section class="content-header">
            <p>Edit Jenis Biaya Pengeluaran Standard</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Dashboard</a>
                <i class="fa fa-angle-right fa-fw"></i> <a href="/jenis-biaya">List Jenis Biaya</a>
                <i class="fa fa-angle-right fa-fw"></i> {{ $jenisBiaya->nama_jenis }}
                <i class="fa fa-angle-right fa-fw"></i> Edit
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit Jenis Biaya Pengeluaran Standard</h4>
                        </div>
                        {!! Form::model(
                                $jenisBiaya,
                                [
                                    'method' => 'PATCH',
                                    'route' => ['jenis-biaya.update', $jenisBiaya->kode]
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
