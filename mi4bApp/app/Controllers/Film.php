<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// step 1
use App\Models\FilmModel;
use App\Models\GenreModel; //tambahkan (1)

class Film extends BaseController
{
    //step 2
    protected $film;
    protected $genre; //tambahkan(2)
    
    //step 3 membuat fungsi contruct untuk menginisiasi class model
    public function __construct()
    {
        //fungsi contrct digunakan untuk agar semua fungsi bisa dijalankan di sini
        //step 4, inisiasi ke class film dan panggil propertinya 
        $this->film = new FilmModel();
        $this->genre = new GenreModel(); //tambahkan(3)
    }

    public function index()
    {
        // menegcek datanya tersedia atau
        $data['data_film']= $this->film->getAllDataJoin();
        return view ("film/index", $data);
    }

    public function all() {
        $data['semuafilm'] = $this->film->getAllDataJoin();
        return view("film/semuafilm", $data);
    }

    public function add()
    {
        $data["genre"] = $this->genre->getAllData();
        $data["errors"] = session('errors');
        return view("film/add", $data);
    }
    // public function update($id){
    //     $data["genre"] = $this->genre->getAllData();
    //     $data["errors"] = session('errors');
    //     $data["film"] = $this->film->getDataByID($id);
    //     return view("film/edit", $data);
    // }

    public function update($id)
    {
        $decryptedId = decryptUrl($id);
        $data["genre"] = $this->genre->getAllData();
        $data["errors"] = session('errors');
        $data["film"] = $this->film->getDataByID($decryptedId);
        return view("film/edit", $data);
    }

    public function edit()
    {
        $validation = $this->validate([
            'nama_film' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Film Harus diisi'
                ]
            ],
            'id_genre'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Genre Harus diisi'
                ]
            ],
            'duration'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Durasi Harus diisi'
                ]
            ],
            'cover'     => [
                'rules' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,2048]',
                'errors' => [
                    'mime_in' => 'Tipe file pada Kolom Cover harus berupa JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file pada Kolom Cover melebihi batas maksimum'
                ]
            ]
        ]);

        if (!$validation) {
            $errors = \Config\Services::validation()->getErrors();

            return redirect()->back()->withInput()->with('errors', $errors);
        }
            $film = $this -> film -> find($this->request->getPost('id'));
    
        $data = [
            'id' => $this->request->getPost('id'),
            'nama_film' => $this->request->getPost('nama_film'),
            'id_genre' => $this->request->getPost('id_genre'),
            'duration' => $this->request->getPost('duration'),
        ];
        $cover = $this->request->getFile('cover');
        if ($cover->isValid() && !$cover->hasMoved()) {
            $imageName = $cover->getRandomName();  
            $cover->move (ROOTPATH . 'public/assets/cover/', $imageName);
            if ($film['cover']) {
                unlink(ROOTPATH . 'public/assets/cover/'. $film['cover']); 
            }
            $data['cover'] = $imageName;
            }
            $this->film->save($data);
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
            return redirect()->to('/film');
    }

    // public function destroy($id)
    // {
    //     $this->film->delete($id);
    //     session()->setFlashdata('success', 'Data Berhasil di Hapus');
    //     return redirect()->to('/film');
    // }

    public function destroy($id)
    {
        $decryptedId = decryptUrl($id);
        $this->film->delete($decryptedId);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/film');
    }

    public function film_by_id() {
        dd($this->film->getDataByID(1));
    }

    public function film_by_genre() {
        dd($this->film->getDataBy("Comedy"));
    }

    public function film_order() {
        dd($this->film->getOrderBy());
    }

    public function film_limit_five() {
        dd($this->film->getLimit());
    }
}