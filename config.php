<?php

$conn = mysqli_connect('localhost', 'root','', 'akademik');

//LOGIN

if(isset($_POST['login'])){
    $username = $_POST['usn'];
    $password = $_POST['psw'];
}

$cekuser = mysqli_query($conn, "select * from multilevel where username= '$username' and password='$password'");

$hitung = mysqli_num_rows($cekuser);

if($hitung>0){
    //kalo data ditemukan
    $ambildatarole = mysqli_fetch_array($cekuser);
    $role = $ambildatarole['role'];

    if($role == 'admin'){
        //kalo dia admin

        $_SESSION['log'] = 'logged';
        $_SESSION['role'] = 'admin';
        header('location:admin.php');
    }else{
        $_SESSION['log'] = 'logged';
        $_SESSION['role'] = 'user';
        header('location:user.php');
        
    }
}else{
    //kalo TIDAK DITEMUKAN
    // echo 'data gakda';
}


?>