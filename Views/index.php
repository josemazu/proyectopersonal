<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bienvenido</title>
    <base href="/" />
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
</head>
    
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center">
                                    <h3 class="font-weight-light my-4">Inicio de Sesión</h3>
                                    <img src="<?php echo base_url; ?>Assets/img/logoww.png" class="img-fluid rounded" width="150">
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger d-none" role="alert" id="alerta">
                                    </div>
                                    <form id="frmLogin" onsubmit="frmLogin(event);">
                                        <div class="form-group mb-3">
                                            <label for="usuario"><i class="fas fa-user"></i>Usuario</label>
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" required/>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="clave"><i class="fas fa-key"></i>Contraseña</label>
                                            <input class="form-control" id="clave" name="clave" type="password" placeholder="Contraseña" required/>
                                        </div>
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-lg" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>"
    </script>
    <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
    
</body>

</html>