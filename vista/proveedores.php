<html> 
<?php require_once("comunes/encabezado.php"); ?>
<body>

<?php require_once('comunes/menu.php'); ?>

<div class="container text-center mt-5">
    <h1 class="display-4 text-primary">Gestion de proveedores</h1>
    <p class="lead text-secondary">Gestión eficiente de productos, proveedores y categorías</p>
    <hr class="my-4">
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="incluir">INCLUIR</button>
        </div>
        <div class="col-md-2">
            <a href="index.php" class="btn btn-secondary">REGRESAR</a>
        </div>
        
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablapersona">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>direccion</th>
                        <th>Contacto</th>
                        <th></th>
                       
                    </tr>
                </thead>
                <tbody id="resultadoconsulta">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- seccion del modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header text-light bg-info">
            <h5 class="modal-title">Agregar nuevo proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-content">
            <div class="container">
                <form method="post" id="f" autocomplete="off">
                    <input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
                    <div class="container">    
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="codigo">Codigo</label>
                                <input class="form-control" type="text" id="codigo" name="codigo" />
                                <span id="scodigo"></span>
                            </div>
                            <div class="col-md-8">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" id="nombre" name="nombre" />
                                <span id="snombre"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="direccion">direccion</label>
                                <input class="form-control" type="text" id="direccion" name="direccion" />
                                <span id="sdireccion"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="contacto">Contacto</label>
                                <input class="form-control" type="text" id="contacto" name="contacto" />
                                <span id="scontacto"></span>
                            </div>
                         
                        
                        </div>
                        <div class="row mb-3">

                           
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="proceso"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer bg-dark">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
<?php require_once("comunes/modal.php"); ?>
<script type="text/javascript" src="js/proveedores.js"></script>

</body>
</html>