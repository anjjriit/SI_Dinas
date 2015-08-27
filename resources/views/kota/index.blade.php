@extends('layouts.app')

@section('page_title', 'Data Kota')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h4>Data Kota</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kota</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data_kota as $kota)

                        <tr>
                            <td>
                                {{ $kota->id }}
                            </td>
                            <td>
                                {{ $kota->nama_kota }}
                            </td>
                            <td>
                                <a href="/kota/{{ $kota->id }}/edit" class="btn btn-xs btn-primary"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['kota.destroy', $kota->id], 'style' => 'display: inline-block;']) !!}
                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i> Hapus', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
