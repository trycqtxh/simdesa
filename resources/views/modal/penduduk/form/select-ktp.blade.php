<table id="tabel-select-ktp">
    <thead>
    <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Pilih</th>
    </tr>
    </thead>
</table>

<script>
    $('#tabel-select-ktp').DataTable({
        ajax :{
            url : "{{ route('penduduk.ktp.select-ktp') }}"
        },
        columns:[
            {"data": 'nik'},
            {"data": 'nama'},
            {"data": 'jenis_kelamin'},
            {"data": 'act'},
        ],
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
    });
</script>