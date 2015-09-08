<div class="modal fade" id="detail-{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h1 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h1>
				</div>
				<div class="modal-body">
					<div>
						<!-- Info basic dari RPD -->
                        <table class="table table-modal table-responsive">
                            <tbody>
                                <tr>
                                    <th class="col-md-4">ID</th>
                                    <td>1009091266</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Penanggung Jawab</th>
                                    <td>Pegawai yang sedang login</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Kategori</th>
                                    <td>Trip</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Jenis</th>
                                    <td>Luar Kota</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Tanggal Mulai</th>
                                    <td>10 Mei 2015</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Tanggal Selesai</th>
                                    <td>20 Mei 2015</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Jumlah Hari Dinas</th>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Asal Kota</th>
                                    <td>Bandung</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Tujuan Kota</th>
                                    <td>Jakarta Pusat</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Sarana Transportasi</th>
                                    <td>Mobil Dinas, Travel</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Sarana Penginapan</th>
                                    <td>Hotel</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Status</th>
                                    <td>Submitted</td>
                                </tr>
                            </tbody>
                        </table>

						<!-- Daftar Peserta RPD-->
						<h3>Peserta dan Tujuan Kegiatan</h3>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Judul Project/Prospek/Pelatihan</th>
									<th>Kegiatan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Andi suryadi</td>
									<td>SI PEndidikan</td>
									<td>Review</td>
								</tr>
								<tr>
									<td>Ali riwansyah</td>
									<td>Web E-Commerce</td>
									<td>Meeting</td>
								</tr>
							</tbody>
						</table>

						<!--Bagian Komentar atau Keterangan-->
						<h4>Komentar</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. 
						</p>

						<!--Bagian Action History-->
						<h3>Action History</h3>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Date Time</th>
									<th>Nama</th>
									<th>Action Taken</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2015/09/09</td>
									<td>Reynaldi Sunaryo</td>
									<td>Submitted</td>
								</tr>
								<tr>
									<td>2015/09/10</td>
									<td>Ananda</td>
									<td>Approve</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>