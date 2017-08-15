<table id="tabel-select-ktp">
    <thead>
    <tr>
        <th>Nomor KK</th>
        <th>Kepala Keluarga</th>
        <th>Pilih</th>
    </tr>
    </thead>
</table>

<script>
    $('#tabel-select-ktp').DataTable({
        ajax :{
            url : "{{ route('induk.cari.select.kk') }}"
        },
        columns:[
            {"data": 'nomor_kk'},
            {"data": 'kepala_keluarga'},
            {"data": 'act'},
        ],
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
    });
</script>