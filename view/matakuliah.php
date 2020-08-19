<!doctype html>
<?php
session_start();
if ($_SESSION['role'] != "Admin") {
  header("location:../index.php?pesan=admin");
}
?>
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
          <a class="nav-link sidebar" href="dashboard.php" role="tab" aria-selected="true" id="link_dashboard"> <i class="fas fa-th-large"></i> Dashboard</a>
          <a class="nav-link sidebar" href="mahasiswa.php" role="tab" aria-selected="false" id="link_barang"> <i class="fas fa-users"></i> Mahasiswa</a>
          <a class="nav-link sidebar" href="matakuliah.php" role="tab" aria-selected="false"><i class="fas fa-user-graduate"></i> Dosen</a>
          <a class="nav-link sidebar active" href="matakuliah.php" role="tab" aria-selected="false"><i class="fas fa-book-open"></i> Mata Kuliah</a>

          <a class="nav-link sidebar" href="pengguna.php" role="tab" aria-selected="false" id="link_user"><i class="fas fa-user"></i> Pengguna</a>
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
                      <h3 class="title-table"> Daftar Mata Kuliah </h3>
                    </div>
                    <div class="col-5"></div>
                    <div class="col-2">
                      <button class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#Tambah" aria-hidden="true" type="button"> Tambah Data Mata Kuliah</button>
                    </div>
                    <div class="col-1 list-button">
                      <button class="btn btn-primary btn-sm" style=" float: right;" onclick="ToPDF()"><i class="fa fa-file-pdf"></i> PDF</button>
                      <div id="Tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Kuliah</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <!-- TAMBAH -->
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="id">Kode</label>
                                <input type="text" class="form-control" id="id" maxlength="6" aria-describedby="kode" required>
                              </div>
                              <div class="form-group">
                                <label for="nama">Nama Mata Kuliah</label>
                                <input type="name" class="form-control" id="nama" aria-describedby="nama" required>
                              </div>
                              <div class="form-group">
                                <label for="sks">SKS</label>
                                <input type="number" class="form-control" id="sks" maxlength="2" aria-describedby="sks" required>
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
                  <!-- TAMPIL -->
                  <table class="table" id="tabel-data">
                    <thead class="" style="background:#007BFF;color:#fff;">
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Mata Kuliah</th>
                        <th scope="col">SKS</th>
                        <th scope="col">
                          <center> </center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../auth/koneksi.php';
                      $matakuliah = mysqli_query($koneksi, "select * from matakuliah");
                      $i = 1;
                      while ($row = mysqli_fetch_array($matakuliah)) {
                        echo "<tr class='item" . $row['KodeMK'] . "'>
                          <td>" . $i . "</td>
                          <td>" . $row['KodeMK'] . "</td>
                          <td>" . $row['NamaMK'] . "</td>
                          <td>" . $row['SKS'] . "</td>
                          <td>
                            <center>
                                <button class='btn btn-primary btn_edit'data-toggle='modal' data-id=" . $row['KodeMK'] . " data-target='#edit'aria-hidden='true' type='button'><i class='fas fa-pen'></i> </button>
                                <button class='btn btn-primary btn_delete' style='background:red;border:none;' data-id=" . $row['KodeMK'] . "> <i class='fas fa-trash'></i> </button>
                            </center>
                          </td>
                        </tr>";
                        $i++;
                      }
                      ?>
                    </tbody>
                  </table>
                  <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data Mata Kuliah</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <!-- EDIT -->
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="edit-id">Kode</label>
                            <input type="text" class="form-control" id="edit-id" maxlength="6" aria-describedby="Kode" required>
                          </div>
                          <div class="form-group">
                            <label for="edit-nama">Nama Mata Kuliah</label>
                            <input type="name" class="form-control" id="edit-nama" aria-describedby="nama" required>
                          </div>
                          <div class="form-group">
                            <label for="edit-sks">SKS</label>
                            <input type="number" class="form-control" id="edit-sks" maxlength="2" aria-describedby="sks" required>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script type="text/javascript" src="../Asset/js/jspdf.plugin.autotable.min.js"></script>
  <script>
    $(document).ready(() => {
      const idLama = null;
      $('#tabel-data').DataTable({
        "pageLength": 4
      })
    });

    // SAVE PDF
    function ToPDF() {
      var doc = new jsPDF('p', 'pt', 'a4'),
        margins = {
          top: 40,
          bottom: 60,
          left: 40,
          width: 522
        };
      doc.setFontSize(26);
      doc.text(40, 35, 'Laporan Data Mata Kuliah');


      doc.autoTable({
        html: '#tabel-data',
        margin: {
          top: 60,
          right: 40,
          bottom: 40,
          left: 40
        }
      });
      doc.save('SBD-Akademik-Mata Kuliah.pdf');
    }

    // DELETE
    function deleteAction(id) {
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
            url: "../controller/matakuliah-controller.php",
            type: 'post',
            data: {
              id,
              tipe: 'delete'
            },
            success: function(data) {
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
              $('.item' + id).fadeOut(1500, function() {
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

    // DELETE BUTTON
    $('.btn_delete').on('click', function() {
      idLama = $(this).data('id');
      deleteAction(idLama);
    });

    // CREATE
    $('.btn_simpan').on('click', function() {
      let id = $('#id').val();
      let nama = $('#nama').val();
      let sks = $('#sks').val();
      if (id == '' || nama == '' || sks == '') {
        Swal.fire(
          'Warning!',
          'Pastikan Semua Data sudah terisi',
          'warning'
        );
      } else {
        $.ajax({
          url: "../controller/matakuliah-controller.php",
          type: 'post',
          data: {
            tipe: 'create',
            id,
            nama,
            sks
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
      }
    });

    // EDIT BUTTON
    $('.btn_edit').on('click', function() {
      idLama = $(this).data('id');
      editAction(idLama);
    });

    // UPDATE
    $('.btn_update').on('click', function() {
      $.ajax({
        url: "../controller/matakuliah-controller.php",
        type: 'post',
        data: {
          tipe: 'update',
          idLama,
          id: $('#edit-id').val(),
          nama: $('#edit-nama').val(),
          sks: $('#edit-sks').val()
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

    // EDIT
    function editAction(id) {
      $.ajax({
        url: "../controller/matakuliah-controller.php",
        type: 'post',
        data: {
          id,
          tipe: 'edit'
        },
        success: function(data) {
          let edit = $.parseJSON(data);
          $('#edit-id').val(edit[0]['id']);
          $('#edit-nama').val(edit[0]['nama']);
          $('#edit-sks').val(edit[0]['sks']);
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
  </script>
</body>

</html>