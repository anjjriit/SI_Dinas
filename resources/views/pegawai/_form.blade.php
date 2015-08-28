
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('nik', 'NIK') !!}
                                {!! Form::text('nik', null, ['class' => 'form-control']) !!}
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
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('role', 'Role') !!}
                                {!! Form::select(
                                    'role',
                                    [
                                        'employee' => 'Employee',
                                        'finance' => 'Finance',
                                        'administration' => 'Administration',
                                        'super_admin' => 'Super Admin'
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
                                    <div class="col-md-6">
                                        <label style="font-weight: normal;">
                                            {!! Form::radio('active', 1) !!} Active
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label style="font-weight: normal;">
                                            {!! Form::radio('active', 0, null, ['class' => 'text-right']) !!} Non-active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
