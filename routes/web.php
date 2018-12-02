<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Przesylanie plikow 
Route::get('/fileform', function()
{
	return View::make('fileform');
});

Route::post('/fileform', function()
{
	$file = Input::file('myfile');
	//$ext = $file->guessExtension();
	if ($file->move('files', 'newfilename.' . 'csv'))
                    //$ext))
	{
		return "<h2>Sukces</h2>";
	}
	else
	{
		return 'Błąd';
	}
});
//Koniec przesylania

class tbl_subjects extends Eloquent {
	protected $tbl_subject = 'tbl_subjects';	
}

class tbl_profesors extends Eloquent {
	protected $tbl_profesors = 'tbl_profesors';	
}

//class tbl_subjects extends Eloquent {
//	protected $tbl_profesor = 'tbl_profesors';	
//}

//Przesyłanie danych do bazy danych
Route::get('/csv', function()
{
	if  (($handle = fopen(public_path() . '/files/newfilename.csv', 'r')) !== FALSE)
	{
        //Czyszczenie tabeli
        DB::table('tbl_subjects')->delete();
        DB::table('tbl_profesors')->delete();
        
        //fgetcsv(file pointer to a file; 
        //Musi być większy niż najdłuższy wiersz, w pliku; 
        //ustawia ogranicznik pola)
		while (($data = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
            if($data!==array(null)){
                $tbl_subjects = new Tbl_subjects();
                $tbl_subjects->id_subject = $data[0];
                $tbl_subjects->subject_name = $data[1];
                $tbl_subjects->protocol_type = $data[2];

                $tbl_profesors = new Tbl_profesors();
                $tbl_profesors->tytul_przed = $data[3];
                $tbl_profesors->nazwisko = $data[4];
                $tbl_profesors->imie = $data[5];
                $tbl_profesors->tytul_po = $data[6];
                $tbl_profesors->email = $data[7];
                $tbl_profesors->save();

                $tbl_subjects->typ_zajec = $data[8];
                $tbl_subjects->program = $data[9];
                $tbl_subjects->etap = $data[10];
                $tbl_subjects->etap_opis = $data[11];
                $tbl_subjects->save();
                }
        }
		fclose($handle);
	}
//	return Tbl_subjects::all();
//    return Tbl_profesors::all();
    echo Tbl_subjects::all();
    echo '<hr>';
    echo Tbl_profesors::all();
});    

//Logowanie się za pomocą OpenID
Route::get('/login', function()
{
    return View::make('login');
});  

Route::any('/openid/{auth?}', function($auth = NULL)
{
    if($auth =='auth') {
        try {
            Hybrid_Endpoint::process();
        } catch (Exception $e) {
            return Redirect::to('openid');
        }
        return;
    }
    try {
        $oauth = new Hybrid_Auth(app_path().'/config/openid_auth.php');
        $provider = $oauth->authenticate('OpenID', array('openid_identifier' => Input::get('openid_identity')));
        $profile = $provider->getUserProfile();
    }
    catch(Exception $e){
        return $e->getMessage();
    }
echo 'Witaj '. $profile->firstName . ' ' . $profile -> lastName . '<br>';
    echo 'Twój adres email: ' . $profile->email . '<br>';
    dd($profile);
});

//-------------Wczesniejsze--------------------
Route::get('/egzaminy','EgzaminyController@index');

Route::get('/data', 'ImportController@getImport')->name('import');
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'ImportController@processImport')->name('import_process');
