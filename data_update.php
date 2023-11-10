<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

@include 'config.php';

$nim = $_GET['edit'];

if(isset($_POST['update_data'])){

    $nim = $_POST['nim'];
    $nm_mhs = $_POST['nm_mhs'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $agama = $_POST['agama'];
    $gender = $_POST['gender'];

    if(empty($nim) || empty($nm_mhs) || empty($alamat) || empty($telp) || empty($agama) || empty($gender) ){
        $message[] = 'please fill out all data';
    }else{
        $update_data = "UPDATE mahasiswa SET nim='$nim', nm_mhs='$nm_mhs', alamat='$alamat', telp='$telp', agama='$agama', gender='$gender' WHERE nim = $nim ";
        $upload = mysqli_query($conn,$update_data);
        var_dump($upload);
        if($upload){
            header('location:index.php');
            exit;

        }else{
            echo "Error: " . mysqli_error($conn);

        }
    }

};

var_dump($_POST);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome"> -->

    <link rel="stylesheet" href="style.css">
    <title>Update your data</title>

</head>
<body>
    
    <?php

    if(isset($message)){
        foreach($message as $message){
            echo '<span class="message">'.$message.'</span>';
        }
    }

    ?>

    <div class="container">

    <div class="form-container centered">

            <?php
            

            $select = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = $nim");
            while($row = mysqli_fetch_assoc($select)){

            
            
            
            ?>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Update Data</h3>
            
            <div class="box">
                <label for="nim">NIM</label>
                <input type="number" placeholder="Enter your NIM" name="nim" value="<?php echo $row['nim']; ?>" required>
                
            </div>

            <div class="box">
                <label for="nm_mhs">Full Name</label>
                <input type="text" placeholder="Enter full name" name="nm_mhs" value="<?php echo $row['nm_mhs']; ?>" required>

            </div>
            
            <div class="box">
                <label for="alamat">Address</label>
                <textarea required name="alamat" placeholder="Enter your address" value="<?php echo $row['alamat']; ?>"  required></textarea>

            </div>
            
            <div class="box">
                <label for="telp">Phone Number</label>
                <input type="number" placeholder="Enter your phone number" name="telp" value="<?php echo $row['telp']; ?>" required>

            </div>

            <div class="box">
                <label for="agama">Religion</label>
                <select name="agama" id="dropdown" required>
                    <option value="">Select Here</option>
                    <option value="islam" <?php if($row['agama'] == 'islam') echo 'selected'; ?>>Islam</option>
                    <option value="kristen protestan" <?php if($row['agama'] == 'kristen protestan') echo 'selected'; ?>>Kristen Protestan</option>
                    <option value="kristen katolik" <?php if($row['agama'] == 'kristen katolik') echo 'selected'; ?>>Kristen Katholik</option>
                    <option value="buddha" <?php if($row['agama'] == 'buddha') echo 'selected'; ?>>Buddha</option>
                    <option value="hindu" <?php if($row['agama'] == 'hindu') echo 'selected'; ?>>Hindu</option>
                    <option value="konghucu" <?php if($row['agama'] == 'konghucu') echo 'selected'; ?>>Khonghucu</option>
                    <option value="other" <?php if($row['agama'] == 'other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            
            <div class="box">

                <span class="gender-title">Gender</span>
                <div class="gender-category">
                    <input class="checkbox" type="radio" name="gender" value="male" <?php if($row['gender'] == 'male') echo 'checked'; ?> required>
                    <label for="male">Male</label>
                    <input class="checkbox" type="radio" name="gender" value="female" <?php if($row['gender'] == 'female') echo 'checked'; ?> required>
                    <label for="female">Female</label>
    
                </div>
            </div>

            <input type="submit" class="btn" name="update_data" value="update data">
            <a href="index.php" class="btn">go back</a>


            </form>

            <?php }; ?>
       </div>

    </div>
    
</body>
</html>