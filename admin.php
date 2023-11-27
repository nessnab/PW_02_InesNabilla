<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

@include 'config.php';

if(isset($_POST['add_data'])){

    $nim = $_POST['nim'];
    $nm_mhs = $_POST['nm_mhs'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $agama = $_POST['agama'];
    $gender = $_POST['gender'];

    if(empty($nim) || empty($nm_mhs) || empty($alamat) || empty($telp) || empty($agama) || empty($gender) ){
        $message[] = 'please fill out all data';
    }else{
        $insert = "INSERT INTO mahasiswa(nim, nm_mhs, alamat, telp, agama, gender) VALUES('$nim','$nm_mhs', '$alamat', '$telp', '$agama', '$gender')";
        $upload = mysqli_query($conn,$insert);
        if($upload){
            $message[] = 'Your Data Added Succesfully!';
        }else{
            $message[] = 'Failed to Add Your Data';

        }
    }

};

if(isset($_GET['delete'])){
    $nim = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = $nim");
    header('location:admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="style.css">
    <title>Admin Page Data Mahasiswa CRUD</title>
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
       <div class="form-container">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Input Data Mahasiswa</h3>
            
            <div class="box">
                <label for="nim">NIM</label>
                <input type="number" placeholder="Enter your NIM" name="nim" required>
                
            </div>

            <div class="box">
                <label for="nm_mhs">Full Name</label>
                <input type="text" placeholder="Enter full name" name="nm_mhs" required>

            </div>
            
            <div class="box">
                <label for="alamat">Address</label>
                <textarea required name="alamat" placeholder="Enter your address"  required></textarea>

            </div>
            
            <div class="box">
                <label for="telp">Phone Number</label>
                <input type="number" placeholder="Enter your phone number" name="telp" required>

            </div>

            <div class="box">
                <label for="agama">Religion</label>
                <select name="agama" id="dropdown" required>
                    <option value="">Select Here</option>
                    <option value="islam">Islam</option>
                    <option value="kristen protestan">Kristen Protestan</option>
                    <option value="kristen katolik">Kristen Katholik</option>
                    <option value="buddha">Buddha</option>
                    <option value="hindu">Hindu</option>
                    <option value="konghucu">Khonghucu</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="box">

                <span class="gender-title">Gender</span>
                <div class="gender-category">
                    <input class="checkbox" type="radio" name="gender" value="male" required>
                    <label for="male">Male</label>
                    <input class="checkbox" type="radio" name="gender" value="female" required>
                    <label for="female">Female</label>
    
                </div>
            </div>

            <input type="submit" class="btn" name="add_data" value="add data">


            </form>
       </div>

       <?php
       
       $select = mysqli_query($conn, "SELECT * FROM mahasiswa");

       ?>

       <div class="table-display">

       <table class="data-display">

            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Religion</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php while($row = mysqli_fetch_assoc($select)){  ?>

                <tr>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['nm_mhs']; ?></td>
                    <td><?php echo $row['telp']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['agama']; ?></td>
                    <td>
                        <a href="data_update.php?edit=<?php echo $row['nim']; ?>" class="btn">edit </a>
                        <a href="admin.php?delete=<?php echo $row['nim']; ?>" class="btn">delete </a>
                    </td>
                </tr>
                
                <?php }; ?>
                
            </table>
            
        </div>
        
        <a href="index.php?logout" class="btn logout">Log Out </a>
    </div>
</body>
</html>
