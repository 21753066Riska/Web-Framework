<?php $this->extend("layout/layout");?>
<?php $this->section("content"); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                <h1> Halaman Tambah Data Film </h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="/film" class="btn btn-dark">Kembali</a>
                    </div>
            </div>
    </div>
        <div class="card-body">
        <form action="/film/store" method="POST" enctype="multipart/form-data">
            <form action="">
                 <div class="row">
                    <div class="col-md-6">
                        <label for="nama film" class="form-label">Nama Film</label>
                        <input type="text" class="form-control" id="nama_film" name="nama_film">
                    </div>
                    <div class="col-md-6">
                        <label for="genre" class="form-label">Genre</label>
                        <select name="id_genre" id="genre" class="form-control" name="id_genre">
                            <option value="">Pilih...</option>
                            <?php foreach ($genre as $g) : ?>
                                <option value="<?= $g["id_genre"]?>"><?= $g["nama_genre"]?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="duration" name="duration">
                    </div>
                    <div class="col-md-6">
                        <label for="cover" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="cover" name="cover">
                    </div>
                    <div class ="col-md-6">
                        <button type="submit" class="btn btn-primary mt 5">Simpan</button>
            </div>
        </div>
</form>
    </div>
</div>


<?php $this->endSection(); ?>