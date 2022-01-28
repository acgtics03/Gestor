
<nav class="sidebar-nav">
    <ul id="sidebarnav" class="p-t-30">
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $NAME_SERVER ?>views/home.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">INICIO</span></a></li>

        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo $NAME_SERVER ?>views/img/64/config.png" height="35px" width="35px" alt=""><span class="hide-menu">&nbsp;&nbsp;Configuración</span></a>
            <ul aria-expanded="false" class="collapse  first-level" style="margin-left: 2%;">

                <li class="sidebar-item" <?php echo $input_ocultar; ?>><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM01_Empresas/M01SM01_Empresas.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Empresas </span></a></li>

                <li class="sidebar-item" <?php echo $input_ocultar; ?>><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM15_BeneficiosSociales/M01SM15_BeneficiosSociales.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Beneficios Sociales </span></a></li>

                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM02_Afp/M01SM02_Afp.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Comisiones y Primas AFP </span></a></li>

                <li class="sidebar-item" <?php echo $input_ocultar; ?>><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM03_Conceptos/M01SM03_Conceptos.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Conceptos </span></a></li>

                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM04_Formulacion/M01SM04_Formulacion.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Formulación </span></a></li>

                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM05_TipoCambio/M01SM05_TipoCambio.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Tipo de Cambio </span></a></li>
                
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM07_Planillas/M01SM07_Planillas.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Periodos </span></a></li>

                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM08_Asistencia/M01SM08_Asistencia.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Asistencia</span></a></li>
               
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM13_Parametros/M01SM13_Parametros.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Parámetros </span></a></li>

                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM09_Rmv/M01SM09_Rmv.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;RMV </span></a></li>

                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM10_Uit/M01SM10_Uit.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;UIT </span></a></li>

                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM11_QuintaCateg/M01SM11_QuintaCateg.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Quinta Categoría </span></a></li>

                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM12_Onp/M01SM12_Onp.php" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu">&nbsp;&nbsp;Aporte ONP </span></a></li>

            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo $NAME_SERVER ?>views/img/64/trabajador.png" height="35px" width="35px" alt=""><span class="hide-menu">&nbsp;&nbsp;Trabajador </span></a>
            <ul aria-expanded="false" class="collapse  first-level" style="margin-left: 2%;">
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM01_RegistroPersonal/M02SM01_RegistroPersonal.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Registro de Personal </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM02_RegistroFamiliares/M02SM02_RegistroFamiliares.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Registro de Familiares </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM03_RegistroParametrosPlanilla/M02SM03_RegistroParametrosPlanillas.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Parámetros Planilla </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM04_Renta5taCategoria/M02SM04_RegistroRenta5taCateg.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Calculadora 5ta Categoría </span></a></li>
                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM05_ContratosVencer/M02SM05_ContratosVencer.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Contratos por Vencer </span></a></li>
                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM06_Constancia/M02SM06_Constancias.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Constancia </span></a></li>
                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM07_Depositos/M02SM07_Depositos.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Depósitos </span></a></li>
                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM08_Boletas/M02SM08_Boletas.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Boletas </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM09_Ficha/M02SM09_FichaPersonal.php" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">&nbsp;&nbsp;Ficha </span></a></li>
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo $NAME_SERVER ?>views/img/64/registros.png" height="35px" width="35px" alt=""><span class="hide-menu">&nbsp;&nbsp;Registros </span></a>
            <ul aria-expanded="false" class="collapse  first-level" style="margin-left: 2%;">
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M03_Registros/M03SM01_Contratos/M03SM01_Contratos.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Contratos </span></a></li>
               <!-- <li class="sidebar-item"><a href="<?php //echo $NAME_SERVER ?>views/M03_Registros/M03SM02_DescansoMedico/M03SM02_DescansoMedico.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Descanso Médico </span></a></li>
                <li class="sidebar-item"><a href="<?php //echo $NAME_SERVER ?>views/M03_Registros/M03SM03_Licencias/M03SM03_Licencias.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Licencias </span></a></li>
                <li class="sidebar-item"><a href="<?php //echo $NAME_SERVER ?>views/M03_Registros/M03SM04_Vacaciones/M03SM04_Vacaciones.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Vacaciones </span></a></li>-->
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M03_Registros/M03SM05_ProgramarVacaciones/M03SM05_ProgramarVacaciones.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Vacaciones </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M03_Registros/M03SM06_ProgramarDescansoMedico/M03SM06_ProgramarDescansoMedico.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Descanso Médico </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M03_Registros/M03SM07_ProgramarLicencia/M03SM07_ProgramarLicencia.php" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu">&nbsp;&nbsp;Licencias </span></a></li>
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo $NAME_SERVER ?>views/img/64/procesos.png" height="35px" width="35px" alt=""><span class="hide-menu">&nbsp;&nbsp;Procesos </span></a>
            <ul aria-expanded="false" class="collapse  first-level" style="margin-left: 2%;">
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM01_CargaAsistencia/M04SM01_CargaAsistencia.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Cierre Tareo </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM02_Afp/M01SM02_Afp_principal.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;AFP's </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M01_Configuracion/M01SM11_QuintaCateg/M01SM11_QuintaCategPrincipal.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Quinta Categoría </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM02_PlanillaAperturaCierre/M04SM02_PlanillaAperturaCierre.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Planilla (Apertura y Cierre) </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM11_RHyT/M04SM11_RHyT.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;RH y Terceros </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM03_Cts/M04SM03_Cts.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;CTS </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM04_Rentas/M04SM04_Rentas.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Rentas </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM05_Gratificaciones/M04SM05_Gratificaciones.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Gratificaciones </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM06_Utilidades/M04SM06_Utilidades.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Utilidades </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM07_Liquidaciones/M04SM07_Liquidaciones.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Liquidaciones </span></a></li>
                <li class="sidebar-item" hidden><a href="<?php echo $NAME_SERVER ?>views/M04_Procesos/M04SM08_CierreTareo/M04SM08_CierreTareo.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu">&nbsp;&nbsp;Cierre de Tareo </span></a></li>
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo $NAME_SERVER ?>views/img/64/reportes.png" height="35px" width="35px" alt=""><span class="hide-menu">&nbsp;&nbsp;Reportes </span></a>
            <ul aria-expanded="false" class="collapse  first-level" style="margin-left: 2%;">
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M02_Trabajador/M02SM08_Boletas/M02SM08_Boletas.php" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">&nbsp;&nbsp;Boletas </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M05_Reportes/M05SM02_Planillas/M05SM02_Planillas.php" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">&nbsp;&nbsp;Planillas </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M05_Reportes/M05SM03_Analiticos/M05SM03_Analiticos.php" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">&nbsp;&nbsp;Analíticos </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M05_Reportes/M05SM04_Personalizados/M05SM04_Personalizados.php" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">&nbsp;&nbsp;Personalizados </span></a></li>
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo $NAME_SERVER ?>views/img/64/declaraciones.png" height="35px" width="35px" alt=""><span class="hide-menu">&nbsp;&nbsp;Declaraciones </span></a>
            <ul aria-expanded="false" class="collapse  first-level" style="margin-left: 2%;">
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M06_Declaraciones/M06SM01_PlanillaElectronica/M06SM01_PlanillaElectronica.php" class="sidebar-link"><i class="mdi mdi-note-multiple"></i><span class="hide-menu">&nbsp;&nbsp;Planilla Electrónica </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M06_Declaraciones/M06SM02_AFP.NET/M06SM02_AFP.NET.php" class="sidebar-link"><i class="mdi mdi-note-multiple"></i><span class="hide-menu">&nbsp;&nbsp;AFP.NET </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M06_Declaraciones/M06SM03_PLAME/M06SM03_PLAME.php" class="sidebar-link"><i class="mdi mdi-note-multiple"></i><span class="hide-menu">&nbsp;&nbsp;PLAME </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M06_Declaraciones/M06SM04_T-Registro/M06SM04_T-Registro.php" class="sidebar-link"><i class="mdi mdi-note-multiple"></i><span class="hide-menu">&nbsp;&nbsp;T-Registro </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M06_Declaraciones/M06SM05_ESSALUD/M06SM05_ESSALUD.php" class="sidebar-link"><i class="mdi mdi-note-multiple"></i><span class="hide-menu">&nbsp;&nbsp;ESSALUD </span></a></li>
                <li class="sidebar-item"><a href="<?php echo $NAME_SERVER ?>views/M06_Declaraciones/M06SM06_PagaBancos/M06SM06_PagaBancos.php" class="sidebar-link"><i class="mdi mdi-note-multiple"></i><span class="hide-menu">&nbsp;&nbsp;Paga Bancos </span></a></li>
            </ul>
        </li>
    </ul>
</nav>