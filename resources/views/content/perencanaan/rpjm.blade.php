@extends('layouts.template')

@section('title', 'RPJM')

@php($rpjm = App\Entities\RPJM::all()->last() )

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title') {{ ($rpjm) ? 'Periode '.$rpjm['periode'] : '' }}
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection


@if((int) Carbon\Carbon::now()->year >= $rpjm['tahun_akhir'] )
    @section('content-main')
        <div class="box box-default">
            <div class="box-body">
                <div class="col-md-4"></div>
                <form class="form-inline" action="{{ route('rpjm.tambahRpjm') }}" method="POST">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label for="jumlah_tahun">Jumlah Tahun</label>
                        <select class="form-control" id="jumlah_tahun" name="jumlah_tahun">
                            <option value="6">6 Tahun</option>
                            <option value="5">5 Tahun</option>
                            <option value="4">4 Tahun</option>
                            <option value="3">3 Tahun</option>
                            <option value="2">2 Tahun</option>
                            <option value="1">1 Tahun</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Tambah</button>
                </form>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="box box-default">
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Tahun Awal</th>
                        <th>Tahun Akhir</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($all = App\Entities\RPJM::all())
                    @foreach($all as $l)
                    <tr>
                        <td>Periode {{ $l->periode }}</td>
                        <td>{{ $l->tahun_awal }}</td>
                        <td>{{ $l->tahun_akhir }}</td>
                        <td>#</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
@else
{{---------------------------------------------------------------------------------------------------------------------}}
    @section('content-main')
        <div class="box box-default" id="rpjm">
            <div class="box-body">
                {{--<button class="btn btn-default btn-sm" id="btn-tambah-sub-bidang"><i class="fa fa-plus"></i> Tambah SubBidang</button>--}}
                {{--<button class="btn btn-default btn-sm" id="btn-tambah-kegiatan"><i class="fa fa-plus"></i> Tambah Kegiatan</button>--}}
                {{--<button class="btn btn-default btn-sm" id="btn-tambah-sub-kegiatan"><i class="fa fa-plus"></i> Tambah SubKegiatan</button>--}}
                <button class="btn btn-default btn-sm" id="btn-export"><i class="fa fa-download"></i> Export</button>
            </div>
        </div>

        <div class="box box-default" id="body-rpjm">
            <div class="box-body">
                <form id="form-rpjm" role="form" action="{{ route('rpjm.tambah') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-bordered table-striped table-rpjm" id="tabel-rpjm">
                        <thead>
                        <tr>
                            <th rowspan="3" style="min-width: 65px">#</th>
                            <th rowspan="2">NO</th>
                            <th colspan="4">BIDANG / JENIS KEGIATAN<br></th>
                            <th rowspan="2">LOKASI</th>
                            <th rowspan="2">PRAKIRA VOLUME<br></th>
                            <th rowspan="2">SASARAN MANFAAT<br></th>
                            @php($selisih = $rpjm['tahun_akhir'] - $rpjm['tahun_awal'])
                            <th colspan="6">WAKTU PELAKSANAAN<br></th>
                            <th colspan="2">PRAKIRA BIAYA DAN SUMBER PEMBIAYAAN<br></th>
                            <th colspan="3">PRAKIRA POLA PELAKSANAAN<br></th>
                        </tr>
                        <tr>
                            <th>BIDANG<br></th>
                            <th></th>
                            <th>SUB BIDANG<br></th>
                            <th>JENIS KEGIATAN<br></th>
                            @for($i=0; $i< 6; $i++)
                            <th>{{ (int) $rpjm['tahun_awal'] + $i }}</th>
                            @endfor
                            {{--<th>1</th>--}}
                            {{--<th>2</th>--}}
                            {{--<th>3</th>--}}
                            {{--<th>4</th>--}}
                            {{--<th>5</th>--}}
                            {{--<th>6</th>--}}
                            <th>JUMLAH (Rp.)<br></th>
                            <th>SUMBER DANA<br></th>
                            <th>SWAKELOLA</th>
                            <th>KERJASAMA ANTAR DESA<br></th>
                            <th>KERJASAMA PIHAK KETIGA<br></th>
                        </tr>
                        <tr>
                            <th style="width: 10px">1</th>
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
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                            <th>15</th>
                            <th>16</th>
                            <th>17</th>
                            <th>18</th>
                            <th>19</th>
                        </tr>
                        </thead>
                    </table>
                    <div class="clearfix"></div>
                    <button class="btn btn-default">Simpan RPJM</button>
                </form>
            </div>
        </div>
        @include('modal.perencanaan.rpjm-sub-bidang')
        @include('modal.perencanaan.rpjm-sub-kegiatan')
        @include('modal.perencanaan.rpjm-kegiatan')
    @endsection

    @push('js')
    <script type="text/javascript">
        var tabel = $('#tabel-rpjm').DataTable({
            ordering     : false,
            paging       : true,
            searching    : false,
            lengthChange : false,
            scrollX      : true,
            scrollY      : "400px",
            fixedHeader  : true,
            scrollCollapse: true,
            scroller     : true,
            stateSave    : true,
            select    : {
                style: 'single'
            },
//            fixedColumns  : {
//                leftColumns : 1,
//            },
            language  : {
                url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
            },
            ajax      : {
                context : {
                    context: 'table'
                },
                url     : "{{ route('rpjm.index') }}",
                dataSrc : "data"
            },
            columns   : [
                {"data" : "action"},
                {"data" : "no"},
                {"data" : "bidang"},
                {"data" : "kosong"},
                {"data" : "sub_bidang"},
                {"data" : "jenis_kegiatan"},
                {"data" : "lokasi"},
                {"data" : "volume"},
                {"data" : "manfaat"},
                {"data" : "th_1"},
                {"data" : "th_2"},
                {"data" : "th_3"},
                {"data" : "th_4"},
                {"data" : "th_5"},
                {"data" : "th_6"},
                {"data" : "jml"},
                {"data" : "sumber", 'className': 'text-right'},
                {"data" : "swakelola"},
                {"data" : "antar_desa"},
                {"data" : "pihak_tiga"}
            ]
        });
        var rpjm = $('#rpjm');
        var btnTambahSubBidang = rpjm.find('button#btn-tambah-sub-bidang');
        var btnTambahKegiatan = rpjm.find('button#btn-tambah-kegiatan');
        var btnTambahSubKegiatan = rpjm.find('button#btn-tambah-sub-kegiatan');

        var modalTambahSubBidang = $('#modal-tambah-sub-bidang');
        var modalUbahSubBidang = $('#modal-ubah-sub-bidang');

        var modalTambahKegiatan = $('#modal-tambah-kegiatan');
        var modalUbahKegiatan = $('#modal-ubah-kegiatan');

        var modalTambahSubKegiatan = $('#modal-tambah-sub-kegiatan');
        var modalUbahSubKegiatan = $('#modal-ubah-sub-kegiatan');

        var formTambahSubBidang = modalTambahSubBidang.find('form#form-tambah-sub-bidang');
        var formUbahSubBidang = modalUbahSubBidang.find('form#form-ubah-sub-bidang');

        var formTambahKegiatan = modalTambahKegiatan.find('form#form-tambah-kegiatan');
        var formUbahKegiatan = modalUbahKegiatan.find('form#form-ubah-kegiatan');

        var formTambahSubKegiatan = modalTambahSubKegiatan.find('form#form-tambah-sub-kegiatan');
        var formUbahSubKegiatan = modalUbahSubKegiatan.find('form#form-ubah-sub-kegiatan');

        var modalTambahSubBidangTabel = $("#modal-tambah-sub-bidang-tabel");
        var modalTambahKegiatanTabel = $("#modal-tambah-kegiatan-tabel");
        var modalTambahSubKegiatanTabel = $("#modal-tambah-sub-kegiatan-tabel");


        $(function(){

            $('input[name=jumlah]').inputmask({alias: "rupiah"});

            {{-- SUB BIDANG --}}
            btnTambahSubBidang.on('click', function(){
                modalTambahSubBidang.modal("show");
            });
            formTambahSubBidang.submit(function(e){
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "POST",
                    url         : "{{ route('kegiatan.tambah', ['jenis'=>'sub-bidang']) }}",
                    dataType    : 'json',
                    data        : formTambahSubBidang.serialize()
                }).done(function(){
                    tabel.ajax.reload();
                });
                e.preventDefault();
            });

            {{-- KEGIATAN --}}
            btnTambahKegiatan.on('click', function(){
                modalTambahKegiatan.modal('show');
            });
            formTambahKegiatan.submit(function(e){
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "POST",
                    url         : "{{ route('kegiatan.tambah', ['jenis'=>'kegiatan']) }}",
                    dataType    : 'json',
                    data        : formTambahKegiatan.serialize()
                }).done(function(){
                    tabel.ajax.reload();
                });
                e.preventDefault();
            });

            {{-- SUB KEGIATAN --}}
            btnTambahSubKegiatan.on('click', function(){
                modalTambahSubKegiatan.modal("show");
            });
            formTambahSubKegiatan.submit(function(e){
                $('input[name=jumlah]').inputmask('remove');
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "POST",
                    url         : "{{ route('kegiatan.tambah', ['jenis'=>'sub-kegiatan']) }}",
                    dataType    : 'json',
                    data        : formTambahSubKegiatan.serialize()
                }).done(function(){
                    $('input[name=jumlah]').inputmask({alias:"rupiah"});
                    tabel.ajax.reload();
                }).fail(function(){
                    $('input[name=jumlah]').inputmask({alias:"rupiah"});
                });
                e.preventDefault();
            });

            modalTambahSubBidang.on('hidden.bs.modal', function(){
                formTambahSubBidang.find('.selectpicker').val("");
                formTambahSubBidang.find('.selectpicker').selectpicker("refresh");
                formTambahSubBidang[0].reset();
            });
            modalTambahKegiatan.on('hidden.bs.modal', function(){
                formTambahKegiatan.find('.selectpicker').val("");
                formTambahKegiatan.find('.selectpicker').selectpicker("refresh");
                formTambahKegiatan[0].reset();
            });
            modalTambahSubKegiatan.on('hidden.bs.modal', function(){
                formTambahSubKegiatan.find('.selectpicker').val("");
                formTambahSubKegiatan.find('.selectpicker').selectpicker("refresh");
                formTambahSubKegiatan[0].reset();
            });

            {{-- FORM UBAH--}}
            formUbahSubBidang.submit(function(e){
                var id = formUbahSubBidang.find('input[name="id"]').val();
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "PUT",
                    url         : "{{ route('kegiatan.ubah', ['jenis'=>'sub-bidang', 'id'=>'']) }}/"+id,
                    dataType    : 'json',
                    data        : formUbahSubBidang.serialize()
                }).done(function(){
                    tabel.ajax.reload();
                });
                e.preventDefault();
            });
            formUbahKegiatan.submit(function(e){
                var id = formUbahKegiatan.find('input[name="id"]').val();
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "PUT",
                    url         : "{{ route('kegiatan.ubah', ['jenis'=>'kegiatan', 'id'=>'']) }}/"+id,
                    dataType    : 'json',
                    data        : formUbahKegiatan.serialize()
                }).done(function(){
                    tabel.ajax.reload();
                });
                e.preventDefault();
            });
            formUbahSubKegiatan.submit(function(e){
                $('input[name=jumlah]').inputmask('remove');
                var id = formUbahSubKegiatan.find('input[name="id"]').val();
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "PUT",
                    url         : "{{ route('kegiatan.ubah', ['jenis'=>'sub-kegiatan', 'id'=>'']) }}/"+id,
                    dataType    : 'json',
                    data        : formUbahSubKegiatan.serialize()
                }).done(function(){
                    $('input[name=jumlah]').inputmask({alias:"rupiah"});
                    tabel.ajax.reload();
                }).fail(function(){
                    $('input[name=jumlah]').inputmask({alias:"rupiah"});
                });
                e.preventDefault();
            });

            {{-- TAMBAH IN TABLE --}}
            modalTambahSubBidangTabel.find('form').submit(function(e){

                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "POST",
                    url         : "{{ route('kegiatan.tambah', ['jenis'=>'sub-bidang']) }}",
                    dataType    : 'json',
                    data        : modalTambahSubBidangTabel.find('form').serialize()
                }).done(function(){
                    tabel.ajax.reload();
                });
                e.preventDefault();
            });
            modalTambahKegiatanTabel.find('form').submit(function(e){
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "POST",
                    url         : "{{ route('kegiatan.tambah', ['jenis'=>'kegiatan']) }}",
                    dataType    : 'json',
                    data        : modalTambahKegiatanTabel.find('form').serialize()
                }).done(function(){
                    tabel.ajax.reload();
                });
                e.preventDefault();
            });
            modalTambahSubKegiatanTabel.find('form').submit(function(e){
                $('input[name=jumlah]').inputmask('remove');
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type        : "POST",
                    url         : "{{ route('kegiatan.tambah', ['jenis'=>'sub-kegiatan']) }}",
                    dataType    : 'json',
                    data        : modalTambahSubKegiatanTabel.find('form').serialize()
                }).done(function(){
                    tabel.ajax.reload();
                }).fail(function(){
                    $('input[name=jumlah]').inputmask({alias:"rupiah"});
                });
                e.preventDefault();
            });
            modalTambahSubBidangTabel.on('hidden.bs.modal', function(){
                modalTambahSubBidangTabel.find('form')[0].reset();
            });
            modalTambahKegiatanTabel.on('hidden.bs.modal', function(){
                modalTambahKegiatanTabel.find('form')[0].reset();
            });
            modalTambahSubKegiatanTabel.on('hidden.bs.modal', function(){
                modalTambahSubKegiatanTabel.find('form').find('.selectpicker').val("").selectpicker('refresh');
                modalTambahSubKegiatanTabel.find('form')[0].reset();
            });

            $('#btn-export').click(function(){
                $.ajax({
                    context  : {
                        context : "form"
                    },
                    url      : "{{ route('rpjm.excel') }}",
                    type     : "GET",
                    dataType : "json",
                }).done(function(data){
                    console.log(data);
                    window.location = "{{ route('rpjm.excel') }}";
                });
            });

        });

        {{-- UBAH  --}}
        function ubah_subbidang(id){
            $.ajax({
                context     : {
                    context : "form"
                },
                type    : "GET",
                url     : "{{ route('kegiatan.cari', ['jenis'=>'sub-bidang', 'id'=>'']) }}/"+id,
                dataType: 'json',
                global : false,
            }).done(function(data){
                formUbahSubBidang.find("select[name='bidang']").val(data[0].data[0].bidang_id);
                formUbahSubBidang.find("input[name='sub_bidang']").val(data[0].data[0].jenis_kegiatan);
                formUbahSubBidang.find("input[name='id']").val(data[0].data[0].id);
                formUbahSubBidang.find("select[name='bidang']").selectpicker("refresh");
                modalUbahSubBidang.modal("show");
            });
        }
        function ubah_kegiatan(id){
            $.ajax({
                context     : {
                    context : "form"
                },
                type    : "GET",
                url     : "{{ route('kegiatan.cari', ['jenis'=>'kegiatan', 'id'=>'']) }}/"+id,
                contentType : "Application/json",
                dataType: 'json',
                global : false,
            }).done(function(data){
                formUbahKegiatan.find("select[name='sub_kegiatan']").val(data[0].data[0].sub_bidang);
                formUbahKegiatan.find("input[name='jenis_kegiatan']").val(data[0].data[0].jenis_kegiatan);
                formUbahKegiatan.find("input[name='id']").val(data[0].data[0].id);
                formUbahKegiatan.find(".selectpicker").selectpicker("refresh");
                modalUbahKegiatan.modal("show");
            });
        }
        function ubah_subkegiatan(id){
            $.ajax({
                context     : {
                    context : "form"
                },
                type    : "GET",
                url     : "{{ route('kegiatan.cari', ['jenis'=>'sub-kegiatan', 'id'=>'']) }}/"+id,
                contentType : "Application/json",
                dataType: 'json',
                global : false,
            }).done(function(data){
                console.log(data[0].data[0]);
                formUbahSubKegiatan.find("select[name='sub_kegiatan']").val(data[0].data[0].sub_bidang);
                formUbahSubKegiatan.find("input[name='kegiatan']").val(data[0].data[0].jenis_kegiatan);
                formUbahSubKegiatan.find("input[name='lokasi']").val(data[0].data[0].lokasi);
                formUbahSubKegiatan.find("input[name='volume']").val(data[0].data[0].volume);
                formUbahSubKegiatan.find("input[name='manfaat']").val(data[0].data[0].manfaat);
                formUbahSubKegiatan.find("input[name='jumlah']").val(data[0].data[0].jumlah);
                formUbahSubKegiatan.find("select[name='sumber_dana']").val(data[0].data[0].sumber_dana);
                formUbahSubKegiatan.find("select[name='pola_pelaksanaan']").val(data[0].data[0].pola_pelaksanaan);
                formUbahSubKegiatan.find("input[name='id']").val(data[0].data[0].id);

                formUbahSubKegiatan.find("select[name='sub_bidang']").selectpicker("refresh");
                formUbahSubKegiatan.find("select[name='sumber_dana']").selectpicker("refresh");
                formUbahSubKegiatan.find(".selectpicker").selectpicker("refresh");
                modalUbahSubKegiatan.modal("show");
            });
        }
        {{-- HAPUS KEGIATAN --}}
        function hapus_kegiatan(id){
            if(confirm('Apakah Yakin Akan Dihapus ?')){
                $.ajax({
                    context     : {
                        context : "form"
                    },
                    type    : "POST",
                    url     : "{{ route('kegiatan.hapus', '') }}/"+id,
                    dataType: 'json',
                }).done(function(){
                    tabel.ajax.reload();
                });
            }
            return false;
        }

        {{-- TAMBAH TABEL --}}
        function tambah_subbidang(id, uraian){
            modalTambahSubBidangTabel.find(".modal-title").text(uraian);
            modalTambahSubBidangTabel.find("input[name=bidang]").val(id);
            modalTambahSubBidangTabel.modal("show");
        }
        function tambah_kegiatan(id, uraian){
            modalTambahKegiatanTabel.find(".modal-title").text(uraian);
            modalTambahKegiatanTabel.find("input[name=sub_kegiatan]").val(id);
            modalTambahKegiatanTabel.modal("show");
        }
        function tambah_subkegiatan(id, uraian){
            modalTambahSubKegiatanTabel.find('.modal-title').text(uraian);
            modalTambahSubKegiatanTabel.find('input[name=sub_kegiatan]').val(id);
            modalTambahSubKegiatanTabel.modal("show");
        }
    </script>
    @endpush
{{---------------------------------------------------------------------------------------------------------------------}}
@endif