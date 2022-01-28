<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

    <div class="modal-content">
        <div class="modal-cabecera-list" style="text-align:left;">
            <button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
                    aria-hidden="true"></i></button>
            <span><i class="fas fa-sync" aria-hidden="true"></i> Reasignar la Actividad</span>
        </div>
        <div class="head-model cabecera-modal-accion">
            <button class="btn btn-registro-success" id="btnReasignarActividad"><i class="fas fa-sync"></i> Reasignar</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="txtidactividad">

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Nombre</label>
                    <select class="cbx-texto" name="bxNombreActividadParticipantes" id="bxNombreActividadParticipantes" disabled>
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                        <?php
                        $Estados = new ControllerCategorias();
                        $verEstados = $Estados->VerNombreActividades();
                        foreach ($verEstados as $TEstados) {
                            ?>
                            <option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
                        <?php }  ?>
                    </select>
                </div>
            </div>

            <div class="form-row separador">
                <div class="col">
                    <label for="" class="label-texto">Inicio</label>
                    <input type="date" id="txtFechaInicioParticipantes" class="caja-texto" placeholder="Apellido Paterno"
                        disabled>
                </div>
                <div class="col">
                    <label for="" class="label-texto">Termino</label>
                    <input type="date" id="txtFechaTerminoParticipantes" class="caja-texto" placeholder="Apellido Materno"
                        disabled>
                </div>
            </div>

            <div class="form-row separador">
                <div class="col">
                    <label for="" class="label-texto">Cliente</label>
                    <select class="cbx-texto" name="bxClienteParticipantes" id="bxClienteParticipantes" disabled>
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
                <div class="col">
                    <label for="" class="label-texto">Estado</label>
                    <select class="cbx-texto" name="bxEstadoParticipantes" id="bxEstadoParticipantes" disabled>
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                        <?php
                        $Estados = new ControllerCategorias();
                        $verEstados = $Estados->VerEstados();
                        foreach ($verEstados as $TEstados) {
                            ?>
                            <option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
                        <?php }  ?>
                    </select>
                </div>
            </div>

            <div class="form-row separador">
                <div class="col">
                    <label for="" class="label-texto">Responsable</label>
                    <input type="text" id="bxResponsableAct" class="caja-texto" placeholder="" disabled>
                </div>
            </div>

            <br>
            <h3 class="texto-titulo">NUEVO RESPONSABLE:</h3>

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Area</label>
                    <select class="cbx-texto" name="bxAreaParticipantes" id="bxAreaParticipantes">
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                         <?php
                        $Estados = new ControllerCategorias();
                        $verEstados = $Estados->VerAreas();
                        foreach ($verEstados as $TEstados) {
                            ?>
                            <option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
                        <?php }  ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Responsable</label>
                    <select class="cbx-texto" name="bxParticipantes" id="bxParticipantes">
                        <option selected="true" disabled="disabled">Seleccionar..</option>                        
                    </select>
                </div>
            </div>
            
        </div>
    </div>
</div>