<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-cabecera-list" style="text-align:left;">
            <button class="close btn-cerrar" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-window-close" aria-hidden="true"></i>
			</button>
            <span><i class="fa fas fa-edit" aria-hidden="true"></i> Datos de la Actividad </span>
        </div>
        <div class="head-model cabecera-modal-accion">
            <button class="btn btn-registro-success" id="btnGuardarPopup"><i class="fa fa-save"></i> Guardar</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="txtIDActividadPopup">

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Nombre</label>
                    <select class="cbx-texto" name="bxNombreActividadPopup" id="bxNombreActividadPopup">
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="" class="label-texto">Descripción</label>
                    <textarea id="txtDescripcionPopup" class="caja-texto cbx-tam descripcion" maxlength="200" onkeypress="cancelar()"></textarea>
                </div>
            </div>

            <div class="form-row" hidden>
                <div class="col">
                    <label for="" class="label-texto">Responsable</label>
                    <select class="cbx-texto" name="bxResponsablePopup" id="bxResponsablePopup">
                        <option selected="true" disabled="disabled">Seleccionar..</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <label for="" class="label-texto">Cliente <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                        <select class="cbx-texto" name="bxClientePopup" id="bxClientePopup">
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
                    <label class="label-texto">Tipo <small id="boxmotivo_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                        <select class="cbx-texto" name="bxTipoPopup" id="bxTipoPopup">
                            <option selected="true" disabled="disabled">Seleccionar..</option>
                            <?php
                            $Tipos = new ControllerCategorias();
                            $verTipos = $Tipos->VerTipos();
                            foreach ($verTipos as $TTipos) {
                                ?>
                                <option value="<?php echo $TTipos['ID']; ?>"><?php echo $TTipos['Nombre']; ?></option>
                            <?php }  ?>
                        </select>
                </div>


                <div class="col-md-6">
                    <label for="" class="label-texto">Fec. Inicio <small id="txtFechaBajaRegistroHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="date" id="txtFechaInicioPopup" class="caja-texto">

                </div>
                <div class="col-md-6">
                    <label class="label-texto">Fec. Termino <small id="boxmotivo_eliminarHtml"
                            class="form-text text-muted-validacion text-danger ocultar-info">
                        </small></label>
                    <input type="date" id="txtFechaTerminoPopup" class="caja-texto">
                </div>

                <div class="col-md-6">
                    <label for="" class="label-texto">Hr Inicio <small id="txtFechaBajaRegistroHtml"
                        class="form-text text-muted-validacion text-danger ocultar-info">
                    </small></label>

                    <div class="row">
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtHoraInicioPopup" id="txtHoraInicioPopup" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                            <input type="number" class="caja-texto" name="txtMinutosInicioPopup" id="txtMinutosInicioPopup" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                    <label for="" class="label-texto">Hr Inicio Real<small id="txtFechaBajaRegistroHtml"
                        class="form-text text-muted-validacion text-danger ocultar-info">
                    </small></label>

                    <div class="row">
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtHoraInicioRealPopup" id="txtHoraInicioRealPopup" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                            <input type="number" class="caja-texto" name="txtMinutosInicioRealPopup" id="txtMinutosInicioRealPopup" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                            <input type="number" class="caja-texto" name="txtHoraTerminoPopup" id="txtHoraTerminoPopup" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                            <input type="number" class="caja-texto" name="txtMinutosTerminoPopup" id="txtMinutosTerminoPopup" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                    <label class="label-texto">Hr Termino Real<small id="boxmotivo_eliminarHtml"
                        class="form-text text-muted-validacion text-danger ocultar-info">
                    </small></label>

                    <div class="row">
                        <div class="col">
                            <input type="number" class="caja-texto" name="txtHoraTerminoRealPopup" id="txtHoraTerminoRealPopup" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                            <input type="number" class="caja-texto" name="txtMinutosTerminoRealPopup" id="txtMinutosTerminoRealPopup" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                    <select class="cbx-texto" name="bxEstadoPopup" id="bxEstadoPopup">
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
        </div>
    </div>
</div>