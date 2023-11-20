<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>

                <form method="POST" action="./database/login.php">
                    <div class="form-group">
                        <label for="nomUsu">Nombre de usuario:</label>
                        <input type="text" name="nomUsu" id="nomUsu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cont">Contraseña:</label>
                        <input type="password" name="cont" id="cont" class="form-control" required>
                    </div>
                    <input type="submit" value="Ingresar" class="btn btn-primary btn-block">
                </form>
                <br>
                <a href="registro.php" class="btn btn-primary">Ir al registro</a>
            </div>
        </div>
    </div>
</body>
</html>
