
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama_project', 'Nama Project') !!}
                                {!! Form::text('nama_project', null, ['class' => 'form-control', 'autofocus']) !!}
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
                                {!! Form::label('tanggal_mulai', 'Tanggal Mulai') !!}
                                {!! Form::input('date', 'tanggal_mulai', date('Y-m-d'), ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('tanggal_selesai', 'Tanggal Selesai') !!}
                                {!! Form::input('date', 'tanggal_mulai', date('Y-m-d'), ['class' => 'form-control']) !!}
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
