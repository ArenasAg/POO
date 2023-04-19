<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Home</title>
</head>
<body class="bg-secondary">
    <div class="d-flex align-items-center min-vh-100">
        <div class="container mw-100">
            <div class="row">
                <div class="col-md-3 mx-auto border shadow-lg p-3 mb-5 bg-body rounded">
                    <fieldset>
                        <div class="text-center">
                            <label class="text-primary h1 p-3">School</label>
                        </div>
                        <?php 
                            session_start();
                            if(isset($_SESSION['admin'])) { ?>
                                <script>
                                    if (!localStorage.getItem('messageAdmin')) {
                                        Swal.fire(
                                            '¡Welcome back Admin!',
                                            '',
                                            'success'
                                        );
                                    }
                                    localStorage.setItem('messageAdmin', true);
                                </script>

                                <div class="p-1 text-center">
                                    <a href="Insert.php" class="btn btn-primary btn-lg w-50">Insert Student</a>
                                </div>

                                <div class="p-1 text-center">
                                    <a href="Read.php" class="btn btn-primary btn-lg w-50">Search Student</a>
                                </div>
                                
                        <?php }else if(isset($_SESSION['normal'])) { ?>
                                <script>
                                    if (!localStorage.getItem('messageUser')) {
                                        Swal.fire(
                                            '¡Welcome back User!',
                                            '',
                                            'success'
                                        );
                                    }
                                    localStorage.setItem('messageUser', true);
                                </script>
                                <div class="p-1 text-center">
                                    <a href="Read.php" class="btn btn-primary btn-lg w-50">View Students</a>
                                </div>

                        <?php }else{
                                    header("Location: Index.php");
                                }?>
                        <div class="p-1 text-center">
                            <button class="btn btn-primary btn-lg w-50" onclick="sign_off()">Sign Off</button>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sign_off(){
            $.ajax({
                url: 'session/Session.php',
                method: 'POST',
                success: function(response) {
                    let timerInterval
                    Swal.fire({
                        icon: 'success',
                        title: 'Sign Off!',
                        html: 'Sign off in <b></b>.',
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
                            window.location.href = 'Index.php';
                        }
                    })
                    
                }
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>