@extends('layouts.template')
@section('title','Profil Desa')
@section('content-main')
@php($profil = new \App\Entities\ProfilDesa)
	<div class="box box-default">
		<div class="box-body">
			<a class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> </a>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-body">
			<table class="table table-striped table-border">
				<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Gambar</th>
					<th>Action</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
	@include('modal.slider')
@endsection

@push('js')
	<script>
		var table = $('table').DataTable({
			ordering  : false,
			paging    : false,
			searching : false,
			ajax:{
				url: "{{ url()->current() }}",
				dataSrc: "data"
			},
			columns:[
				{'data': 'no', 'width': '20px'},
				{'data': 'judul', },
				{'data': 'gambar', 'width': '200px'},
				{'data': 'act', 'width': '150px'},
			],
			language  : {
				url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
			},

		});

		function update_gambar(id, judul){
			$('#modal-ubah').find('input[name=id]').val(id);
			$('#modal-ubah').find('textarea[name=judul]').val(judul);
			$('#modal-ubah').modal('show');
		}

		function delete_gambar(id){
			if(confirm("Apakah yakin akan Dihapus ?")){
				$.ajax({
					context : {
						context : "form"
					},
					url : "{{ route('profil.slider.destroy', '') }}/"+id,
					dataType : "json",
					type : "POST"
				}).done(function(){
					table.ajax.reload();
				});
			}
		}

		$(function(){
			$('#modal-tambah').find('form').submit(function(e){
				console.log(new FormData(this));
				$.ajax({
					context : {
						context : "form"
					},
					type     : "POST",
					data     : new FormData(this),
					url      : "{{ route('profil.slider.store') }}",
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,
				}).done(function(){
					table.ajax.reload();
				});
				e.preventDefault();
			});
			$('#modal-ubah').find('form').submit(function(e){
				var id = $(this).find('input[name=id]').val();
				$.ajax({
					context : {
						context : "form"
					},
					type     : "POST",
					data     : new FormData(this),
					url      : "{{ route('profil.slider.update', '') }}/"+id,
					contentType: false,
					cache      : false,
					processData:false,
				}).done(function(){
					table.ajax.reload();
				});
				e.preventDefault();
			});

		})
	</script>
@endpush