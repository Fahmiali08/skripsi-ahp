@extends('layout.based')
@section('content')
	<!-- Main content -->
	<section class="content">
        <nav aria-label="breadcrumb" class="small">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}" class="text-brown-400">Laporan</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-brown-400">Analisa Kriteria</a></li>
            </ol>
        </nav>
		<!-- Main card -->
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row mt-4">
	            	<div class="col-md-12">
                        <h5>Normalisasi Kriteria</h5>
                        <table class='table table-striped table-bordered data tbl_criteria_analyst_result' id='tbl_criteria_analyst_result' style='width: 100%;'>
                             <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    @foreach ($criterias as $criteria)
                                        <th style='width: 10%;'>{{$criteria->criteria_name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criterias as $criteria)
                                    <tr>
                                        <td style='width: 10%; font-weight: bold' id='{{$criteria->criteria_analyst_id}}'>{{$criteria->criteria_name}}</td>
                                        @foreach (json_decode($criteria->criteria_analyst_value, true) as $value)
                                            <td>{{ $value['data_value']}}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="font-weight-bold">Jumlah</td>
                                    @foreach ($criterias as $criteria_1)
                                        <td style="font-weight: bold;">{{$criteria_1->total_value}}</td>
                                        {{-- <td rowspan="{{ count($criterias) }}"></td> --}}
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                         {{-- <hr class="divider" /> --}}
                        <h5 class="mt-5">Eigen Vektor</h5>
                        <table class='table table-striped table-bordered data tbl_criteria_analyst_result' id='tbl_criteria_analyst_result' style='width: 100%;'>
                            <thead>
                               <tr>
                                   <th></th>
                                   @foreach ($criterias as $criteria)
                                       <th style='width: 10%;'>{{$criteria->criteria_name}}</th>
                                   @endforeach
                               </tr>
                           </thead>
                           <tbody>
                            <tr>
                                <td style='width: 10%; font-weight: bold;writing-mode: vertical-lr' rowspan="{{ count($criterias)+1 }}" > Nilai Eigen</td>
                            </tr>
                               @foreach ($criterias as $criteria)
                                   <tr>
                                       {{-- <td style='width: 10%; font-weight: bold' > Rata - Rata</td> --}}
                                       @foreach (json_decode($criteria->eigen_vertical_value, true) as $value)
                                           <td>{{ $value['eigen_value']}}</td>
                                       @endforeach
                                   </tr>
                               @endforeach
                               <tr>
                                   <td class="font-weight-bold">Rata - Rata</td>
                                   @foreach ($criterias as $criteria_1)
                                       <td style="font-weight: bold;">{{$criteria_1->average}}</td>
                                   @endforeach
                               </tr>
                           </tbody>
                        </table>
                        <h5 class="mt-5">Hasil</h5>
                        <hr class="divider" />
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Consistency Index</label>
                                <label class="col-sm-2 col-form-label font-weight-bold">{{ $consistency->consistency_index }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Ratio Index</label>
                                <label class="col-sm-2 col-form-label font-weight-bold">{{ $consistency->ratio_index }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Consistency Ratio</label>
                                <label class="col-sm-2 col-form-label font-weight-bold">{{ $consistency->consistency_ratio }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Consistency</label>
                                <label class="col-sm-2 col-form-label font-weight-bold">{{ $consistency->consistency }}</label>
                            </div>
                        </div>
                        <button class="btn btn-flat btn-primary-custom text-white float-left mr-2 d-none" id="btn_analyst_nomalize">Normalize</button>
                    </div>
                </div>
             </div>
        </div>
		<!-- /.row -->
		<!--/. container-fluid -->
    </section>
    <!-- /.card -->
    <script type="text/javascript">
        let criteria = new CriteriaAnalyst();
        criteria.initLoad();

	</script>
@endsection
