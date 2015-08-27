@extends('layouts.app')

@section('page_title', 'Manage Prospek')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="page-header text-center">
                    <h4>List Prospek</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Prospek</th>
                            <th>Nama Lembaga</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data_prospek as $prospek)

                        <tr>
                            <td>
                                {{ $prospek->nama_prospek }}
                            </td>
                            <td>
                                {{ $prospek->nama_lembaga }}
                            </td>
                            <td>
                                {{ $prospek->alamat }}
                            </td>
                            <td>
                                <a href="/prospek/{{ $prospek->kode }}/edit" class="btn btn-xs btn-primary"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                {!! Form::open(
                                    [
                                        'method' => 'DELETE',
                                        'route' => ['user.destroy', $prospek->kode],
                                        'style' => 'display: inline-block;',
                                        'data-nama' => $prospek->nama_prospek,
                                    ]
                                ) !!}

                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i> Hapus', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button',]
                                    ) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                {!! $data_prospek->render() !!}
                <div class="clearfix"></div>

                <a href="/prospek/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Add Prospek</a>

            </div>
        </div>

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
                title: 'Hapus User',
                content: 'Apakah Anda yakin akan menghapus prospek dengan nama <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-success',
                cancelButton: 'Tidak',
                confirmButton: '<i class="fa fa-trash"></i> Ya, Hapus',
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
