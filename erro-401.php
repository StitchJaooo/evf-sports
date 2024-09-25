<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Erro</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />
    <style>

      .container, .login-container{
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .container {
        width: 100vw;
        height: 95.8vh;
        padding: 20px;
        font-family: "OpenSauceRegular";
        background-image: url("assets/background.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: start;
      }

      .login-container {
        flex-direction: column;
        height: 35vh;
        padding: 20px;
        width: 30%;
        border: 1px solid #cae8ff33;
        border-radius: 5px;
        background: #00294910;
        backdrop-filter: blur(8px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 0 10px;
      }

      .login-container h1, 
      .login-container h2{
        text-align: center;
        margin-bottom: 20px;
      }

      .login-container .flat,
      .register-container .flat {
        font-size: 1rem;
        padding: 10px;
        border-radius: 18px;
        margin: 22px 0;
      }

      .login-container .flat:hover,
      .register-container .flat:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 10px 1px #233dff;
      }

      ion-icon{
        font-size: 3rem;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="login-container">
        <h1>401 - Não Autorizado</h1>
        <p>Você não pode acessar essa página porque não está logado.</p>
        <p><ion-icon name="close-circle"></ion-icon></p>
        <a href="login.php">
          <button class="flat">Entrar</button>
        </a>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  </body>
</html>
