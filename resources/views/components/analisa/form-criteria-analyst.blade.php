@extends('layout.based')
@section('content')
	<!-- Main content -->
	<section class="content">
        <nav aria-label="breadcrumb" class="small">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}" class="text-brown-400">Analisa</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-brown-400">Kriteria</a></li>
            </ol>
        </nav>
		<!-- Main card -->
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row mt-4">
	            	<div class="col-md-12">
                        <h5>Matriks Perbandingan Kriteria</h5>
                        <table class='table table-striped table-bordered data tbl_criteria_analyst' id='tbl_criteria_analyst' style='width: 100%;'>
                             <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    @foreach ($criterias as $criteria)
                                        <th style='width: 15%;'>{{$criteria->criteria_name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($criterias as $criteria)
                                    <tr>
                                        <td style='width: 15%; font-weight: bold' id='{{$criteria->criteria_id}}'>{{$criteria->criteria_name}}</td>
                                        @foreach ($criterias as $criteria_1)
                                            <td><input type="text" class="form-control" value="" id="{{$criteria_1->criteria_id}}"></td>
                                        @endforeach
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                         <hr class="divider" />
                        <button class="btn btn-flat btn-primary-custom text-white float-left mr-2" id="btn_analyst_proses">Proses</button>
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
        let criteria = new CriteriaAnalyst();
        criteria.initLoad();

        var tbl = document.getElementById('tbl_criteria_analyst');
        for (let i = 1; i < tbl.rows.length; i++) {
            let rows = tbl.rows[i];
            // rows.cells[i].style.backgroundColor = 'red';
            rows.cells[i].children[0].value = '1';
            // console.log(rows.cells[i].children[0].id+" ------------ "+rows.cells[i].children[0].value)
        }

	</script>
@endsection
