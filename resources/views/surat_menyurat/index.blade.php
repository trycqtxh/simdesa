@extends('layouts.template')

@section('title', 'Pembuatan Surat')

@section('content-main')
    <div class="box box-default" id="surat">
        <div class="box-body">

            <div class="form-inline">
                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat </label>
                    <select name="jenis_surat" id="jenis_surat" class="form-control">
                        <option value="">Pilih Jenis Surat</option>
                        <option value="surat-keterangan-kelahiran">Surat Keterangan Kelahiran</option>
                        <option value="surat-keterangan-kematian">Surat Keterangan Kematian</option>
                        <option value="surat-keterangan-belum-pernah-kawin">Surat Keterangan Belum Pernah Kawin</option>
                        <option value="surat-keterangan-cerai">Surat Keterangan Cerai</option>
                        <option value="surat-keterangan-kelakuan-baik">Surat Keterangan Kelakuan Baik</option>
                        <option value="surat-keterangan-tidak-mampu">Surat Keterangan Tidak Mampu</option>
                        <option value="surat-keterangan-kehilangan">Surat Keterangan Kehilangan</option>
                        <option value="surat-keterangan-usaha">Surat Keterangan Usaha</option>
                        <option value="surat-keterangan-domisili">Surat Keterangan Domisili</option>
                        <option value="surat-keterangan-adon-nikah">Surat Keterangan Adon Nikah</option>
                        <option value="surat-keterangan-izin-rame-rame">Surat Keterangan Izin Rame-Rame</option>
                        <option value="surat-keterangan-tanah">Surat Keterangan Tanah</option>
                        <option value="surat-keterangan-tanah">Surat Keterangan Tanah</option>
                        <option value="surat-keterangan-waris">Surat Keterangan Waris</option>
                        <option value="surat-keterangan-pindah">Surat Keterangan Pindah</option>
                    </select>
                </div>
                <button class="btn btn-default" id="btn-buat">Buat</button>
            </div>

        </div>
    </div>
    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered table-striped" id="tabel-surat-menyurat">
                <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Tanggal Dikeluarkan</th>
                    <th>Jenis Surat</th>
                    <th>Pemohon</th>
                    <th>Unduh</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('surat_menyurat.modal.index')
@endsection

@push('js')
<script type="text/javascript">
    var suratMenyurat = $('table#tabel-surat-menyurat').DataTable({
        ajax  : {
            url : "{{ url()->current() }}",
            dataSrc : "data.data"
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        columns : [
            {data: "nomor_surat"},
            {data: "tanggal_surat"},
            {data: "jenis_surat"},
            {data: "pemohon"},
            {data: "url"},
        ]
    });
    var $btnTambah = $('#surat').find('button#btn-buat');
    var $modalSurat = $('#modal-surat');
    $(function(){
        $btnTambah.click(function(){
            var jenis_surat = $('select[name=jenis_surat]').val();
            $.ajax({
                url     : "{{ route('surat.load', '') }}/"+jenis_surat,
            }).done(function(html){
                $modalSurat.find('.modal-title').text(jenis_surat);
                $modalSurat.find('#load-file-html').html(html);
                $modalSurat.modal("show");
            });
        });
    });
</script>
@endpush