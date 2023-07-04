@extends('layout.based')
@section('content')
	<!-- Main content -->
	<section class="content">
        <nav aria-label="breadcrumb" class="small">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}" class="text-brown-400">Laporan</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-brown-400">Analisa Alternatif</a></li>
            </ol>
        </nav>
		<!-- Main card -->
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row mt-4">
	            	<div class="col-md-12">
                        <div class="row">
                            <div class="input-group col-sm-4">
                                <h6 class="h6 mt-1">Normalisasi Kriteria</h6>
                            </div>
                            <div class="col">
                            </div>
                            <div class="input-group col-sm-3">
                                <h6 class="h6 mt-1">Kriteria</h6>
                                <select class='custom-select mr-md-2 ml-4' id="select_criteria_alternatif">
                                    @foreach ($criterias as $criteria)
                                         <option value="{{$criteria->criteria_id}}">{{$criteria->criteria_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class='table table-striped table-bordered data tbl_alternative_analyst_result mt-4' id='tbl_alternative_analyst_result' style='width: 100%;'>
                             <thead>
                                <tr>
                                    <th id="text_criteria_alternative">Alternatif</th>
                                    @foreach ($alternatives as $alternative)
                                        <th style='width: 10%;'>{{$alternative->alternative_name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                         {{-- <hr class="divider" /> --}}
                        <h5 class="mt-5">Eigen Vektor</h5>
                        <table class='table table-striped table-bordered data tbl_alternative_analyst_result_eigen' id='tbl_alternative_analyst_result_eigen' style='width: 100%;'>
                            <thead>
                               <tr>
                                   <th></th>
                                   @foreach ($alternatives as $alternative)
                                       <th style='width: 10%;'>{{$alternative->alternative_name}}</th>
                                   @endforeach
                               </tr>
                           </thead>
                           <tbody>
                                {{-- <tr>
                                    <td style='width: 10%; font-weight: bold;writing-mode: vertical-lr' rowspan="{{ count($alternatives)+1 }}" > Nilai Eigen</td>
                                </tr>
                               @foreach ($alternatives as $alternative)
                                   <tr>
                                       @foreach (json_decode($alternative->eigen_vertical_value, true) as $value)
                                           <td>{{ $value['eigen_value']}}</td>
                                       @endforeach
                                   </tr>
                               @endforeach --}}
                               {{-- <tr>
                                   <td class="font-weight-bold">Rata - Rata</td>
                                   @foreach ($alternatives as $alternative_1)
                                       <td style="font-weight: bold;">{{$alternative_1->average}}</td>
                                   @endforeach
                               </tr> --}}
                           </tbody>
                        </table>
                        <h5 class="mt-5">Hasil</h5>
                        <hr class="divider" />
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Consistency Index</label>
                                <label class="col-sm-2 col-form-label font-weight-bold" id="consistency_index"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Ratio Index</label>
                                <label class="col-sm-2 col-form-label font-weight-bold" id="ratio_index"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Consistency Ratio</label>
                                <label class="col-sm-2 col-form-label font-weight-bold" id="consistency_ratio"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alternative" class="col-sm-2 col-form-label">Consistency</label>
                                <label class="col-sm-2 col-form-label font-weight-bold" id="consistency"></label>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
		<!-- /.row -->
		<!--/. container-fluid -->
    </section>
    <!-- /.card -->
    <script type="text/javascript">
        let alternative = new AlternativeResult();
        alternative.initLoad();
	</script>
@endsection
