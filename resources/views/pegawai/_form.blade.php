
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('nik', 'NIK') !!}
                                {!! Form::text('nik', null, ['class' => 'form-control', 'autofocus']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama_lengkap', 'Nama') !!}
                                {!! Form::text('nama_lengkap', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('email', 'E-mail') !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    @if (!isset($pegawai))

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('password', 'Kata Sandi') !!}
                                {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('role', 'Peran') !!}
                                {!! Form::select(
                                    'role',
                                    [
                                        'employee' => 'Pegawai',
                                        'finance' => 'Finance',
                                        'administration' => 'Administrasi',
                                        'super_admin' => 'Administrator'
                                    ],
                                    null,
                                    ['class' => 'form-control']
                                ) !!}
                            </div>
                        </div>
                    </div>
                    @if (isset($pegawai))

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('active', 'Status') !!}
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="font-weight: normal;">
                                            {!! Form::radio('active', 1) !!} Aktif
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-weight: normal;">
                                            {!! Form::radio('active', 0, null, ['class' => 'text-right']) !!} Non-aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('password', 'Kata Sandi') !!}
                                {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                                <small><span class="text-muted"><i class="fa fa-fw fa-info-circle"></i> Hanya isi kolom ini jika ingin mengubah kata sandi.</span></small>
                            </div>
                        </div>
                    </div>
                    @endif
