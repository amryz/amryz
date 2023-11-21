<?php

//panggil oneksi database
include "koneksi.php";
session_start();

    //uji jika tombol simpan diklik
    if(isset($_POST['bsimpan'])){

        //ambil data yang diparsing dari form sebelumnya
    $nis      = $_POST['tnis'];
    $nama     = $_POST['tnama'];
    $jurusan  = $_POST['tjurusan'];
    $alamat   = $_POST['talamat'];
    $telp    = $_POST['ttelp'];

        //persiapan simpan data baru
        $simpan = mysqli_query($koneksi, "INSERT INTO siswa (nis, nama, jurusan, alamat, telp)
                                          VALUES ('$_POST[tnis]',
                                                  '$_POST[tnama]',
                                                  '$_POST[tjurusan]',
                                                  '$_POST[talamat]',
                                                  '$_POST[ttelp]') ");

            //set session sukses
    $_SESSION["sukses"] = 'Data Berhasil Disimpan';
    
    //redirect ke halaman index.php
    header('Location: index.php');   
}

 //uji jika tombol ubah diklik
 if(isset($_POST['bubah'])){

    //persiapan ubah data baru
    $ubah = mysqli_query($koneksi, "UPDATE siswa SET
                                                    nis = '$_POST[tnis]',
                                                    nama = '$_POST[tnama]',
                                                    jurusan = '$_POST[tjurusan]',
                                                    alamat = '$_POST[talamat]',
                                                    telp = '$_POST[ttelp]'
                                                     WHERE id_siswa = '$_POST[id_siswa]'
                                                            ");

        //JIKA UBAH SUKSES
    $_SESSION["sukses"] = 'Data Berhasil Di Update';
    
    //redirect ke halaman index.php
    header('Location: index.php');

}

//panggil koneksi database
include "koneksi.php";

    //uji jika tombol hapus diklik
    if(isset($_POST['bhapus'])){

        //persiapan simpan data baru
        $hapus = mysqli_query($koneksi, "DELETE FROM siswa
                                         WHERE id_siswa= '$_POST[id_siswa]'");


            //JIKA SIMPAN SUKSES
            $_SESSION["sukses"] = 'Data Berhasil Di Hapus ';
    
            //redirect ke halaman index.php
            header('Location: index.php');
}
?>