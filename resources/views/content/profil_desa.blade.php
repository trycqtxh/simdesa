@extends('layouts.template')
@section('title','Profil Desa')
@section('content-main')
@php($profil = new \App\Entities\ProfilDesa)
<div class="box box-default">
	<div class="box-body">
		<div class="nav nav-tabs-custom" id="tabs">
	        <ul class="nav nav-tabs pull-right" role="tablist">
	            <li role="presentation"><a href="#tabpanel-wilayah" aria-controls="tabpanel-wilayah" role="tab"  data-toggle="tab" >Batas Wilayah</a></li>
	            {{--<li role="presentation"><a href="#tabpanel-statistik" aria-controls="tabpanel-statistik" role="tab"  data-toggle="tab" >Statistik</a> </li>--}}
	            <li role="presentation" class="active"><a href="#tabpanel-profil" aria-controls="tabpanel-profil" role="tab"  data-toggle="tab">Profil Desa</a> </li>
	        </ul>
	        <div class="tab-content">
	            <div role="tabpanel" class="tab-pane active" id="tabpanel-profil" style="min-height: 400px">
					@php($slider = App\Slider::all())
					<div id="slider-gambar" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							@php($i = 0)
							@foreach($slider as $s)
							<li data-target="#slider-gambar" data-slide-to="{{ $i++ }}"></li>
							@endforeach
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							@foreach($slider as $s)
							<div class="item">
								<img src="{{ asset('img/slider/'.$s->gambar) }}" alt="{{ $s->title }}" style="height: auto">
								<div class="carousel-caption">
									<h3 class="text-black">{{ $s->title }}</h3>
								</div>
							</div>
							@endforeach
						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#slider-gambar" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#slider-gambar" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<a href="{{ route('profil.slider') }}" class="btn btn-default btn-flat pull-right">Kelola Slider</a>

	            	<table class="table table-striped table-hover" id="profil-desa" width="100%">
						<thead>
							<tr>
								<th colspan="2"><h3>Profil Desa</h3></th>
							</tr>
							<tr>
								<th width="20%"></th>
								<th></th>
							</tr>
						</thead>
					</table>
					<br><hr>
	            </div>
	            <div role="tabpanel" class="tab-pane" id="tabpanel-wilayah" style="min-height: 400px">
	            	<table class="table table-striped table-hover table-responsive" id="batas-wilayah" style="width:100%">
						<thead>
							<tr>
								<th colspan="2"><h3>Batas Wilayah</h3></th>
							</tr>
							<tr>
								<th width="20%"></th>
								<th></th>
							</tr>
						</thead>
					</table>
					<br><hr>
					<table class="table table-bordered table-hover table-condensed table-striped" id="lokasi" style="width:100%">
						<thead>
							<tr>
								<th colspan="2"><h3>Lokasi Desa</h3></th>
							</tr>
							<tr>
								<th width="20%"></th>
								<th></th>
							</tr>
						</thead>
					</table>
	            </div>
	            {{--<div role="tabpanel" class="tab-pane" id="tabpanel-statistik" style="min-height: 400px">--}}
					{{--<table class="table table-striped table-hover" id="jumlah-penduduk" style="width:100%">--}}
						{{--<thead>--}}
						{{--<tr>--}}
							{{--<th colspan="2"><h3>Jumlah Penduduk</h3></th>--}}
						{{--</tr>--}}
						{{--<tr>--}}
							{{--<th width="20%">Jenis Kelamin</th>--}}
							{{--<th>Jumlah</th>--}}
						{{--</tr>--}}
						{{--</thead>--}}
					{{--</table>--}}
					{{--<br>--}}
					{{--<div class="panel panel-primary">--}}
						{{--<div class="panel-heading">--}}
							{{--<span class="fa fa-pie-chart"></span>--}}
							{{--<h3 class="panel-title" style="display: inline;">Grafik Jumlah Penduduk</h3>--}}
							{{--<div class="clearfix"></div>--}}
						{{--</div>--}}
						{{--<div class="panel-body" id="yw16">--}}
							{{--<div id="chart-penduduk"></div>--}}
						{{--</div>--}}
					{{--</div>--}}
					{{--<br><hr>--}}

					{{--<table class="table table-striped table-hover" id="jumlah-umur" style="width:100%">--}}
						{{--<thead>--}}
						{{--<tr>--}}
							{{--<th colspan="2"><h3>Jumlah Penduduk Menurut Umur</h3></th>--}}
						{{--</tr>--}}
						{{--<tr>--}}
							{{--<th width="20%">Umur</th>--}}
							{{--<th>Jumlah</th>--}}
						{{--</tr>--}}
						{{--</thead>--}}
					{{--</table>--}}
					{{--<br>--}}
					{{--<div class="panel panel-primary">--}}
						{{--<div class="panel-heading">--}}
							{{--<span class="fa fa-pie-chart"></span>--}}
							{{--<h3 class="panel-title" style="display: inline;">Grafik Jumlah Penduduk Menurut Umur</h3>--}}
							{{--<div class="clearfix"></div>--}}
						{{--</div>--}}
						{{--<div class="panel-body" id="yw16">--}}
							{{--<div id="chart-umur"></div>--}}
						{{--</div>--}}
					{{--</div>--}}
					{{--<br><hr>--}}

					{{--<table class="table table-striped table-hover" id="jumlah-pendidikan" style="width:100%">--}}
						{{--<thead>--}}
						{{--<tr>--}}
							{{--<th colspan="2"><h3>Tingkat Pendidikan Masyarakat</h3></th>--}}
						{{--</tr>--}}
						{{--<tr>--}}
							{{--<th width="20%">Tingkat Pendidikan</th>--}}
							{{--<th>Jumlah</th>--}}
						{{--</tr>--}}
						{{--</thead>--}}
					{{--</table>--}}
					{{--<br>--}}
					{{--<div class="panel panel-primary">--}}
						{{--<div class="panel-heading">--}}
							{{--<span class="fa fa-pie-chart"></span>--}}
							{{--<h3 class="panel-title" style="display: inline;">Grafik Tingkat Pendidikan Masyarakat</h3>--}}
							{{--<div class="clearfix"></div>--}}
						{{--</div>--}}
						{{--<div class="panel-body" id="yw16">--}}
							{{--<div id="chart-pendidikan"></div>--}}
						{{--</div>--}}
					{{--</div>--}}
					{{--<br><hr>--}}

					{{--<table class="table table-striped table-hover" id="jumlah-kerja" style="width:100%">--}}
						{{--<thead>--}}
						{{--<tr>--}}
							{{--<th colspan="2"><h3>Pekerjaan Penduduk</h3></th>--}}
						{{--</tr>--}}
						{{--<tr>--}}
							{{--<th width="20%">Pekerjaan</th>--}}
							{{--<th>Jumlah</th>--}}
						{{--</tr>--}}
						{{--</thead>--}}
					{{--</table>--}}
					{{--<br>--}}
					{{--<div class="panel panel-primary">--}}
						{{--<div class="panel-heading">--}}
							{{--<span class="fa fa-pie-chart"></span>--}}
							{{--<h3 class="panel-title" style="display: inline;">Grafik Pekerjaan Penduduk</h3>--}}
							{{--<div class="clearfix"></div>--}}
						{{--</div>--}}
						{{--<div class="panel-body" id="yw16">--}}
							{{--<div id="chart-pekerjaan"></div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
	        </div>
        </div>
	</div>
</div>	

<div class="modal" id="modal"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" style="min-width: 360px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">FORM UBAH</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="form-group form-group-sm">
						<label for="label" class="col-md-4 control-label">RT</label>
						<div class="col-md-8">
							<input class="form-control" name="label" id="label">
							<input type="hidden" name="kode" id="kode">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-logo"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" style="min-width: 360px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">FORM UBAH LOGO</h4>
			</div>
			{!! Form::open([
				'class' => 'form-horizontal',
				'files' => true,
				'route' => 'profil.desa.logo',
			]) !!}
			{{--<form class="form-horizontal" role="form">--}}
				<div class="modal-body">
					<div class="form-group form-group-sm">
						<label for="label" class="col-md-4 control-label">Logo</label>
						<div class="col-md-8">
							{!! Form::file('logo', null) !!}
							<input type="hidden" name="kode" id="kode">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			{{--</form>--}}
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal" id="modal-slider"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" style="min-width: 360px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kelola Slider</h4>
			</div>
				<div class="modal-body">
					<table class="table">
						<thead>
						<tr>
							<td>Gambar</td>
							<td>Title</td>
						</tr>
						</thead>
						<tbody>
						@foreach($slider as $s)
						<tr>
							<td><a onclick="return edit_slider('{{$s->id}}', '{{$s->gambar}}', '{{$s->title}}')">{{ $s->gambar }}</a></td>
							<td>{{ $s->title }}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
		</div>
	</div>
</div>

<div class="modal" id="modal-slider-edit"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" style="min-width: 360px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Slider</h4>
			</div>
			{!! Form::open([
				'class' => 'form-horizontal',
				'files' => true,
				'route' => 'profil.slider',
			]) !!}
			{{--<form class="form-horizontal" role="form">--}}
				<div class="modal-body">
					<div class="form-group form-group-sm">
						<div class="col-md-6">
							<input class="form-control" name="title" id="title">
							<input type="hidden" name="id">
						</div>
						<div class="col-md-6">
							{!! Form::file('gambar', null) !!}
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			{{--</form>--}}
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@push('js')
{{ Html::script('assets/plugins/fusioncharts/js/fusioncharts.js') }}
{{ Html::script('assets/plugins/fusioncharts/js/themes/fusioncharts.theme.fint.js') }}
	<script type="text/javascript">
		$("#slider-gambar .carousel-indicators li:first").addClass("active");
		$("#slider-gambar .carousel-inner .item:first").addClass("active");

		var profil = $('#profil-desa').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ url()->current() }}",
				dataSrc : "data.profil"
			},
			columns   : [
				{"data" : "index"},
				{"data" : "value",},
			],
		});
		var batasWilayah = $('#batas-wilayah').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ route('profil.desa.wilayah') }}",
				dataSrc : "data.wilayah"
			},
			columns   : [
				{"data" : "index",},
				{"data" : "value",},
			]
		});
		var lokasiDesa = $('#lokasi').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ route('profil.desa.lokasi') }}",
				dataSrc : "data.lokasi"
			},
			columns   : [
				{"data" : "index",},
				{"data" : "value",},
			]
		});
		var jumlahPenduduk = $('#jumlah-penduduk').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ route('profil.desa.statistik') }}",
				dataSrc : "data.penduduk"
			},
			columns   : [
				{"data" : "index",},
				{"data" : "value",},
			]
		});
		var jumlahUmur = $('#jumlah-umur').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ route('profil.desa.statistik') }}",
				dataSrc : "data.umur"
			},
			columns   : [
				{"data" : "index",},
				{"data" : "value",},
			]
		});
		var jumlahPendidikan = $('#jumlah-pendidikan').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ route('profil.desa.statistik') }}",
				dataSrc : "data.pendidikan"
			},
			columns   : [
				{"data" : "index",},
				{"data" : "value",},
			]
		});
		var jumlahKerja = $('#jumlah-kerja').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			info      : false,
			ajax      : {
				context : {
					context: "table"
				},
				url     : "{{ route('profil.desa.statistik') }}",
				dataSrc : "data.kerja"
			},
			columns   : [
				{"data" : "index",},
				{"data" : "value",},
			]
		});
		var modal = $('#modal');
		var modalSlider = $('#modal-slider');
		var modalSliderEdit = $('#modal-slider-edit');


		function ubah(kode, index, value){
			if(kode == 'kode_provinsi' || kode == 'kode_kota' || kode == 'kode_kecamatan' ){
				modal.find('input[name=label]').inputmask({mask: '99'});
			}
			modal.find('label[for=label]').text(index);
			modal.find('input[name=label]').val(value);
			modal.find('input[name=kode]').val(kode);
			modal.modal('show');
		}

		function ubah_logo(){
			$('#modal-logo').modal("show");
		}

		function kelola_slider(){
			modalSlider.modal("show");
		}

		function edit_slider(id, gambar, title){
			modalSliderEdit.find('input[name=id]').val(id);
//			modalSliderEdit.find('input[name=gambar]').val(gambar);
			modalSliderEdit.find('input[name=title]').val(title);
			modalSliderEdit.modal("show");
		}


		var DataJson = null;
		$.ajax({
			type : "GET",
			global : false,
			dataType   : "json",
			url        : "{{ route('profil.desa.statistik') }}",
			async: false
		}).done(function(data){
			DataJson = data.data;
		});

//		FusionCharts.ready(function () {
//			var penduduk = new FusionCharts({
//				"type": "pie3d",
//				"renderAt": "chart-penduduk",
//				"width": "100%",
//				"height": "300",
//				"dataFormat": "json",
//				"dataSource": DataJson['grafik_penduduk']
//
//        	});
//			penduduk.render();
//			var umur = new FusionCharts({
//				"type": "pie3d",
//				"renderAt": "chart-umur",
//				"width": "100%",
//				"height": "300",
//				"dataFormat": "json",
//				"dataSource": DataJson['grafik_umur']
//
//        	});
//			umur.render();
//			var pendidikan = new FusionCharts({
//				"type": "pie3d",
//				"renderAt": "chart-pendidikan",
//				"width": "100%",
//				"height": "300",
//				"dataFormat": "json",
//				"dataSource": DataJson['grafik_pendidikan']
//
//        	});
//			pendidikan.render();
//			var pekerjaan = new FusionCharts({
//				"type": "pie3d",
//				"renderAt": "chart-pekerjaan",
//				"width": "100%",
//				"height": "300",
//				"dataFormat": "json",
//				"dataSource": DataJson['grafik_pekerjaan']
//
//        	});
//			pekerjaan.render();
//		});


		$(function(){
			$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
				$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
			});
			modal.find('form').submit(function(e){
				var kode = $(this).find('input[name=kode]').val();
				$.ajax({
					context : {
						context : "form"
					},
					type : "PUT",
					dataType : "json",
					data : $(this).serialize(),
					url      : "{{ route('profil.desa.ubah', '') }}/"+kode
				}).done(function(){
					modal.find('input[name=label]').inputmask("remove");
					profil.ajax.reload();
					batasWilayah.ajax.reload();
					lokasiDesa.ajax.reload();
				}).fail(function(){
					modal.find('input[name=label]').inputmask("remove");
				});
				e.preventDefault();
			});
			modal.on('hidden.bs.modal', function(){
				modal.find('input[name=label]').inputmask("remove");
			});

			$('#modal-logo').find('form').submit(function(e){
				$.ajax({
					context : {
						context : "form"
					},
					type     : "POST",
//					dataType : "json",
					data     : new FormData(this),
					url      : "{{ route('profil.desa.logo') }}",
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,
				}).done(function(){
					profil.ajax.reload();
				});
				e.preventDefault();
			});
		});
	</script>
@endpush

