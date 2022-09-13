<?php include_once "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">Planes</div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmPlanes();"><i class="fas fa-plus"></i></button>
        <table class="table table-hover table-striped" id="tblPlanes">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Plan</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal usuario -->
<div id="nuevo_plan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Plan</h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="frmPlanes">
                    <!--<div class="form-group">
                        <label for="plan_id">Id</label>
                        <input id="plan_id" class="form-control" type="text" name="plan_id" placeholder="Identificador (id) del Plan">
                    </div>-->
                    <div class="form-group">
                        <input type="hidden" id="plan_id" name="plan_id">
                        <label for="plan">Plan</label>
                        <input id="plan" class="form-control" type="text" name="plan" placeholder="Nombre del Plan">
                    </div>
                    <div class="form-group" id="precios">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio no modificable">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" name="estado">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="obs">Observaciones</label>
                        <textarea rows="3" id="obs" class="form-control" type="text" name="obs" placeholder="Observaciones"></textarea>
                    </div>
                </form>
                <button class="btn btn-primary" type="button" onclick="registrarPlan(event);" id="btnAccion">Registrar</button>
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<?php include_once "Views/Templates/footer.php"; ?>

?>