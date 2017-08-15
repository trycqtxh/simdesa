@extends('layouts.template')

@section('title', 'Buku Tanah Kas Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="tanah_kas">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-tanah-kas-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-tanah-kas-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-tanah-kas-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-tanah-kas-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
	<div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-tanah_kas">
                <thead>
                    <tr>
                        <th rowspan="3">NOMOR URUT</th>
                        <th rowspan="3">ASAL TANAH KAS DESA</th>
                        <th rowspan="3">NOMOR SERFIKAT BUKU LETTER C / PERSIL</th>
                        <th rowspan="3">LUAS (M)</th>
                        <th rowspan="3">KELAS</th>
                        <th colspan="6">PEROLEHAN TKD</th>
                        <th colspan="5">JENIS TKD</th>
                        <th colspan="2">PATOK TANDA BATAS</th>
                        <th colspan="2">PAPAN NAMA</th>
                        <th>LOKASI</th>
                        <th>PERUNTUKAN</th>
                        <th>MUTASI</th>
                        <th>KET</th>
                    </tr>
                    <tr>
                        <th rowspan="2">ASLI  MILIK DESA</th>
                        <th colspan="3">BANTUAN</th>
                        <th rowspan="2">LAIN- LAIN</th>
                        <th rowspan="2">TGL PEROLEHAN</th>
                        <th rowspan="2">SAWAH</th>
                        <th rowspan="2">TEGAL</th>
                        <th rowspan="2">KEBUN</th>
                        <th rowspan="2">TAMBAK/ KOLAM</th>
                        <th rowspan="2">TANAH KERING/ DARAT</th>
                        <th rowspan="2">ADA</th>
                        <th rowspan="2">TIDAK ADA</th>
                        <th rowspan="2">ADA</th>
                        <th rowspan="2">TIDAK ADA</th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>PEMERINTAH</th>
                        <th>PROV</th>
                        <th>KAB / KOTA</th>
                    </tr>
                    <tr>
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
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>  
                        <td>#</td>  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@include('modal.umum.tanah_kas')
@endsection
@push('js')
<script type="text/javascript">
    var tabeltanah_kas = $('table#tabel-tanah_kas').DataTable({
        ordering     : false,
        paging       : false,
        searching    : false,
        lengthChange: false,
        scrollX      : true,
//        scrollY      : "400px",
//        fixedHeader  : true,
//        scrollCollapse: true,
//        scroller:       true,
//        stateSave:      true,
//        fixedColumns  : {
//            leftColumns : 2,
//        },
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            url     : "{{ route('tanah-kas.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
         columns : [
            { data : 'id'},
            { data : 'asal_tanah'},
            { data : 'no_sertifikat'},
            { data : 'luas_kas'},
            { data : 'kelas'},
            { data : 'milik_desa'},
            { data : 'pemerintah'},
            { data : 'provinsi'},
            { data : 'kabkota'},
            { data : 'lain_lain'},
            { data : 'tgl_perolehan'},
            { data : 'sawah'},
            { data : 'tegal'},
            { data : 'kebun'},
            { data : 'tambak'},
            { data : 'tanah_kering'},
            { data : 'patok_ada'},
            { data : 'patok_tidak'},
            { data : 'papan_ada'},
            { data : 'papan_tidak'},
            { data : 'lokasi'},
            { data : 'peruntukan'},
            { data : 'mutasi'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('input[name=tanggal_perolehan]').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        })

        $('#modal-tambah').find('form').submit(function(e){
            $.ajax({
                context: {
                    context : "form",
                },
                url    : "{{ route('tanah-kas.tambah') }}",
                type   : "POST",
                dataType : "json",
                data   : $(this).serialize()
            }).done(function(){
                tabeltanah_kas.ajax.reload();
            });
            e.preventDefault();
        });
        tabeltanah_kas.on('select', function(){
            $('#btn-ubah').attr('disabled', false);
            $('#btn-hapus').attr('disabled', false);
        }).on('deselect', function(){
            $('#btn-ubah').prop('disabled', true);
            $('#btn-hapus').prop('disabled', true);
        });
        $('#btn-ubah').click(function(){
            var row = tabeltanah_kas.rows('.selected').indexes();
            var tanah = tabeltanah_kas.rows(row).data().toArray()[0];
            $('#modal-ubah').find('input[name=id]').val(tanah['id']);
            $('#modal-ubah').find('input[name=asal_tanah]').val(tanah['asal_tanah']);
            $('#modal-ubah').find('input[name=nomor_sertifikat]').val(tanah['no_sertifikat']);
            $('#modal-ubah').find('input[name=kelas]').val(tanah['kelas']);
            $('#modal-ubah').find('input[name=luas]').val(tanah['luas_kas']);
            $('#modal-ubah').find('select[name=perolehan_tkd]').val(tanah['perolehan_tkd']);
            $('#modal-ubah').find('input[name=luas_peroleh_tkd]').val(tanah['luas_perolehan_tkd']);
            $('#modal-ubah').find('input[name=tanggal_perolehan]').val(tanah['tanggal_perolehan']);
            $('#modal-ubah').find('select[name=jenis_tkd]').val(tanah['jenis_tkd']);
            $('#modal-ubah').find('input[name=luas_jenis_tkd]').val(tanah['luas_jenis_tkd']);
            $('#modal-ubah').find('input[name=luas_patok_ada]').val(tanah['patok_ada']);
            $('#modal-ubah').find('input[name=luas_patok_tidak_ada]').val(tanah['patok_tidak']);
            $('#modal-ubah').find('input[name=luas_papan_nama_ada]').val(tanah['papan_ada']);
            $('#modal-ubah').find('input[name=luas_papan_nama_tidak_ada]').val(tanah['papan_tidak']);
            $('#modal-ubah').find('input[name=lokasi]').val(tanah['lokasi']);
            $('#modal-ubah').find('input[name=peruntukan]').val(tanah['peruntukan']);
            $('#modal-ubah').find('input[name=mutasi]').val(tanah['mutasi']);
            $('#modal-ubah').find('textarea[name=keterangan]').val(tanah['keterangan']);
            $('#modal-ubah').modal("show");
        });
        $('#modal-ubah').find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context: {
                    context : "form",
                },
                url    : "{{ route('tanah-kas.ubah', '') }}/"+id,
                type   : "PUT",
                dataType : "json",
                data   : $(this).serialize()
            }).done(function(){
                tabeltanah_kas.ajax.reload();
            });
            e.preventDefault();
        });
        $('#btn-hapus').click(function(){
            var row = tabeltanah_kas.rows('.selected').indexes();
            var id = tabeltanah_kas.rows(row).data().toArray()[0]['id'];
            if(confirm("apakah Yakin Akan Dihapus ?")){
                $.ajax({
                    context: {
                        context : "form",
                    },
                    url    : "{{ route('tanah-kas.hapus', '') }}/"+id,
                    type   : "POST",
                    dataType : "json",
                }).done(function(){
                    tabeltanah_kas.ajax.reload();
                });
            }
        });
        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('tanah-kas-desa.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('tanah-kas-desa.excel') }}";
            });
        });
    })


</script>
@endpush