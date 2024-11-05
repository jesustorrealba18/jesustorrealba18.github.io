<?php require_once("comunes/encabezado.php"); ?>
<body>
<?php require_once('comunes/menu.php'); ?>

<div class="container text-center mt-5">
    <h1 class="display-4 text-primary">Inventario de Productos</h1>
    <p class="lead text-secondary">Gestión eficiente de productos, proveedores y categorías</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="#" role="button">Comenzar</a>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="incluir">INCLUIR</button>
        </div>
        <div class="col-md-2">
            <a href="index.php" class="btn btn-secondary">REGRESAR</a>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-striped table-hover" id="tablapersona">
            <thead class="thead-dark">
                <tr>
                    <th>Acciones</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                    <th>Categoría</th>
                    <th>Stock Actual</th>
                </tr>
            </thead>
            <tbody id="resultadoconsulta">
                <!-- Los datos serán insertados aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar nuevo producto -->
<!-- Modal para agregar nuevo producto -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal1Label">Agregar Nuevo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="f" autocomplete="off">
                    <input type="hidden" class="form-control" name="accion" id="accion">
                    <div class="form-row mb-3">
                        <div class="col-md-4">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo">
                            <span id="scodigo" class="text-danger"></span>
                        </div>
                        <div class="col-md-8">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                            <span id="snombre" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-8">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                            <span id="sdescripcion" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" id="cantidad" name="cantidad">
                            <span id="scantidad" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-4">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" id="proveedor" name="proveedor">
                                <option value="HP">HP</option>
                                <option value="MICROSOFT">MICROSOFT</option>
                                <option value="SAMSUNG">SAMSUNG</option>
                                <option value="XIAOMI">XIAOMI</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="categoria">Categoría</label>
                            <select class="form-control" id="categoria" name="categoria">
                                <option value="Papeleria">Papelería</option>
                                <option value="Tecnologia">Tecnología</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="stock_actual">Stock Actual</label>
                            <input type="text" class="form-control" id="stock_actual" name="stock_actual">
                            <span id="sstock_actual" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-block" id="proceso"></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<?php require_once("comunes/modal.php"); ?>
<!-- Bootstrap JS and dependencies -->

<script type="text/javascript" src="js/productos.js"></script>

</body>
</html>
