@foreach ($rpd->peserta as $peserta)
    <div class="row peserta">
        @if ($peserta != $rpd->peserta[0])
            <div class="col-md-12"><hr></div>
        @endif
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('list_peserta', 'Peserta') !!}
                {!! Form::select(
                    'list_peserta',
                    $list_pegawai,
                    $peserta->nik,
                    [
                        'class' => 'form-control list-peserta'
                    ]
                ) !!}
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('list_tujuan_kegiatan', 'Tujuan Kegiatan') !!}
                {!! Form::select(
                    'list_tujuan_kegiatan',
                    [
                        'project' => 'Project',
                        'prospek' => 'Prospek',
                        'pelatihan' => 'Pelatihan'
                    ],
                    null,
                    ['class' => 'form-control'])
                !!}
            </div>
        </div>

        <div class="col-md-6" style="margin-top: 24px;">
            {!! Form::button(
                '<i class="fa fa-fw fa-plus"></i> Tambah Kegiatan',
                [
                    'type' => 'button',
                    'class' => 'btn btn-default btn-tambah-kegiatan',
                    'data-loading-text' => 'Loading...'
                ]
            ) !!}
            @if ($peserta != $rpd->peserta[0])
                {!! Form::button(
                    '<i class="fa fa-fw fa-minus"></i>',
                    [
                        'type' => 'button',
                        'class' => 'btn btn-danger btn-hapus-peserta pull-right',
                    ]
                ) !!}
            @endif
        </div>

        @foreach ($rpd->kegiatan as $kegiatan)
            @if ($kegiatan['nik_peserta'] == $peserta['nik'])
                @if ($kegiatan->jenis_kegiatan == 'project')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::hidden('id_peserta[]', $peserta['nik']) !!}
                            {!! Form::hidden('tujuan_kegiatan[]', $kegiatan->jenis_kegiatan) !!}
                            <div class="form-group">
                                <label for="kode_kegiatan">Nama Project</label>
                                <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                    @foreach ($list_project as $project)
                                        <option value="{{ $project->kode }}"{{ ($project->kode == $kegiatan->kode_kegiatan) ? ' selected' : '' }}> {{ $project->nama_project . ' (' . $project->nama_lembaga . ')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('kegiatan', 'Kegiatan') !!}
                                {!! Form::select(
                                    'kegiatan[]',
                                    [
                                        'REQUIREMENT_GATHERING' => 'Requirement Gathering',
                                        'UAT' => 'UAT',
                                        'REVIEW' => 'Review',
                                        'TRAINING_USER' => 'Training User'
                                    ],
                                    $kegiatan->kegiatan,
                                    ['class' => 'form-control']
                                ) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @elseif ($kegiatan->jenis_kegiatan == 'prospek')


                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::hidden('id_peserta[]', $peserta['nik']) !!}
                            {!! Form::hidden('tujuan_kegiatan[]', $kegiatan->jenis_kegiatan) !!}
                            <div class="form-group">
                                <label for="kode_kegiatan">Nama Prospek</label>
                                <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                    @foreach ($list_prospek as $prospek)
                                        <option value="{{ $prospek->kode }}"{{ ($prospek->kode == $kegiatan->kode_kegiatan) ? ' selected' : '' }}>{{ $prospek->nama_prospek . ' (' . $prospek->nama_lembaga . ')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-top: 24px;">
                            <input type="hidden" name="kegiatan[]" value="-">
                            <button type="button" class="btn btn-default btn-modal-prospek">
                                <i class="fa fa-fw fa-plus"></i> Prospek Baru
                            </button>
                            <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @elseif ($kegiatan->jenis_kegiatan == 'pelatihan')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::hidden('id_peserta[]', $peserta['nik']) !!}
                            {!! Form::hidden('tujuan_kegiatan[]', $kegiatan->jenis_kegiatan) !!}
                            <div class="form-group">
                                <label for="kode_kegiatan">Nama Pelatihan</label>
                                <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                    @foreach ($list_pelatihan as $pelatihan)
                                        <option value="{{ $pelatihan->kode }}"{{ ($pelatihan->kode == $kegiatan->kode_kegiatan) ? ' selected' : '' }}>{{ $pelatihan->nama_pelatihan . ' (' . $pelatihan->nama_lembaga . ')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-top: 24px;">
                            <input type="hidden" name="kegiatan[]" value="-">
                            <button type="button" class="btn btn-default btn-modal-pelatihan">
                                <i class="fa fa-fw fa-plus"></i> Pelatihan Baru
                            </button>
                            <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        @endforeach
    </div>
@endforeach
