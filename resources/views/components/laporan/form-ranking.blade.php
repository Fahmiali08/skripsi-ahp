@extends('layout.based')
@section('content')
	<!-- Main content -->
	<section class="content">
        <nav aria-label="breadcrumb" class="small">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}" class="text-brown-400">Laporan</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-brown-400">Ranking</a></li>
            </ol>
        </nav>
		<!-- Main card -->
        <div class="card rounded-0">
            <div class="card-body">
                <!-- buat form search -->
                <div class="row">
                    <div class="input-group col-sm-4">
                        <h6 class="h6 mt-1">Find</h6>
                        <input type="text" id="find_ranking" class="form-control ml-3 find_ranking" autofocus="true"/>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="btn_find_ranking"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
		        <hr class="divider" />
		        <div class="row mt-4">
	            	<div class="col-md-12">
                        <table class='table table-striped table-bordered data tbl_ranking' id='tbl_ranking' style='width: 100%;'>
                            <thead>
                                <tr>
                                    <th style='width: 2%;'>No</th>
                                    <th style='width: auto;'>Nama</th>
                                    <th style='width: 15%;'>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankings as $ranking)
                                    <tr>
                                        <td>{{ $ranking->alternative_id}}</td>
                                        <td>{{ $ranking->alternative_name}}</td>
                                        <td>{{ $ranking->hasil}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="divider" />
					</div>
				</div>
		        <!-- <div id="container"></div> -->
             </div>
        </div>
		<!-- /.row -->
		<!--/. container-fluid -->
    </section>
    <!-- /.card -->
@endsection
