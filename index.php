<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="./ico/favicon.ico" />
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <script src="./js/index.js?v=<?php echo time(); ?>" defer></script>
    <script src="https://kit.fontawesome.com/5906fc9277.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-analytics.js"></script>

    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyB3XcsCPohlhAoyCf_c7_04RCA_Aeybokw",
            authDomain: "vgdesk-26a04.firebaseapp.com",
            projectId: "vgdesk-26a04",
            storageBucket: "vgdesk-26a04.appspot.com",
            messagingSenderId: "804428766855",
            appId: "1:804428766855:web:96e3e5d029da054978e222",
            measurementId: "G-9BPS4J5JZ0"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
    </script>

    <header>
        <h1>VG Desk</h1>
    </header>
    <main>
        <form>
            <section class="loginame">
                <span>login</span>
            </section>

            <section class="inputs-container">
                <input type="email" placeholder="usuário" id="field-user">

                <div class="password-container">
                    <input type="password" id="field-password" class="field-password" placeholder="senha">
                    <i class="far fa-eye" id="eye" onclick="showPassword()"></i>
                    <i class="far fa-eye-slash" id="eye-slash" onclick="showPassword()"></i>
                </div>
            </section>

            <section class="password-infos">
                <div>
                    <input type="checkbox">
                    <span>Lembrar senha?</span>
                </div>
                <a href="#">Esqueceu a senha?</a>
            </section>

            <button id="btn-login">Entrar</button>

        </form>
    </main>
</body>

</html>