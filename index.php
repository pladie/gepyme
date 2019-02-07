<!--<?php/*
// Inicializo la sesion.
session_start();
 
// Si pudo loguearse, ingresa al sistema
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    session_unset();     // limpio los datos de la sesion
    session_destroy();   // borra los datos almacenados de la session.
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // Actualizo la ultima actividad
 
// Leo los parametros de conexion de la base de datos.
require_once "database.php";
$pdo = Database::connect();
 
$username = $password = "";
$username_err = $password_err = "";
 
// Proceso datos de ingreso
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Valido los datos ingresados.
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, ingrese su clave.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Comparo los datos ingresados con los leidos de la base.
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT usuId,usuNombre, usuClave FROM usuarios WHERE usuNombre = :username";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["usuNombre"];
                        $hashed_password = $row["usuClave"];
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: sessionVariables.php");
                        } else{
                            $password_err = "La clave no es la correcta.";
                        }
                    }
                } else{
                    $username_err = "El usuario no existe.";
                }
            } else{
                echo "Por favor intente nuevamente.";
            }
        }
        unset($stmt);
    }
    unset($pdo);
    $pdo = Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GePyME</title>
    <link href="./css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div align="center">
        <h2>Bienvenido a GePyME</h2>
        <!--<p>Por favor, valide sus datos para ingresar al sistema.</p>-- >
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table class="table" >
        		<tr align="left"><th>Usuario :</th><th><input name="username" type="text" placeholder="Usuario" value="<?php echo $username; ?>"></th></tr>             
           	<tr align="left"><th>Clave   :</th><th><input name="password"   type="password" placeholder="Clave"   value="<?php echo !empty($mod)?$mod:'';?>"></th></tr>
		      <tr><th colspan="2"><input type="submit" value="Ingresar"></th></tr>
        </table>

        </form>
    </div>
</body>
</html>-->
<?php header("location: home.php"); ?>