<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>

<body style="width: 70%; margin: 0 auto; padding-top: 30px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Mahasiswa</h2>
            </div>
        </div>
    </div>
    <hr>
    <a href="/Mahasiswa/Add" class="btn btn-primary"><span class="fa fa-plus"></span>Tambah Data</a>
    <hr>
    <?php if (!empty(session()->getFlashdata('berhasil'))) { ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('berhasil'); ?>
        </div>
    <?php } ?>

    <?php
    $errors = $validation->getErrors();
    if (!empty($errors)) {
        echo $validation->listErrors();
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Foto Diri</th>
                        <th>Foto KTP</th>
                        <th>Aksi</th>
                    </tr>
                    <?php foreach ($mahasiswa as $row) : ?>
                        <tr>
                            <td><?= $row['NIM']; ?></td>
                            <td><?= $row['nama_mahasiswa']; ?></td>
                            <td><?php
                                if (!empty($row["foto_diri"])) {
                                    echo '<img src="' . base_url("assets/images/$row[foto_diri]") . '" width="100">';
                                }
                                ?></td>
                            <td><?php
                                if (!empty($row["foto_ktp"])) {
                                    echo '<img src="' . base_url("assets/images/$row[foto_ktp]") . '" width="100">';
                                }
                                ?></td>
                            <td>
                                <a href="Mahasiswa/form_edit/<?= $row['id_mahasiswa']; ?>" class="btn btn-primary">Edit</a> |
                                <a href="Mahasiswa/hapus/<?= $row['id_mahasiswa']; ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>