<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "almacen";


$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$nombre = "";
$material = "";
$numero = "";
$fecha = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET["id"])){
        header("location: index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM peticion WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: index.php");
        exit;
    }

    $nombre = $row["nombre"];
    $material = $row["material"];
    $numero = $row["numero"];
    $fecha = $row["fecha"];
}
else{
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $material = $_POST["material"];
    $numero = $_POST["numero"];
    $fecha = $_POST["fecha"];

    do{
        if (empty($id) || empty($nombre) || empty($material) || empty($numero) || empty($fecha) ){
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE peticion" . 
       "SET nombre = '$nombre', material = '$material', numero = '$numero', fecha = '$fecha' " . 
       "WHERE id = $id";

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalido: " . $connection->error;
            break;
        }

        $successMessage = "Peticion creada";

        header("location: index.php");
        exit;

    }while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equipv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recursos</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nueva peticion</h2>

        <?php
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Material</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="material" value="<?php echo $material;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Numero</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="numero" value="<?php echo $numero;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Fecha</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fecha" value="<?php echo $fecha;?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class ='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-sucess alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                <div class="offset-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>