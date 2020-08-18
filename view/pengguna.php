<?php
session_start();
if ($_SESSION['role'] != "admin") {
  header("location:../index.php?pesan=admin");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../asset/css/base.css">
  <link rel="stylesheet" href="../asset/css/mobile.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" type="text/css" href="../asset/SweetAlert/sweetalert2.min.css">
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <title>SBD-Akademik</title>
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
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <div class="profile-user">
            <div class="image-user">
              <i class="fas fa-user"></i>
            </div>
            <p> <?php echo $_SESSION['nama'] ?></p>
          </div>
          <a class="nav-link sidebar" href="dashboard.php" role="tab" aria-selected="true"> <i class="fas fa-th-large"></i> Dashboard</a>
          <a class="nav-link sidebar" href="barang.php" role="tab" aria-selected="false"> <i class="fas fa-box-open"></i> Barang</a>
          <a class="nav-link active sidebar" href="pengguna.php" role="tab" aria-selected="false"><i class="fas fa-users"></i> Pengguna</a>
          <a class="nav-link sidebar" href="perkuliahan.php" role="tab" aria-selected="false"><i class="fas fa-shopping-cart"></i> Transaksi</a>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="container">
              <section class="data-table">
                <div class="container">
                  <div class="row">
                    <div class="col-4">
                      <h3 class="title-table"> Daftar Pengguna </h3>
                    </div>
                    <div class="col-3">
                    </div>
                    <div class="col-2">
                      <button class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#Tambah" aria-hidden="true" type="button"> Tambah Pengguna</button>
                    </div>
                    <div class="col-3 list-button">
                      <div id="Tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="nama">Nama </label>
                                <input type="name" class="form-control" id="nama" aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username">
                              </div>
                              <div class="form-group">
                                <label for="password">Password </label>
                                <input type="password" class="form-control" id="password" aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="kpassword">
                                <small class="msg_error" style="color: red">Sorry Password Didn't Match Please check Again</small>
                                <small class="msg_done" style="color: green">Password Match!! Thanks :)</small>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary btn_simpan">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table class="table" id="tabel-data">
                    <thead class="" style="background:#007BFF;color:#fff;">
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama </th>
                        <th scope="col">Username</th>
                        <th scope="col">Roles</th>
                        <th scope="col">
                          <center>opsi</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../auth/koneksi.php';
                      $user = mysqli_query($koneksi, "select * from user where role != 'admin'");
                      $i = 1;
                      while ($row = mysqli_fetch_array($user)) {
                        echo "<tr class='itemUser" . $row['id_user'] . "'>
                          <td>" . $i . "</td>
                          <td>" . $row['nama'] . "</td>
                          <td>" . $row['username'] . "</td>
                          <td>" . $row['role'] . "</td>
                          <td>
                            <center>
                              <button class='btn btn-primary btn_edit'data-toggle='modal' data-id=" . $row['id_user'] . " data-target='#edit'aria-hidden='true' type='button'><i class='fas fa-pen'></i> </button>
                              <button class='btn btn-primary btn_delete' style='background:red;border:none;' data-id=" . $row['id_user'] . "> <i class='fas fa-trash'></i> </button>
                            </center>
                          </td>
                        </tr>";
                        $i++;
                      }
                      ?>
                    </tbody>
                  </table>
                  <a href="#" class="float" data-toggle="modal" data-target="#Tambah" aria-hidden="true">
                    <i class="fa fa-plus my-float"></i>
                  </a>
                  <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengguna</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="edit_nama">Nama</label>
                            <input type="name" class="form-control" id="edit_nama" aria-describedby="emailHelp">
                          </div>
                          <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" id="edit_username">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary btn_update">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </header>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="../asset/SweetAlert/sweetalert2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

  <script>
    $(document).ready(function() {
      var nama, username, password;
      var codeListTable = $('#tabel-data').DataTable({
        "pageLength": 4
      });
      $('.msg_done').hide();
      $('.msg_error').hide();
      new $.fn.dataTable.Buttons(codeListTable, {
        buttons: [{
            extend: 'csv',
            text: '<i class="fa fa-file"></i> CSV',
            titleAttr: 'CSV',
            className: 'btn btn-primary btn-sm',
            init: function(api, node, config) {
              $(node).removeClass('btn-default btn-secondary')
            },
            exportOptions: {
              columns: ['0', '1', '2', '3']
            }
          },
          {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel"></i> Excel',
            titleAttr: 'Excel',
            className: 'btn btn-primary btn-sm',
            init: function(api, node, config) {
              $(node).removeClass('btn-default btn-secondary')
            },
            exportOptions: {
              columns: ['0', '1', '2', '3']
            }
          },
          {
            extend: 'pdf',
            text: '<i class="fa fa-file-pdf"></i> PDF',
            titleAttr: 'pdfHtml5',
            className: 'btn btn-primary btn-sm',
            init: function(api, node, config) {
              $(node).removeClass('btn-default btn-secondary')
            },
            exportOptions: {
              columns: ['0', '1', '2', '3']
            }
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print"></i> Print',
            titleAttr: 'Print',
            className: 'btn btn-primary btn-sm',
            init: function(api, node, config) {
              $(node).removeClass('btn-default btn-secondary')
            },
            exportOptions: {
              columns: ['0', '1', '2', '3']
            }
          },
        ]
      });
      codeListTable.buttons().container().appendTo('.list-button');
    });

    $('#kpassword').on('keyup', function() {
      if ($(this).val() != $('#password').val()) {
        $('.msg_done').hide();
        $('.msg_error').show();
        $('.btn_simpan').prop('disabled', true);
      } else {
        $('.msg_done').show();
        $('.msg_error').hide();
        $('.btn_simpan').prop('disabled', false);
      }
    });

    $('.btn_simpan').on('click', function() {
      var id_user;
      nama = $('#nama').val();
      username = $('#username').val();
      password = $('#password').val();
      console.log(nama + username + password);
      if (nama == '' || username == '' || password == '') {
        Swal.fire(
          'Warning!',
          'Pastikan Semua Data sudah terisi',
          'warning'
        );
      } else {
        $.ajax({
          url: "../controller/user_manage.php",
          type: 'post',
          data: {
            id: '0',
            tipe: 'get_id'
          },
          success: function(data) {
            console.log(data);
            id_user = data;
            $.ajax({
              url: "../controller/user_manage.php",
              type: 'post',
              data: {
                id: id_user,
                tipe: 'add_user',
                nama: nama,
                username: username,
                password: password
              },
              success: function(data) {
                Swal.fire({
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
                setTimeout(function() {
                  window.location.reload(1);
                }, 1600);
              },
              error: function(data) {
                swalWithBootstrapButtons.fire(
                  'Gagal!',
                  'Failed to add data',
                  'error'
                );
              }
            });
          },
          error: function(data) {
            swalWithBootstrapButtons.fire(
              'Gagal!',
              'Failed to get code',
              'error'
            );
          }
        });
      }
    });

    $('.btn_delete').on('click', function() {
      id = $(this).data('id');
      console.log(id);
      Delete_User(id);
    });

    $('.btn_edit').on('click', function() {
      id = $(this).data('id');
      console.log(id);
      edit_User(id);
    });

    $('.btn_update').on('click', function() {
      $.ajax({
        url: "../controller/user_manage.php",
        type: 'post',
        data: {
          id: id,
          tipe: 'update',
          nama: $('#edit_nama').val(),
          username: $('#edit_username').val()
        },
        success: function(data) {
          Swal.fire({
            icon: 'success',
            title: 'Update Success !',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout(function() {
            window.location.reload(1);
          }, 1600);
        },
        error: function(data) {
          swalWithBootstrapButtons.fire(
            'Gagal!',
            'Failed to delete your file.',
            'error'
          );
        }
      });
    });

    function edit_User(id) {
      $.ajax({
        url: "../controller/user_manage.php",
        type: 'post',
        data: {
          id: id,
          tipe: 'edit'
        },
        success: function(data) {
          console.log(data);
          var edit = $.parseJSON(data);
          $('#edit_nama').val(edit[0]['nama']);
          $('#edit_username').val(edit[0]['username']);

        },
        error: function(data) {
          swalWithBootstrapButtons.fire(
            'Gagal!',
            'Failed to delete your file.',
            'error'
          );
        }
      });
    }

    function Delete_User(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "../controller/user_manage.php",
            type: 'post',
            data: {
              id: id,
              tipe: 'delete'
            },
            success: function(data) {
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
              $('.itemUser' + id).fadeOut(1500, function() {
                $(this).remove();
              });
            },
            error: function(data) {
              swalWithBootstrapButtons.fire(
                'Gagal!',
                'Failed to delete your file.',
                'error'
              );
            }
          });
        } else if (
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      });
    }
  </script>
</body>

</html>