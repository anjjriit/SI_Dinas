
                            <div class="form-group">
                                {!! Form::label('nik', 'NIK') !!}
                                {!! Form::text('nik', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('nama_lengkap', 'Nama Lengkap') !!}
                                {!! Form::text('nama_lengkap', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'E-mail') !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            </div>
                            @if (!isset($pegawai))

                            <div class="form-group">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                            </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('role', 'Role') !!}
                                {!! Form::select(
                                    'role',
                                    [
                                        'employee' => 'Employee',
                                        'finance' => 'Finance',
                                        'administrasi' => 'Administrasi',
                                        'super_admin' => 'Super Admin'
                                    ],
                                    null,
                                    ['class' => 'form-control']
                                ) !!}
                            </div>
                            @if (isset($pegawai))

                            <div class="form-group">
                                {!! Form::label('active', 'Status') !!}
                                {!! Form::select('active', ['0' => 'Active', '1' => 'Non-active'], $pegawai->active, ['class' => 'form-control']) !!}
                            </div>
                            @endif
