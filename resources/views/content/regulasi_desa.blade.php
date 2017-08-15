@extends('layouts.template')

@section('title', 'Regulasi Desa')

@section('content-main')
    <div class="list-group">
        <p href="" class="list-group-item active">
            UNDANG -UNDANG
        </p>
        <a href="{{ url('regulasi-desa/uu-ri-no-6-th-2014-tentang-desa.pdf') }}" target="_blank" class="list-group-item">UU No Tahun 2014 Tentang Desa</a>
    </div>

    <div class="list-group">
        <p href="" class="list-group-item active">
            PERATURAN PRESIDEN
        </p>
        <a href="{{ url('regulasi-desa/perpres_no_11_2015.pdf') }}"  target="_blank" class="list-group-item">Perpres No 11 Tahun 2015 Tentang Kementerian Dalam Negeri </a>
        <a href="{{ url('regulasi-desa/perpres_no_12_2015.pdf') }}" target="_blank" class="list-group-item">Perpres No 12 Tahun 2015 Tentang Kementerian Desa Pembangunan Daerah Tertinggal dan Transmigrasi  </a>
    </div>

    <div class="list-group">
        <p href="" class="list-group-item active">
            PERATURAN PEMERINTAH (PP)
        </p>
        <a href="{{ url('regulasi-desa/pp_no_43_2014.pdf') }}" target="_blank" class="list-group-item">PP-No-43-Tahun-2014-Tentang-Peraturan-Pelaksanaan-Undang-Undang-Nomor-6-Tahun-2014-Tentang-Desa </a>
        <a href="{{ url('regulasi-desa/pp_no_60_2014.pdf') }}" target="_blank" class="list-group-item">PP-No-60-Tahun-2014-Tentang-Dana-Desa-yang-Bersumber-Dari-Anggaran-Pendapatan-dan-Belanja-Negara </a>
        <a href="{{ url('regulasi-desa/pp_no_22_2015.pdf') }}" target="_blank" class="list-group-item">PP-No-22-Tahun-2015-Tentang-Perubahan-Peraturan-Pemerintah-No-60-Tahun-2014 </a>
        <a href="{{ url('regulasi-desa/pp_no_47_2015.pdf') }}" target="_blank" class="list-group-item">PP-No-47-Tahun-2015-TENTANG-PERUBAHAN ATAS PERATURAN PEMERINTAH NOMOR 43 TAHUN 2014 </a>
    </div>
    <div class="list-group">
        <p href="" class="list-group-item active">
            PERATURAN MENTERI DALAM NEGRI
        </p>
        <a href="{{ url('regulasi-desa/permendagri_no_32_2006.pdf') }}" target="_blank" class="list-group-item">Permendagri-32-Tahun-2006-Tentang-pedoman-Administrasi-Desa </a>
        <a href="{{ url('regulasi-desa/permendagri_no_111_2014.pdf') }}" target="_blank" class="list-group-item">Permendagri-No-111-Tahun-2014-Tentang-Pedoman-Teknis-Peraturan-di-Desa </a>
        <a href="{{ url('regulasi-desa/permendagri_no_112_2014.pdf') }}" target="_blank" class="list-group-item">Permendagri-No-112-Tahun-2014-Tentang-Pemilihan-Kepala-Desa</a>
        <a href="{{ url('regulasi-desa/permendagri_no_113_2014.pdf') }}" target="_blank" class="list-group-item">Permendagri-No-113-Tahun-2014-Tentang-Pengelolaan-Keuangan-Desa </a>
        <a href="{{ url('regulasi-desa/permendagri_no_114_2014.pdf') }}" target="_blank" class="list-group-item">Permendagri-No-114-Tahun-2014-Tentang-Pedoman-Pembangunan-Desa  </a>
    </div>
    <div class="list-group">
        <p href="" class="list-group-item active">
            PERATURAN MENTERI KEUANGAN
        </p>
        <a href="{{ url('regulasi-desa/permenkeu_no_93_2015.pdf') }}" target="_blank" class="list-group-item">Permenkeu-No-93-Tahun-2015-Tentang-Tata-Cara-Pengalokasian-Penyaluran-Penggunaan-Pemenfaatan-Evaluasi-Dana-Desa</a>
        <a href="{{ url('regulasi-desa/permenkeu_no_241_2014.pdf') }}" target="_blank" class="list-group-item">Permenkeu-No-241-Tahun-2014-Tentang-Pelaksanaan-dan-Pertanggungjawaban-Transfer-ke-Daerah-dan-Dana-Desa</a>
    </div>
@endsection