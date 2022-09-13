<?php include_once "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">Horarios</div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmHorarios();"><i class="fas fa-plus"></i></button>
        <table class="table table-hover table-striped" id="tblHorarios">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Plan</th></th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal usuario -->
<div id="nuevo_horario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Horario</h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="frmHorarios">
                    <!--<div class="form-group">
                        <label for="plan_id">Id</label>
                        <input id="plan_id" class="form-control" type="text" name="plan_id" placeholder="Identificador (id) del Plan">
                    </div>-->
                    <div class="form-group">
                        <label for="plan">Plan:</label>
                        <select id="plan" class="form-control" name="plan" onchange="buscarPlanH(event)" >
                            <option>Elija plan</option>
                            <?php foreach ($data['plan'] as $row) { ?>
                                <option value="<?php echo $row['plan_id']; ?>"><?php echo $row['plan']; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" id="plan_id" name="plan_id">
                        <input type="hidden" id="horarios_id" name="horarios_id">
                    </div>                    
                    <div class="form-group">
                        <label for="horario_i">Horario inicio</label>
                        <input id="horario_i" class="form-control" type="text" name="horario_i" placeholder="00:00">
                        <label for="horario_f">Horario fin</label>
                        <input id="horario_f" class="form-control" type="text" name="horario_f" placeholder="00:00">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" name="estado">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                </form>
                <button class="btn btn-primary" type="button" onclick="registrarHorario(event);" id="btnAccion">Registrar</button>
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "Views/Templates/footer.php"; ?>