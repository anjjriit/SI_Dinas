$(document).ready(function(){
    $('.btn-tambah-peserta').on('click', function() {
        var list_peserta = $('.list-peserta').html();

        var new_row =
            '<div class="row peserta">' +
                '<div class="col-md-12"><hr></div>' +
                '<div class="col-md-4">' +
                    '<div class="form-group">' +
                        '<label for="list_peserta">Peserta</label>' +
                        '<select class="form-control list-peserta" id="list_peserta" name="list_peserta">' +
                            list_peserta +
                        '</select>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-2">' +
                    '<div class="form-group">' +
                        '<label for="tujuan_kegiatan">Tujuan Kegiatan</label>' +
                        '<select class="form-control" id="tujuan_kegiatan" name="list_tujuan_kegiatan"><option value="project">Project</option><option value="prospek">Prospek</option><option value="pelatihan">Pelatihan</option></select>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-6" style="margin-top: 24px;">' +
                    '<button type="button" class="btn btn-default btn-tambah-kegiatan" data-loading-text="Loading..."><i class="fa fa-fw fa-plus"></i> Tambah Kegiatan</button> ' +
                    '<button type="button" class="btn btn-danger btn-hapus-peserta pull-right"><i class="fa fa-fw fa-minus"></i></button>' +
                '</div>' +
            '</div>';

        $('.box-body.box-participants').append(new_row);

        $('select[name=list_tujuan_kegiatan]').select2({ width: '100%', minimumResultsForSearch: Infinity });

        attachAddActivityEvent();
        attachRemoveParticipantEvent();
        attachParticipantChangesEvent();
    });

    attachAddActivityEvent();
    attachRemoveParticipantEvent();
    attachParticipantChangesEvent();
    attachAddProspectButtonClickEvent();
    attachAddTrainingButtonClickEvent();

    // Datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "0,6",
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        enableOnReadonly: false
    });

    // Autofocus when modal shown
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('[autofocus]').focus();
    });

    // Init select2
    $('select[name=jenis_perjalanan], select[name=id_penginapan], select[name=list_tujuan_kegiatan]')
        .select2({ width: '100%', minimumResultsForSearch: Infinity });

    $('select[name=kode_kota_asal], select[name=kode_kota_tujuan], select[name="kode_kegiatan[]"], select[name="kegiatan[]"]')
        .select2({ width: '100%' });

    $('select[name=list_peserta]').select2( {width: '100%', display: 'block' } );

    // Wizard
    $(".next-step").click(function () {
        var $active = $('.wizard .nav-tabs li.active');

        nextTab($active);
    });

    $(".prev-step").click(function () {
        var $active = $('.wizard .nav-tabs li.active');

        prevTab($active);
    });

    $('select[name=jenis_perjalanan').on('change', function () {
        var jenis_perjalanan = $(this).val()
        var kode_kota_asal = $('select[name=kode_kota_asal]').val();

        var $kota_tujuan = $('select[name=kode_kota_tujuan]');

        if (jenis_perjalanan == 'dalam_kota') {
            $kota_tujuan.val(kode_kota_asal).trigger('change');
            attachCityChangesEvent();
        }  else {
            $('select[name=kode_kota_asal').off('change.kota.asal');
        }
    });

    attachCityChangesEvent();

    $('input[name=tanggal_mulai]').on('change', function () {
        var $mulai = $(this);
        var $selesai = $('input[name=tanggal_selesai]');

        changeTripDaysInput($mulai, $selesai);
    });

    $('input[name=tanggal_selesai]').on('change', function () {
        var $mulai = $('input[name=tanggal_mulai]');
        var $selesai = $(this);

        changeTripDaysInput($mulai, $selesai);
    });

    $('input[value=trip]').on('change.radio.trip', function () {
        $('input[name=tanggal_selesai]').prop('readonly', false);

        $('input[name=tanggal_mulai]').off('change.selesai');
    });

    $('input[value=non_trip]').on('change.radio.nontrip', function () {
        $('input[name=tanggal_selesai]').prop('readonly', true);

        var tanggal_mulai = $('input[name=tanggal_mulai').val()
        var $tanggal_selesai = $('input[name=tanggal_selesai]');

        if (tanggal_mulai) {
            $tanggal_selesai.val(tanggal_mulai);
        }

        $('input[name=tanggal_mulai]').on('change.selesai', function () {
            var tanggal_mulai = $('input[name=tanggal_mulai').val()

            $('input[name=tanggal_selesai]').val(tanggal_mulai);
        });

        var $mulai = $('input[name=tanggal_mulai]');
        var $selesai = $('input[name=tanggal_selesai]');

        changeTripDaysInput($mulai, $selesai);
    });


    if ($('input[name=kategori]:checked').val() == 'non_trip') {
        $('input[name=tanggal_selesai]').prop('readonly', true);

        var $mulai = $('input[name=tanggal_mulai]');
        var $selesai = $('input[name=tanggal_selesai]');

        changeTripDaysInput($mulai, $selesai);

        $('input[name=tanggal_mulai]').on('change.selesai', function () {
            var tanggal_mulai = $('input[name=tanggal_mulai').val()

            $('input[name=tanggal_selesai]').val(tanggal_mulai);
        });
    }

    attachRemoveActivityEvent();

    var $mulai = $('input[name=tanggal_mulai]');
    var $selesai = $('input[name=tanggal_selesai]');

    changeTripDaysInput($mulai, $selesai);

});

function nextTab(active) {
    $(active).next().find('a[data-toggle="tab"]').click();
}

function prevTab(active) {
    $(active).prev().find('a[data-toggle="tab"]').click();
}

function attachRemoveParticipantEvent() {
    $('.btn-hapus-peserta').off('click').on('click', function() {
        var $row = $(this).closest('.row.peserta');

        $row.remove();
    });
}

function attachParticipantChangesEvent() {
    $('select[name=list_peserta]').off('change.list_peserta').on('change.list_peserta', function () {
            var $row = $(this).closest('.row.peserta');
            var id = $row.find('select[name=list_peserta]').val();

            $row.find('input[name="id_peserta[]"]').val(id);
        }
    );
}

function attachAddActivityEvent() {
    $('.btn-tambah-kegiatan').off('click').on('click', function() {
        var $btn = $(this).button('loading');

        var $row = $(this).closest('.row.peserta');

        var id_peserta = $row.find('select[name=list_peserta]').val();
        var tujuan = $row.find('select[name=list_tujuan_kegiatan]').val();

        if (tujuan == 'project') {
            $.ajax({
                type : 'GET',
                url : '/json/project',
                dataType : 'json',
                encode : true,
            })
            .done(function(response) {
                var total = response.length;
                var list_data = '';

                $.each(response, function(total, list) {
                    list_data +=
                        '<option value="' + list.kode + '">' +
                            list.nama_project + ' (' + list.nama_lembaga + ')' +
                        '</option>';
                })

                form_kegiatan =
                    '<div class="col-md-12">' +
                        '<div class="row">' +
                            '<div class="col-md-4">' +
                                '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                                '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                                '<div class="form-group">' +
                                    '<label for="kode_kegiatan">Nama Project</label>' +
                                    '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                        list_data +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<label for="kode_kegiatan">Kegiatan</label>' +
                                    '<select class="form-control" id="kode_kegiatan" name="kegiatan[]">' +
                                        '<option value="REQUIREMENT_GATHERING">Requirement Gathering</option>' +
                                        '<option value="UAT">UAT</option>' +
                                        '<option value="REVIEW">Review</option>' +
                                        '<option value="TRAINING_USER">Training User</option>' +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                                '<div class="form-group">' +
                                    '<label for="deskripsi">Deskripsi</label>' +
                                    '<input type="text" id="deskripsi" name="deskripsi[]" class="form-control">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-1">' +
                                '<button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right" style="margin-top: 24px;"><i class="fa fa-fw fa-minus"></i></button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                $row.append(form_kegiatan);

                $('select[name="kode_kegiatan[]"]').select2({ width: '100%' });
                $('select[name="kegiatan[]"]').select2({ minimumResultsForSearch: Infinity });

                attachRemoveActivityEvent();

                attachAddProspectButtonClickEvent();

                $btn.button('reset');
            });
        } else if (tujuan == 'prospek') {
            $.ajax({
                type : 'GET',
                url : '/json/prospek',
                dataType : 'json',
                encode : true,
            })

            .done(function(response) {
                var total = response.length;
                var list_data = '';

                $.each(response, function(total, list) {
                    list_data +=
                        '<option value="' + list.kode + '">' +
                            list.nama_prospek + ' (' + list.nama_lembaga + ')' +
                        '</option>';
                })

                form_kegiatan =
                    '<div class="col-md-12">' +
                        '<div class="row">' +
                            '<div class="col-md-4">' +
                                '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                                '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                                '<div class="form-group">' +
                                    '<label for="kode_kegiatan">Nama Prospek</label>' +
                                    '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                        list_data +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-3" style="margin-top: 24px;">' +
                                '<input type="hidden" name="kegiatan[]" value="-">' +
                                '<button type="button" class="btn btn-default btn-modal-prospek">' +
                                    '<i class="fa fa-fw fa-plus"></i> Prospek Baru' +
                                '</button>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                                '<div class="form-group">' +
                                    '<label for="deskripsi">Deskripsi</label>' +
                                    '<input type="text" id="deskripsi" name="deskripsi[]" class="form-control">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-1" style="margin-top: 24px;">' +
                                '<button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                $row.append(form_kegiatan);

                $('select[name="kode_kegiatan[]"]').select2( {width: '100%' } );

                attachRemoveActivityEvent();

                attachAddProspectButtonClickEvent();

                $btn.button('reset');
            });
        } else {
            $.ajax({
                type : 'GET',
                url : '/json/pelatihan',
                dataType : 'json',
                encode : true,
            })

            .done(function(response) {
                var total = response.length;
                var list_data = '';

                $.each(response, function(total, list) {
                    list_data +=
                        '<option value="' + list.kode + '">' +
                            list.nama_pelatihan + ' (' + list.nama_lembaga + ')' +
                        '</option>';
                })

                form_kegiatan =
                    '<div class="col-md-12">' +
                        '<div class="row">' +
                            '<div class="col-md-4">' +
                                '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                                '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                                '<div class="form-group">' +
                                    '<label for="kode_kegiatan">Nama Pelatihan</label>' +
                                    '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                        list_data +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-3" style="margin-top: 24px;">' +
                                '<input type="hidden" name="kegiatan[]" value="-">' +
                                '<button type="button" class="btn btn-default btn-modal-pelatihan">' +
                                    '<i class="fa fa-fw fa-plus"></i> Pelatihan Baru' +
                                '</button>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                                '<div class="form-group">' +
                                    '<label for="deskripsi">Deskripsi</label>' +
                                    '<input type="text" id="deskripsi" name="deskripsi[]" class="form-control">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-1" style="margin-top: 24px;">' +
                                '<button type="button" class="btn btn-danger btn-hapus-kegiatan pull-right"><i class="fa fa-fw fa-minus"></i></button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                $row.append(form_kegiatan);

                $('select[name="kode_kegiatan[]"]').select2({width: '100%' });

                attachRemoveActivityEvent();

                attachAddTrainingButtonClickEvent();

                $btn.button('reset');
            });
        }
    });

    $('select[name=list_peserta]').select2( {width: '100%', display: 'block' } );
}

function attachRemoveActivityEvent() {
    $('.btn-hapus-kegiatan').off('click').on('click', function() {
        var $row_activity = $(this).closest('.col-md-12');
        $row_activity.remove();
    });
}

function attachCityChangesEvent() {
    $('select[name=kode_kota_asal]').on('change.kota.asal', function () {
        var kode_kota_asal = $('select[name=kode_kota_asal]').val();
        var $kota_tujuan = $('select[name=kode_kota_tujuan]');

        $kota_tujuan.val(kode_kota_asal).trigger('change');
    });
}

function countCertainDays(start_date, end_date ) {
    var days = [1, 2, 3, 4, 5];

    var ndays = 1 + Math.round(( end_date - start_date) / (24 * 3600 * 1000));
    var sum = function(a, b) {
        return a + Math.floor((ndays + (start_date.getDay() + 6 - b) % 7) / 7);
    };

    return days.reduce(sum, 0);
}

function changeTripDaysInput(mulai, selesai) {
    if (mulai.val() && selesai.val()) {
        var start_date = new Date(mulai.val());
        var end_date = new Date(selesai.val());

        var jumlah_hari = countCertainDays(start_date, end_date);

        if (jumlah_hari > 0) {
            $('input[name=lama_hari]').val(jumlah_hari);
        } else {
            $('input[name=lama_hari]').val(0);
        }
    }
}

function attachAddProspectButtonClickEvent() {
    $('.btn-modal-prospek').on('click', function(event) {
        $('#modal-tambah-prospek').modal('show');

        var $row_activity = $(this).closest('.col-md-12');

        $('form[name=tambah-prospek]').off('submit').on('submit', function(event) {
            $('.modal').modal('hide');

            var id_peserta = $row_activity.find('input[name="id_peserta[]"]').val();
            var tujuan = $row_activity.find('input[name="tujuan_kegiatan[]"]').val();

            $row_activity.find('select[name="kode_kegiatan[]"]').prop("disabled", true);

            var $form = $(this);

            var nama_prospek = $form.find('input[name=nama_prospek]').val();
            var nama_lembaga = $form.find('input[name=nama_lembaga]').val();
            var alamat = $form.find('textarea[name=alamat]').val();
            var token = $form.find('input[name=_token]').val();

            var form_data = {
                'nama_prospek' : nama_prospek,
                'nama_lembaga' : nama_lembaga,
                'alamat' : alamat,
                '_token' : token
            };

            $.ajax({
                type : 'POST',
                url : '/prospek/store',
                data : form_data,
                dataType : 'json',
                encode : true,
            })

            .done(function(response) {
                $form.find('input[name=nama_prospek]').val('');
                $form.find('input[name=nama_lembaga]').val('');
                $form.find('textarea[name=alamat]').val('');

                $row_activity.find('.col-md-4').remove();

                var total = response.length;
                var list_data = '';

                $.each(response, function(total, list) {
                    list_data +=
                        '<option value="' + list.kode + '">' +
                            list.nama_prospek + ' (' + list.nama_lembaga + ')' +
                        '</option>';
                })

                form_prospek =
                    '<div class="col-md-4">' +
                        '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                        '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                        '<div class="form-group">' +
                            '<label for="kode_kegiatan">Nama Prospek</label>' +
                            '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                list_data +
                            '</select>' +
                        '</div>' +
                    '</div>'

                $row_activity.find('.row').prepend(form_prospek);

                $('select[name="kode_kegiatan[]"]').select2({width: '100%' });
            });

            event.preventDefault();
        });
    });
}

function attachAddTrainingButtonClickEvent() {
    $('.btn-modal-pelatihan').on('click', function() {
        $('#modal-tambah-pelatihan').find('.alert').remove();

        $('#modal-tambah-pelatihan').modal('show');

        var $row_activity = $(this).closest('.col-md-12');

        $('form[name=tambah-pelatihan]').off('submit').on('submit', function(event) {
            $('.modal').modal('hide');

            var id_peserta = $row_activity.find('input[name="id_peserta[]"]').val();
            var tujuan = $row_activity.find('input[name="tujuan_kegiatan[]"]').val();

            $row_activity.find('select[name="kode_kegiatan[]"]').prop("disabled", true);

            var $form = $(this);

            var nama_pelatihan = $form.find('input[name=nama_pelatihan]').val();
            var nama_lembaga = $form.find('input[name=nama_lembaga]').val();
            var tanggal_mulai = $form.find('input[name=tanggal_mulai]').val();
            var tanggal_selesai = $form.find('input[name=tanggal_selesai]').val();
            var alamat = $form.find('textarea[name=alamat]').val();
            var token = $form.find('input[name=_token]').val();

            var form_data = {
                'nama_pelatihan' : nama_pelatihan,
                'nama_lembaga' : nama_lembaga,
                'tanggal_mulai' : tanggal_mulai,
                'tanggal_selesai' : tanggal_selesai,
                'alamat' : alamat,
                '_token' : token
            };

            $.ajax({
                type : 'POST',
                url : '/pelatihan/store',
                data : form_data,
                dataType : 'json',
                encode : true,
            })

            .done(function(response) {
                $form.find('input[name=nama_pelatihan]').val('');
                $form.find('input[name=nama_lembaga]').val('');
                $form.find('input[name=tanggal_mulai]').val('');
                $form.find('input[name=tanggal_selesai]').val('');
                $form.find('textarea[name=alamat]').val('');

                $row_activity.find('.col-md-4').remove();

                var total = response;
                var list_data = '';

                $.each(response, function(total, list) {
                    list_data +=
                        '<option value="' + list.kode + '">' +
                            list.nama_pelatihan + ' (' + list.nama_lembaga + ')' +
                        '</option>';
                });

                form_pelatihan =
                    '<div class="col-md-4">' +
                        '<input type="hidden" name="id_peserta[]" value="' + id_peserta + '">' +
                        '<input type="hidden" name="tujuan_kegiatan[]" value="' + tujuan + '">' +
                        '<div class="form-group">' +
                            '<label for="kode_kegiatan">Nama Pelatihan</label>' +
                            '<select class="form-control" id="kode_kegiatan" name="kode_kegiatan[]">' +
                                list_data +
                            '</select>' +
                        '</div>' +
                    '</div>';

                $row_activity.find('.row').prepend(form_pelatihan);

                $('select[name="kode_kegiatan[]"]').select2({width: '100%' });
            })

            .fail(function(response) {
                $('#modal-tambah-pelatihan').modal('show');

                error =
                    '<div class="alert alert-danger">' +
                        JSON.parse(response.responseText).tanggal_selesai[0] +
                    '</div>';

                $('#modal-tambah-pelatihan').find('.modal-body').prepend(error);
            })

            event.preventDefault();
        });
    });
}
