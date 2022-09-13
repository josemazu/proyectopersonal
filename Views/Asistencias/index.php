<?php include_once "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">Registro de Asistencias para clientes</div>
    <div class="card-body">
        <form action="" method="post" id="frmAsistencia">
            <div class="row">
                <div class="form-group col-md-3">
                    <input type="hidden" id="ci" name="atleta_id">
                    <label for="regcliente">Ingrese nombre del cliente</label>
                    <input id="regcliente" class="form-control" type="text" name="regcliente" placeholder="Nombre de cliente">
                </div>    
                <div class="form-group col-md-2" >
                    <label for="fecha">Fecha:</label>
                    <input id="fecha" class="form-control" name="fecha" value="<?php echo date('Y-m-d'); ?>"><?php echo date('Y-m-d'); ?>
                </div>
                <div class="form-group col-md-3 id="reloj">
                    <label for="hora">Hora:</label>
                    <input type="datetime" name="fechahora" step="1" min="2013-01-01 T00:00Z" max="2013-12-31T12:00Z" value="2013-01-01T12:00">
                    <input type="datetime" name="fechahora" step="1" min="2013-01-01T00:00Z" max="2013-12-31T12:00Z" value="<?php echo date("Y-m-d\TH-i");?>">
                    <input id="hora" class="form-control" name="hora" value="<?php echo time('m-h-s'); ?>"><?php echo date('m'); ?></input>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-primary col-md-3" type="button" onclick="registrarAsistencia(event);">Registrar</button>
            </div>
        </form>
    </div>

    <div class="card-body">
        <table class="table table-hover table-striped" id="tblRegistro">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Fecha y hora de ingreso</th>
                    <th>Fecha y hora de salida</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>



<?php include_once "Views/Templates/footer.php"; ?>