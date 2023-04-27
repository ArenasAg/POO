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
        <title>Insert</title>
    </head>
    <body>
        <div class="d-flex align-items-center min-vh-100">
            <div class="container mw-100">
                <div class="row">
                    <div class="col-md-3 mx-auto shadow-lg p-3 mb-5 bg-body rounded">
                        <form id="form" name="form" method="post" action="process/Functions.php">
                            <fieldset>
                                <div class="text-center">
                                    <label class="text-primary h1 p-3">Insert Student</label>
                                </div>

                                <div id="1" class="mt-3 d-none border">
                                    <input autocomplete="off" id="rfname" name="rfname" type="text" placeholder="Full Name" class="form-control" required>
                                </div>

                                <div id="2" class="mt-3 d-none border">
                                    <input autocomplete="off" id="rfsurname" name="rfsurname" type="text" placeholder="First Surname" class="form-control" required>
                                </div>

                                <div id="3" class="mt-3 d-none border">
                                    <input autocomplete="off" id="rssurname" name="rssurname" type="text" placeholder="Second Surname" class="form-control" required>
                                </div>

                                <div id="4" class="mt-3 d-none border">
                                    <input autocomplete="off" id="rdocument" name="rdocument" type="text" placeholder="Document" class="form-control" required>
                                </div>

                                <div id="5" class="mt-3 d-none border">
                                    <input autocomplete="off" id="phone" name="phone" type="text" placeholder="Phone" class="form-control" required>
                                </div>

                                <div id="6" class="p-4 text-center d-none">
                                    <button type="button" class="btn btn-primary w-50" onclick="student()">Accept</button>
                                </div>

                                <div id="7" class="mt-3 border">
                                    <input autocomplete="off" id="fname" name="fname" type="text" placeholder="Full Name" class="form-control" required>
                                </div>

                                <div id="8" class="mt-3 border">
                                    <input autocomplete="off" id="fsurname" name="fsurname" type="text" placeholder="First Surname" class="form-control" required>
                                </div>

                                <div id="9" class="mt-3 border">
                                    <input autocomplete="off" id="ssurname" name="ssurname" type="text" placeholder="Second Surname" class="form-control" required>
                                </div>

                                <div id="10" class="mt-3 border">
                                    <input autocomplete="off" id="birth" name="birth" type="date" placeholder="Birthdate" class="form-control" required>
                                </div>

                                <div id="11" class="mt-3 border">
                                    <input autocomplete="off" id="document" name="document" type="text" placeholder="Document" class="form-control" required>
                                </div>

                                <div id="12" class="mt-3 border">
                                    <select name="group" class="form-control" required>
                                        <option value="" disabled selected>Select Group</option>
                                        <option value="6-1">6-1</option>
                                        <option value="6-2">6-2</option>
                                        <option value="6-3">6-3</option>
                                        <option value="7-1">7-1</option>
                                        <option value="7-2">7-2</option>
                                        <option value="7-3">7-3</option>
                                    </select>
                                </div>

                                <div id="13" class="p-4 text-center">
                                    <button id="button" type="button" class="btn btn-primary w-50" onclick="responsible()">Responsible</button>
                                </div>

                                <div class="d-none">
                                    <input type="text" name='submitInsert'></input>
                                </div>

                                <div id="14" class="p-4 text-center">
                                    <a href="Home.php" class="btn btn-primary btn-lg w-49">Return</a>
                                    <button type="submit" class="btn btn-primary btn-lg w-49" onclick="campos()">Register</button>
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
                    document.getElementById("rdocument").value = ""
                    document.getElementById("document").value = ""
                    Swal.fire(
                        '¡The parent and student document cannot be the same!',
                        '',
                        'error'
                    );
                }else{
                    var formulario = document.getElementById('form');
                    formulario.addEventListener('submit', (event) => {
                        event.preventDefault();
                    });
                    Swal.fire({
                        title: 'Register',
                        text: "Do you want to register the student?",
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
            window.onload = function() {
                <?php if (isset($_COOKIE['insert'])) {?>
                            setTimeout(function() {
                                Swal.fire(
                                    '¡The student has been added successfully!',
                                    '',
                                    'success'
                                )
                                document.cookie = 'insert=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                            },100);
                <?php }else if (isset($_COOKIE['exists'])) {?>
                            setTimeout(function() {
                                Swal.fire(
                                    '¡The student is already registered!',
                                    '',
                                    'info'
                                )
                                document.cookie = 'exists=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                            },100);
                <?php }else if (isset($_COOKIE['error'])) {?>
                            setTimeout(function() {
                                Swal.fire(
                                    '¡Could not add student!',
                                    '',
                                    'error'
                                )
                                document.cookie = 'error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                            },100);
                <?php }?>
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>
<?php 
}else{
    header('Location: Index.php');
} 
?>