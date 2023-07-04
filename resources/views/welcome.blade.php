@extends('layout.based')
@section('content')
<div class="form-group row">
	<div class="col-sm-12">
    <!-- Default box -->
        <div class="card h-100 rounded-0 bg-custom">
			<div class="bg-opacity">
				<div>
					<div class="row pt-3 pl-2">
						<div class="col-md-6 text-left">
							<div class="row pt-3">
								<h1 style="color:red; padding-left:12px; color:#05BFDB; font-weight: bold;">Sistem Pendukung Keputusan</h1>
							</div>
						</div>
						<div class="col text-right mr-4">
							<!-- <img src="{{asset('img/t2.png')}}" width="75%" height="105%"> -->
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<table class='table table-striped table-bordered data tbl_alternative' id='tbl_alternative' style='width: 100%;'>
								<thead>
									<tr>
										<th colspan="12"><center><h2>TABEL INDEX RANDOM</h2></center></th>
									</tr>
									<tr>
										<th>n</th>
										<th>1</th>
										<th>2</th>
										<th>3</th>
										<th>4</th>
										<th>5</th>
										<th>6</th>
										<th>7</th>
										<th>8</th>
										<th>9</th>
										<th>10</th>
										<th>11</th>
									</tr>
								</thead>
									<tr>
										<td>RC</td>
										<td>0.00</td>
										<td>0.00</td>
										<td>0.58</td>
										<td>0.90</td>
										<td>1.12</td>
										<td>1.24</td>
										<td>1.32</td>
										<td>1.41</td>
										<td>1.45</td>
										<td>1.49</td>
										<td>1.51</td>
	
									</tr>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    <!-- /.card -->
    </div>
</div>
@endsection
