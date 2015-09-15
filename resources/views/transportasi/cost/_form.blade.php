
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('id_kota_asal', 'Kota Asal') !!}
                                        {!! Form::select('id_kota_asal', $list_kota, null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('id_kota_tujuan', 'Kota Tujuan') !!}
                                        {!! Form::select('id_kota_tujuan', $list_kota, null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('harga', 'Biaya') !!}
                                        {!! Form::text('harga', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>


