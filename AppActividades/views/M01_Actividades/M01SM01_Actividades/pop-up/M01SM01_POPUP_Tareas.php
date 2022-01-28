<div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 1000px;">

    <div class="modal-content" style="width: 1000px;">
        <div class="modal-cabecera-list" style="text-align:left;">
            <button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
                    aria-hidden="true"></i></button>
            <span><i class="fa fa-list" aria-hidden="true"></i> Registro de Tareas </span>
        </div>
        <div class="head-model cabecera-modal-accion">
            <button class="btn btn-registro-success" id="btnGuardarTarea"><i class="fa fa-save"></i> Guardar</button>
        </div>
        <div class="modal-body" style="width: 900px;">
            <input type="hidden" id="txtIDActividadTareas">
            <label for="" class="label-texto">DATOS DE LA ACTIVIDAD</label>
            <div class="form-row separador">                
                <div class="col">
                    <label for="" class="label-texto">Nombre</label>
                    <select class="cbx-texto" name="bxNombreActividadTarea" id="bxNombreActividadTarea" disabled>
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="" class="label-texto">Fecha Inicio</label>
                    <input type="date" id="txtFechaInicioTarea" class="caja-texto" disabled>
                </div>
                <div class="col-2">
                    <label for="" class="label-texto">Fecha Termino</label>
                    <input type="date" id="txtFechaTerminoTarea" class="caja-texto" disabled>
                </div>
                <div class="col">
                    <label for="" class="label-texto">Cliente <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                        <select class="cbx-texto" name="bxClienteActividadTarea" id="bxClienteActividadTarea" disabled>
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
            </div>
            <div class="form-row" hidden>              
                <div class="col-md-12">
                    <label class="label-texto">Descripcion <small id="descripcion_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <textarea rows="4" maxlength="150" id="txtDescripcionActividadTarea" class="caja-texto"
                        placeholder="Describa la tarea" style="height: 40px;resize: none;" disabled></textarea>
                </div>
            </div>

            <br>
            <label for="" class="label-texto">DATOS DE LA TAREA</label>
            <div class="form-row separador">
                <div class="col">
                    <label for="" class="label-texto">Nombre</label>
                    <input type="text" id="txtNombreTarea" class="caja-texto" placeholder="Escriba aquí">
                </div>
                <div class="col">
                    <label for="" class="label-texto">Responsable</label>
                    <select class="cbx-texto" name="bxResponsableTarea" id="bxResponsableTarea">
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                    </select>
                </div>                                
            </div>

            <div class="form-row separador">

                <div class="col-3">
                    <label for="" class="label-texto">Fecha Inicio</label>
                    <input type="date" id="txtFechaInicioTareas" class="caja-texto">
                </div>

                <div class="col-3">
                    <label for="" class="label-texto">Fecha Termino</label>
                    <input type="date" id="txtFechaTerminoTareas" class="caja-texto">
                </div>

                <div class="col">
                    <label for="" class="label-texto">Hora de Inicio</label>
                    <input type="number" class="caja-texto" name="txtHoraInicioTarea" id="txtHoraInicioTarea" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                <div class="col">
                    <label for="" class="label-texto"></label>
                    <input type="number" class="caja-texto" name="txtMinutosInicioTarea" id="txtMinutosInicioTarea" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" style="margin-top: 16%;">
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
                <div class="col">
                    <label for="" class="label-texto">Hora de Termino</label>
                    <input type="number" class="caja-texto" name="txtHoraTerminoTarea" id="txtHoraTerminoTarea" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                <div class="col">
                    <label for="" class="label-texto"></label>
                    <input type="number" class="caja-texto" name="txtMinutosTerminoTarea" id="txtMinutosTerminoTarea" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" style="margin-top: 16%;">
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


            <div class="form-row">              
                <div class="col-md-12">
                    <label class="label-texto">Descripcion <small id="descripcion_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <textarea rows="4" maxlength="150" id="txtDescripcionTarea" class="caja-texto"
                        placeholder="Describa la tarea" style="height: auto;resize: none;" required></textarea>
                </div>
            </div>


            <div class="form-row">     
                <div class="col-md-12">
                    <div class="table-responsive tamanio-tabla">
                        <table class="table table-striped table-bordered w-100" cellspacing="0"
                            id="TablaTareas">
                            <thead class="cabecera">
                                <tr>
                                    <th></th>
                                    <th>REGISTRO</th>
                                    <th>INICIO</th>
                                    <th>TERMINO</th>
                                    <th>ESTADO</th>
                                    <th>NOMBRE</th>
                                    <th>RESPONSABLE</th>
                                </tr>
                            </thead>
                            <tbody class="control-detalle">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>