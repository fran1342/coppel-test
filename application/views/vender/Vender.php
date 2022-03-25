<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vender</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home');?>'">Home</a></li>
              <li class="breadcrumb-item active">Ventas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Realizar ventas</h3>
        </div>
        <div class="card-body">

        <?php 
$granTotal = 0;
?>
<div class="col-xs-12">
	<?php if(!empty($this->session->flashdata())): ?>
		<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
			<?php echo $this->session->flashdata('mensaje') ?>
		</div>
	<?php endif; ?>
	<br>
	<form method="post" action="<?php echo base_url() ?>index.php/vender/agregar">
		<label for="codigo">Id del producto:</label>
		<input autocomplete="off" autofocus class="form-control" name="pro_v" required type="text" id="pro_v" placeholder="Escribe el id del producto">
	</form>
	<br><br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Quitar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($carrito as $indice => $producto){ 
					$granTotal += $producto->total;
				?>
			<tr>
				<td><?php echo $producto->id_producto ?></td>
				<td><?php echo $producto->nombre_producto ?></td>
				<td>$<?php echo $producto->precio_producto ?></td>
				<td><?php echo $producto->cantidad_detalleV ?></td>
				<td>$<?php echo $producto->total ?></td>
				<td><a class="btn btn-danger" href="<?php echo base_url() . "index.php/vender/quitarDelCarrito/" . $indice?>"><i class="fa fa-trash"></i></a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<h3>Total: $<?php echo $granTotal; ?></h3>
	<input name="total" type="hidden" value="<?php echo $granTotal;?>">
	<a href="<?php echo base_url() ?>index.php/vender/terminarVenta" class="btn btn-success">Terminar venta</a>
	<a href="<?php echo base_url() ?>index.php/vender/cancelarVenta" class="btn btn-danger">Cancelar venta</a>
</div>
          
          <div class="row mt-2">
            <div class="col-12" id="registro_contenido">
              
            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  
  <div class="modal fade" id="modal_ventas" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content" id="contenido_modal">
        
      </div>
    </div>
  </div>




  
