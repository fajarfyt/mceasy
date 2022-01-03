@extends('layouts.master')

@section('konten')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6">
            <h1 class="m-0">Master Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Karyawan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success float-end" href="javascript:void(0)" id="addEmployee"><i class="fas fa-user-plus"></i> Karyawan</a>
                </div>
            </div>

              <div class="card-body">
                <table id="tabel_karyawan" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

</div>
</div>



<script src="{{ asset('js/app.js') }}"></script>
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> --}}

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script type="application/javascript">
   let tabel_karyawan;
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        tabel_karyawan = $('#tabel_karyawan').DataTable({
            "ajax": {
				"url": "{{ route('get-karyawan') }}",
				"method": "GET",
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			},
			"columns": [
                {
					data: 'nomor_induk',
					name: 'nomor_induk'
				},
				{
					data: 'nama',
					name: 'nama'
				},
				{
					data: 'alamat',
					name: 'alamat'
				},
				{
					data: 'tanggal_lahir',
					name: 'tanggal_lahir'
				},
                {
					data: 'tanggal_bergabung',
					name: 'tanggal_bergabung'
				},
                {
                    data: 'aksi'
                }
			],
			"columnDefs": [{
				"targets": [0], //last column
				"className": 'dt-body-center'
			}],
        });

        $('#addEmployee').click(function () {
            //$('#saveBtn').val("create-karyawan");
            $('#employee_form').trigger("reset");
            $('#modelHeading').html("Buat Karyawan Baru");
            $('#saveModal').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Menyimpan..');

            $.ajax({
                data: $('#employee_form').serialize(),
                url: "{{ route('save-karyawan')}}",
                method: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#employee_form').trigger("reset");
                    $('#saveModal').modal('hide');
                     $('#saveBtn').html('Simpan');
                    reloadTable();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Simpan');
                }
            });
        });

        $('body').on('click', '.editEmployee', function () {
            var nomor_induk = $(this).data('id');
            var url = "{{ route('get-byid-karyawan', ':nomer') }}";
            url = url.replace(':nomer', nomor_induk);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modelHeading').html("Edit Employee "+data[0].nama);
                    $('#saveBtn').val("edit-user");
                    $('#saveModal').modal('show');
                    $('#nomor_induk').val(data[0].nomor_induk);
                    $('#nama').val(data[0].nama);
                    $('#alamat').val(data[0].alamat);
                    $('#tanggal_lahir').val(data[0].tanggal_lahir);
                    $('#tanggal_bergabung').val(data[0].tanggal_bergabung);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        });

        $('body').on('click', '.deleteEmployee', function () {
            var nomor_induk = $(this).data('id');
            var url = "{{ route('delete-karyawan', ':nomer') }}";
            url = url.replace(':nomer', nomor_induk);
            confirm("Are You sure want to delete !");
            $.ajax({
                url: url,
                method: "DELETE",
                dataType: "JSON",
                success: function(data) {
                    reloadTable();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        });
    });

    function reloadTable() {
        tabel_karyawan.ajax.reload(null, false);
    }

</script>

<div class="modal animated pulse text-left" id="saveModal" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="min-width: 85%" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title text-bold-500 white"><i class="la la-plus-square"></i> <b id="modelHeading"></b></h4>
				<button type="button" class="close white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="employee_form" name="employee_form" method="POST" class="form-horizontal" autocomplete="off">
					<div class="form-body">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nomor Induk</label>
									<input id="nomor_induk" name="nomor_induk" class="form-control" placeholder="Auto Generate" readonly="readonly" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nama</label>
									<input id="nama" name="nama" class="form-control" type="text">
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tanggal Lahir</label>
									<input name="tanggal_lahir" id="tanggal_lahir" class="form-control" type="date" >
								</div>
							</div>
                            <div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tanggal Bergabung</label>
									<input name="tanggal_bergabung" id="tanggal_bergabung" class="form-control" type="date" >
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Alamat</label>
									<textarea name="alamat" id="alamat" class="form-control" type="text"></textarea>
								</div>
							</div>
                        </div>

						<hr class="mb-0 mt-0 pt-0 pb-0">
						<div class="row" style="padding-top: 1.5rem !important;">

							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" id="saveBtn" class="btn mb-1 btn-info box-shadow-2 btn-lg btn-block pull-up">
										Simpan
									</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<button type="button" class="btn mb-1 btn-danger box-shadow-2 btn-lg btn-block pull-up" data-dismiss="modal">
										Tutup
									</button>
								</div>
							</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
