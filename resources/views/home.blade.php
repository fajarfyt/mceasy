@extends('layouts.master')

@section('konten')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6">
            <h1 class="m-0">Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
          <div class="col-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Karyawan</span>
                <span class="info-box-number">{{ $jml_karyawan }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Karyawan Cuti Hari Ini</span>
                <span class="info-box-number">{{ $karyawan_cuti_hari_ini }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          {{-- <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div> --}}

          <div class="col-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hourglass-end"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Masa Kerja</span>
                <span class="info-box-number"> - Hari</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-4">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Members</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">3 New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        @foreach($karyawan_terbaru as $p)
                            <li>
                                <img src="{{asset('img/default.png')}}" alt="User Image">
                                <a class="users-list-name" href="#">{{ $p->nama }}</a>
                                <span class="users-list-date">{{ $p->tanggal_bergabung }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="{{ route('karyawan') }}">View All Users</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sisa Cuti Karyawan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabel_sisa_cuti" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Sisa Cuti</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Karyawan Yang pernah Mengambil Cuti</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabel_karyawan_cuti" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Tanggal Cuti</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Karyawan yang mengambil Cuti >1x</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabel_karyawan_lebih_sekali" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Nomor Induk</th>
                        <th>Nama</th>
                        <th>Tanggal Cuti</th>
                        <th>Keterangan</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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
    let tabel_karyawan_cuti;
    let tabel_sisa_cuti;
    let tabel_karyawan_lebih_sekali;
    $( document ).ready(function() {
        tabel_karyawan_cuti = $('#tabel_karyawan_cuti').DataTable({
            "ajax": {
				"url": "{{ route('karyawan-cuti') }}",
				"method": "GET",
                dataSrc: '',
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
					data: 'tanggal_cuti',
					name: 'tanggal_cuti'
				},
				{
					data: 'keterangan',
					name: 'keterangan'
				},
			],
			"columnDefs": [{
				"targets": [0], //last column
				"className": 'dt-body-center'
			}],
        });

        tabel_sisa_cuti = $('#tabel_sisa_cuti').DataTable({
            "ajax": {
				"url": "{{ route('sisa-cuti') }}",
				"method": "GET",
                dataSrc: '',
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
					data: 'sisa_cuti',
					name: 'sisa_cuti'
				}
			],
			"columnDefs": [{
				"targets": [0], //last column
				"className": 'dt-body-center'
			}],
        });

        tabel_karyawan_lebih_sekali = $('#tabel_karyawan_lebih_sekali').DataTable({
            "ajax": {
				"url": "{{ route('karyawan-cuti-lebih-sekali') }}",
				"method": "GET",
                dataSrc: '',
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
					data: 'tanggal_cuti',
					name: 'tanggal_cuti'
				},
				{
					data: 'keterangan',
					name: 'keterangan'
				},
			],
			"columnDefs": [{
				"targets": [0], //last column
				"className": 'dt-body-center'
			}],
        });
    });

</script>

@endsection
