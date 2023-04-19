<?php
session_start(); 
if(isset($_SESSION['admin'])) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>Update</title>
    </head>
    <body class="bg-secondary">
        <?php if(isset($_POST['fname'])
            && isset($_POST['fsurname'])
            && isset($_POST['ssurname'])
            && isset($_POST['birth'])
            && isset($_POST['document'])
            && isset($_POST['group'])
            && isset($_POST['rfname'])
            && isset($_POST['rfsurname'])
            && isset($_POST['rssurname'])
            && isset($_POST['rdocument'])
            && isset($_POST['phone'])) { ?>
                <div class="d-flex align-items-center min-vh-100">
                    <div class="container mw-100">
                        <div class="row">
                            <div class="col-md-3 mx-auto border shadow-lg p-3 mb-5 bg-body rounded">
                                <form name="form" id="form" method="post" class="mt-100" action="process/Functions.php">
                                    <fieldset>
                                        <div id="ti" class="text-center">
                                            <label class="text-primary h1 p-3">Update Student</label>
                                        </div>

                                        <div class="d-none">
                                            <input id="id" name="id" type="number" value="<?php echo $_POST['id'] ?>">
                                        </div>
                                        
                                        <div id="1" class="mt-3 d-none border">
                                            <input id="rfname" name="rfname" type="text" placeholder="Full Name" class="form-control" value="<?php echo $_POST['rfname'] ?>" required>
                                        </div>

                                        <div id="2" class="mt-3 d-none border">
                                            <input id="rfsurname" name="rfsurname" type="text" placeholder="First Surname" class="form-control" value="<?php echo $_POST['rfsurname'] ?>" required>
                                        </div>

                                        <div id="3" class="mt-3 d-none border">
                                            <input id="rssurname" name="rssurname" type="text" placeholder="Second Surname" class="form-control" value="<?php echo $_POST['rssurname'] ?>" required>
                                        </div>

                                        <div id="4" class="mt-3 d-none border">
                                            <input id="rdocument" name="rdocument" type="number" placeholder="Document" class="form-control" value="<?php echo $_POST['rdocument'] ?>" required>
                                        </div>

                                        <div id="5" class="mt-3 d-none border">
                                            <input id="phone" name="phone" type="number" placeholder="Phone" class="form-control" value="<?php echo $_POST['phone'] ?>" required>
                                        </div>

                                        <div id="6" class="p-4 text-center d-none">
                                            <button type="button" class="btn btn-primary w-50" onclick="student()">Accept</button>
                                        </div>

                                        <div id="7" class="mt-3 border">
                                            <input id="fname" name="fname" type="text" placeholder="Full Name" class="form-control" value="<?php echo $_POST['fname'] ?>" required>
                                        </div>

                                        <div id="8" class="mt-3 border">
                                            <input id="fsurname" name="fsurname" type="text" placeholder="First Surname" class="form-control" value="<?php echo $_POST['fsurname'] ?>" required>
                                        </div>

                                        <div id="9" class="mt-3 border">
                                            <input id="ssurname" name="ssurname" type="text" placeholder="Second Surname" class="form-control" value="<?php echo $_POST['ssurname'] ?>" required>
                                        </div>

                                        <div id="10" class="mt-3 border">
                                            <input id="birth" name="birth" type="date" placeholder="Birthdate" class="form-control" value="<?php echo $_POST['birth'] ?>" required>
                                        </div>

                                        <div id="11" class="mt-3 border">
                                            <input id="document" name="document" type="number" placeholder="Document" class="form-control" value="<?php echo $_POST['document'] ?>" required>
                                        </div>

                                        <div id="12" class="mt-3 border">
                                            <select name="group" class="form-control" required>
                                                <option value="" disabled>Select Group</option>
                                                <option value="6-1" <?php if($_POST['group'] === "6-1"){?>selected<?php } ?> >6-1</option>
                                                <option value="6-2" <?php if($_POST['group'] === "6-2"){?>selected<?php } ?> >6-2</option>
                                                <option value="6-3" <?php if($_POST['group'] === "6-3"){?>selected<?php } ?> >6-3</option>
                                                <option value="7-1" <?php if($_POST['group'] === "7-1"){?>selected<?php } ?> >7-1</option>
                                                <option value="7-2" <?php if($_POST['group'] === "7-2"){?>selected<?php } ?> >7-2</option>
                                                <option value="7-3" <?php if($_POST['group'] === "7-3"){?>selected<?php } ?> >7-3</option>
                                            </select>
                                        </div>

                                        <div id="13" class="p-4 text-center">
                                            <button id="button" type="button" class="btn btn-primary w-50" onclick="responsible()">Responsible</button>
                                        </div>

                                        <div class="d-none">
                                            <input type="text" name='submitUpdate'>esgseg</input>
                                        </div>

                                        <div id="14" class="p-4 text-center">
                                        <a href="Read.php" class="btn btn-primary btn-lg w-49">Return</a>
                                            <button type="submit" class="btn btn-primary btn-lg w-49" onclick="campos()">Update</button>
                                        </div>

                                        <div id="message" class="text-center text-danger h5 d-none">
                                            <p>You must fill in all the fields "Responsible"</p>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{
                        setcookie("errorUpdate","true", time()+3600, "/");
                        header("Location: Read.php");
                    } ?>
        <script>
            function responsible() {
                document.getElementById("1").classList.remove("d-none");
                document.getElementById("2").classList.remove("d-none");
                document.getElementById("3").classList.remove("d-none");
                document.getElementById("4").classList.remove("d-none");
                document.getElementById("5").classList.remove("d-none");
                document.getElementById("6").classList.remove("d-none");

                document.getElementById("7").classList.add("d-none");
                document.getElementById("8").classList.add("d-none");
                document.getElementById("9").classList.add("d-none");
                document.getElementById("10").classList.add("d-none");
                document.getElementById("11").classList.add("d-none");
                document.getElementById("12").classList.add("d-none");
                document.getElementById("13").classList.add("d-none");
                document.getElementById("14").classList.add("d-none");
                document.getElementById("message").classList.add("d-none");

                document.getElementById("button").classList.remove("btn-danger");
                document.getElementById("button").classList.add("btn-primary");
            }

            function student() {
                document.getElementById("1").classList.add("d-none");
                document.getElementById("2").classList.add("d-none");
                document.getElementById("3").classList.add("d-none");
                document.getElementById("4").classList.add("d-none");
                document.getElementById("5").classList.add("d-none");
                document.getElementById("6").classList.add("d-none");

                document.getElementById("7").classList.remove("d-none");
                document.getElementById("8").classList.remove("d-none");
                document.getElementById("9").classList.remove("d-none");
                document.getElementById("10").classList.remove("d-none");
                document.getElementById("11").classList.remove("d-none");
                document.getElementById("12").classList.remove("d-none");
                document.getElementById("13").classList.remove("d-none");
                document.getElementById("14").classList.remove("d-none");
            }

            function campos() {
                if(document.getElementById("rfname").value.length == 0 || 
                document.getElementById("rfsurname").value.length == 0 || 
                document.getElementById("rssurname").value.length == 0 || 
                document.getElementById("rdocument").value.length == 0 || 
                document.getElementById("phone").value.length == 0){

                    document.getElementById("message").classList.remove("d-none");
                    document.getElementById("button").classList.remove("btn-primary");
                    document.getElementById("button").classList.add("btn-danger");

                }else if(document.getElementById("rdocument").value === document.getElementById("document").value){
                    alert("El documento del padre y el estudiante no pueden ser iguales")
                    document.getElementById("rdocument").value = ""
                    document.getElementById("document").value = ""
                }else{
                    var formulario = document.getElementById('form');
                    formulario.addEventListener('submit', (event) => {
                        event.preventDefault();
                    });
                    Swal.fire({
                        title: 'Update',
                        text: "Do you want to update the student?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, accept'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formulario.submit();
                        }
                    })
                    
                }
            }

            history.pushState(null, null);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>
<?php 
}else{
    header('Location: Index.php');
}
?>
