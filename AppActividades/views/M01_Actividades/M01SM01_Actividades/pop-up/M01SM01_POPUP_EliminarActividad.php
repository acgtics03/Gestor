<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

    <div class="modal-content">
        <div class="modal-cabecera-list" style="text-align:left;">
            <button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
                    aria-hidden="true"></i></button>
            <span><i class="fa fa-trash" aria-hidden="true"></i> Eliminar Actividad </span>
        </div>
        <div class="head-model cabecera-modal-accion">
            <button class="btn btn-model-cerrar" id="btnEliminarActividad"><i class="fa fa-folder-open"></i> Eliminar</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="txtIdActividad">

            <div class="form-row">
                <div class="col-md-12">
                    <label for="" class="label-texto">Nombre <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <select id="bxNombreActivi" class="cbx-texto" disabled>
                        <option selected="true" disabled="disabled">Seleccione...</option>
                    </select>

                </div>
                <div class="col-md-6">
                    <label for="" class="label-texto">Cliente <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <select id="bxClienteActivi" class="cbx-texto" disabled>
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                        <?php
                        $Clientes = new ControllerCategorias();
                        $verClientes = $Clientes->VerClientes();
                        foreach ($verClientes as $TClientes) {
                            ?>
                            <option value="<?php echo $TClientes['ID']; ?>"><?php echo $TClientes['Nombre']; ?></option>
                        <?php }  ?>
                    </select>

                </div>
                <div class="col-md-6">
                    <label class="label-texto">Responsable <small id="boxmotivo_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="text" id="bxResponsableActivi" class="caja-texto" disabled>
                </div>
                <div class="col-md-6">
                    <label for="" class="label-texto">Inicio <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="date" id="txtFecInicioActivi" class="caja-texto" disabled>

                </div>
                <div class="col-md-6">
                    <label class="label-texto">Termino <small id="boxmotivo_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="date" id="txtFecTerminoActivi" class="caja-texto" disabled>
                </div>

                <p class="texto-guia"> Por motivos de mejorar la gestión de las actividades registradas necesitamos conocer el motivo más un breve comentario que sustenten la acción a realizar.</p>

                <div class="col-md-12">
                    <label class="label-texto">Motivo <small id="boxmotivo_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <select id="bxMotivoEliminarActividad" class="cbx-texto">
                        <option selected="true" disabled="disabled">Seleccione...</option>
                        <?php
                        $MotivoEliminar = new ControllerCategorias();
                        $verMotivoEliminar = $MotivoEliminar->VerMotivosEliminarActividad();
                        foreach ($verMotivoEliminar as $TMotivoEliminar) {
                            ?>
                            <option value="<?php echo $TMotivoEliminar['ID']; ?>"><?php echo $TMotivoEliminar['Nombre']; ?></option>
                        <?php }  ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="label-texto">Descripcion <small id="descripcion_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <textarea rows="4" maxlength="150" id="txtDescripcionActivi" class="caja-texto"
                        placeholder="Describa el motivo" style="height: auto;resize: none;" required></textarea>
                </div>
            </div>
        </div>
    </div>
</div>