<div class="box-body box-finish">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                @if (isset($rpd) && $rpd->status == 'SUBMIT' && auth()->user()->role == 'administration')
                    {!! Form::label('akomodasi_awal', 'Akomodasi Awal') !!}
                    {!! Form::input('number', 'akomodasi_awal', null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::label('keterangan', 'Keterangan') !!}
                    {!! Form::textarea(
                        'keterangan',
                        null,
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Isi dengan keterangan tambahan (bila diperlukan)',
                            'rows' => 3
                        ]
                    ) !!}
                @endif
            </div>
        </div>
    </div>
</div>

<ul class="list-inline text-right">
    <li>
        {!! Form::button(
            '<i class="fa fa-fw fa-angle-left"></i> Sebelumnya',
            [
                'type' => 'button',
                'class' => 'btn btn-default prev-step'
            ]
        ) !!}
    </li>

    @if (!isset($rpd) || (isset($rpd) && $rpd->status == 'DRAFT'))
        <li>
            {!! Form::button(
                '<i class="fa fa-fw fa-floppy-o"></i> Simpan Sebagai Draf',
                [
                    'type' => 'submit',
                    'class' => 'btn btn-default',
                    'name' => 'action',
                    'value' => 'draft'
                ]
            ) !!}
        </li>
    @endif

    @if (isset($rpd) && $rpd->status == 'SUBMIT' && auth()->user()->role == 'administration')
        <li>
            {!! Form::button(
                '<i class="fa fa-fw fa-check"></i> Perbarui',
                [
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'name' => 'action',
                    'value' => 'submit'
                ]
            ) !!}
        </li>
    @else
        <li>
            {!! Form::button(
                '<i class="fa fa-fw fa-check"></i> Ajukan',
                [
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'name' => 'action',
                    'value' => 'submit'
                ]
            ) !!}
        </li>
    @endif
</ul>
