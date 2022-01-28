<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

    <div class="modal-content">
        <div class="modal-cabecera-list" style="text-align:left;">
            <button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
                    aria-hidden="true"></i></button>
            <span><i class="fa fas fa-edit" aria-hidden="true"></i> Datos de la Tarea </span>
        </div>
        <div class="head-model cabecera-modal-accion">
            <button class="btn btn-registro-success" id="btnEditarTarea"><i class="fa fa-save"></i> Guardar</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="txtIDActividadTareas2">

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Nombre</label>
                    <input type="text" id="txtNombreTarea2" class="caja-texto" placeholder="Apellido Paterno">
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Descripción</label>
                   <textarea rows="4" maxlength="150" id="txtDescripcionTarea2" class="caja-texto"
                        placeholder="Describa la tarea" style="height: auto;resize: none;" required></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Responsable</label>
                    <select class="cbx-texto" name="bxResponsableTarea2" id="bxResponsableTarea2">
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <label for="" class="label-texto">Fec. Inicio <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="date" id="txtFechaInicioTarea2" class="caja-texto">

                </div>
                <div class="col-md-6">
                    <label class="label-texto">Fec. Termino <small id="boxmotivo_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="date" id="txtFechaTerminoTarea2" class="caja-texto">
                </div>

                <div class="col-md-6">
                    <label for="" class="label-texto">Hr Inicio <small id="txtFechaBajaRegistroHtml"
                        class="form-text text-muted-validacion text-danger ocultar-info">
                    </small></label>

                    <div class="row">
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtHoraInicioTarea2" id="txtHoraInicioTarea2" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
                            <datalist id="horas">
                                <?php
                                $Horas = new ControllerCategorias();
                                $verHoras = $Horas->VerHoras();
                                foreach ($verHoras as $THoras) {
                                    ?>
                                    <option value="<?php echo $THoras['ID']; ?>"><?php echo $THoras['Nombre']; ?></option>
                                <?php }  ?>
                            </datalist>  
                        </div>
                        <label for="">:</label>
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtMinutosInicioTarea2" id="txtMinutosInicioTarea2" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
                            <datalist id="Minutos">
                                <?php
                                $Minutos = new ControllerCategorias();
                                $verMinutos = $Minutos->VerMinutos();
                                foreach ($verMinutos as $TMinutos) {
                                    ?>
                                    <option value="<?php echo $TMinutos['ID']; ?>"><?php echo $TMinutos['Nombre']; ?></option>
                                <?php }  ?>
                            </datalist>  
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="label-texto">Hr Termino <small id="boxmotivo_eliminarHtml"
                        class="form-text text-muted-validacion text-danger ocultar-info">
                    </small></label>

                    <div class="row">
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtHoraTerminoTarea2" id="txtHoraTerminoTarea2" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
                            <datalist id="horas">
                                <?php
                                $Horas = new ControllerCategorias();
                                $verHoras = $Horas->VerHoras();
                                foreach ($verHoras as $THoras) {
                                    ?>
                                    <option value="<?php echo $THoras['ID']; ?>"><?php echo $THoras['Nombre']; ?></option>
                                <?php }  ?>
                            </datalist>  
                        </div>
                        <label for="">:</label>
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtMinutosTerminoTarea2" id="txtMinutosTerminoTarea2" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
                            <datalist id="Minutos">
                                <?php
                                $Minutos = new ControllerCategorias();
                                $verMinutos = $Minutos->VerMinutos();
                                foreach ($verMinutos as $TMinutos) {
                                    ?>
                                    <option value="<?php echo $TMinutos['ID']; ?>"><?php echo $TMinutos['Nombre']; ?></option>
                                <?php }  ?>
                            </datalist>  
                        </div>
                    </div>                                             
                </div>

            </div>
            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Estado</label>
                    <select class="cbx-texto" name="bxEstadoTarea2" id="bxEstadoTarea2">
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                        <?php
                        $Estados = new ControllerCategorias();
                        $verEstados = $Estados->VerEstadosTareas();
                        foreach ($verEstados as $TEstados) {
                            ?>
                            <option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
                        <?php }  ?>
                    </select>   
                </div>
            </div>
        </div>
    </div>
</div>