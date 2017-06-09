<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
* Here is group route for siswa where not authenticate
 */
	Route::group(['middleware' => 'guest'], function() {
		Route::get('/', 'Auth\AuthController@getLogin');
		Route::post('/login', 'Auth\AuthController@postLogin');
	});
/*
* this is group route for siswa where has been authenticate
 */
	Route::group(['middleware' => 'auth'], function() {

		Route::get('dashboard', 'siswa\DashboardController@index');
		Route::get('/authenticate/finish', 'Auth\AuthController@getLogout');
		Route::get('/ujian/{id}', 'siswa\UjianController@index');
		Route::post('/ujian/{id}', 'siswa\UjianController@submit');

		/*
		* this route for save radio button in cookie
		* if user refresh browser, radio button has not changed
		 */
		Route::patch('checkradio', function() {
			$id = Input::get('id_soal');
			$checked = Input::get('checked');
			Cookie::queue(Cookie::make($id, $checked));
		    return Response::json('ok');
		});

	});


/*
* here is group route for administrator where not authenticate
 */
	Route::group(['middleware' => 'guest.admin'], function() {
		Route::get('index/login', 'Admin\AuthAdminController@getLogin');
		Route::post('index/login', 'Admin\AuthAdminController@postLogin');
	});

/*
* here is group route for administrator where has been authenticate
 */
	Route::group(['middleware' => 'auth.admin'], function() {
		
		Route::get('index/dashboard', 'DashboardController@index');
			
		//Route::resource('index/manajemen/kelas', 'kelasController');
//        Route::get('index/manajemen/siswa/create', 'SiswaController@create');


		Route::resource('index/manajemen/siswa', 'SiswaController');
		Route::resource('index/manajemen/ujian', 'UjianController');
		Route::resource('index/manajemen/soal', 'SoalController');
		Route::resource('index/manajemen/mapel', 'MapelController');
		Route::resource('index/manajemen/jurusan', 'JurusanController');
		
		Route::post('index/manajemen/siswa/search', 'SiswaController@search');
		Route::get('index/manajemen/soal/list/{id}', 'SoalController@soal');
		Route::post('index/manajemen/soal/list/{id}', 'SoalController@storeSoal');
		Route::post('index/manajemen/soal/list/edit/{id}', 'SoalController@updateSoal');

		Route::post('index/manajemen/ujian/search', 'UjianController@search');
		Route::get('index/manajemen/ujian/view/{id}', 'UjianController@lihatNilai');

		Route::get('index/logout', 'Admin\AuthAdminController@getLogout');
			
	});