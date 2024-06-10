<?php
include 'lib/library.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $nis            = @$_POST['nis'];
    $nama_lengkap   = @$_POST['nama_lengkap'];
    $jenis_kelamin  = @$_POST['jenis_kelamin'];
    $kelas          = @$_POST['id_kelas'];
    $jurusan        = @$_POST['jurusan'];
    $alamat         = @$_POST['alamat'];
    $golongan_darah = @$_POST['golongan_darah'];
    $nama_ibu       = @$_POST['nama_ibu'];
    $foto           = @$_FILES['foto'];

    // Validate form fields
    if (empty($nis)) {
        flash('error', 'Mohon masukkan NIS dengan benar');
    } elseif (empty($nama_lengkap)) {
        flash('error', 'Mohon masukkan Nama Lengkap dengan benar');
    } else {
        // Continue processing if validation passes

        // Handle file upload
        if (!empty($foto) && $foto['error'] == 0) {
            $upload_dir = './media/images/';
            $file_name = $foto['name'];
            $upload_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($foto['tmp_name'], $upload_path)) {
                // File upload success
            } else {
                flash('error', 'Upload file gagal');
                header('Location: index.php');
                exit;
            }
        }

        // Insert data into database
        $sql = "INSERT INTO siswa (nis, nama_lengkap, jenis_kelamin, id_kelas, jurusan, alamat, golongan_darah, nama_ibu, file) 
                VALUES ('$nis', '$nama_lengkap', '$jenis_kelamin', '$kelas', '$jurusan', '$alamat', '$golongan_darah', '$nama_ibu', '$file_name')";

        if ($mysqli->query($sql)) {
            flash('success', 'Data berhasil disimpan');
            header('Location: index.php');
            exit;
        } else {
            flash('error', 'Gagal menyimpan data: ' . $mysqli->error);
            header('Location: index.php');
            exit;
        }
    }
}

// Retrieve flash messages
$success = flash('success');
$error = flash('error');

// Fetch kelas data
$sql = "SELECT * FROM kelas";
$dataKelas = $mysqli->query($sql) or die($mysqli->error);

// Load view
include 'views/v_tambah.php';
?>
