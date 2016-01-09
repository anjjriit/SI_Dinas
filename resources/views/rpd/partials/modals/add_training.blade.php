<div class="modal fade" id="modal-tambah-pelatihan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Tambah Pelatihan</h4>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'pelatihan.store', 'name' => 'tambah-pelatihan']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('nama_pelatihan', 'Nama Pelatihan') !!}
                        {!! Form::text('nama_pelatihan', null, ['class' => 'form-control', 'autofocus', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                        {!! Form::text('nama_lembaga', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('tanggal_mulai', 'Tanggal Mulai') !!}
                        {!! Form::text('tanggal_mulai', null, ['class' => 'form-control datepicker', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('tanggal_selesai', 'Tanggal Selesai') !!}
                        {!! Form::text('tanggal_selesai', null, ['class' => 'form-control datepicker', 'required']) !!}
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
