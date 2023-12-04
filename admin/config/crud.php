<?php
    //panggil koneksi database
    include "database.php";

    if(isset($_POST['bt_addK'])) {
        //persiapan simpan data baru
        $add = mysqli_query($database, "INSERT INTO categories (`category_name`) VALUES ('$_POST[tc_name]')");
        
        //uji jika simpan data sukses
        if($add){
            echo"<script>
                alert('Simpan data Kategori berhasil!');
                document.location='../kategori.php'; 
                </script>";
        } else {
            echo"<script>
            alert('Simpan data Kategori Gagal!');
            document.location='../kategori.php';
            </script>";
        } 
    }

    if(isset($_POST['bt_editK'])) {
        //persiapan edit data 
        $edit = mysqli_query($database, "UPDATE categories SET `category_name`='$_POST[tc_name]'
        WHERE `category_id` = '$_POST[tc_id]'
        ");

        if($edit){
            echo"<script>
                alert('Edit data Kategori berhasil!');
                document.location='../kategori.php';
                </script>";
        } else {
            echo"<script>
            alert('Edit data Kategori gagal!');
            document.location='../kategori.php';
            </script>";
        }          
        
    }

     if(isset($_POST['bt_deleteK'])) {
        //persiapan delete data 
        mysqli_query($database, "SET FOREIGN_KEY_CHECKS=0");
        mysqli_query($database, "DELETE FROM products WHERE `category_id` = '$_POST[tc_id]'");
        $delete = mysqli_query($database, "DELETE FROM categories WHERE `category_id` = '$_POST[tc_id]'");
        mysqli_query($database, "SET FOREIGN_KEY_CHECKS=1");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Hapus data Kategori berhasil!');
                document.location='../kategori.php';
                </script>";
        } else {
            echo"<script>
            alert('Hapus data Kategori gagal!');
            document.location='../kategori.php';
            </script>";
        }          
    }
    error_reporting(0);
    mysqli_query($database,"UPDATE products SET categories=(SELECT name from categories WHERE products.category_id=category_id)");
?>