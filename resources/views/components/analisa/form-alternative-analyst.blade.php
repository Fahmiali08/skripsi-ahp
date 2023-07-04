@extends('layout.based')
@section('content')
	<!-- Main content -->
	<section class="content">
        <nav aria-label="breadcrumb" class="small">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}" class="text-brown-400">Analisa</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-brown-400">Alternatif</a></li>
            </ol>
        </nav>
		<!-- Main card -->
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row mt-4">
	            	<div class="col-md-12">
                        <div class="row">
                            <div class="input-group col-sm-4">
                                <h6 class="h6 mt-1">Matrik Perbandingan Alternatif</h6>
                            </div>
                            <div class="col">
                            </div>
                            <div class="input-group col-sm-3">
                                <h6 class="h6 mt-1">Kriteria</h6>
                                <select class='custom-select mr-md-2 ml-4' id="select_criteria">
                                    @foreach ($criterias as $criteria)
                                         <option value="{{$criteria->criteria_id}}">{{$criteria->criteria_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class='table table-striped table-bordered data tbl_alternative_analyst mt-4' id='tbl_alternative_analyst' style='width: 100%;'>
                             <thead>
                                <tr>
                                    <th id="text_criteria">Alternatif</th>
                                    @foreach ($alternatives as $alternative)
                                        <th style='width: 15%;'>{{$alternative->alternative_name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($alternatives as $alternative)
                                    <tr>
                                        <td style='width: 15%; font-weight: bold' id='{{$alternative->alternative_id}}'>{{$alternative->alternative_name}}</td>
                                        @foreach ($alternatives as $alternative_1)
                                            <td><input type="text" class="form-control" value="" id="{{$alternative_1->alternative_id}}"></td>
                                        @endforeach
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                         <hr class="divider" />
                        <button class="btn btn-flat btn-primary-custom text-white float-left mr-2" id="btn_alternative_analyst_proses">Proses</button>
                    </div>
                </div>
             </div>
        </div>
		<!-- /.row -->
		<!--/. container-fluid -->
    </section>
    <!-- /.card -->
    <style>
    table {
      border-collapse: collapse;
    }

    td {
      border: 1px solid black;
      padding: 3px 5px;
    }
  </style>
    <script type="text/javascript">
        let alternative = new AlternativeAnalyst();
        alternative.initLoad();

        var tbl = document.getElementById('tbl_alternative_analyst');
        for (let i = 1; i < tbl.rows.length; i++) {
            let rows = tbl.rows[i];
            // rows.cells[i].style.backgroundColor = 'red';
            rows.cells[i].children[0].value = '1';
            // console.log(rows.cells[i].children[0].id+" ------------ "+rows.cells[i].children[0].value)
        }

	</script>
@endsection
