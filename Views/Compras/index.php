<?php include_once "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 >Nueva compra</h4>    
    </div>
    <div class="card-body">
        <form id="frmCompra" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" name="detalle_id" id="detalle_id">
                        <label for="atleta_id">Asignar cliente:</label>
                        <!--<select id="atleta_id" class="form-control" name="atleta_id">
                            <?php /*foreach ($data['clientes'] as $row) { ?>
                                <option value="<?php echo $row['atleta_id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } */?>
                        </select>-->
                        <input type="hidden" id="id_a" name="id_a">
                        <input type="text" list="clientes" id="atleta_id" name="atleta_id" class="form-control" onchange="buscarCliente(event)">
                        <datalist id="clientes">
                            <?php foreach ($data['clientes'] as $row) { ?>
                                <option id="atleta_id" name="atleta_id" value="<?php echo $row['atleta_id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="plan">Asignar plan:</label>
                        <select id="plan" class="form-control" name="plan" onchange="buscarPlan(event)" >
                            <option>Elija plan</option>
                            <?php foreach ($data['plan'] as $row) { ?>
                                <option value="<?php echo $row['plan_id']; ?>"><?php echo $row['plan']; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" id="id" name="id">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="hidden" id="id_h" name="id_h">
                        <input type="hidden" id="hinicio" name="hinicio">
                        <input type="hidden" id="hfin" name="hfin">
                        <label for="horarios">Asignar Horario:</label>
                        <select id="horarios" name="horarios_id" class="form-control"></select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="obs">Descripción:</label>
                        <input id="obs" class="form-control" type="text" name="obs" placeholder="" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Meses a contratar" onkeyup="calcularPrecio(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sub_total">Subtotal:</label>
                        <input id="sub_total" class="form-control" type="number" name="sub_total" placeholder="Sub total" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fecha_pago">Fecha de pago:</label>
                        <input id="fecha_pago" class="form-control" type="date" name="fecha_pago" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-light table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Plan</th>
            <th>Horario</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetalle">
    </tbody>
</table>
<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold">Total:</label>
            <input id="total" class="form-control" type="text" name="total" placeholder="Total" readonly>
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="generarCompra()">Generar Pago</button>
        </div>
    </div>
</div>

</div>

<?php include_once "Views/Templates/footer.php"; ?>