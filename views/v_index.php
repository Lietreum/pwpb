<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Nanum+Pen+Script&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            font-family: 'Nanum Pen Script', cursive;
            color: #000;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #000;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            font-size: 36px;
            color: #000;
        }

        .form-container label {
            font-size: 18px;
            color: #000;
        }

        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #000;
            border-radius: 10px;
            font-size: 16px;
            background-color: #fff;
            color: #000;
        }

        .form-container button {
            background-color: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            background-color: #f9f9f9;
            border: 1px solid #000;
            border-radius: 10px;
            overflow: hidden;
        }

        table thead {
            background-color: #000;
            color: #fff;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #000;
        }

        table tbody tr:nth-child(even) {
            background-color: #eaeaea;
        }

        table tbody tr:hover {
            background-color: #ddd;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin: 2px;
            font-size: 14px;
            color: #fff;
        }

        .btn-warning {
            background-color: #ff9800;
            color: #fff;
        }

        .btn-danger {
            background-color: #f44336;
            color: #fff;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .modal-content {
            background-color: #f9f9f9;
            border: 1px solid #000;
        }

        .modal-header, .modal-footer {
            border: none;
        }

        .modal-title {
            color: #000;
        }

        .modal-body {
            color: #000;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Student Information</h2>
        <form method="GET" action="index.php">
            <div class="mb-3">
                <label for="search">Search by NIS and Name</label>
                <input type="text" class="form-control" id="search" name="search" value="<?= @$search ?>">
            </div>
            <button type="submit" class="btn btn-dark">Search</button>
            <button type="button" class="btn btn-secondary" onClick="clearSearch()">Clear</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>
                    NIS
                    <a href="index.php?sort=nis&order=asc">⬆️</a>
                    <a href="index.php?sort=nis&order=desc">⬇️</a>
                </th>
                <th>
                    Full Name
                    <a href="index.php?sort=nama_lengkap&order=asc">⬆️</a>
                    <a href="index.php?sort=nama_lengkap&order=desc">⬇️</a>
                </th>
                <th>Gender</th>
                <th>Class</th>
                <th>Major</th>
                <th>Address</th>
                <th>Blood Type</th>
                <th>Mother's Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                while ($siswa = $listSiswa->fetch_array()) {
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td>
                    <?php if (!empty($siswa['file'])) { ?>
                        <img width="60" height="60" src="media/images/<?= $siswa['file'] ?>">
                    <?php } ?>
                </td>
                <td><?= $siswa['nis'] ?></td>
                <td><?= $siswa['nama_lengkap'] ?></td>
                <td><?= $siswa['jenis_kelamin'] ?></td>
                <td><?= $siswa['nama_kelas'] ?></td>
                <td><?= $siswa['jurusan'] ?></td>
                <td><?= $siswa['alamat'] ?></td>
                <td><?= $siswa['golongan_darah'] ?></td>
                <td><?= $siswa['nama_ibu'] ?></td>
                <td>
                    <a href="edit.php?nis=<?= $siswa['nis'] ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?nis=<?= $siswa['nis'] ?>" class="btn btn-danger btnDelete">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="tambah.php" class="btn btn-dark">Add Data</a><br><br>
    <a href="logout.php" class="btn btn-danger">Logout</a><br><br>

    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">Are you sure you want to delete this data?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btnYa">Yes</button>
                    <button type="button" class="btn btn-danger btnNo" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function clearSearch() {
            window.location.href = 'index.php';
        }

        $(function() {
            $(".btnDelete").on("click", function(e) {
                e.preventDefault();
                var nama = $(this).parent().siblings().eq(2).text();
                var tr = $(this).closest("tr");
                var href = $(this).attr('href');

                $(".modal").modal('show');
                $(".modal-body").html('Are you sure you want to delete data of <b>' + nama + '</b>?');

                $('.btnYa').off().on('click', function() {
                    $.ajax({
                        url: href,
                        type: 'POST',
                        success: function(result) {
                            if (result == 1) {
                                $(".modal").modal('hide');
                                tr.fadeOut();
                                toastr.success('Data successfully deleted', 'Information');
                            }
                        }
                    });
                });
            });

            $('.btnNo').on('click', function() {
                $(".modal").modal('hide');
            });
        });
    </script>
</body>

</html>
