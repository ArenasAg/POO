<?php
/*Hay dos USUARIOS:
    1. username:root
       password:root
       description: Este usuario tiene permisos de administrador asi que puede hacer todo el CRUD

    2. username:user
       password:user
       description: Este usuario tiene permisos normales asi que solo puede hacer el READ
*/
session_start(); 
if(isset($_SESSION['admin']) || isset($_SESSION['normal'])) {
    header('Location: Home.php');
}else{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>Login</title>
    </head>
    <body>
        <div class="d-flex align-items-center min-vh-100">
            <div class="container mw-100">
                <div class="row">
                    <div class="col-md-3 mx-auto border shadow-lg p-3 mb-5 bg-body rounded">
                        <form id="form" name="form" method="post" action="process/Functions.php">
                            <fieldset>
                                <div class="text-center">
                                    <label class="text-primary h1 p-3">Login</label>
                                </div>

                                <div class="mt-3 border">
                                    <input autocomplete="off" id="username" name="username" type="text" placeholder="Username" class="form-control" required>
                                </div>

                                <div class="mt-3 border">
                                    <input autocomplete="off" id="password" name="password" type="password" placeholder="Password" class="form-control" required>
                                </div>

                                <div class="mt-3 d-none">
                                    <input id="submitLogin" name="submitLogin" >
                                </div>

                                <div id="14" class="p-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg w-49" onclick="log_in()">Login</button>
                                </div>

                            </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function log_in(){
            var formulario = document.getElementById('form');
            if(document.getElementById('username').value == "" 
            || document.getElementById('password').value == ""){
                formulario.addEventListener('submit', (event) => {
                    event.preventDefault();
                });
            }else{
                $.ajax({
                    url: 'session/Session.php',
                    method: 'POST',
                    success: function(response) {
                        let timerInterval
                        Swal.fire({
                            icon: 'success',
                            title: 'Log in!',
                            html: 'Log in <b></b>.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                                }, 100)
                        },willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                formulario.submit();
                            }
                        })
                        
                    }
                });
            }
        }

        if (localStorage.getItem('messageAdmin')) {
            localStorage.removeItem('messageAdmin');
        }else if (localStorage.getItem('messageUser')) {
            localStorage.removeItem('messageUser');
        }

        <?php if (isset($_COOKIE['errorLogin'])) {?>
            setTimeout(function() {
                Swal.fire(
                    '¡Username does not exist!',
                    '',
                    'error'
                )
                document.cookie = 'errorLogin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            },100);
        <?php } ?>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </html>
<?php } ?>