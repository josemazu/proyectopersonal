<?php include_once "Views/Templates/header.php"; ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning">
            <form method="POST" id="frmAsistencia">
                <div class="card-body d-flex text-white">
                    <div class="">Asistencia</div>
                    <input type="text" class="ml-2" id="carnet" name="carnet" placeholder="Ingrese carnet cliente">
                    <button class="btn btn-light text-warning ml-2" type="button" onclick="registrarAsistencia(event);">
                        <i class="fas fa-clock ml-auto"></i>
                    </button>
                    
                </div>
            </form>            
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white" id="time"></span>
                <span class ="text-white"><?php echo date('d/m/Y');?></span>
            </div>            
        </div>
        <div class="form-group">
        </div>
    </div>    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white">
                Usuario
                <i class="fas fa-user fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<? echo base_url;?>Usuarios" class="text-white">Ver detalle</a>
                <span class="text-white"><?php echo $data['usuarios']['total']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success">
            <div class="card-body d-flex text-white">
                Clientes
                <i class="fas fa-users fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<? echo base_url;?>Clientes" class="text-white">Ver detalle</a>
                <span class="text-white"><?php echo $data['clientes']['total']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger">
            <div class="card-body d-flex text-white">
                Planes
                <i class="fas fa-book fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<? echo base_url;?>Planes" class="text-white">Ver detalle</a>
                <span class="text-white"><?php echo $data['planes']['total']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Planes mas vendidos
            </div>
            <div class="car-body">
                <canvas id="planesVendidos"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                horarios mas vendidos
            </div>
            <div class="car-body">
                <canvas id="horariosVendidos"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include_once "Views/Templates/footer.php"; ?>

