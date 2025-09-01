<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>LOGIN CON SESIONES</title>
</head>

<body>
    <center> <br>
        <br>
        <br>
        <br>
        <form action="logica/loguear.php" method="POST">
            <input type="text" name="usuario" placeholder="Digite su usuario">
            <br><br>
            <input type="password" name="clave" placeholder="digite clave">
            <br><br>
            <button type="submit"> ENTRAR</button>
        </form>
    </center>
</body>

</html>