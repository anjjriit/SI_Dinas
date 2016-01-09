<div class="box-body box-basic-info">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('kategori', 'Kategori') !!}

                <div class="row">
                    <div class="col-md-6">
                        <label style="font-weight: normal;">
                            {!! Form::radio('kategori', 'trip') !!} Trip
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: normal;">
                            {!! Form::radio('kategori', 'non_trip') !!} Non-trip
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('jenis_perjalanan', 'Jenis Perjalanan') !!}
                {!! Form::select(
                    'jenis_perjalanan', [
                        'luar_kota' => 'Luar Kota',
                        'dalam_kota' => 'Dalam Kota'
                    ],
                    null,
                    ['class' => 'form-control']
                ) !!}
            </div>
        </div>
    </div>
</div>

<ul class="list-inline text-right">
    <li>
        {!! Form::button(
            'Selanjutnya <i class="fa fa-fw fa-angle-right"></i>',
            [
                'type' => 'button',
                'class' => 'btn btn-success next-step'
            ]
        ) !!}
    </li>
</ul>
