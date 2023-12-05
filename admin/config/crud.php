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

    if(isset($_POST['bt_addP'])) {
        //persiapan simpan data baru
        $add = mysqli_query($database, "INSERT INTO products (`product_name`, `price`, `category_id`,
                            `created_at`, `tokopedia_link`, `shopee_link`, `description`) VALUES ('$_POST[tp_name]', 
                            '$_POST[tp_price]', '$_POST[tp_cat]', '$_POST[tp_date]', 
                            '$_POST[tp_linkT]', '$_POST[tp_linkS]', '$_POST[tp_desc]')");
        
        //uji jika simpan data sukses
        if($add){
            echo"<script>
                alert('Simpan data Produk berhasil!');
                document.location='../produk.php'; 
                </script>";
        } else {
            echo"<script>
            alert('Simpan data Produk Gagal!');
            document.location='../produk.php';
            </script>";
        } 
    }

    if(isset($_POST['bt_editP'])) {
        // Persiapan edit data 
        $edit = mysqli_query($database, "UPDATE products 
            SET 
            `product_name`='$_POST[tp_name]',
            `price`='$_POST[tp_price]',
            `category_id`='$_POST[tp_cat]',
            `created_at`='$_POST[tp_date]',
            `tokopedia_link`='$_POST[tp_linkT]',
            `shopee_link`='$_POST[tp_linkS]',
            `description`='$_POST[tp_desc]'
            WHERE `product_id` = '$_POST[tp_id]'
        ");

        if($edit){
            echo"<script>
                alert('Edit data Produk berhasil!');
                document.location='../produk.php';
                </script>";
        } else {
            echo"<script>
            alert('Edit data Produk gagal!');
            document.location='../produk.php';
            </script>";
        }          
    }

    if(isset($_POST['bt_deleteP'])) {
        //persiapan delete data 
        mysqli_query($database, "SET FOREIGN_KEY_CHECKS=0");
        mysqli_query($database, "DELETE FROM products WHERE `product_id` = '$_POST[tp_id]'");
        $delete = mysqli_query($database, "DELETE FROM product_images WHERE `product_id` = '$_POST[tp_id]'");
        mysqli_query($database, "SET FOREIGN_KEY_CHECKS=1");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Hapus data Produk berhasil!');
                document.location='../produk.php';
                </script>";
        } else {
            echo"<script>
            alert('Hapus data Produk gagal!');
            document.location='../produk.php';
            </script>";
        }          
    }
    
    if (isset($_POST['bt_addI'])) {
        if (isset($_FILES['tpi_ip']['name'])) {
            $files_name = $_FILES['tpi_ip']['name'];
            $img_order = $_POST['tpi_order'];
            $product_id = $_POST['tpi_pro'];
        
            // Set the destination path for the uploaded image
            $destination_path = '../assets/img/' . $files_name;
        
            // Check if the file does not exist in the destination path
            if (!file_exists($destination_path)) {
                // Move the uploaded file to the destination path
                if (move_uploaded_file($_FILES['tpi_ip']['tmp_name'], $destination_path)) {
                    // Use the destination path as the image path
                    $img_path = $destination_path;
        
                    // Query to save data to the database
                    $add = mysqli_query($database, "INSERT INTO product_images (`image_path`, `product_id`, `display_order`) VALUES ('$img_path', '$product_id', '$img_order')");
        
                    if ($add) {
                        echo"<script>
                        alert('Simpan data Gambar Produk berhasil!');
                        document.location='../gambar.php'; 
                        </script>";                    
                    } else {
                        echo"<script>
                        alert('Simpan data Banner gagal!');
                        document.location='../gambar.php'; 
                        </script>";  
                    }
                } else {
                    echo "Gagal! Terjadi kesalahan saat memindahkan file.";
                }
            } else {
                echo "Gagal! Ada file dengan nama $files_name.";
            }
        } else {
            echo "Error: File input 'tim_ip' not found.";
        }      
    }

    if (isset($_POST['bt_editI'])) {
        $tpi_id = $_POST['tpi_id'];
        $img_order = $_POST['tpi_order'];
        $product_id = $_POST['tpi_pro'];
    
        // Get the old image path
        $old_img_query = mysqli_query($database, "SELECT `image_path` FROM product_images WHERE `image_id`='$tpi_id'");
        $old_img_data = mysqli_fetch_assoc($old_img_query);
        $old_img_path = $old_img_data['image_path'];
    
        $updateQuery = "UPDATE product_images SET `display_order`='$img_order', `product_id`='$product_id'";
    
        // Check if a new image file is uploaded
        if (!empty($_FILES['tpi_ip']['name'])) {
            $destination_path = '../assets/img/' . $_FILES['tpi_ip']['name'];
    
            if (move_uploaded_file($_FILES['tpi_ip']['tmp_name'], $destination_path)) {
                $updateQuery .= ", `image_path`='$destination_path'";
    
                // Delete the old image file
                if (!empty($old_img_path) && file_exists($old_img_path)) {
                    unlink($old_img_path);
                }
            }
        }
    
        $updateQuery .= " WHERE `image_id`='$tpi_id'";
    
        $update = mysqli_query($database, $updateQuery);
    
        if ($update) {
            echo "<script>
                alert('Update data Gambar Produk berhasil!');
                document.location='../gambar.php'; 
            </script>";
        } else {
            echo "<script>
                alert('Update data Gambar Produk gagal!');
                document.location='../gambar.php'; 
            </script>";
        }
    }

    if(isset($_POST['bt_deleteI'])) {
        $delete = mysqli_query($database, "DELETE FROM product_images WHERE `image_id` = '$_POST[tpi_id]'");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Hapus data Gambar Produk berhasil!');
                document.location='../gambar.php';
                </script>";
        } else {
            echo"<script>
            alert('Hapus data Gambar Produk gagal!');
            document.location='../gambar.php';
            </script>";
        }          
    }

    if (isset($_POST['bt_addB'])) {
        if (isset($_FILES['tim_ip']['name'])) {
            $files_name = $_FILES['tim_ip']['name'];
            $img_title = $_POST['tim_title'];
        
            // Set the destination path for the uploaded image
            $destination_path = '../assets/img/' . $files_name;
        
            // Check if the file does not exist in the destination path
            if (!file_exists($destination_path)) {
                // Move the uploaded file to the destination path
                if (move_uploaded_file($_FILES['tim_ip']['tmp_name'], $destination_path)) {
                    // Use the destination path as the image path
                    $img_path = $destination_path;
        
                    // Query to save data to the database
                    $add = mysqli_query($database, "INSERT INTO image_banner (`image_path`, `image_title`) VALUES ('$img_path', '$img_title')");
        
                    if ($add) {
                        echo"<script>
                        alert('Simpan data Banner berhasil!');
                        document.location='../banner.php'; 
                        </script>";                    
                    } else {
                        echo"<script>
                        alert('Simpan data Banner gagal!');
                        document.location='../banner.php'; 
                        </script>";  
                    }
                } else {
                    echo "Gagal! Terjadi kesalahan saat memindahkan file.";
                }
            } else {
                echo "Gagal! Ada file dengan nama $files_name.";
            }
        } else {
            echo "Error: File input 'tim_ip' not found.";
        }     
    }
    
    if (isset($_POST['bt_editB'])) {
        $tim_id = $_POST['tim_id'];
        $img_title = $_POST['tim_title'];
    
        // Get the old image path
        $old_img_query = mysqli_query($database, "SELECT `image_path` FROM image_banner WHERE `image_id`='$tim_id'");
        $old_img_data = mysqli_fetch_assoc($old_img_query);
        $old_img_path = $old_img_data['image_path'];
    
        $updateQuery = "UPDATE image_banner SET `image_title`='$img_title'";
    
        // Check if a new image file is uploaded
        if (!empty($_FILES['tim_ip']['name'])) {
            $destination_path = '../assets/img/' . $_FILES['tim_ip']['name'];
    
            if (move_uploaded_file($_FILES['tim_ip']['tmp_name'], $destination_path)) {
                $updateQuery .= ", `image_path`='$destination_path'";
    
                // Delete the old image file
                if (!empty($old_img_path) && file_exists($old_img_path)) {
                    unlink($old_img_path);
                }
            }
        }
    
        $updateQuery .= " WHERE `image_id`='$tim_id'";
    
        $update = mysqli_query($database, $updateQuery);
    
        if ($update) {
            echo "<script>
                alert('Update data Banner berhasil!');
                document.location='../banner.php'; 
            </script>";
        } else {
            echo "<script>
                alert('Update data Banner gagal!');
                document.location='../banner.php'; 
            </script>";
        }
    }

    if(isset($_POST['bt_deleteB'])) {
        $delete = mysqli_query($database, "DELETE FROM image_banner WHERE `image_id` = '$_POST[tim_id]'");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Hapus data Banner berhasil!');
                document.location='../banner.php';
                </script>";
        } else {
            echo"<script>
            alert('Hapus data Banner gagal!');
            document.location='../banner.php';
            </script>";
        }          
    }
    error_reporting(0);
    mysqli_query($database,"UPDATE products SET categories=(SELECT name from categories WHERE products.category_id=category_id)");
?>