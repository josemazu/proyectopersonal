<?php include_once "Views/Templates/header.php"; ?>
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                Asignar permisos
            </div>
            <div class="card-body">
                <form id="formulario" onsubmit="registrarPermisos(event)">
                    <div class="row">
                        <?php foreach ($data['datos'] as $row) { ?>
                            <div class="col-md-4 text-center text-capitalize p-2">
                                <label for=""><?php echo $row['permiso'] ?></label><br>
                                <input type="checkbox" name="permisos[]" value="<?php echo $row['permisos_id']; ?>"<?php echo isset($data['asignados'][$row['permisos_id']]) ? 'checked' : ''; ?>>
                            </div>
                        <?php } ?>
                            <input type="hidden" value="<?php echo $data['usuario_id']; ?>" name="usuario_id">
                    </div>
                    <div class="dgrid gap-2">
                        <button type="submit" class="btn btn-outline-primary">Asignar Permisos</button>
                        <a class="btn btn-outline-danger" href="<?php echo base_url;?>Usuarios">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



<?php include_once "Views/Templates/footer.php"; ?>