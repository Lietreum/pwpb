<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./media/css/tambah.css">
</head>
<body>
    <?php
        $action = 'tambah.php';
        if (!empty($siswa)) $action = 'edit.php';
        $form = "tambah";
    ?>

    <?php if (!empty($success)) { ?>
        <div class="alert alert-success">
            <p><?= $success ?></p>
        </div>
    <?php } ?>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php } ?>

    <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Foto</label>
            <div class="col-sm-6">
                <?php if ($form == "edit") { ?>
                    <img width="100" height="110" src="<?= empty($siswa['file']) ? : 'media/images/' . $siswa['file'] ?>" id="output">
                    <input type="hidden" name="foto" value="<?= @$result->file ?>">
                <?php } ?>
                <input type="file" name="foto" />
            </div>
        </div>
        NIS <input type="text" name="nis" value="<?= @$siswa['nis'] ?>"><br>
        <!-- Properly formatted the value attribute for Nama Lengkap field -->
        Nama Lengkap <input type="text" name="nama_lengkap" value="<?= @$siswa['nama_lengkap'] ?>"><br>
        jenis Kelamin<br>
        <input type="radio" name="jenis_kelamin" value="L" <?= @$siswa['jenis_kelamin'] == 'L' ? 'checked' : '' ?>> Laki-Laki<br>
        <input type="radio" name="jenis_kelamin" value="P" <?= @$siswa['jenis_kelamin'] == 'P' ? 'checked' : '' ?>> Perempuan<br>
        kelas
        <select name="kelas">
            <option value="X" <?= @$siswa['kelas'] == 'X' ? 'selected' : '' ?>>X</option>
            <option value="XI" <?= @$siswa['kelas'] == 'XI' ? 'selected' : '' ?>>XI</option>
            <option value="XII" <?= @$siswa['kelas'] == 'XII' ? 'selected' : '' ?>>XII</option>
        </select>

        <select name="id_kelas" id="id_kelas" class="select1">
            <option value="">[ Pilih Kelas ]</option>
            <?php while ($murid = @$dataKelas->fetch_array()) { ?>
                <option value="<?= $murid['id_kelas']; ?>" <?= @$siswa['id_kelas'] == $murid['id_kelas'] ? 'selected' : ''; ?>>
                    <?= $murid['nama_kelas']; ?>
                </option>
            <?php } ?>
        </select>

        jurusan
        <select name="jurusan">
            <option value="RPL" <?= @$siswa['jurusan'] == 'RPL' ? 'selected' : '' ?>>RPL</option>
            <option value="DKV" <?= @$siswa['jurusan'] == 'DKV' ? 'selected' : '' ?>>DKV</option>
            <option value="TKJ" <?= @$siswa['jurusan'] == 'TKJ' ? 'selected' : '' ?>>TKJ</option>
        </select><br>
        Alamat <input type="text" name="alamat" value="<?= @$siswa['alamat'] ?>"><br>
        Golongan Darah <input type="text" name="golongan_darah" value="<?= @$siswa['golongan_darah'] ?>"><br>
        Nama Ibu <input type="text" name="nama_ibu" value="<?= @$siswa['nama_ibu'] ?>"><br>
        <input type="submit" value="Simpan Data">
    </form>
</body>
</html>
