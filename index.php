<!DOCTYPE html>
<html>

<head>
    <title>Capacitaciones</title>
    <link rel="icon" href="img/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Encode+Sans&display=swap">

    <style>
        * {
            font-family: 'Encode Sans', sans-serif;
        }

        .prome-green-title {
            color: #23952E;
            font-weight: bold !important;
        }

        .btn-prome-green {
            background-color: #23952E;
            color: #FFFFFF;
        }

        .btn-prome-green:hover {
            background-color: #1b7424;
            color: #FFFFFF;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
        }

        .hidden {
            display: none;
        }

        .m0 {
            margin: 0;
        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-light" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mt-md-4">
                                <h2 class="mb-5 text-uppercase prome-green-title">Capacitaciones</h2>
                                <p class="mb-5">Para acceder al campus de capacitaciones tenemos que verificar tu DNI</p>
                                <div class="form-outline mb-4">
                                    <input type="text" class="form-control form-control-lg" placeholder="Ingresá tu DNI" name="dni" id="dni" required="required" autocomplete="off" maxlength="11" onkeypress="return validateDNI(event);" onblur="cleanDNIInput();">
                                </div>
                                <button type="submit" id="btnLogin" class="btn btn-lg btn-success px-5 mt-4 btn-prome-green">
                                    Verificar
                                </button>
                                <div class="mt-4 hidden m0" id="alert">ㅤ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", "#btnLogin", function() {
                $("#alert").removeClass("hidden");

                var dni = jQuery('#dni').val();
                $("#btnLogin").prop("disabled", true);

                if (dni == "") {
                    $("#alert").html("<div class='alert alert-danger m0' role='alert'><i class='fa-regular fa-circle-xmark'></i>ㅤNo se ingresó un DNI</div> ");
                    $("#btnLogin").prop("disabled", false);
                    return false;
                }

                $("#alert").html("<div class='alert alert-info m0' role='alert'><i class='fa-regular fa-clock'></i>ㅤVerificando...</div> ");

                $.ajax({
                    url: "dni-verification.php",
                    type: "POST",
                    cache: false,
                    data: {
                        dni: dni,
                    },
                    success: function(data) {
                        if (data == "dni verified") {
                            $("#alert").html("<div style='display: block;' class='alert alert-success m0' role='alert'><i class='fa-regular fa-circle-check'></i>ㅤDNI verificado</div>");
                        } else {
                            $("#alert").html("<div style='display: block;' class='alert alert-danger m0' role='alert'><i class='fa-regular fa-circle-xmark'></i>ㅤEl DNI ingresado no se encontró en nuestos registros</div>");
                            $("#btnLogin").prop("disabled", false);
                        }
                    }
                });
            });
        });

        function validateDNI(evt) {
            var code = (evt.which) ? evt.which : evt.keyCode;

            if (code == 8) {
                return true;
            } else if (code >= 48 && code <= 57) {
                return true;
            } else {
                return false;
            }
        }

        function cleanDNIInput() {
            var dniInput = document.getElementById('dni');
            dniInput.value = dniInput.value.replace(/[.-]/g, '');
            console.log(dniInput.value);
        }
    </script>

</body>

</html>