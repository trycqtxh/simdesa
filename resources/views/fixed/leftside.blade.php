    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ url('img/avatar/users.png') }}" class="img-circle" style="background-color: #ffffff" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ (Auth::user()->induk) ? Auth::user()->induk->penduduk->nama: Auth()->user()->nip }}</p>
                    <a>{{ (Auth::user()->jabatan) ? Auth::user()->jabatan->nama: 'Admin' }}</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->

            <ul class="sidebar-menu">
                @permission('*-master')
                <li class="treeview">
                    <a href="#"><i class="fa fa-gears"></i> <span> Data Induk</span></a>
                    <ul class="treeview-menu">
                        @permission('*-rw-*')
                        <li><a href="{{ route('rw.index') }}"><i class="fa fa-address-book"></i> Data RW</a></li>
                        @endpermission
                        @permission('*-rt-*')
                        <li><a href="{{ route('rt.index') }}"><i class="fa fa-address-book-o"></i> Data RT</a></li>
                        @endpermission
                        @permission('*-keluarga-*')
                        <li><a href="{{ route('keluarga.index') }}"><i class="fa fa-font-awesome"></i> Kedudukan Keluarga</a></li>
                        @endpermission
                        @permission('*-jabatan-*')
                        <li><a href="{{ route('jabatan.index') }}"><i class="fa fa-id-badge"></i> Jabatan</a></li>
                        @endpermission
                        @permission('*-pekerjaan-*')
                        <li><a href="{{ route('pekerjaan.index') }}"><i class="fa fa-briefcase"></i> Pekerjaan</a></li>
                        @endpermission
                        @permission('*-akses-*')
                        <li><a href="{{ route('hak-akses') }}"><i class="fa fa-gear"></i> Hak Akses</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission('*-penduduk')
                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span> Data Penduduk</span></a>
                    <ul class="treeview-menu">
                        @permission('*-induk-*')
                        <li><a href="{{ route('induk.index') }}"><i class="fa fa-users"></i> Penduduk induk</a></li>
                        @endpermission
                        @permission('*-mutasi-*')
                        <li><a href="{{ route('mutasi.index') }}"><i class="fa fa-users"></i> Penduduk Mutasi</a></li>
                        @endpermission
                        @permission('*-sementara-*')
                        <li><a href="{{ route('sementara.index') }}"><i class="fa fa-users"></i> Penduduk Sementara</a></li>
                        @endpermission
                        @permission('*-rekapitulasi-penduduk')
                        <li><a href="{{ route('penduduk.rekapitulasi') }}"><i class="fa fa-users"></i> Rekapitulasi</a></li>
                        @endpermission
                        @permission('*-kk-*')
                        <li><a href="{{ route('penduduk.anggota-keluarga') }}"><i class="fa fa-users"></i> Kartu Keluarga </a></li>
                        @endpermission
                        @permission('*-ktp-*')
                        <li><a href="{{ route('penduduk.ktp') }}"><i class="fa fa-address-card"></i> KTP </a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                <li class="treeview">
                    <a href="#"><i class="fa fa-bar-chart"></i> <span> Grafik Penduduk</span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('grafik.pendidikan') }}"><i class="fa fa-line-chart"></i> Pendidikan</a></li>
                        <li><a href="{{ route('grafik.agama') }}"><i class="fa fa-pie-chart"></i> Agama</a></li>
                        <li><a href="{{ route('grafik.pekerjaan') }}"><i class="fa fa-bar-chart-o"></i> Pekerjaan</a></li>
                        <li><a href="{{ route('grafik.kelompok-umur') }}"><i class="fa  fa-pie-chart"></i> Kelompok Umur</a></li>
                        <li><a href="{{ route('grafik.dusun') }}"><i class="fa fa-line-chart"></i> RW</a></li>
                        <li><a href="{{ route('grafik.status-perkawinan') }}"><i class="fa  fa-pie-chart"></i> Status Perkawinan</a></li>
                        <li><a href="{{ route('grafik.kewarganegaraan') }}"><i class="fa fa-bar-chart"></i> Kewarganegaraan</a></li>
                        <li><a href="{{ route('grafik.status-keluarga') }}"><i class="fa  fa-pie-chart"></i> Status Keluarga</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="glyphicon glyphicon-pushpin"></i> <span> Kelompok Penduduk</span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('kelompok.balita') }}"><i class="fa fa-child"></i> Usia Balita</a></li>
                        <li><a href="{{ route('kelompok.belajar') }}"><i class="fa fa-graduation-cap"></i> Wajib Belajar</a></li>
                        <li><a href="{{ route('kelompok.pemilu') }}"><i class="fa fa-odnoklassniki"></i> Pemilih Pemilu</a></li>
                    </ul>
                </li>

                @permission('*-rpjm-*')
                <li class="treeview">
                    <a href="#"><i class="fa fa-book"></i> <span> RPJM & RKP</span></a>
                    <ul class="treeview-menu">
                        @php( $rpjm = App\Entities\RPJM::all()->last() )
                        @php($selisih = $rpjm['tahun_akhir'] - $rpjm['tahun_awal'])
                        @permission('*-rpjm-perencanaan')
                        <li><a href="{{ route('rpjm.index') }}"><i class="fa fa-file-archive-o"></i> RPJM</a></li>
                        @endpermission
                        @permission('*-rkp-perencanaan')
                        <li><a href="#"><i class="fa fa-file-o"></i> RKP</a>
                            <ul class="treeview-menu">
                                @if(Carbon\Carbon::now()->year < $rpjm['tahun_akhir'])
                                    @php($j = 1)
                                    @for($i=0; $i<$selisih; $i++)
                                        <li><a href="{{ route('rkp.index', $j) }}"><i class="fa fa-file"></i> RKP-{{ Carbon\Carbon::createFromDate($rpjm['tahun_awal'])->addYears($i)->year }}</a></li>
                                    @php($j++)
                                    @endfor
                                @endif
                            </ul>
                        </li>
                        @endpermission
                        @permission('*-rkk-perencanaan')
                        <li><a href="#"><i class="fa fa-file-o"></i> RKK</a>
                            <ul class="treeview-menu">
                                @if(Carbon\Carbon::now()->year < $rpjm['tahun_akhir'])
                                    @php($j = 1)
                                    @for($i=0; $i<$selisih; $i++)
                                        <li><a href="{{ route('rkk.index', $j) }}"><i class="fa fa-file"></i> RKK-{{ Carbon\Carbon::createFromDate($rpjm['tahun_awal'])->addYears($i)->year }}</a></li>
                                        @php($j++)
                                    @endfor
                                @endif
                            </ul>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission('*-perencanaan')
                <li class="treeview">
                    <a href="#"><i class="fa fa-bookmark-o"></i> <span>Perencanaan APBD</span></a>
                    <ul class="treeview-menu">
                        @permission('*-apbd-perencanaan')
                        <li><a href="{{ route('apbd.perencanaan') }}"><i class="fa fa-money"></i> <span> APBD</span></a></li>
                        @endpermission
                        @permission('*-pendapatan-perencanaan')
                        <li><a href="{{ route('pendapatan.index') }}"><i class="fa fa-money"></i> <span>Pendapatan</span></a></li>
                        @endpermission
                        @permission('*-belanja-perencanaan')
                        <li><a href="{{ route('belanja.index') }}"><i class="fa fa-money"></i>Belanja</a></li>
                        @endpermission
                        {{--@permission('*-rpjm-perencanaan')--}}
                        {{--<li class="treeview">--}}
                            {{--<a href="#"><i class="fa fa-money"></i> <span>Belanja</span></a>--}}
                            {{--<ul class="treeview-menu">--}}
                                {{--<li><a href="{{ route('belanja.index') }}"><i class="fa fa-money"></i>Belanja</a></li>--}}
                                {{--<li><a href="{{ route('belanja.anggaran') }}"><i class="fa fa-money"></i>Rencana Anggaran</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--@endpermission--}}
                        @permission('*-pembiayaan-perencanaan')
                        <li><a href="{{ route('pembiayaan.index') }}"><i class="fa fa-money"></i> <span>Pembiayaan</span></a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission('*-pelaksanaan')
                <li class="treeview">
                    <a href="#"><i class="fa fa-bookmark"></i> <span>Pelaksanaan</span></a>
                    <ul class="treeview-menu">
                        @permission('*-apbd-pelaksanaan')
                        <li><a href="{{ route('pelaksanaan.apbd.index') }}"><i class="fa fa-money"></i> <span> APBD</span></a></li>
                        @endpermission
                        @permission('*-pendapatan-pelaksanaan')
                        <li><a href="{{ route('pelaksanaan.apbd.pendapatan.index') }}"><i class="fa fa-money"></i> <span>Pendapatan</span></a></li>
                        @endpermission
                        @permission('*-belanja-pelaksanaan')
                        <li><a href="{{ route('pelaksanaan.apbd.belanja.index') }}"><i class="fa fa-money"></i> <span>Belanja</span></a></li>
                        @endpermission
                        @permission('*-pembiayaan-pelaksanaan')
                        <li><a href="{{ route('pelaksanaan.apbd.pembiayaan.index') }}"><i class="fa fa-money"></i> <span>Pembiayaan</span></a></li>
                        @endpermission
                        {{--<li><a href="{{ route('pelaksanaan.apbd.pembiayaan.index') }}"><i class="fa fa-link"></i> <span>Buku Kas P. Kegiatan</span></a></li>--}}
                        {{--<li><a href="{{ route('pelaksanaan.apbd.pembiayaan.index') }}"><i class="fa fa-link"></i> <span>Buku Kas Umum</span></a></li>--}}
                        {{--<li><a href="{{ route('pelaksanaan.apbd.pembiayaan.index') }}"><i class="fa fa-link"></i> <span>Buku Kas P. Pajak</span></a></li>--}}
                        {{--<li><a href="{{ route('pelaksanaan.apbd.pembiayaan.index') }}"><i class="fa fa-link"></i> <span>Buku Bank Desa</span></a></li>--}}
                    </ul>
                </li>
                @endpermission

                @permission('*-umum')
                <li class="treeview">
                    <a href="#"><i class="fa fa-bar-chart"></i> <span>UMUM</span></a>
                    <ul class="treeview-menu">
                        @permission('*-peraturan-umum')
                        <li><a href="{{ route('peraturan-desa.index') }}"><i class="fa fa-line-chart"></i> Peraturan Desa</a></li>
                        @endpermission
                        @permission('*-keputusan-umum')
                        <li><a href="{{ route('keputusan-kades.index') }}"><i class="fa fa-pie-chart"></i> Keputusan Kades</a></li>
                        @endpermission
                        @permission('*-inventaris-umum')
                        <li><a href="{{ route('inventaris-kekayaan.index') }}"><i class="fa fa-bar-chart-o"></i> Inventaris dan Kekayaan</a></li>
                        @endpermission
                        @permission('*-aparat-umum')
                        <li><a href="{{ route('aparat-pemerintah.index') }}"><i class="fa  fa-pie-chart"></i> Aparat Desa</a></li>
                        @endpermission
                        @permission('*-tanah-kas-umum')
                        <li><a href="{{ route('tanah-kas.index') }}"><i class="fa  fa-pie-chart"></i> Tanah dan Kas Desa</a></li>
                        @endpermission
                        @permission('*-tanah-desa-umum')
                        <li><a href="{{ route('tanah-desa.index') }}"><i class="fa fa-bar-chart"></i> Buku Tanah di Desa</a></li>
                        @endpermission
                        @permission('*-agenda-umum')
                        <li><a href="{{ route('adm-surat.index.agenda') }}"><i class="fa  fa-pie-chart"></i> Buku Agenda</a></li>
                        @endpermission
                        @permission('*-ekspedisi-umum')
                        <li><a href="{{ route('adm-surat.index.ekspedisi') }}"><i class="fa  fa-pie-chart"></i> Ekspedisi</a></li>
                        @endpermission
                        @permission('*-lembar-berita-umum')
                        <li><a href="{{ route('lembar-berita.index') }}"><i class="fa  fa-pie-chart"></i> Lembaran & Berita</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                {{--@permission('*-pembangunan')--}}
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class="glyphicon glyphicon-pushpin"></i> <span> Pembangunan</span></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--@permission('*-rencana-kerja-pembangunan')--}}
                        {{--<li><a href="{{ route('pembangunan.rencana-kerja') }}"><i class="fa fa-child"></i> Rencana Kerja</a></li>--}}
                        {{--@endpermission--}}
                        {{--@permission('*-kegiatan-kerja-pembangunan')--}}
                        {{--<li><a href="{{ route('pembangunan.kegiatan-pembangunan') }}"><i class="fa fa-graduation-cap"></i> Kegiatan Pembangunan</a></li>--}}
                        {{--@endpermission--}}
                        {{--@permission('*-inventaris-pembangunan')--}}
                        {{--<li><a href="{{ route('pembangunan.inventaris') }}"><i class="fa fa-odnoklassniki"></i> Inventaris </a></li>--}}
                        {{--@endpermission--}}
                        {{--@permission('*-pemberdayaan-masyarakat-pembangunan')--}}
                        {{--<li><a href="{{ route('pembangunan.pemberdayaan-masyarakat') }}"><i class="fa fa-odnoklassniki"></i> Pemberdaaan Masyarakat </a></li>--}}
                        {{--@endpermission--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--@endpermission--}}
                @permission('*-surat-*')
                <li>
                    <a href="{{ route('surat.index') }}"><i class="glyphicon glyphicon-envelope"></i> <span> Surat</span></a>
                </li>
                @endpermission
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>