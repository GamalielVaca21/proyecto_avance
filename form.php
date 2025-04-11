<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equipv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recursos</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/form.css">
</head>
<body>
  <div class="container my-5">
      <h2>Solicitud</h2>
      <a class="btn btn-primary" href="/myshop/create.php" role="button">Nueva peticion</a>
      <br>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Material</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>Fecha</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "almacen";

            $connection = new mysqli($servername, $username, $password, $database);

            if($connection->connect_error){
              die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM peticiones";
            $result = $connection->query($sql);

            if(!$result){
              die("Invalid query: " . $connection->error);
            }

            while($row = $result->fetch_assoc()) {
              echo "
                <tr>
                  <td>$row[id_material]</td>
                  <td>$row[material]</td>
                  <td>$row[cantidad]</td>
                  <td>$row[imagen]</td>
                  <td>$row[fecha]</td>
                  <td>
                    <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Editar</a>
                    <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Borrar</a>
                  </td>
                </tr>
                ";
            }
          ?>
        </tbody>
      </table>
  </div>
</body>
</html>