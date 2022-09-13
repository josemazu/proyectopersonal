<?php include_once "Views/Templates/header.php"; ?>
<form action="<?php echo base_url;?>Compras/pdf" method="POST" target="_blank">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="desde">Desde</label>
                <input type="date" name="desde" value="<?php echo date('Y-m-d'); ?>" id="desde">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="hasta">Desde</label>
                <input type="date" name="hasta" value="<?php echo date('Y-m-d'); ?>" id="hasta">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">PDF</button>
            </div>
        </div>
    </div>
</form>

<table class="table table-light" id="t_historial_c">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Total</th>
            <th>Fecha de compra</th>
            <th>Estado</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>


<?php include_once "Views/Templates/footer.php"; ?>