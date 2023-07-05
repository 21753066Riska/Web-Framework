<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
            <tr>
            <th> No </th>
            <th> Nama Genre </th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($data_genre as $row):?>
            <tr> 
                <td><?= $i++; ?></td>
                <td><?php echo $row['nama_genre'] ?></td>
                <td>
                            <a href="" class="btn btn-success">Update</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
             </tr>

            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>