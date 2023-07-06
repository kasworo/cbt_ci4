<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview <?php echo $menu == 'data master' ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo $menu == 'data master' ? 'active' : ''; ?>">
                <i class="fas fa-database nav-icon"></i>
                <p>Data Master <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/sekolah" class="nav-link <?php echo $submenu == 'satuan pendidikan' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Satuan Pendidikan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/gtk" class="nav-link <?php echo $submenu == 'guru dan staff' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Guru dan Staff</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/siswa" class="nav-link <?php echo $submenu == 'peserta didika' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Peserta Didik</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview <?php echo $menu == 'manajemen kbm' ? 'menu-open' : ''; ?>">
            <a href=" #" class="nav-link <?php echo $menu == 'manajemen kbm' ? 'active' : ''; ?>">
                <i class=" nav-icon fas fa-book-reader"></i>
                <p>Manajemen KBM<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/kurikulum" class="nav-link <?php echo $submenu == 'kurikulum' ? 'active' : ''; ?>">
                        <i class=" far fa-check-square nav-icon"></i>
                        <p>Kurikulum</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rombel" class="nav-link <?php echo $submenu == 'rombel' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Rombongan Belajar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/registrasi" class="nav-link <?php echo $submenu == 'registrasi' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Registrasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kkm" class="nav-link <?php echo $submenu == 'kkm' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Pengaturan KKM</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview <?php echo $menu == 'manajemen ujian' ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo $menu == 'manajemen ujian' ? 'active' : ''; ?>">
                <i class="fas fa-list nav-icon"></i>
                <p>Manajemen Ujian <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/ujian" class="nav-link <?php echo $submenu == 'ujian' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Data Ujian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/peserta" class="nav-link <?php echo $submenu == 'peserta' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Data Peserta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/banksoal" class="nav-link <?php echo $submenu == 'bank soal' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Data Bank Soal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/jadwal" class="nav-link <?php echo $submenu == 'jadwal' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Jadwal Ujian</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview <?php echo $menu == 'administrasi ujian' ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo $menu == 'administrasi ujian' ? 'active' : ''; ?>">
                <i class="far fa-calendar-alt nav-icon"></i>
                <p>Administrasi Ujian<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/administrasi/kartu" class="nav-link <?php echo $submenu == 'kartu' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Kartu Ujian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/administrasi/nomeja" class="nav-link <?php echo $submenu == 'nomeja' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Nomor Meja</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/administrasi/denah" class="nav-link <?php echo $submenu == 'denah' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Denah Peserta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/administrasi/absen" class="nav-link <?php echo $submenu == 'absen' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Daftar Hadir</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/administrasi/berita" class="nav-link <?php echo $submenu == 'berita' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Berita Acara</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview <?php echo $menu == 'status ujian' ? 'active' : ''; ?>">
            <a href="#" class="nav-link <?php echo $menu == 'status ujian' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Status Ujian<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/token" class="nav-link <?php echo $submenu == 'token' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Rilis Token</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logpeserta" class="nav-link <?php echo $submenu == 'logpeserta' ? 'active' : ''; ?>">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Status Login Peserta</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?php echo $menu == 'laporan' ? 'active' : ''; ?>">
            <a href="/laporan" class="nav-link <?php echo $menu == 'laporan' ? 'active' : ''; ?>">
                <i class="fas fa-print nav-icon"></i>
                <p>Laporan Ujian</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</nav>