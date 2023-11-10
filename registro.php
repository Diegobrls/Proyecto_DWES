<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Registro</h2>

                <form method="POST" action="register.php">
                    <div class="form-group">
                        <label for="nomUsu">Nombre de usuario:</label>
                        <input type="text"  id="nomUsu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email"  id="correo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cont">Contraseña:</label>
                        <input type="password" id="cont" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmarCont">Repetir contraseña:</label>
                        <input type="password" id="confirmarCont" class="form-control" required>
                    </div>
                    <input type="submit" value="Registrarse" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
