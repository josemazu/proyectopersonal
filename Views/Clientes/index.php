<?php include_once "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">Clientes</div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmClientes();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="tblClientes">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Correo Electrónico</th>
                        <th>Celular</th>
                        <th>Estado</th>
                        <th>Fecha de Ingreso</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="frmCliente">
                    <div class="form-group">
                        <input type="hidden" id="atleta_id" name="atleta_id">
                        <label for="ci">CI</label>
                        <input id="ci" class="form-control" type="text" name="ci" placeholder="Carnet de Identidad">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del cliente">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion del cliente">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input id="email" class="form-control" type="text" name="email" placeholder="E-mail del cliente">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input id="celular" class="form-control" type="text" name="celular" placeholder="Celular del cliente">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_ingreso">Fecha de Ingreso</label>
                                <input id="fecha_ingreso" class="form-control" type="date" name="fecha_ingreso" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" name="estado">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                </form>
                <button class="btn btn-primary" type="button" onclick="registrarCliente(event);" id="btnAccion">Registrar</button>
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<?php include_once "Views/Templates/footer.php"; ?>