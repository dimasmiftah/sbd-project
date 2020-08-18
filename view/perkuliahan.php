<?php
session_start();
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['role'] == "") {
  header("location:../index.php?pesan=admin");
}

// fungsi formatting rupiah
function rupiah($angka)
{
  $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
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
          <?php
          if ($_SESSION['role'] == "admin") {
            echo '
            <a class="nav-link sidebar" href="dashboard.php" role="tab" aria-selected="true" id="link_dashboard"> <i class="fas fa-th-large"></i> Dashboard</a>
            <a class="nav-link sidebar"  href="barang.php" role="tab" aria-selected="false" id="link_barang"> <i class="fas fa-box-open"></i> Barang</a>
            <a class="nav-link sidebar" href="pengguna.php"role="tab" aria-selected="false" id="link_user"><i class="fas fa-users"></i> Pengguna</a>
            <a class="nav-link active sidebar" href="perkuliahan.php" role="tab" aria-selected="false" id="link_transaksi"><i class="fas fa-shopping-cart"></i> Transaksi</a>';
          }
          ?>
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
                      <h3 class="title-table"> Daftar Transaksi </h3>
                    </div>
                    <div class="col-5">
                    </div>
                    <div class="col-2">
                      <button class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#Tambah" aria-hidden="true" type="button"> Tambah Data Transaksi</button>
                    </div>
                    <div class="col-1 list-button">
                      <button class="btn btn-primary btn-sm" style=" float: right;" onclick="ToPDF()"><i class="fa fa-file-pdf"></i> PDF</button>
                      <div id="Tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <!-- TAMBAH -->
                            <div class="modal-body">
                              <input id="kasir" type="hidden" value='<?= $_SESSION['username'] ?>'>
                              <table class="table">
                                <tr>
                                  <td>
                                    <select id="barangs" name="barangs">
                                      <option></option>
                                      <?php
                                      include '../auth/koneksi.php';
                                      $barang = mysqli_query($koneksi, "select * from barang where stok>=1");
                                      $i = 1;
                                      while ($row = mysqli_fetch_array($barang)) {
                                        echo "<option class='barang'" . $i . " value=" . $row['id_barang'] . ">" . $row['barang'] . "</option>";
                                        $i++;
                                      }
                                      ?>
                                    </select>
                                  </td>
                                  <td><input type="text" placeholder="Jumlah" id="txt_jumlah"></td>
                                  <td>
                                    <button class="btn btn-primary" id="btn_tambah">Tambah</button>
                                  </td>
                                </tr>
                              </table>

                              <table class="table">
                                <thead class="" style="background:#007BFF;color:#fff;">
                                  <tr>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                  </tr>
                                </thead>
                                <tbody id="list_barang">
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td id="total"></td>
                                  </tr>
                                </tfoot>
                              </table>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <button type="button" class="btn btn-primary" id="btn_simpan">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- TAMPIL -->
                  <table class="table tabel-transaksi" id="tabel-data">
                    <thead class="" style="background:#007BFF;color:#fff;">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Kasir</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total Belanja</th>
                        <th scope="col">
                          <center>Aksi</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../auth/koneksi.php';
                      $transaksi = mysqli_query($koneksi, "select * from transaksi order by tanggal DESC");
                      $i = 1;
                      while ($row = mysqli_fetch_array($transaksi)) {
                        $nama_kasir = '';
                        $kasir = mysqli_query($koneksi, "select nama from user where id_user = '" . $row['id_user'] . "'");
                        while ($row2 = mysqli_fetch_array($kasir)) {
                          $nama_kasir = $row2['nama'];
                        }
                        echo "<tr class='itemTransaksi" . $row['id_transaksi'] . "'>
                                <td>" . $i . "</td>
                                <td>" . $row['id_transaksi'] . "</td>
                                <td>" . $nama_kasir . "</td>
                                <td>" . $row['tanggal'] . "</td>
                                <td>" . rupiah($row['subtotal']) . "</td>
                                <td>
                                  <center>
                                    <button class='btn btn-primary btn_detail' data-id=" . $row['id_transaksi'] . "> <i class='fas fa-eye'></i> </button>
                                    <button class='btn btn-primary btn_delete' style='background:red;border:none;' data-id=" . $row['id_transaksi'] . "> <i class='fas fa-trash'></i> </button>
                                  </center>
                                </td>
                              </tr>";
                        $i++;
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="cetak_pdf">
                    <table class="table table-striped" id="table_pdf" hidden>

                      <thead>
                        <tr>
                          <th>ID Transaksi</th>
                          <th>Kasir</th>
                          <th>Tanggal</th>
                          <th>List Barang</th>
                          <th>Total Harga</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include '../auth/koneksi.php';
                        $transaksi = mysqli_query($koneksi, "select * from transaksi");

                        while ($row = mysqli_fetch_array($transaksi)) {
                          $id_transaksi = $row['id_transaksi'];
                          $nama_kasir = '';
                          $kasir = mysqli_query($koneksi, "select nama from user where id_user = '" . $row['id_user'] . "'");
                          while ($row2 = mysqli_fetch_array($kasir)) {
                            $nama_kasir = $row2['nama'];
                          }
                          echo "<tr class='itemTransaksi" . $row['id_transaksi'] . "'>
                                <td>" . $row['id_transaksi'] . "</td>
                                <td>" . $nama_kasir . "</td>
                                <td>" . $row['tanggal'] . "</td>";
                          echo "<td>";
                          $list = mysqli_query($koneksi, "select barang.barang,list_transaksi.qty from list_transaksi join barang on list_transaksi.id_barang = barang.id_barang where list_transaksi.id_transaksi='$id_transaksi'");
                          echo "<ul>";
                          while ($row3 = mysqli_fetch_array($list)) {
                            echo "<li>" . $row3['barang'] . " (" . $row3['qty'] . ")</br> ";
                          }
                          echo "</ul>";
                          echo "</td>";
                          echo "<td>" . rupiah($row['subtotal']) . "</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div id="list-transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">List Data Transaksi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <!-- LIST -->
                        <div class="modal-body">
                          <table class="table">
                            <thead class="" style="background:#007BFF;color:#fff;">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total Harga</th>
                              </tr>
                            </thead>
                            <tbody id="list-barang">
                            </tbody>
                          </table>
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
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="../asset/SweetAlert/sweetalert2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script type="text/javascript" src="../asset/js/jspdf.plugin.autotable.min.js"></script>
  <script>
    const id_transaksi = Number(new Date().getTime());
    const list = [];
    let kasir = null;
    let total = 0;
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    $(document).ready(function() {
      role = "<?php echo $_SESSION['role'] ?>";
      if (role == 'kasir') {
        $('#link_dashboard').hide();
        $('#link_user').hide();
        $('#link_barang').hide();
        $('#link_transaksi').hide();
      }
    });

    // DOCUMENT READY
    $(document).ready(function() {
      let role = "<?php echo $_SESSION['role'] ?>";
      if (role == 'kasir') {
        $('#link_dashboard').hide();
        $('#link_user').hide();
        $('#link_barang').hide();
      }
      $('#tabel-data').DataTable({
        "pageLength": 4
      });
      $('#barangs').select2({
        placeholder: 'Pilih Barang',
        allowClear: true
      });
      kasir = $('#kasir').val();
    });

    // Simpan transaksi
    $('#btn_simpan').on('click', () => {
      $.ajax({
        url: "../controller/transaksi_manage.php",
        type: 'post',
        data: {
          kasir,
          tipe: 'kasir'
        },
        success: (id_user) => {
          $.ajax({
            url: "../controller/transaksi_manage.php",
            type: 'post',
            data: {
              id_transaksi,
              id_user,
              total,
              list,
              tipe: 'create'
            },
            success: function(data) {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil menyimpan transaksi',
                showConfirmButton: false,
                timer: 1500
              })
              console.log(data);

              setTimeout(function() {
                window.location.reload(1);
              }, 1600);
            },
            error: function(data) {
              swalWithBootstrapButtons.fire(
                'Gagal!',
                'Gagal menyimpan transaksi',
                'error'
              );
            }
          });
        },
        error: (err) => {
          alert(err);
        }
      });

    })

    // reset tambah barang
    function resetTambah() {
      $('#barangs').val(null).trigger('change');
      $('#txt_jumlah').val(null);
    }

    // TAMBAH BARANG EVENT
    $('#btn_tambah').on('click', function() {
      let id = $('#barangs').children("option:selected").val();
      let jumlah = Number($('#txt_jumlah').val());
      if (id == '') {
        alert('pilih barang')
      } else if (jumlah == '') {
        alert('isi jumlah');
      } else {
        $.ajax({
          url: "../controller/transaksi_manage.php",
          type: 'post',
          data: {
            id: id,
            tipe: 'pilih'
          },
          success: (data) => {
            let data_json = JSON.parse(data)
            let barang = {
              id_barang: Number(data_json[0].id_barang),
              barang: data_json[0].barang,
              stok: Number(data_json[0].stok),
              harga: Number(data_json[0].harga)
            }
            console.log(barang);
            if (jumlah > barang.stok) {
              alert(barang.barang + ' hanya tersisa ' + barang.stok)
            } else {
              total += (jumlah * barang.harga);
              list.push({
                id_barang: barang.id_barang,
                barang: barang.barang,
                harga: barang.harga,
                qty: jumlah,
                total: jumlah * barang.harga
              })
              $("#list_barang").append(
                `
              <tr>
                <td>${barang.barang}</td>
                <td>${barang.harga}</td>
                <td>${jumlah}</td>
                <td>${jumlah*barang.harga}</td>
              </tr>
              `
              );
              $('#total').html(total)
              resetTambah()
            }
          },
          error: (err) => {
            console.log(err)
          }
        })
      }
    });

    // DELETE CLICK EVENT
    $('.btn_delete').on('click', function() {
      let id = $(this).data('id');
      Delete_Transaksi(id);
    });

    // DETAIL CLICK EVENT
    $('.btn_detail').on('click', function() {
      let id_transaksi = $(this).data('id');
      Detail_Transaksi(id_transaksi);
    });

    //DETAIL ACTION
    function Detail_Transaksi(id_transaksi) {
      $.ajax({
        url: "../controller/transaksi_manage.php",
        type: 'post',
        data: {
          id_transaksi,
          tipe: 'detail'
        },
        success: function(data) {
          const list_transaksi = [...JSON.parse(data)];
          let htmlList = '';
          list_transaksi.forEach((li, index) => {
            htmlList +=
              `
            <tr>
            <td>${index+1}</td>
            <td>${li.barang}</td>
            <td>Rp${new Intl.NumberFormat('id').format(li.harga)}</td>
            <td>${li.qty}</td>
            <td>Rp${new Intl.NumberFormat('id').format(li.total)}</td>
            </tr>
            `
          })
          $('#list-barang').html(htmlList)
          $('#list-transaksi').modal('toggle');
        },
        error: function(err) {
          console.log(err)
        }
      });
    }

    //DELETE CLICK ACTION
    function Delete_Transaksi(id) {
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
            url: "../controller/transaksi_manage.php",
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
              $('.itemTransaksi' + id).fadeOut(1500, function() {
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
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe',
            'error'
          )
        }
      });
    }

    function ToPDF() {
      var doc = new jsPDF('p', 'pt', 'a4'),
        margins = {
          top: 40,
          bottom: 60,
          left: 40,
          width: 522
        };
      doc.setFontSize(26);
      doc.text(40, 35, 'Laporan Transaksi So-Ping');


      doc.autoTable({
        html: '#table_pdf',
        margin: {
          top: 60,
          right: 40,
          bottom: 40,
          left: 40
        }
      });
      doc.save('Laporan_Transaksi_So-Ping.pdf');
    }
  </script>
</body>

</html>