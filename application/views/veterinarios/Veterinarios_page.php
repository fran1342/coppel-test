<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Veterinarios</h1>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right shadow">
              <li class="breadcrumb-item"><a href="<?=base_url('home');?>">Home</a></li>
              <li class="breadcrumb-item active">Veterinarios</li>
            </ol>
          </div>
    </div>

<!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de veterinarios</h6>
                </div>
                <div class="card-body">                    
                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" 
                    data-toggle="modal" data-target="#modal_veterinarios" id="btn_nuevo_veterinario">
                        <i class="fas fa-plus fa-sm text-white-50"></i> 
                    Nuevo veterinario</button>
                    <div class="row mt-2">
                        <div class="col-12" id="registro_contenido">
              
                        </div>
                    </div>
                
                </div>
            </div>

        </div>
</div>

<div class="modal fade" id="modal_veterinarios" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content" id="contenido_modal">
        
      </div>
    </div>
</div>