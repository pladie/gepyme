<?php
session_start();
require './database.php';

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
//$db = mysqli_connect('192.168.33.80', 'gepyme', 'gepyme', 'Sondeos.13');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  //$email = mysqli_real_escape_string($db, $_POST['email']);
  //$password_1 = mysqli_real_escape_string($db, $_POST['password']);
  //$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $user_check_query = "SELECT * FROM users WHERE usunombre='$username' OR usumail='$email' LIMIT 1";

  $q = $pdo->prepare($user_check_query);
  $q->execute(array($_SESSION['username']));
  $user  = $q->fetch(PDO::FETCH_ASSOC);
  
  Database::disconnect();
  
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['usunombre'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['usumail'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO users (usunombre, usumail, usuclave) VALUES(?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($username, $email, $password));
    
    $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array('ALTA->USUARIO',$username,'Solicitud de alta de usuario'));
             
    Database::disconnect();

  	$_SESSION['usunombre'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
    //$username = mysqli_real_escape_string($db, $_POST['username']);
    //$password = mysqli_real_escape_string($db, $_POST['password']);
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    if (empty($username)) {
        array_push($errors, "El campo Nombre no puede estar vacio");
    }
    if (empty($password)) {
        array_push($errors, "El campo Clave no puede estar vacio");
    }
  
    if (count($errors) == 0) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $password = md5($password);
        $sql = "SELECT * FROM users WHERE usunombre='$username' AND usuclave='$password' AND usuestado = 1";
        $q = $pdo->prepare($sql);
        $q -> execute();
        $cant = $q -> rowCount();
        
        //$results = mysqli_query($db, $query);
        //$user = mysqli_fetch_assoc($results);
        if ( $cant == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: home.php');
        }else {
            if ($cant == 0)
              array_push($errors, "Usuario no habilitado en el sistema");
            else
              array_push($errors, "Wrong username/password combination"+ $cant);
        }
    }
}
?>