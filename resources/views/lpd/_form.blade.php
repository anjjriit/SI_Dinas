<fieldset>
    <legend>Item</legend>
    <table class="table">
        <tr>
            <td>{!! Form::label('tanggal', 'Tanggal') !!}</td>
            <td>{!! Form::label('keterangan', 'Keterangan') !!}</td>
            <td>{!! Form::label('biaya', 'Biaya') !!}</td>
            <td>{!! Form::label('struk', 'Struk') !!}</td>
            <td>Pengeluaran</td>
            <td>Personel</td>
            <td></td>
        </tr>
        <tr>
            <td>
                {!! Form::text('tanggal', null, ['class' => 'form-control datepicker']) !!}
            </td>
            <td>
                {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
            </td>
            <td>
                {!! Form::text('biaya', null, ['class' => 'form-control']) !!}
            </td>
            <td>
                {!! Form::text('struk', null, ['class' => 'form-control']) !!}
            </td>
            <td> </td>
            <td> </td>
            <td>
                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus" > </i></a> 
            </td>
        </tr>
    </table>
    
</fieldset>