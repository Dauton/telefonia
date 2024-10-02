<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Almoxarifado IDL</title>
    <link rel="shortcut icon" type="imagex/png" href="img/id-logo-browser.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="desciption" content="Controle de requisição de insumos">
    <meta name="author" content="Desenvolvedor - Dauton Pereira Félix, Analista de TI - 2024">
    <meta name="author" content="Apoio - Alexandre Toffanin, Analista de Controladoria - 2024">
    <meta name="theme-color" content="#0088ff">

    <link rel='stylesheet' type='text/css' media='screen' href='css/login.css'>
    <link rel='stylesheet' type='text/css' href='css/toastr.min.css'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/d8ed80570b.js" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <main class="principal">
        <section class="center">
            <article class="left-form">
                <h1>Olá!<br>
                    <h2>Seja muito bem-vindo(a)!</h2>
                    <br>
                    <p>Entre com seu usuário e senha e tenha acesso ao sistema de Controle e Requisição de Insumos!</p>
                    <img src="img/id-logo-branco-extenso.png">
            </article>
            <form method="post" action="src/config/validacao.php">
                <img src="img/sistema-logo.png">
                <label>
                    <p>Usuário<font color="red">*</font></p>
                    <div>
                        <i class="fa-solid fa-user"></i><input type="text" name="usuario" id="usuario" placeholder="Insira seu usuário" required>
                    </div>
                </label>
                <label>
                    <p>Senha<font color="red">*</font></p>
                    <div>
                        <i class="fa-solid fa-lock"></i><input type="password" name="senha" id="senha" placeholder="Insira sua senha" required>
                        <i id="mostrar-senha" class="fa-solid fa-eye"></i>
                        <i id="ocultar-senha" class="fa-solid fa-eye-slash" style="display: none;"></i>
                    </div>
                </label>
                <button type="submit">Entrar</button>
                <p>Não possui usuário?<br>Verifique a disponibilidade com um administrador.</p>
                <img src="img/id-logo-extenso.png" id="id-logo">
            </form>
        </section>
        <footer class="rodape">
            <small>Inventário de Telefonia - ID DO BRASIL LOGISTICA LTDA - 2024</small>
        </footer>
    </main>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>