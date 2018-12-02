<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\http\Requests;
use App\http\Controllers\Controller;

class EgzaminyController extends Controller
{
        public function index(){
                $ExamsDate = DB::select('select nazwaPrzedmiotu, dataDMY, godzinaRozpoczecia, godzinaZakonczenia from tblPrzedmiot, tblTerminuEgzaminu;', [1]);

                return view('egzaminy')->with("allUsers", $ExamsDate);
       
	}
}
