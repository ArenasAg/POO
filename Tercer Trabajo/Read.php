<?php
session_start(); 
if(isset($_SESSION['admin']) || isset($_SESSION['normal'])) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <title>Read</title>
    </head>
    <body>
        <div class="d-flex align-items-center min-vh-100">
            <div class="container mw-100">
                <div class="row">
                    <div class="col-md-6 mx-auto border shadow-lg p-3 mb-5 bg-body rounded">
                            <fieldset>
                                
                                <div class="text-center">
                                    <label class="text-primary h1 p-3">Read Students</label>
                                </div>
                                
                                <div class="mt-3 border">
                                    <input id="docu" name="docu" type="number" placeholder="Search Document" class="form-control" required>
                                </div>

                                <div id="result" class="mt-3 form-control table-responsive">
                                    
                                </div>

                                <div id="14" class="p-4 text-center">
                                    <a href="Home.php" class="btn btn-primary btn-lg w-49">Return</a>
                                </div>
                                
                            </fieldset>
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

                }
            }
            
            <?php if (isset($_COOKIE['update'])) {?>
                        setTimeout(function() {
                            Swal.fire(
                                '¡Se actualizo correctamente el estudiante!',
                                '',
                                'success'
                            )
                            document.cookie = 'update=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                        },100);
            <?php }else if (isset($_COOKIE['errorUpdate'])) {?>
                        setTimeout(function() {
                            Swal.fire(
                                '¡No se actualizo ningun dato!',
                                '',
                                'error'
                            )
                            document.cookie = 'errorUpdate=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                        },100);
            <?php } else if (isset($_COOKIE['delete'])) {?>
                        setTimeout(function() {
                            Swal.fire(
                                '¡Se elimino correctamente el estudiante!',
                                '',
                                'success'
                            )
                            document.cookie = 'delete=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                        },100);
            <?php } else if (isset($_COOKIE['errorDelete'])) {?>
                        setTimeout(function() {
                            Swal.fire(
                                '¡No se elimino el estudiante!',
                                '',
                                'error'
                            )
                            document.cookie = 'errorDelete=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                        },100);
            <?php } ?>

            function mostrar(id) {
                var menu = document.getElementById(id);
                menu.classList.remove("d-none");
            }

            function ocultar(id) {
                var menu = document.getElementById(id);
                menu.classList.add("d-none");
            }

            $(document).ready(function() {
                var submitRead = "submitRead"
                $.ajax({
                    url: 'process/Functions.php',
                    method: 'POST',
                    data: {submitRead: submitRead},
                    success: function(response) {
                        $('#result').html(response);
                    }
                });
                $('#docu').keyup(function() {
                    var docu = $(this).val();
                    var submitSearch = "submitSearch"
                    if (docu != '') {
                        $.ajax({
                            url: 'process/Functions.php',
                            method: 'POST',
                            data: {docu: docu, submitSearch: submitSearch},
                            success: function(response) {
                                $('#result').html(response);
                            }
                        });
                    }else{
                        var submitRead = "submitRead"
                        $.ajax({
                            url: 'process/Functions.php',
                            method: 'POST',
                            data: {submitRead: submitRead},
                            success: function(response) {
                                $('#result').html(response);
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.update', function() {
                    var fila = $(this).closest('tr');
                    
                    var id = fila.find('td:eq(0)').text();
                    var fname = fila.find('td:eq(1)').text();
                    var fsurname = fila.find('td:eq(2)').text();
                    var ssurname = fila.find('td:eq(3)').text();
                    var birth = fila.find('td:eq(4)').text();
                    var document = fila.find('td:eq(5)').text();
                    var group = fila.find('td:eq(6)').text();
                    var tabla2 = $(this).closest('tr').find('[data-id]');
                    var rfname = tabla2.closest('tr').find('td:eq(0)').text();
                    var rfsurname = tabla2.closest('tr').find('td:eq(1)').text();
                    var rssurname = tabla2.closest('tr').find('td:eq(2)').text();
                    var rdocument = tabla2.closest('tr').find('td:eq(3)').text();
                    var phone = tabla2.closest('tr').find('td:eq(4)').text();
                    
                    $('#form input[name="id"]').val(id);
                    $('#form input[name="fname"]').val(fname);
                    $('#form input[name="fsurname"]').val(fsurname);
                    $('#form input[name="ssurname"]').val(ssurname);
                    $('#form input[name="birth"]').val(birth);
                    $('#form input[name="document"]').val(document);
                    $('#form input[name="group"]').val(group);
                    $('#form input[name="rfname"]').val(rfname);
                    $('#form input[name="rfsurname"]').val(rfsurname);
                    $('#form input[name="rssurname"]').val(rssurname);
                    $('#form input[name="rdocument"]').val(rdocument);
                    $('#form input[name="phone"]').val(phone);
                    $('#form').submit();
            });

            $(document).on('click', '.delete', function() {
                    var fila = $(this).closest('tr'); 
                    var id = fila.find('td:eq(0)').text();
                    var submitDelete = 'submitDelete';
                    Swal.fire({
                        title: 'Delete',
                        text: "Do you want to delete the student?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, accept'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'process/Functions.php',
                                method: 'POST',
                                data: {id: id, submitDelete: submitDelete},
                                success: function(response) {
                                    location.reload();
                                }
                            });
                        }
                    })
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>
<?php
}else{
    header('Location: Index.php');
}
?>