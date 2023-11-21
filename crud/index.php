<?php
 //panggil database
include "koneksi.php";
session_start();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
  </head>
  <body>
     <div class="container">
        <div class="mt-5">
            <h3 class="alert alert-success  text-center">DATA MAHASISWA</h3>
        </div>
        <div class="card mt-3">
            <div class="card-header bg-secondary text-white">
                Data Siswa 
            </div>
            <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="ri-add-fill" ></i>Tambah Data
                </button>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <thead class="table-dark">
                                <th>NO</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th class="col d-flex justify-content-center">Aksi</th>
                            </thead>
                        </tr>
                        <?php
                        
                        //persiapan menampilkan data
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY id_siswa DESC");
                            while ($data = mysqli_fetch_array($tampil)) :

                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nis']?></td>
                            <td><?= $data['nama']?></td>
                            <td><?= $data['jurusan']?></td>
                            <td><?= $data['alamat']?></td>
                            <td><?= $data['telp']?></td>
                            <td>
                                <div class="row">
                                    <div class=" col d-flex justify-content-center">
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalLihat<?= $no ?>">Detail</a>
                                    </div>
                                    <div class=" col d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Update</a>
                                    </div>
                                    <div class=" col d-flex justify-content-center">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Delete</a>
                                    </div>
                                </div>
                            </td>
                         </tr>
                            <!--awal Modal ubah  -->
                    <div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                             <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">From Ubah Data Siswa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="aksi.php">
                                    <input type="hidden" name="id_siswa" value="<?=$data['id_siswa']?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">NIS</label>
                                            <input type="text" class="form-control" name="tnis" value="<?= $data['nis'] ?>" placeholder="Masukan Nis Anda !" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="tnama" value="<?= $data['nama'] ?>" placeholder="Masukan Nama Lengkap Anda !" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jurusan</label>
                                            <select class="form-select" name="tjurusan" required>
                                                <option value="<?= $data['jurusan'] ?>"><?= $data['jurusan'] ?></option>
                                                <option value="Teknik Otomotif">Teknik Otomotif</option>
                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                                <option value="Akuntansi">Akuntansi</option>
                                                <option value="Tata Boga">Tata Boga</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control" name="talamat" rows="3" required><?= $data['alamat'] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Telpon</label>
                                            <input type="text" class="form-control" name="ttelp" vaule="<?= $data['telp'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bubah">Update</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--akhir Modal ubah -->


                       <!--awal Modal Hapus  -->
                    <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                             <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi hapus data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="aksi.php">
                                    <input type="hidden" name="id_siswa" value="<?=$data['id_siswa']; ?>">
                                    <div class="modal-body">
                                        <h5 class="text-center"> Apakah anda yakin akan menghapus data ini?<br>
                                        <span class="text-danger"><?= $data['nis']?> - <?= $data['nama']?></span>
                                        </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bhapus">Ya, Hapus Aja</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Jangan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--akhir Modal Hapus -->
                    
                        <?php endwhile; ?>
                    </table>

                    <!--awal Modal tambah  -->
                    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                             <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">From Data Siswa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="aksi.php">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">NIS</label>
                                            <input type="text" class="form-control" name="tnis" placeholder="Masukan Nis Anda !">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="tnama" placeholder="Masukan Nama Lengkap Anda !">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jurusan</label>
                                            <select class="form-select" name="tjurusan">
                                                <option>Pilih Jurusan</option>
                                                <option value="Teknik Otomotif">Teknik Otomotif</option>
                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                                <option value="Akuntansi">Akuntansi</option>
                                                <option value="Tata Boga">Tata Boga</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control" name="talamat" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Telpon</label>
                                            <input type="number" class="form-control" name="ttelp">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--akhir Modal tambah  -->

                 </div>
         </div>
     </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php if(@$_SESSION['sukses']){ ?>
        <script>
            swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
        </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>
  </body>
</html>