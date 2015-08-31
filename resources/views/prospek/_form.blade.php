
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama_prospek', 'Nama Prospek') !!}
                                {!! Form::text('nama_prospek', null, ['class' => 'form-control', 'autofocus']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama_lembaga', 'Nama Lembaga') !!}
                                {!! Form::text('nama_lembaga', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('alamat', 'Alamat') !!}
                                {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>
                        </div>
                    </div>
