@extends('layouts.master')

@section('page_title', 'Data Project')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Project</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($data_project->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Project</th>
                                            <th>Nama Lembaga</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Alamat</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_project as $project)

                                        <tr>
                                            <td>
                                                {{ $project->nama_project }}
                                            </td>
                                            <td>
                                                {{ $project->nama_lembaga }}
                                            </td>
                                            <td>
                                                {{ $project->tanggal_mulai }}
                                            </td>
                                            <td>
                                                {{ $project->tanggal_selesai }}
                                            </td>
                                            <td>
                                                {{ $project->alamat }}
                                            </td>
                                            <td>
                                                <a href="/project/{{ $project->kode }}/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['project.destroy', $project->kode],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $project->nama_project,
                                                    ]
                                                ) !!}

                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i> Hapus', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger delete-button',]
                                                    ) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Data project belum tersedia. Klik tombol Tambah Project untuk menambah project.
                        </div>
                    @endif

                    {!! $data_project->render() !!}

                    <a href="/project/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Project</a>
                </div>
            </div>
        </section>

@endsection

@section('script')
    @parent
    <script src="/vendor/jquery-confirm/js/jquery-confirm.min.js"></script>

    <script>
        $('.delete-button').on('click', function(event) {
            event.preventDefault();

            var element = $(this).parent()

            var nama = element.attr('data-nama')

            $.confirm({
                title: '<i class="fa fa-trash"></i> Hapus Project',
                content: 'Apakah Anda yakin akan menghapus project dengan nama <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-success',
                cancelButton: 'Tidak',
                confirmButton: 'Ya, Hapus',
                animation: 'top',
                animationSpeed: 300,
                animationBounce: 1,

                confirm: function(){
                    return element.submit()
                },
                cancel: function(event){
                    return;
                }
            });
        })

    </script>
@endsection
