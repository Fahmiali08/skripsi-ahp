@extends('layout.based')
@section('content')
	<!-- Main content -->
	<section class="content">
        <nav aria-label="breadcrumb" class="small">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}" class="text-brown-400">Data</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-brown-400">Kriteria</a></li>
            </ol>
        </nav>
		<!-- Main card -->
        <div class="card rounded-0">
            <div class="card-body">
                <!-- buat form search -->
                <div class="row">
                    <div class="input-group col-sm-4">
                        <h6 class="h6 mt-1">Find</h6>
                        <input type="text" id="find_criteria" class="form-control ml-3 find_criteria" autofocus="true"/>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="btn_find_criteria"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col">
                    </div>
                    <div class="input-group col-sm-2">
                        <h6 class="h6 mt-1">Status</h6>
                        <select class='custom-select mr-md-2 ml-4' id="select_criteria_status">
                            <option value="all_criteria">All</option>
                            <option value="criteria_active">Active</option>
                            <option value="criteria_not_active">Not Active</option>
                        </select>
                    </div>
                </div>
		        <hr class="divider" />
		        <div class="row mt-4">
	            	<div class="col-md-12">
                        <table class='table table-striped table-bordered data tbl_criteria' id='tbl_criteria' style='width: 100%;'>
                            <thead>
                                <tr>
                                    <th style='width: 2%;'>No</th>
                                    <th style='width: 15%;'>Kode</th>
                                    <th style='width: auto;'>Nama</th>
                                    <th style='width: 12%; text-align: center;'>Aksi</th>
                                    <th style='display: none;'>siswa_id</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <hr class="divider" />
                        <button class="btn btn-flat btn-primary-custom text-white float-left mr-2" id="btn_add_criteria">Tambah</button>
					</div>
				</div>
		        <!-- <div id="container"></div> -->
             </div>
        </div>
		<!-- /.row -->
		<!--/. container-fluid -->
    </section>
    @include('components.admin.form-criteria-entry')
    <!-- /.card -->
    <script type="text/javascript">
        let criteria = new Criteria();
        criteria.initLoad();
	</script>
@endsection
