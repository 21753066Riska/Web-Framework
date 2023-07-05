<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{

    protected $table                = 'film ';
    protected $primarykey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields          = ['nama_film', 'id_genre', 'duration', 'cover'];

    public function getFilm(){
        $data=[
            [
                "nama_film" => "Sewu Dino",
                "genre" => "horor",
                "duration" => "1 jam 43 menit"
            ],
            [
                "nama_film" => "Fast And Forious X",
                "genre" => "action",
                "duration" => "2 jam 9 menit"
            ],
            [
                "nama_film" => "Waktu Maghrib",
                "genre" => "horor",
                "duration" => "1 jam 40 menit"
            ],
            [
                "nama_film" => "Hello Gost",
                "genre" => "komedi",
                "duration" => "1 jam 30 menit"
            ],
            [
                "nama_film" => "Qorin",
                "genre" => "horor",
                "duration" => "1 jam 45 menit"
            ]
        ];
        
        return $data;
    }

    public function getAllDataJoin(){
        $query = $this -> db -> table("film")
        -> select("film. *, genre.nama_genre")
        -> join("genre", "genre.id_genre = film.id_genre");
        return $query -> get() -> getResultArray();
    }

    public function getAllData()
    {
        return $this -> findAll();
    }

    public function getDataByID($id)
    {
        return $this -> find($id);
    }

    public function getDataBy($data)
    {
        return $this -> where('genre', $data)->findAll();
    }

    public function getOrderBy()
    {
        return $this -> orderBy('created_at', 'desc')->findAll();
    }

    public function getLimit()
    {
        return $this -> limit(10)->findAll();
    }

}
