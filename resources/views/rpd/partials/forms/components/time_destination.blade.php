<div class="box-body box-destination">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('tanggal_mulai', 'Tanggal Mulai') !!}
                {!! Form::text('tanggal_mulai', null, ['class' => 'form-control datepicker']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tanggal_selesai', 'Tanggal Selesai') !!}
                {!! Form::text('tanggal_selesai', null, ['class' => 'form-control datepicker']) !!}
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('lama_hari', 'Lama Hari Dinas') !!}
                        {!! Form::text('lama_hari', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>

            </div>
            <div class="form-group">
                {!! Form::label('kode_kota_asal', 'Kota Asal') !!}
                {!! Form::select('kode_kota_asal', $list_kota, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('kode_kota_tujuan', 'Kota Tujuan') !!}
                {!! Form::select('kode_kota_tujuan', $list_kota, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('id_penginapan', 'Sarana Penginapan') !!}
                {!! Form::select(
                    'id_penginapan',
                    $list_penginapan,
                    null,
                    ['class' => 'form-control'])
                !!}
            </div>

            <div class="form-group">
                {!! Form::label('id_transportasi', 'Sarana Transportasi') !!}

                <div class="row">
                    @foreach ($list_transportasi as $transportasi)
                        <div class="col-md-6">
                            <label style="font-weight:normal">
                                {!! Form::checkbox(
                                    'id_transportasi[]',
                                    $transportasi->id,
                                    in_array(
                                        $transportasi->id,
                                        (isset($rpd)) ? $rpd->saranaTransportasi()->lists('id_transportasi')->all() : []
                                    )
                                ) !!} {{ $transportasi->nama_transportasi }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<ul class="list-inline text-right">
    <li>
        {!! Form::button(
            '<i class="fa fa-fw fa-angle-left"></i> Prev',
            [
                'type' => 'button',
                'class' => 'btn btn-default prev-step'
            ]
        ) !!}
    </li>
    <li>
        {!! Form::button(
            'Next <i class="fa fa-fw fa-angle-right"></i>',
            [
                'type' => 'button',
                'class' => 'btn btn-success next-step'
            ]
        ) !!}
    </li>
</ul>
