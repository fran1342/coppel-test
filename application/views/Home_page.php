<!-- Begin Page Content -->
<style>
    #btn_nuevo_producto:hover {
        transform: scale(1.1) perspective(1px)
    }
    #btn_cambiar_producto:hover {
        transform: scale(1.1) perspective(1px)
    }
    #btn_baja_producto:hover {
        transform: scale(1.1) perspective(1px)
    }
    #btn_consulta_producto:hover {
        transform: scale(1.1) perspective(1px)
    }

</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Prueba coppel</h1>
    </div>

<!-- Content Row -->
    <div class="row">
        <!-- Little cards -->
        <div class="col-12">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alta, Baja, Cambio y Consulta de productos</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <div class="card border-left-success shadow h-100 py-2" data-toggle="modal" data-target="#modal_productos" id="btn_nuevo_producto">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Dar de alta, baja o cambiar producto</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Alta, Baja o Cambio</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <div class="card border-left-info shadow h-100 py-2" data-toggle="modal" data-target="#modal_ver_producto" id="btn_consulta_producto">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Consultar producto</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Consulta</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- End of Main Content -->
<div class="modal fade" id="modal_productos" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content" id="contenido_modal">
        
      </div>
    </div>
</div>

<div class="modal fade" id="modal_ver_producto" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content" id="contenido_ver_modal">
        
      </div>
    </div>
</div>