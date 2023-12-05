<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
    exit;
}

require __DIR__ . '/config/functions.php';

$banner = query("SELECT * FROM image_banner ib GROUP BY ib.image_id");
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SCT Admin</title> 
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />       
        <link href="css/newstyles.css" rel="stylesheet" /> <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Admin Panel SCT</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="config/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <script>
            $(document).ready(function () {
                $(".modal form").submit(function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);

                    $.ajax({
                        url: "config/crud.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            alert(response); // Check the response for any error messages
                        },
                        error: function () {
                            alert("Gagal menyimpan data ke database.");
                        }
                    });
                });
            });
        </script>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Tabel</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                                <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                                Kategori
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="kategori.php">Tambah Kategori</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                                Produk
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="produk.php">Tambah Produk</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseImage" aria-expanded="false" aria-controls="collapseImage">
                                <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                                Gambar Produk
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseImage" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="gambar.php">Tambah Gambar Produk</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBanner" aria-expanded="false" aria-controls="collapseBanner">
                                <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                                Gambar Banner
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseBanner" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="banner.php">Tambah Gambar Banner</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Masuk sebagai :</div>
                        <?php echo $_SESSION['username']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Banner</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Banner</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Daftar Banner</h4>
                                <a class="btn btn-primary" data-bs-toggle="modal" href="#modalAdd" role="button">
                                    <i class="fas fa-user-plus fa-xs"></i>&nbsp;Tambah Banner
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Gambar Banner</th>
                                            <th>Judul (Keterangan)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($banner as $row) : ?>
                                        <tr>
                                            <td><?= $row['image_id']; ?> </td>
                                            <td><img src="img/<?= $row["image_path"] ?>" width="250px"/> </td>
                                            <td><?= $row['image_title']; ?> </td>
                                            <td class="aksi">
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['image_id'] ?>" style="font-weight: 600;"><i class="bi bi-pencil-square"></i>&nbsp;Ubah&nbsp;</a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['image_id'] ?>" style="font-weight: 600;"><i class="bi bi-trash-fill"></i>&nbsp;Hapus&nbsp;</a>
                                                </div>
                                            </td>
                                        </tr>
             
                                    <!--Awal Modal Edit -->
                                    <div class="modal fade" id="modalEdit<?= $row['image_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Form Data Banner</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="config/crud.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="tim_id" value="<?=$row['image_id']?>">
                                                        <div class="modal-body">
                                                            <div class="mb-file" style="display: block;">
                                                                <label class="form-label">Gambar Banner :</label><br>
                                                                <img src="img/<?= $row["image_path"] ?>" width="150px"/>
                                                                <input type="file" name="tim_ip" class="form-control-file" id="photo" value="<?= $row['image_path']; ?>" required>
                                                            </div><br>
                                                            <div class="col">
                                                                <label class="form-label">Judul (Keterangan) :</label>
                                                                <input type="text" name="tim_title" class="form-control" value="<?= $row['image_title']; ?>" required>
                                                            </div>                                  
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" name="bt_editB">Update</button>
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Keluar</button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>

                                    <!--Akhir Modal Edit -->

                                    <!--Awal Modal Hapus -->
                                    <div class="modal fade" id="modalDelete<?= $row['image_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Banner</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="config/crud.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="tim_id" value="<?= $row['image_id']?>">
                                                    <div class="modal-body">       
                                                        <h5 class="text-center">Apa Anda yakin ingin menghapus Gambar Banner ini?<br>
                                                        <span><img src="img/<?= $row["image_path"] ?>" width="100px"/></span>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" name="bt_deleteB">Hapus</button>
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                    <!--Akhir Modal Hapus -->
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel" style="align-items: center;">Form Data Banner</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="config/crud.php" enctype="multipart/form-data">                 
                                    <div class="modal-body">
                                        <div class="mb-file" style="display: block;">
                                            <label class="form-label">Gambar Banner :</label><br>
                                            <input type="file" name="tim_ip" class="form-control-file" id="photo" required>
                                        </div><br>
                                        <div class="col">
                                            <label class="form-label">Judul (Keterangan) :</label>
                                            <input type="text" name="tim_title" class="form-control" placeholder="Masukkan Judul Gambar" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="bt_addB">Tambah</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!--Akhir Modal -->
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Syn Chroma Tech 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>