<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loguin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container-fluid">
        <div id="login-row" class="row">
            <div id="image-column" class="col-md-6">
                <div class="bike">
                    <div class="bike__bike">
                        <div class="bike__wheel">
                        <div class="bike__needle"></div>
                        <div class="bike__needle"></div>
                        <div class="bike__needle"></div>
                    </div>
                    <div class="bike__wheel">
                        <div class="bike__needle"></div>
                        <div class="bike__needle"></div>
                        <div class="bike__needle"></div>    
                    </div>
                    <div class="bike__down-tube"></div>
                    <div class="bike__tubes">
                        <div class="bike__chain"></div>
                        <div class="bike__seat-stays"></div>
                        <div class="bike__chain-stays"></div>
                        <div class="bike__seat-tube"></div>
                        <div class="bike__star">
                            <div class="bike__pedal"></div>    
                        </div>
                        <div class="bike__seat"></div>    
                    </div>
                        <div class="bike__top-tube"></div>
                        <div class="bike__fo"></div>
                        <div class="bike__head-tube"></div>
                        <div class="bike__helm"></div>
                        <div class="bike__lock"></div>    
                    </div>
                    <div class="bike__man">
                        <div class="bike__arm">
                            <div class="bike__forearm">
                                <div class="bike__hand"></div>    
                            </div>
                            <div class="bike__sleeve"></div>    
                        </div>
                        <div class="bike__back-leg">
                            <div class="bike__shin">
                                <div class="bike__skin"></div>
                                <div class="bike__ked"></div>    
                            </div>    
                        </div>
                        <div class="bike__butt"></div>
                        <div class="bike__front-leg">
                            <div class="bike__shin">
                                <div class="bike__skin"></div>
                                <div class="bike__ked"></div>    
                            </div>    
                        </div>
                        <div class="bike__shirt">
                        <div class="bike__collar"></div>    
                        </div>
                        <div class="bike__arm">
                        <div class="bike__forearm">
                            <div class="bike__hand"></div>    
                        </div>
                        <div class="bike__sleeve"></div>    
                        </div>
                        <div class="bike__head">
                        <div class="bike__eye"></div>
                        <div class="bike__eye"></div>
                        <div class="bike__whisker"></div>
                        <div class="bike__nose"></div>
                        <div class="bike__month"></div>
                        <div class="bike__whisker"></div>
                        <div class="bike__cap">
                            <div class="bike__peak">
                            <div class="bike__peak-parts"></div>   
                            </div>    
                        </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div id="login-column" class="col-md-6">
                <div id="div" class="col-md-9 mx-auto p-3 position-relative">
                    <form id="form" name="form" method="post" action="functions.php">
                        <fieldset>
                            <?php if (isset($_COOKIE['login'])) {?>
                                <div class="text-center">
                                    <label class="text-primary h1 p-3">Sign off</label>
                                </div>
                                <div id="14" class="p-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" name="sign_off">Sign off</button>
                                </div>
                            <?php }else{ ?>
                                <div class="text-center">
                                    <label class="text-primary h1 p-3">Login</label>
                                </div>
                                <p class="text-center fs-3 text-muted">Enter your credentials to access:</p>
                                <div class="mt-3">
                                    <input autocomplete="off" id="username" name="username" type="text" placeholder="Username" class="form-control rounded-pill" required>
                                </div>
                                <div class="mt-3">
                                    <input autocomplete="off" id="password" name="password" type="password" placeholder="Password" class="form-control rounded-pill" required>
                                </div>
                                <div id="14" class="p-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>
                                </div>
                            <?php } ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php if (isset($_COOKIE['error'])) {?>
                setTimeout(function() {
                    Swal.fire({
                        title:'¡Username does not exist!',
                        text:'',
                        icon:'error',
                        
                        background: 'rgba(0, 0, 0, 0.5)',
                        customClass: {
                            container: 'my-custom-alert',
                            title: 'my-custom-title',
                            content: 'my-custom-content',
                            confirmButton: 'my-custom-button',
                        },
                    });
                    document.cookie = 'error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                },100);

        <?php }else if (isset($_COOKIE['login'])){ ?>
                setTimeout(function() {
                    Swal.fire(
                        '¡Login successful!',
                        '',
                        'success'
                    )
                    document.cookie = 'login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                },100);
        <?php }else if (isset($_COOKIE['sign_off'])){ ?>
                setTimeout(function() {
                    Swal.fire(
                        '¡Closed session!',
                        'Good Bye',
                        'success'
                    )
                    document.cookie = 'sign_off=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                },100);
        <?php } ?>
    </script>
</body>
</html>