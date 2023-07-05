<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\GenreModel;

class Genre extends BaseController
{
   protected $genre;

    //step 3 membuat fungsi construct untuk inisiasi clas model
    public function __construct()
    {
        //step 4
        $this-> genre = new GenreModel();
    }

    public function index()
    {

        $data['data_genre'] = $this-> genre -> getGenre();
        return view ("genre/semuagenre", $data);
    }
    public function all()
    {
        $data['semua_genre'] = $this -> genre -> getAllData();
        return view ("genre/index", $data);
    }
    public function film_by_id(){
        dd($this -> film -> getDataByID(1));
    }

    public function film_by_genre(){
        dd($this -> film -> getDataBy("horor"));
    }
    
    public function film_order(){
        dd($this -> film -> getOrderBy());
    }

    public function film_limit_five(){
        dd($this -> film -> getLimit());
    }
}