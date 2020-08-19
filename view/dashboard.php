<?php
session_start();

if ($_SESSION['role'] == "") {

  header("location:../index.php?pesan=gagal");
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../asset/css/base.css">
  <link rel="stylesheet" href="../asset/css/mobile.css">
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <title>SBD-Akademik</title>
  <style>
    a.wrapper-card-dashbord.kotak-item {
      display: block;
      color: white;
      text-decoration: none;
    }
  </style>
</head>

<body style="background:#f9f9f9;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">SBD-Akademik</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <div> Hi! <?php echo $_SESSION['role'] ?> </div>
        <div class="logout"><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
      </form>
    </div>
  </nav>
  <header>
    <div class="row">
      <div class="col-3">
        <div class="nav flex-column nav-pills navigation-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <div class="profile-user">
            <div class="image-user">
              <i class="fas fa-user"></i>
            </div>
            <p> <?php echo $_SESSION['nama'] ?></p>
          </div>
          <a class="nav-link active sidebar" href="dashboard.php" role="tab" aria-selected="true" id="link_dashboard"> <i class="fas fa-th-large"></i> Dashboard</a>
          <a class="nav-link sidebar" href="mahasiswa.php" role="tab" aria-selected="false" id="link_barang"> <i class="fas fa-users"></i> Mahasiswa</a>
          <a class="nav-link sidebar" href="dosen.php" role="tab" aria-selected="false"><i class="fas fa-user-graduate"></i> Dosen</a>
          <a class="nav-link sidebar" href="matakuliah.php" role="tab" aria-selected="false"><i class="fas fa-book-open"></i> Mata Kuliah</a>
          <a class="nav-link sidebar" href="perkuliahan.php" role="tab" aria-selected="false"><i class="fas fa-university"></i> Perkuliahan</a>
          <a class="nav-link sidebar" href="pengguna.php" role="tab" aria-selected="false" id="link_user"><i class="fas fa-user"></i> Pengguna</a>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="container">
              <section id="data-toko">
                <div class="row">
                  <div class="col-4">
                    <a href="mahasiswa.php" class="wrapper-card-dashbord kotak-item" style="background:#E94B35">
                      <div class="row">
                        <div class="col-6">
                          <div class="avatar-wrapper-card-dashbord">
                            <i class="fas fa-users"></i>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="data-wrapper-card-dashbord">
                            <h4> Data Mahasiswa </h4>
                            <?php
                            include '../auth/koneksi.php';
                            $jumlah = mysqli_query($koneksi, "select COUNT(*) AS jumlah from mahasiswa");
                            while ($row = mysqli_fetch_array($jumlah)) {
                              echo "<P> " . $row['jumlah'] . " orang</P>";
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-4">
                    <a href="dosen.php" class="wrapper-card-dashbord kotak-item" style="background:#F3C501;">
                      <div class="row">
                        <div class="col-6">
                          <div class="avatar-wrapper-card-dashbord">
                            <i class="fas fa-user-graduate"></i>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="data-wrapper-card-dashbord">
                            <h4> Data Dosen </h4>
                            <?php
                            include '../auth/koneksi.php';
                            $jumlah = mysqli_query($koneksi, "select COUNT(*) AS jumlah from dosen");
                            while ($row = mysqli_fetch_array($jumlah)) {
                              echo "<P> " . $row['jumlah'] . " orang</P>";
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-4">
                    <a href="matakuliah.php" class="wrapper-card-dashbord kotak-item" style="background:#19AF5D;">
                      <div class="row">
                        <div class="col-6">
                          <div class="avatar-wrapper-card-dashbord">
                            <i class="fas fa-book-open"></i>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="data-wrapper-card-dashbord">
                            <h4> Data Mata Kuliah </h4>
                            <?php
                            include '../auth/koneksi.php';
                            $jumlah = mysqli_query($koneksi, "select COUNT(*) AS jumlah from matakuliah");
                            while ($row = mysqli_fetch_array($jumlah)) {
                              echo "<P> " . $row['jumlah'] . " mata kuliah</P>";
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </section>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <section class="data-table">
              <section class="Data Tables">
                <div class="container">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td>
                          <a href=""></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>
          </div>
          <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
          <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
        </div>
      </div>
    </div>
  </header>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
</body>

</html>