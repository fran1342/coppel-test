<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Veterinaria</h1>
    </div>

<!-- Content Row -->
    <?php 

        $session=$this->session->userdata('veterinaria_sess');
        switch($session->tipo_usuario){
            case 'Empleado':
                $card=array(
                    /*array(
                        "card_icon" => "fas fa-user",
                        "card_title" => "Empleados",
                        "card_url" =>"empleados"
                    ),*/
                    array(
                        "card_icon" => "fas fa-user",
                        "card_title" => "Clientes",
                        "card_url" => "clientes"
                    ),
                    array(
                        "card_icon" => "fas fa-paw",
                        "card_title" => "Mascotas",
                        "card_url" => "mascotas"
                    ),
                    array(
                        "card_icon" => "fas fa-calendar-day",
                        "card_title" => "Citas",
                        "card_url" => "citas"
                    ),
                    array(
                        "card_icon" => "fa fa-cubes",
                        "card_title" => "Productos",
                        "card_url" => "productos"
                    ),
                    array(
                        "card_icon" => "fa fa-credit-card",
                        "card_title" => "Vender",
                        "card_url" => "vender"
                    ),
                    array(
                        "card_icon" => "fa fa-list-ol",
                        "card_title" => "Ventas",
                        "card_url" => "ventas"
                    )
                );
                break;
        }

    ?>
    <div class="row">
        <!-- Little cards -->
        <?php foreach($card as $iCard){ ?> 
            <a class="col-xl-3 col-md-6 mb-4" href="<?=$iCard['card_url']?>">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-700"><?=$iCard['card_title']?></div>
                            </div>
                            <div class="col-auto">
                                <i class="<?=$iCard['card_icon']?> fa-2x text-tertiary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
        <div class="col-12">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Servicios</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="...">
                    </div>
                    <p>*Poner los servicios que se realizan en la veterinaria*</p>
                </div>
            </div>

        </div>
</div>
<!-- End of Main Content -->