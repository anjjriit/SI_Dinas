<div class="modal fade" id="modal-tambah-prospek" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form Tambah Prospek</h4>
            </div>

            {!! Form::open(
                [
                    'method' => 'POST',
                    'route' => 'prospek.ajax.store',
                    'name' => 'tambah-prospek'
                ]
            ) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('nama_prospek', 'Nama Prospek') !!}
                        {!! Form::text('nama_prospek', null, ['class' => 'form-control', 'autofocus', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                        {!! Form::text('nama_lembaga', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('alamat', 'Alamat') !!}
                        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
