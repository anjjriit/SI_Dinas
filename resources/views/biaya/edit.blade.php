@extends('layouts.master')

@section('page_title', 'Edit Jenis Biaya Pengeluaran Standard')

@section('content')

        <section class="content-header">
            <h1>Data Jenis Biaya Pengeluaran Standard</h1>
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
