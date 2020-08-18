<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="Asset/css/base.css">
  <link rel="stylesheet" href="Asset/css/mobile.css">
  <link rel="stylesheet" href="Asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <title>SBD-Akademik</title>
</head>

<body style="background:#E5E9EA;">
  <?php
  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
      echo "<div class='alert alert-danger'>Username dan Password tidak sesuai !</div>";
    } else if ($_GET['pesan'] == "admin") {
      echo "<div class='alert alert-danger'>Silahkan Login Akun admin untuk akses halaman ini!</div>";
    }
  }
  ?>
  <div class="container">
    <div class="wrapper-register" style="margin-top:120px;">
      <div class="row">
        <div class="col-5">
          <div class="wrapper-avatar-register wrapper-avatar-login">
            <div class="logo-register">
              <img src="Asset/img/school.png">
            </div>
            <p> SBD-Akademik</p>
            <h5> Sistem Basis Data Akademik </h5>
          </div>
        </div>
        <div class="col-7">
          <div class="wrapper-form-register">
            <h5 style="text-align:center;"> Login </h5>
            <form action="Auth/cek_login.php" method="post">
              <div class="form-group">
                <label for="exampleInputPassword1">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username .." required="required">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password .." required="required">
              </div>
              <div class="form-check form-check-inline" style="margin-left: 80px!important;">
              </div>
              <div class="form-check form-check-inline" style="margin-left: 80px!important;margin-bottom:20px;">
              </div>
              <input type="submit" class="btn btn-primary" value="LOGIN">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="../Asset/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#inlineRadio1').hide();
    $('#inlineRadio2').hide();
    $('#inlineRadio2l').hide();
  </script>
</body>

</html>