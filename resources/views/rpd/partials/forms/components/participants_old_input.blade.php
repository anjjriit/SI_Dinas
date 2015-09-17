@foreach (array_unique(old('id_peserta')) as $peserta)
    <div class="row peserta">
        @if ($peserta != old('id_peserta')[0])
            <div class="col-md-12"><hr></div>
        @endif

        <div class="col-md-4">
            <div class="form-group">
                <label for="list_peserta">Peserta</label>
                <select name="list_peserta" id="list_peserta">
                    @foreach ($list_pegawai as $nik => $nama_pegawai)
                        <option value="{{ $nik }}"{{ ($nik == $peserta) ? ' selected' : '' }}>{{ $nama_pegawai }}</option>
                    @endforeach
                </select>
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
            @if ($peserta != old('id_peserta')[0])
                {!! Form::button(
                    '<i class="fa fa-fw fa-minus"></i>',
                    [
                        'type' => 'button',
                        'class' => 'btn btn-danger btn-hapus-peserta pull-right',
                    ]
                ) !!}
            @endif
        </div>

        @for ($i = 0;$i < count(old('id_peserta'));$i++)
            @if (old('id_peserta')[$i] == $peserta)
                @if (old('tujuan_kegiatan')[$i] == 'project')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id_peserta[]" value="{{ old('id_peserta')[$i] }}">
                            <input type="hidden" name="tujuan_kegiatan[]" value="{{ old('tujuan_kegiatan')[$i] }}">
                            <div class="form-group">
                                <label for="kode_kegiatan">Nama Project</label>
                                <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                    @foreach ($list_project as $project)
                                        <option value="{{ $project->kode }}"{{ ($project->kode == old('kode_kegiatan')[$i]) ? ' selected' : '' }}>{{ $project->nama_project . ' (' . $project->nama_lembaga . ')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kode_kegiatan">Kegiatan</label>
                                <select class="form-control" id="kode_kegiatan" name="kegiatan[]">
                                    <option value="REQUIREMENT_GATHERING"{{ (old('kegiatan')[$i] == "REQUIREMENT_GATHERING") ? ' selected' : '' }}>Requirement Gathering</option>
                                    <option value="UAT"{{ (old('kegiatan')[$i] == "UAT") ? ' selected' : '' }}>UAT</option>
                                    <option value="REVIEW"{{ (old('kegiatan')[$i] == "REVIEW") ? ' selected' : '' }}>Review</option>
                                    <option value="TRAINING_USER"{{ (old('kegiatan')[$i] == "TRAINING_USER") ? ' selected' : '' }}>Training User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @elseif (old('tujuan_kegiatan')[$i] == 'prospek')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id_peserta[]" value="{{ old('id_peserta')[$i] }}">
                            <input type="hidden" name="tujuan_kegiatan[]" value="{{ old('tujuan_kegiatan')[$i] }}">
                            <div class="form-group">
                                <label for="kode_kegiatan">Nama Prospek</label>
                                <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                    @foreach ($list_prospek as $prospek)
                                        <option value="{{ $prospek->kode }}"{{ ($prospek->kode == old('kode_kegiatan')[$i]) ? ' selected' : '' }}>{{ $prospek->nama_prospek . ' (' . $prospek->nama_lembaga . ')' }}</option>
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
                @elseif (old('tujuan_kegiatan')[$i] == 'pelatihan')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id_peserta[]" value="{{ old('id_peserta')[$i] }}">
                            <input type="hidden" name="tujuan_kegiatan[]" value="{{ old('tujuan_kegiatan')[$i] }}">
                            <div class="form-group">
                                <label for="kode_kegiatan">Nama Pelatihan</label>
                                <select name="kode_kegiatan[]" id="kode_kegiatan" class="form-control">
                                    @foreach ($list_pelatihan as $pelatihan)
                                        <option value="{{ $pelatihan->kode }}"{{ ($pelatihan->kode == old('kode_kegiatan')[$i]) ? ' selected' : '' }}>{{ $pelatihan->nama_pelatihan . ' (' . $pelatihan->nama_lembaga . ')' }}</option>
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
        @endfor
    </div>
@endforeach
