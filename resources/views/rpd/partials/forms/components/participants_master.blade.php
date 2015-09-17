<div class="box-body box-participants">

    @yield('form')

</div>

<div class="box-body box-add-participants">
    <div class="row">
        <div class="col-md-12">
            {!! Form::button(
                '<i class="fa fa-fw fa-plus"></i> Tambah Peserta',
                [
                    'type' => 'button',
                    'class' => 'btn btn-default btn-tambah-peserta pull-right'
                ])
            !!}
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
