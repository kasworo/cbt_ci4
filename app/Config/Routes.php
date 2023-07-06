<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('home', 'Home::index');


//Kelola Data Satuan Pendidikan
$routes->get('/sekolah', 'Sekolah::index');
$routes->get('/sekolah/baru', 'Sekolah::baru');
$routes->post('/sekolah/aktif', 'Sekolah::aktif');
$routes->get('/sekolah/edit/(:num)', 'Sekolah::edit/$1');
$routes->post('/sekolah/post', 'Sekolah::post');

// Kelola data Guru dan Staff (GTK)
$routes->get('/gtk', 'Gtk::index');
$routes->get('/gtk/baru', 'Gtk::baru');
$routes->get('/gtk/edit/(:num)', 'Gtk::edit/$1');
$routes->post('/gtk/post', 'Gtk::post');
// Kelola Data Siswa
$routes->get('/siswa', 'Siswa::index');
$routes->get('/siswa/baru', 'Siswa::baru');
$routes->get('/siswa/edit/(:num)', 'Siswa::edit/$1');
$routes->post('/siswa/post', 'Siswa::post');
// Kelola Data Kurikulum
$routes->get('/kurikulum', 'Kurikulum::index');
$routes->post('/kurikulum/edit', 'Kurikulum::edit');
$routes->post('/kurikulum/post', 'Kurikulum::post');

// Kelola Data Mapel
$routes->get('/mapel/(:num)', 'Mapel::index/$1');
$routes->post('/mapel/edit', 'Mapel::edit');
$routes->post('/mapel/post', 'Mapel::post');
//Kelola Data Rombel
$routes->get('/rombel', 'Rombel::index');

//Kelola Data Pengampu
$routes->get('/pengampu/(:num)', 'Pengampu::index/$1');
$routes->post('/pengampu/post', 'Pengampu::post');


//Kelola Registrasi Peserta Didik
$routes->get('/registrasi', 'Registrasi::index');
$routes->get('/registrasi/ekspor', 'Registrasi::ekspor');
$routes->post('/registrasi/impor', 'Registrasi::impor');
//Kelola KKM
$routes->get('/kkm', 'Kkm::index');

// Kelola Ujian
$routes->get('/ujian', 'Ujian::index');
$routes->post('/ujian/edit', 'Ujian::edit');
$routes->post('/ujian/post', 'Ujian::post');
$routes->post('/ujian/aktif', 'Ujian::aktif');
$routes->post('/ujian/hapus', 'Ujian::hapus');
//Kelola Bank Soal
$routes->get('/banksoal', 'BankSoal::index');
$routes->get('/banksoal/isi/(:num)', 'BankSoal::isi/$1');
$routes->post('/banksoal/getkur', 'BankSoal::getkur');
$routes->post('/banksoal/getmapel', 'BankSoal::getmapel');
$routes->post('/banksoal/getid', 'BankSoal::getid');
$routes->post('/banksoal/postbank', 'BankSoal::postbank');
$routes->post('/banksoal/navigasi', 'BankSoal::navigasi');
$routes->post('/banksoal/navlist', 'BankSoal::navlist');
$routes->post('/banksoal/seturut', 'BankSoal::seturut');
$routes->get('/banksoal/stimulus/(:num)', 'BankSoal::stimulus/$1');
$routes->post('/banksoal/poststimulus', 'BankSoal::poststimulus');
$routes->get('/banksoal/editstimulus/(:num)', 'BankSoal::editstimulus/$1');
$routes->get('/banksoal/addsoal/(:num)', 'BankSoal::addsoal/$1');
$routes->post('/banksoal/postbutir', 'BankSoal::postbutir');
//Kelola Jadwal
$routes->get('/jadwal', 'Jadwal::index');
// Kelola Peserta
$routes->get('/peserta', 'Peserta::index');
$routes->post('/peserta/generate', 'Peserta::generate');

//Administrasi Ujian
$routes->get('/administrasi/kartu', 'Administrasi::kartu');
$routes->get('/administrasi/kartucetak', 'Administrasi::kartucetak');
$routes->get('/administrasi/nomeja', 'Administrasi::nomeja');
$routes->get('/administrasi/nomejacetak', 'Administrasi::nomejacetak');
$routes->get('/administrasi/absen', 'Administrasi::absen');
$routes->get('/administrasi/absencetak', 'Administrasi::absencetak');
//Kelola Login
$routes->get('/login', 'Login::index');
$routes->post('/login/ceklogin', 'Login::ceklogin');
$routes->get('/logout', 'Login::logout');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
