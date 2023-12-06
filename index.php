<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
    body{
        background-color: #f2f2f2;
    }
    .login{
        width: 100%;
        height: 100vh;
        align-items: center;
        justify-content: center;
        display: flex;
    }

</style>
</head>
<body>
<div class="login">
<div class="container">
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
        <div class="card">
            <div class="card-body">
                <h3>Acesso Restrito</h3>

            </div>
            <div class="card-body">
                <form action="login.php" method="POST">
                    <div>
                        <div class="mb-3">
                            <label>Usuário</label>
                            <input type="text" name="nome" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>Senha</label>
                            <input type="password" name="senha" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>