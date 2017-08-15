@extends('layouts.template')

@section('title', 'Buku Tanah di Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="tanah_desa">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-tanah-desa-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-tanah-desa-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-tanah-desa-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-tanah-desa-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
	<div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-tanah_desa">
                <thead>
                    <tr>
                        <th rowspan="3">NOMOR URUT</th>
                        <th rowspan="3">NAMA PER- ORANGAN / BADAN HUKUM</th>
                        <th rowspan="3">JML (M2)</th>
                        <th colspan="8">STATUS HAK TANAH (M2)</th>
                        <th colspan="13">PENGGUNAAN TANAH (M2)</th>
                        <th></th>
                        <th rowspan="3">Keterangan</th>
                    </tr>
                    <tr>
                        <th colspan="5">SUDAH BERSERTIFIKAT</th>
                        <th colspan="3">BELUM BERSERTIFIKAT</th>
                        <th colspan="5">NON PERTANIAN</th>
                        <th colspan="8">PERTANIAN</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>HM</th>
                        <th>HGB</th>
                        <th>HP</th>
                        <th>HGU</th>
                        <th>HPL</th>
                        <th>MA</th>
                        <th>VI</th>
                        <th>TN</th>
                        <th>PERUMAHAN</th>
                        <th>PERDAGANGAN  DAN JASA</th>
                        <th>PERKANTORAN</th>
                        <th>INDUSTRI</th>
                        <th>FASILITAS UMUM</th>
                        <th>SAWAH</th>
                        <th>TEGALAN</th>
                        <th>PERKEBUNAN</th>
                        <th>PETERNAKAN / PERIKANAN</th>
                        <th>HUTAN BELUKAR</th>
                        <th>HUTAN  LEBAT / LINDUNG</th>
                        <th>MUTASI TANAH  DI  DESA</th>
                        <th>TANAH KOSONG</th>
                        <th>LAIN- LAIN</th>
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
                        <th>25</th>
                        <th>26</th>
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
                        <td>#</td>    
                        <td>#</td>    
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@include('modal.umum.tanah_desa')
@endsection
@push('js')
<script type="text/javascript">
    var tabtanah_desa = $('div#tanah_desa');
    var tabeltanah_desa = $('table#tabel-tanah_desa').DataTable({
        ordering     : false,
        paging       : false,
        searching    : false,
        lengthChange: false,
        scrollX      : true,
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
            url     : "{{ route('tanah-desa.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
         columns : [
            { data : 'id'},
            { data : 'nama'},
            { data : 'jumlah'},
            { data : 'hm'},
            { data : 'hgb'},
            { data : 'hp'},
            { data : 'hgu'},
            { data : 'hpl'},
            { data : 'ma'},
            { data : 'vi'},
            { data : 'tn'},
            { data : 'non_perumahan'},
            { data : 'non_perdagangan'},
            { data : 'non_perkantoran'},
            { data : 'non_industri'},
            { data : 'non_fasilitas'},
            { data : 'sawah'},
            { data : 'tegalan'},
            { data : 'perkebunan'},
            { data : 'peternakan_perikanan'},
            { data : 'hutan_belukar'},
            { data : 'hutan_lebat'},
            { data : 'mutasi'},
            { data : 'tanah_kosong'},
            { data : 'lain_lain'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        });
        $('#modal-tambah').find('form').submit(function(e){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('tanah-desa.tambah') }}",
                type     : "POST",
                dataType : "json",
                data     : $(this).serialize()
            }).done(function(){
                tabeltanah_desa.ajax.reload();
            });
            e.preventDefault();
        });
        tabeltanah_desa.on('select', function(){
            $('#btn-hapus').attr('disabled', false);
            $('#btn-ubah').attr('disabled', false);
        }).on('deselect', function(){
            $('#btn-hapus').prop('disabled', true);
            $('#btn-ubah').prop('disabled', true);
        });
        $('#btn-ubah').on('click',function(e){
            var row = tabeltanah_desa.rows('.selected').indexes();
            var id = tabeltanah_desa.rows(row).data().toArray()[0]['id'];
            var nama = tabeltanah_desa.rows(row).data().toArray()[0]['nama'];
            var jumlah = tabeltanah_desa.rows(row).data().toArray()[0]['jumlah'];
            var status_tanah = tabeltanah_desa.rows(row).data().toArray()[0]['status_tanah'];
            var luas_status_tanah = tabeltanah_desa.rows(row).data().toArray()[0]['luas_status_tanah'];
            var penggunaan_tanah = tabeltanah_desa.rows(row).data().toArray()[0]['penggunaan_tanah'];
            var luas_penggunaan_tanah = tabeltanah_desa.rows(row).data().toArray()[0]['luas_penggunaan_tanah'];
            var keterangan = tabeltanah_desa.rows(row).data().toArray()[0]['keterangan'];
            $('#modal-ubah').find('input[name=id]').val(id);
            $('#modal-ubah').find('input[name=nama]').val(nama);
            $('#modal-ubah').find('input[name=jumlah]').val(jumlah);
            $('#modal-ubah').find('select[name=status_tanah]').val(status_tanah);
            $('#modal-ubah').find('input[name=luas_status_tanah]').val(luas_status_tanah);
            $('#modal-ubah').find('select[name=penggunaan_tanah]').val(penggunaan_tanah);
            $('#modal-ubah').find('input[name=luas_penggunaan_tanah]').val(luas_penggunaan_tanah);
            $('#modal-ubah').find('textarea[name=keterangan]').val(keterangan);
            $('.selectpicker').selectpicker('refresh')
            $('#modal-ubah').modal('show');
        });
        $('#modal-ubah').find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('tanah-desa.ubah', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : $(this).serialize()
            }).done(function(){
                tabeltanah_desa.ajax.reload();
            });
            e.preventDefault();
        });
        $('#btn-hapus').click(function(){
            var row = tabeltanah_desa.rows('.selected').indexes();
            var id = tabeltanah_desa.rows(row).data().toArray()[0]['id'];
            var nama = tabeltanah_desa.rows(row).data().toArray()[0]['nama'];
            if(confirm("Apakah Yakin "+nama+" Akan Dihapus ?")){
                $.ajax({
                    context  : {
                        context : "form"
                    },
                    url      : "{{ route('tanah-desa.hapus', '') }}/"+id,
                    type     : "POST",
                    dataType : "json",
                }).done(function(){
                    tabeltanah_desa.ajax.reload();
                });

            }
        });
        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('tanah-desa.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('tanah-desa.excel') }}";
            });
        });
    });
</script>
@endpush