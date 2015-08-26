@extends('layouts.app')

@section('page_title', 'Data Pegawai')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h4>Data Pegawai</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data_pegawai as $pegawai)

                        <tr>
                            <td>
                                {{ $pegawai->nik }}
                            </td>
                            <td>
                                {{ $pegawai->nama_lengkap }}
                            </td>
                            <td>
                                {{ $pegawai->email }}
                            </td>
                            <td>
                                @if ($pegawai->role == 'super_admin')
                                    Super Admin
                                @elseif ($pegawai->role == 'administrasi')
                                    Administrasi
                                @elseif ($pegawai->role == 'finance')
                                    Finance
                                @else
                                    Employee
                                @endif
                            </td>
                            <td>
                                @if ($pegawai->active == 1)
                                    Aktif
                                @else
                                    Non-aktif
                                @endif
                            </td>
                            <td>
                                <a href="/pegawai/{{ $pegawai->nik }}/edit" class="btn btn-xs btn-primary"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['pegawai.destroy', $pegawai->nik], 'style' => 'display: inline-block;']) !!}
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
