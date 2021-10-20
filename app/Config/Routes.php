<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('auth',  function ($routes) {
	$routes->get('/', 'Auth::login');
	$routes->post('/', 'Auth::login');
	$routes->get('/login', 'Auth::login');
	$routes->post('/login', 'Auth::login');
	$routes->get('daftar', 'Auth::daftar');
	$routes->get('lupa-password', 'Auth::lupaPassword');
	$routes->get('logout', 'Auth::logout');

});

$routes->group('home', ['filter' => 'authfilter'], function ($routes) {
	$routes->get('/', 'Home::index');
	$routes->get('dashboard', 'Home::dashboard');
	$routes->get('profil', 'Home::profil');
	$routes->get('setting', 'Home::setting');
	$routes->get('setting/getkode', 'Home::settingCode');

	// MODEL PENGGUNA
	$routes->group('pengguna', function ($routes) {
		$routes->get('/', 'Users::index');
		$routes->add('tambah', 'Users::add');
		$routes->add('ubah/(:any)', 'Users::update/$1');
		$routes->get('hapus/(:any)', 'Users::delete/$1');
	});

	$routes->group('pengurus', function ($routes) {
		$routes->get('/', 'Users::index');
		$routes->add('tambah', 'Users::add');
		$routes->add('ubah/(:any)', 'Users::update/$1');
		$routes->get('hapus/(:any)', 'Users::delete/$1');
	});

	$routes->group('peserta', function ($routes) {
		$routes->get('/', 'Users::index');
		$routes->add('tambah', 'Users::add');
		$routes->add('ubah/(:any)', 'Users::update/$1');
		$routes->get('hapus/(:any)', 'Users::delete/$1');
	});

	// MODEL KEGIATAN
	$routes->group('kegiatan', function ($routes) {
		
		$routes->get('/', 'Kegiatan::index');
		$routes->get('detail/ubah/(:any)', 'Kegiatan::update/$1');
		$routes->post('detail/ubah/(:any)', 'Kegiatan::update/$1');
		$routes->get('detail/(:any)', 'Kegiatan::detail/$1');
		
		// kegiatan/modal
		$routes->group('modal', function ($routes) {
			$routes->post('tambah-panitia', 'Kegiatan::modalTambahPanitia');
			$routes->post('tambah-berkas', 'Kegiatan::modalTambahBerkas');
			$routes->post('tambah-peserta', 'Kegiatan::modalTambahPeserta');
			$routes->post('tambah-tugas', 'Kegiatan::modalTambahTugas');
			$routes->post('edit-tugas', 'Kegiatan::modalEditTugas');
			
		});
		
		// kegiatan/aksi
		$routes->group('aksi', function ($routes) {
			$routes->post('tambah-panitia', 'Kegiatan::aksiTambahPanitia');
			$routes->get('hapus-panitia/(:any)/(:any)', 'Kegiatan::aksiHapusPanitia/$1/$2');
			
			$routes->post('tambah-berkas', 'Kegiatan::aksiTambahBerkas');
			
			$routes->post('tambah-peserta', 'Kegiatan::aksiTambahPeserta');
			$routes->get('hadir-peserta/(:any)/(:any)', 'Kegiatan::aksiHadirPeserta/$1/$2');
			$routes->get('batal-hadir-peserta/(:any)/(:any)', 'Kegiatan::aksiBatalHadirPeserta/$1/$2');
			$routes->get('hapus-peserta/(:any)/(:any)', 'Kegiatan::aksiHapusPeserta/$1/$2');

			$routes->post('tambah-tugas', 'Kegiatan::aksiTambahTugas');
			$routes->post('edit-tugas', 'Kegiatan::aksiEditTugas');
			$routes->get('hapus-tugas/(:any)/(:any)', 'Kegiatan::aksiHapusTugas/$1/$2');

			
		});

		$routes->post('tambah-panitia', 'Kegiatan::tambahPanitia');

		// kegiatan/master
		$routes->group('master', function ($routes) {
			$routes->get('/', 'Kegiatan::index');
			$routes->add('tambah', 'Kegiatan::add');
			$routes->add('ubah/(:any)', 'Kegiatan::update/$1');
			$routes->get('hapus/(:any)', 'Kegiatan::delete/$1');
		});

		// kegiatan/semua
		$routes->group('semua', function ($routes) {
			$routes->get('/', 'Kegiatan::index');
			$routes->add('tambah', 'Kegiatan::add');
			$routes->add('ubah/(:any)', 'Kegiatan::update/$1');
			$routes->get('hapus/(:any)', 'Kegiatan::delete/$1');
		});

		// kegiatan/umum
		$routes->group('umum', function ($routes) {
			$routes->get('/', 'Kegiatan::index');
			$routes->add('tambah', 'Kegiatan::add');
			$routes->add('ubah/(:any)', 'Kegiatan::update/$1');
			$routes->get('hapus/(:any)', 'Kegiatan::delete/$1');
		});

		// kegiatan/internal
		$routes->group('internal', function ($routes) {
			$routes->get('/', 'Kegiatan::index');
			$routes->add('tambah', 'Kegiatan::add');
			$routes->add('ubah/(:any)', 'Kegiatan::update/$1');
			$routes->get('hapus/(:any)', 'Kegiatan::delete/$1');
		});
	});
	
});

// BOT TELEGRAM
$routes->group('bot', function ($routes) {
	$routes->post('/', 'Bot::index');
});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
