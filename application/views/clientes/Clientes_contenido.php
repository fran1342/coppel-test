
<table id="tabla_clientes" class="table table-bordered table-striped">
                <thead>
                    <tr>   
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tel(s)</th>
                        <th>Usuario</th>
                        <th>Mascota</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $iCliente){ ?>
                        <tr>
                        <td><?=$iCliente->nombre_usuario;?></td>
                        <td><?=$iCliente->apellidos_usuario;?></td>
                        <td><?=$iCliente->tel_usuario;?></td>
                        <td><?=$iCliente->user_usuario;?></td>
                        <td>
                            <?php 
                            foreach($mascotas as $iMascota){
                                if ($iCliente->id_usuario == $iMascota->id_usuario) {?>
                                    
                                    <ul>
                                        <li><?=$iMascota->nombre_mascota;?></li>
                                    </ul>
                                    
                            <?php } }?>
                        </td>
                        <td><?=$iCliente->estatus_usuario;?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn_operacion" data-codigo="<?=$iCliente->id_usuario;?>" data-opt="editar">
                            <i class="fas fa-edit"></i>Editar
                            </button>
                            <button class="btn btn-danger btn-sm btn_operacion" data-codigo="<?=$iCliente->id_usuario;?>" data-opt="borrar">
                            <i class="fas fa-trash"></i>Borrar
                            </button>
                        </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>