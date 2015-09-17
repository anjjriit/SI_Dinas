<div class="row peserta">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('list_peserta', 'Peserta') !!}
            {!! Form::select(
                'list_peserta',
                $list_pegawai,
                null,
                [
                    'class' => 'form-control list-peserta'
                ]
            ) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('list_tujuan_kegiatan', 'Tujuan Kegiatan') !!}
            {!! Form::select(
                'list_tujuan_kegiatan',
                [
                    'project' => 'Project',
                    'prospek' => 'Prospek',
                    'pelatihan' => 'Pelatihan'
                ],
                null,
                ['class' => 'form-control'])
            !!}
        </div>
    </div>

    <div class="col-md-6" style="margin-top: 24px;">
        {!! Form::button(
            '<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan',
            [
                'type' => 'button',
                'class' => 'btn btn-default btn-tambah-kegiatan',
                'data-loading-text' => 'Loading...'
            ]
        ) !!}
    </div>
</div>
