<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Membuat CRUD Input Gambar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
</head>

<body style="width: 70%; margin: 0 auto; padding-top: 30px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD BERITA ARTIKEL </h2>
            </div>
        </div>
    </div>
    <hr>
    <?= form_open_multipart(base_url('Mahasiswa/simpan')); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <label>NIM Mahasiswa</label>
                    <div class="form-group">
                        <input type="text" name="NIM" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Nama Mahasiswa</label>
                    <div class="form-group">
                        <input type="text" name="nama_mahasiswa" class="form-control">
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Foto Diri</label>
                    <div class="form-group">
                        <input type="file" name="diri" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Foto KTP</label>
                        <div class="form-group">
                            <input type="file" name="ktp" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
</body>

</html>