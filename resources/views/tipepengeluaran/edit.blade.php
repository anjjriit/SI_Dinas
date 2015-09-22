@extends('layouts.master')

@section('page_title', 'Edit Tipe Pengeluaran')

@section('content')

        <section class="content-header">
            <h1>Data Tipe Pengeluaran</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit Tipe Pengeluaran</h4>
                        </div>
                        {!! Form::model(
                                $tipepengeluaran,
                                [
                                    'method' => 'PATCH',
                                    'route' => ['tipepengeluaran.update', $tipepengeluaran->id]
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
                                @include('tipepengeluaran._form')
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
