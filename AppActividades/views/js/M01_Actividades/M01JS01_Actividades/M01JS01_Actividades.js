var timeoutDefecto = 1000 * 60;
var ListaSeleccionada = Array();
$(document).ready(function() {
    Control();
});

function Control() {
    $('.modal').on("hidden.bs.modal", function(e) {
        if ($('.modal:visible').length) {
            $('body').addClass('modal-open');
        }
    });
    ValidarPerfil();
    LlenarFechas();
    ListarActividadesDiarias();
    ListarActividadesDiariasReporte();
    LlenarTipoActividad();


   BuscarActividadesGenerados();
   InicializarAtributosTablaBusquedaCabActividades();
   LlenarTablaActividadesGeneradosReporte();

   LlenarResponsables();
   LlenarFiltroResponsables();

    $('#guardar').click(function() {
        Registrar();
     });

    $('#btnbuscar').click(function() {
        //$('#TablaActividades').DataTable().ajax.reload();
        //$('#TablaActividadesReporte').DataTable().ajax.reload();
        BuscarActividadesGenerados();
        //InicializarAtributosTablaBusquedaCabActividades();
     });

    $('#btnlimpiar').click(function() {
        Limpiar();
        //$('#TablaActividades').DataTable().ajax.reload();
       // $('#TablaActividadesReporte').DataTable().ajax.reload();
       BuscarActividadesGenerados();
        InicializarAtributosTablaBusquedaCabActividades();
     });


    $('#btnGuardarPopup').click(function() {
        GuardarPopup();
     });

    $('#btnCerrarSesion').click(function() {
        ConsultaCerrarSesion();
     });

      $('#btnGuardarTarea').click(function() {
        GuardarTareaPopup();
     });

       $('#btnEditarTarea').click(function() {
        EditarTareaPopup();
     });


  //POPUP PARTICIPANTES

    $('#bxAreaParticipantes').change(function() {
        $("#bxParticipantes").val("");
        var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD04_ListarActividades.php';
        var datos = {
            "ReturnListaParticipantes": true,
            "area": $('#bxAreaParticipantes').val()
        }
        document.getElementById('bxParticipantes').selectedIndex = 0;
        llenarCombo(url, datos, "bxParticipantes");
    });

    $('#btnRegistrarParticipante').click(function() {
        RegistrarParticipantesPopup();
     });


    //POP ELIMINAR ACTIVIDAD

     $('#btnEliminarActividad').click(function() {
        VerificarEliminarActividad();
     });



}

function LlenarFechas() {

   bloquearPantalla("Buscando...");
    var data = {
        "btnLlenarFechas": true
    };
    $.ajax({
        type: "POST",
        url: "../../models/M02_Supervisar/M02MD01_Supervisar/M02MD01_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                $("#txtfiltroFecInicio").val(dato.fecha1);
                $("#txtfiltroFecTermino").val(dato.fecha2);
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}


/*****************************************LLENAR TABLA LISTA********************************************* */
function ListarActividadesDiarias() {

    var options = $.extend(true, {}, defaults, {
        "order": [
            [1, "asc"]
        ],
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0],
            "targets": [0],
            "visible": false
        }],
        "iDisplayLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
        "tableTools": {
            "aButtons": []
        },
        "bFilter": false,
        "bSort": true,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 20, 50, 100, 150],
            [10, 20, 50, 100, 150] // change per page values here
        ],
        "pageLength": 10, // default record count per page,
        "ajax": {
            "url": "../../models/M01_Actividades/M01MD01_Actividades/M01MD01_Actividades.php", // ajax source
            "type": "POST",
            "error": validarErrorGrilla,
            "data": function(d) {
                return $.extend({}, d, {

                });
            }
        },
        "columns": [
            { "data": "id" },
            {
                "data": "estado",
                "render": function(data, type, row) {
                    var html = "";
                    if (parseInt(data) === 1) {
                        html = '<span class="badge badge-plan">' + row.descEstado + '</span>';
                    } else {
                        if (parseInt(data) === 2) {
                        html = '<span class="badge badge-proce">' + row.descEstado + '</span>';
                        } else {
                            if (parseInt(data) === 3) {
                                html = '<span class="badge badge-final">' + row.descEstado + '</span>';
                            } else {
                                html = '<span class="badge badge-dete">' + row.descEstado + '</span>';
                            }
                        }
                    }
                    return html;
                }
            },
            { "data": "tiempo" },
            { "data": "empresa" },
            { "data": "nombre" }

        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });

    $('#TablaActividadesDiarias').DataTable(options);
}

function ListarActividadesDiariasReporte() {
    var options = $.extend(true, {}, defaults, {
        "aoColumnDefs": [{
        }],
        "iDisplayLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "sDom": 'Bfrtilp',
        "tableTools": {
            "aButtons": []
        },
        "bFilter": false,
        "paging": false,
        "info": false,
        "bSort": false,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 20, 50, 100, 150],
            [10, 20, 50, 100, 150] // change per page values here
        ],
        "pageLength": 1000000000, // default record count per page,
        "ajax": {
            "url": "../../models/M01_Actividades/M01MD01_Actividades/M01MD01_Actividades.php", // ajax source
            "type": "POST",
            "error": validarErrorGrilla,
            "data": function(d) {
                return $.extend({}, d, {
                });
            }
        },
        "columns": [
            { "data": "contador" },
            { "data": "estado" },
             { "data": "tiempo" },
            { "data": "empresa" },
            { "data": "nombre" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        responsive: "true",

        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info'
            },
        ]

    });

    $('#TablaActividadesDiariasReporte').DataTable(options);
}


function LlenarTipoActividad(){
    document.getElementById('bxTipoActividad').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarTiposActividad": true
    }
    llenarCombo(url, datos, "bxTipoActividad");
}

function LlenarResponsables(){
    document.getElementById('bxTipoActividad').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarResponsables": true
    }
    llenarCombo(url, datos, "bxResponsable");
}

function LlenarResponsablesPopup(){
    document.getElementById('bxResponsable').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarResponsables": true
    }
    llenarCombo(url, datos, "bxResponsable");
}

function LlenarFiltroResponsables(){
    document.getElementById('bxfiltroResponsable').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarFiltroResponsables": true
    }
    llenarCombo(url, datos, "bxfiltroResponsable");
}


function LlenarTipoActividadPopup(){
    document.getElementById('bxNombreActividadPopup').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarTiposActividadPopup": true
    }
    llenarCombo(url, datos, "bxNombreActividadPopup");
}

function LlenarTipoActividadComent(){
    document.getElementById('bxNombreActividadComent').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarTiposActividadPopup": true
    }
    llenarCombo(url, datos, "bxNombreActividadComent");
}

function LlenarNombresActividadTarea(){
    document.getElementById('bxNombreActividadTarea').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarTiposActividadTarea": true
    }
    llenarCombo(url, datos, "bxNombreActividadTarea");
}

function cancelar() {
    var key = event.keyCode;

    if (key === 13) {
        event.preventDefault();
    }
}


function Registrar() {
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnRegistrar": true,
        "bxTipoActividad": $("#bxTipoActividad").val(),
        "txtDescripcion": $("#txtDescripcion").val(),
        "bxResponsable": $("#bxResponsable").val(),
        "bxCliente": $("#bxCliente").val(),
        "bxTipo": $("#bxTipo").val(),
        "txtFechaInicio": $("#txtFechaInicio").val(),
        "txtFechaTermino": $("#txtFechaTermino").val(),
        "txtHoraInicio": $("#txtHoraInicio").val(),
        "txtMinutosInicio": $("#txtMinutosInicio").val(),
        "txtHoraFin": $("#txtHoraFin").val(),
        "txtMinutosFin": $("#txtMinutosFin").val(),
        "txtHoraInicioReal": $("#txtHoraInicioReal").val(),
        "txtMinutosInicioReal": $("#txtMinutosInicioReal").val(),
        "txtHoraFinReal": $("#txtHoraFinReal").val(),
        "txtMinutosFinReal": $("#txtMinutosFinReal").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD02_RegistrarActividad.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    //$('#TablaActividades').DataTable().ajax.reload();
                    //$('#TablaActividadesReporte').DataTable().ajax.reload();
                    BuscarActividadesGenerados();
                    //InicializarAtributosTablaBusquedaCabActividades();

                    $('#TablaActividadesDiarias').DataTable().ajax.reload();
                    $('#TablaActividadesDiariasReporte').DataTable().ajax.reload();

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function Limpiar(){
    $("#txtfiltroFecInicio").val("");
    $("#txtfiltroFecTermino").val("");
    document.getElementById('bxfiltroEstado').selectedIndex = 0;
    document.getElementById('bxfiltroIdentificador').selectedIndex = 0;
    document.getElementById('bxfiltroCliente').selectedIndex = 0;
    document.getElementById('bxfiltroResponsable').selectedIndex = 0;
}



/******************************************LISTAR BUSQUEDA CABECERA**************************************** */
function BuscarActividadesGenerados() {
    bloquearPantalla("Buscando...");
    var url = "../../models/M01_Actividades/M01MD01_Actividades/M01MD04_ListarActividades.php";
    var dato = {
        "ReturnListaActividades": true,
        "txtfiltroFecInicio": $("#txtfiltroFecInicio").val(),
        "txtfiltroFecTermino": $("#txtfiltroFecTermino").val(),
        "bxfiltroEstado": $("#bxfiltroEstado").val(),
        "bxfiltroIdentificador": $("#bxfiltroIdentificador").val(),
        "bxfiltroCliente": $("#bxfiltroCliente").val(),
        "bxfiltroResponsable": $("#bxfiltroResponsable").val()
    };
    realizarJsonPost(url, dato, respuestaBuscarActividadesGenerados, null, 10000, null);
}

function respuestaBuscarActividadesGenerados(dato) {
    desbloquearPantalla();
    console.log(dato);
    LlenarTablaActividadesGenerados(dato.data);
    $('#TablaActividadesReporte').DataTable().ajax.reload();
}

var getTablaBusquedaCabGenerado = null;

function LlenarTablaActividadesGenerados(datos) {
    if (getTablaBusquedaCabGenerado) {
        getTablaBusquedaCabGenerado.destroy();
        getTablaBusquedaCabGenerado = null;
    }

    getTablaBusquedaCabGenerado = $('#TablaActividades').DataTable({
        "data": datos,
        "columnDefs": [{
                'aTargets': [0],
                'ordering': false,
                'width': "1%"
            },
            {
                'aTargets': [1],
                'ordering': false,
                'width': "1%"
            }
        ],
        ordering: false,
        "info": true,
        "searching": false,
        "lengthChange": false,
        "paging": true,
        destroy: true,
        "pageLength": 10,
        "lengthMenu": [
            [10, -1],
            [10, "Todos"]
        ],
        columns: [{
                className: 'details-control',
                defaultContent: '',
                data: null,
                orderable: true
            },{
                "data": "id",
                "render": function(data, type, row) {
                    return '<button class="btn btn-edit-action"   onclick="AbrirModalRegistroActualizar(\'' + data + '\')"><i class="fas fa-pencil-alt"></i></button>\
                    <button class="btn btn-info btn-success-action"  onclick="AbrirModalTareas(\'' + data + '\')"><i class="fas fa-list"></i></button>\
                    <button class="btn btn-info btn-edit-action"  onclick="AbrirModalParticipantes(\'' + data + '\')"><i class="fas fa-users"></i></button>\
                    <button class="btn btn-info btn-delete-action"  onclick="AbrirModalEliminarActividad(\'' + data + '\')"><i class="fas fa-trash"></i></button>\
                    <button class="btn btn-info btn-success-action"  onclick="AbrirModalFinalizarActividad(\'' + data + '\')"><i class="fas  fa-clipboard-check"></i></button>\
                    <button class="btn btn-info btn-comments-action"  onclick="AbrirModalComentariosActividades(\'' + data + '\')"><i class="fas fa-comments"></i></button>';
                }
            },
            { "data": "registro" },
            { "data": "fecha" },
            { "data": "fechafin" },
             {
                "data": "estado",
                "render": function(data, type, row) {
                    var html = "";
                    if (parseInt(data) === 1) {
                        html = '<span class="badge badge-plan">' + row.descEstado + '</span>';
                    } else {
                        if (parseInt(data) === 2) {
                        html = '<span class="badge badge-proce">' + row.descEstado + '</span>';
                        } else {
                            if (parseInt(data) === 3) {
                                html = '<span class="badge badge-final">' + row.descEstado + '</span>';
                            } else {
                                html = '<span class="badge badge-dete">' + row.descEstado + '</span>';
                            }
                        }
                    }
                    return html;
                }
            },
            { "data": "cliente" },
            { "data": "tareas" },
            { "data": "nombre" },
            { "data": "dato" }
        ],
        "select": {
            style: 'single'
        },
        "keys": {
            keys: [13 /* ENTER */ , 38 /* UP */ , 40 /* DOWN */ ]
        },
        "order": [
            [2, 'asc']
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });
    setTimeout(function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    }, 100);

}

function LlenarTablaActividadesGeneradosReporte() {
    var options = $.extend(true, {}, defaults, {
        "aoColumnDefs": [{
        }],
        "iDisplayLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "sDom": 'Bfrtilp',
        "tableTools": {
            "aButtons": []
        },
        "bFilter": false,
        "paging": false,
        "info": false,
        "bSort": false,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 20, 50, 100, 150],
            [10, 20, 50, 100, 150] // change per page values here
        ],
        "pageLength": 1000000000, // default record count per page,
        "ajax": {
            "url": "../../models/M01_Actividades/M01MD01_Actividades/M01MD04_ListarActividades.php", // ajax source
            "type": "POST",
            "error": validarErrorGrilla,
            "data": function(d) {
                return $.extend({}, d, {
                    "ReturnListaActividades": true,
                    "txtfiltroFecInicio": $("#txtfiltroFecInicio").val(),
                    "txtfiltroFecTermino": $("#txtfiltroFecTermino").val(),
                    "bxfiltroEstado": $("#bxfiltroEstado").val(),
                    "bxfiltroIdentificador": $("#bxfiltroIdentificador").val(),
                    "bxfiltroCliente": $("#bxfiltroCliente").val(),
                    "bxfiltroResponsable": $("#bxfiltroResponsable").val()
                });
            }
        },
        "columns": [
            { "data": "registro" },
            { "data": "fecha" },
            { "data": "fechafin" },
            { "data": "descEstado" },
            { "data": "cliente" },
            { "data": "tareas" },
            { "data": "nombre" },
            { "data": "dato" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        responsive: "true",

        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info'
            },
        ]

    });

    $('#TablaActividadesReporte').DataTable(options);
}


function format(data) {

    return '<div class="table-child">' +
        '<table  class="table table-striped table-bordered  w-100" id="TablaTareasReportt" style="margin-top: -1px !important;">' +
        '<thead class="cabecera-child">' +
        '<tr>' +
        ' <th>Registro</th>' +
        ' <th>Inicio</th>' +
        ' <th>Termino</th>' +
        ' <th>Estado</th>' +
        ' <th>Nombre</th>' +
        ' <th>Descripcion</th>' +
        ' <th>Responsable</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>' +
        '</tbody>' +
        '</table>' +
        '</div>';
};


function InicializarAtributosTablaBusquedaCabActividades() {

    $('#TablaActividades').on('key-focus.dt', function(e, datatable, cell) {

        getTablaBusquedaCabGenerado.row(cell.index().row).select();
        var data = getTablaBusquedaCabGenerado.row(cell.index().row).data();
    });

    $('#TablaActividades').on('click', 'tbody td', function(e) {
        e.stopPropagation();
        var rowIdx = getTablaBusquedaCabGenerado.cell(this).index().row;
        getTablaBusquedaCabGenerado.row(rowIdx).select();
    });
    $('#TablaActividades tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = getTablaBusquedaCabGenerado.row(tr);
        var open = row.child.isShown();
        getTablaBusquedaCabGenerado.rows().every(function(rowIdx, tableLoop, rowLoop) {
            if (this.child.isShown()) {
                this.child.hide();
                $(this.node()).removeClass('shown');
            }
        });
        if (!open) {
            row.child(format(row.data())).show();
            tr.next('tr').addClass('details-row');
            tr.addClass('shown');
            var data = row.data();
            BuscarTareasGenerado(data.id);
        }
    });
}

function BuscarTareasGenerado(codigo) {
    bloquearPantalla("Buscando...");
    var url = "../../models/M01_Actividades/M01MD01_Actividades/M01MD04_ListarActividades.php";
    var dato = {
        "ReturnListaTareas": true,
        "Codigo": codigo
    };
    realizarJsonPost(url, dato, respuestaBuscarMovimientoDetalleGenerado, null, 10000, null);
}

function respuestaBuscarMovimientoDetalleGenerado(dato) {
    desbloquearPantalla();
    CargarTablaBusquedaDetalleMovimientoGenerado(dato.data);
}

var getTablaBusquedaTareasGenerado = null;

function CargarTablaBusquedaDetalleMovimientoGenerado(data) {
    console.log(data);
    if (getTablaBusquedaTareasGenerado) {
        getTablaBusquedaTareasGenerado.destroy();
        getTablaBusquedaTareasGenerado = null;
    }

    getTablaBusquedaTareasGenerado = $('#TablaTareasReportt').DataTable({
        "data": data,
        "order": [
            [0, "desc"]
        ],
        "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
        "ordering": false,
        "info": false,
        "searching": false,
        "lengthChange": false,
        "paging": true,
        destroy: true,
        "pageLength": 10,
        "lengthMenu": [
            [10, -1],
            [10, "Todos"]
        ],
        "columns": [
            { "data": "registro" },
            { "data": "inicio" },
            { "data": "termino" },
            {
                "data": "estado",
                "render": function(data, type, row) {
                    var html = "";
                    if (parseInt(data) === 1) {
                        html = '<span class="badge badge-plan">' + row.descEstado + '</span>';
                    } else {
                        if (parseInt(data) === 2) {
                        html = '<span class="badge badge-proce">' + row.descEstado + '</span>';
                        } else {
                            if (parseInt(data) === 3) {
                                html = '<span class="badge badge-final">' + row.descEstado + '</span>';
                            } else {
                                html = '<span class="badge badge-dete">' + row.descEstado + '</span>';
                            }
                        }
                    }
                    return html;
                }
            },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "responsable" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });

}




/************************-------------  BOTON DE EDITAR ---------------************************/

function AbrirModalRegistroActualizar(id) {
   LlenarTipoActividadPopup();
   LlenarResponsablesPopup();
  // $('#modalRegistrar').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarDatosActividad": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtIDActividadPopup").val(resultado.id);
                $("#bxNombreActividadPopup").val(resultado.nombre);
                $("#txtDescripcionPopup").val(resultado.descripcion);
                $("#txtFechaInicioPopup").val(resultado.fechaini);
                $("#txtFechaTerminoPopup").val(resultado.fechafin);
                $("#txtHoraInicioPopup").val(resultado.Horaini);
                $("#txtMinutosInicioPopup").val(resultado.Minutosini);
                $("#txtHoraTerminoPopup").val(resultado.Horafin);
                $("#txtMinutosTerminoPopup").val(resultado.Minutosfin);
                $("#txtHoraInicioRealPopup").val(resultado.Horainireal);
                $("#txtMinutosInicioRealPopup").val(resultado.Minutosinireal);
                $("#txtHoraTerminoRealPopup").val(resultado.Horafinreal);
                $("#txtMinutosTerminoRealPopup").val(resultado.Minutosfinreal);
                $("#bxResponsablePopup").val(resultado.responsable);
                $("#bxEstadoPopup").val(resultado.estado);
                $("#bxClientePopup").val(resultado.cliente);
                $("#bxTipoPopup").val(resultado.tipo);

                $('#modalRegistrar').modal('show');
                return;
            } else {
                mensaje_alerta("¡IMPORTANTE!", dato.data, "info");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function GuardarPopup() {
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnActualizarActividad": true,
        "txtIDActividadPopup": $("#txtIDActividadPopup").val(),
        "bxNombreActividadPopup": $("#bxNombreActividadPopup").val(),
        "txtDescripcionPopup": $("#txtDescripcionPopup").val(),
        "bxResponsablePopup": $("#bxResponsablePopup").val(),
        "bxClientePopup": $("#bxClientePopup").val(),
        "bxTipoPopup": $("#bxTipoPopup").val(),
        "txtFechaInicioPopup": $("#txtFechaInicioPopup").val(),
        "txtFechaTerminoPopup": $("#txtFechaTerminoPopup").val(),
        "txtHoraInicioPopup": $("#txtHoraInicioPopup").val(),
        "txtMinutosInicioPopup": $("#txtMinutosInicioPopup").val(),
        "txtHoraTerminoPopup": $("#txtHoraTerminoPopup").val(),
        "txtMinutosTerminoPopup": $("#txtMinutosTerminoPopup").val(),
        "txtHoraInicioRealPopup": $("#txtHoraInicioRealPopup").val(),
        "txtMinutosInicioRealPopup": $("#txtMinutosInicioRealPopup").val(),
        "txtHoraTerminoRealPopup": $("#txtHoraTerminoRealPopup").val(),
        "txtMinutosTerminoRealPopup": $("#txtMinutosTerminoRealPopup").val(),
        "bxEstadoPopup": $("#bxEstadoPopup").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    //$('#TablaActividades').DataTable().ajax.reload();
                    //$('#TablaActividadesReporte').DataTable().ajax.reload();
                    BuscarActividadesGenerados();
                    //InicializarAtributosTablaBusquedaCabActividades();

                    $('#TablaActividadesDiarias').DataTable().ajax.reload();
                    $('#TablaActividadesDiariasReporte').DataTable().ajax.reload();

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}



/*****************************-------------  BOTON DE TAREAS ---------------**********************/

function AbrirModalTareas(id) {
    LlenarNombresActividadTarea()
  // $('#modalRegistrar').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarDatosActividadTarea": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtIDActividadTareas").val(resultado.id);
                $("#bxNombreActividadTarea").val(resultado.nombre);
                $("#txtFechaInicioTarea").val(resultado.fechaini);
                $("#txtFechaTerminoTarea").val(resultado.fechafin);
                $("#bxClienteActividadTarea").val(resultado.cliente);
                $("#txtDescripcionActividadTarea").val(resultado.descripcion);

                $('#modalTareas').modal('show');
                BuscarTareasPopup(resultado.id);
                ListarResponsablesTarea(resultado.id)

                return;
            } else {
                mensaje_alerta("¡Error!", dato.data + "\n" + dato.dataDB, "error");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function BuscarTareasPopup(id) {
    bloquearPantalla("Cargando...");
    var url = "../../models/M01_Actividades/M01MD01_Actividades/M01MD06_ListarTareas.php";
    var dato = {
        "ListarTareas": true,
        "txtIDActividadTareas": id
    };
    realizarJsonPost(url, dato, respuestaBuscarTareas, null, 10000, null);
}

function respuestaBuscarTareas(dato) {
    desbloquearPantalla();
    if (dato.status === "ok") {
        ListaTareasPopup = dato.data;
        CargarTablaTareas(ListaTareasPopup);
        return;
    }
}

var getTablaTareasPopup = null;

function CargarTablaTareas(data) {
    if (getTablaTareasPopup) {
        getTablaTareasPopup.destroy();
        getTablaTareasPopup = null;
    }
    getTablaTareasPopup = $('#TablaTareas').DataTable({
        "data": data,
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [
            { "width": "1%", "targets": 0 },
            { "width": "1%", "targets": 2 },
            { "width": "1%", "targets": 3 }
        ],
        "info": false,
        "searching": false,
        "pageLength": 10,
        "lengthMenu": [
            [10, -1],
            [10, "Todos"]
        ],
        "bLengthChange": false,
        "select": {
            style: 'single'
        },
        "keys": {
            keys: [13 /* ENTER */ , 38 /* UP */ , 40 /* DOWN */ ]
        },
        "columns": [{
                "data": "id",
                "render": function(data, type, row) {
                    return '<button class="btn btn-edit-action"   onclick="AbrirModalUpdateTareas(\'' + data + '\')"><i class="fas fa-pencil-alt"></i></button>\
                    <button class="btn btn-info btn-delete-action"  onclick="AbrirModalEliminarTareas(\'' + data + '\')"><i class="fas fa-trash"></i></button>\
                    <button class="btn btn-info btn-comments-action"  onclick="AbrirModalComentariosTareas(\'' + data + '\')"><i class="fas fa-comments"></i></button>';
                }
            },
            { "data": "registro" },
            { "data": "inicio" },
            { "data": "termino" },
            {
                "data": "estado",
                "render": function(data, type, row) {
                    var html = "";
                    if (parseInt(data) === 1) {
                        html = '<span class="badge badge-plan">' + row.descEstado + '</span>';
                    } else {
                        if (parseInt(data) === 2) {
                        html = '<span class="badge badge-proce">' + row.descEstado + '</span>';
                        } else {
                            if (parseInt(data) === 3) {
                                html = '<span class="badge badge-final">' + row.descEstado + '</span>';
                            } else {
                                html = '<span class="badge badge-dete">' + row.descEstado + '</span>';
                            }
                        }
                    }
                    return html;
                }
            },
            { "data": "nombre" },
            { "data": "responsable" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
}

function AbrirModalUpdateTareas(id){

     ListarResponsablesTarea2(id);
     AbrirModalEditarTareas(id);
}

function AbrirModalEditarTareas(id) {

  // $('#modalRegistrar').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarDatosTarea": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtIDActividadTareas2").val(resultado.id);
                $("#txtNombreTarea2").val(resultado.nombre);
                $("#txtFechaInicioTarea2").val(resultado.fechaini);
                $("#txtFechaTerminoTarea2").val(resultado.fechafin);
                $("#txtHoraInicioTarea2").val(resultado.Horaini);
                $("#txtMinutosInicioTarea2").val(resultado.Minutosini);
                $("#txtHoraTerminoTarea2").val(resultado.Horafin);
                $("#txtMinutosTerminoTarea2").val(resultado.Minutosfin);
                $("#txtDescripcionTarea2").val(resultado.descripcion);
                $("#bxEstadoTarea2").val(resultado.estado);
                $("#bxResponsableTarea2").val(resultado.responsable);

                $('#modalEditarTareas').modal('show');

                return;
            } else {
                mensaje_alerta("¡Error!", dato.data + "\n" + dato.dataDB, "error");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function GuardarTareaPopup() {
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnRegistrarTarea": true,
        "txtIDActividadTareas": $("#txtIDActividadTareas").val(),
        "txtNombreTarea": $("#txtNombreTarea").val(),
        "bxResponsableTarea": $("#bxResponsableTarea").val(),
        "txtFechaInicioTareas": $("#txtFechaInicioTareas").val(),
        "txtFechaTerminoTareas": $("#txtFechaTerminoTareas").val(),
        "txtHoraInicioTarea": $("#txtHoraInicioTarea").val(),
        "txtMinutosInicioTarea": $("#txtMinutosInicioTarea").val(),
        "txtHoraTerminoTarea": $("#txtHoraTerminoTarea").val(),
        "txtMinutosTerminoTarea": $("#txtMinutosTerminoTarea").val(),
        "txtDescripcionTarea": $("#txtDescripcionTarea").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarActividadesGenerados();
                    BuscarTareasPopup(dato.id);

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function EditarTareaPopup() {
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnActualizarTarea": true,
        "txtIDActividadTareas2": $("#txtIDActividadTareas2").val(),
        "txtNombreTarea2": $("#txtNombreTarea2").val(),
        "bxResponsableTarea2": $("#bxResponsableTarea2").val(),
        "txtFechaInicioTarea2": $("#txtFechaInicioTarea2").val(),
        "txtFechaTerminoTarea2": $("#txtFechaTerminoTarea2").val(),
        "txtHoraInicioTarea2": $("#txtHoraInicioTarea2").val(),
        "txtMinutosInicioTarea2": $("#txtMinutosInicioTarea2").val(),
        "txtHoraTerminoTarea2": $("#txtHoraTerminoTarea2").val(),
        "txtMinutosTerminoTarea2": $("#txtMinutosTerminoTarea2").val(),
        "txtDescripcionTarea2": $("#txtDescripcionTarea2").val(),
        "bxEstadoTarea2": $("#bxEstadoTarea2").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarTareasPopup(dato.id);
                    BuscarActividadesGenerados();
                    $('#TablaActividadesDiarias').DataTable().ajax.reload();
                    $('#TablaActividadesDiariasReporte').DataTable().ajax.reload();

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function ListarResponsablesTarea(idact){
    document.getElementById('bxResponsableTarea').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarResponsablesTarea": true,
        "idactividad": idact
    }
    console.log(datos);
    llenarCombo(url, datos, "bxResponsableTarea");
}

function ListarResponsablesTarea2(ida){
    document.getElementById('bxResponsableTarea2').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarResponsablesTareaEditar": true,
        "idactividad": ida
    }
    console.log(datos);
    llenarCombo(url, datos, "bxResponsableTarea2");
}

function AbrirModalEliminarTareas(idtarea){
   // var idpart = id;
    mensaje_eliminar_parametro("¿Seguro que desea eliminar la tarea seleccionada?", EliminarTarea, idtarea);
}

function EliminarTarea(idtarea){
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnEliminarTarea": true,
        "idtarea": idtarea
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarTareasPopup(dato.id);
                    BuscarActividadesGenerados();
                    $('#TablaActividadesDiarias').DataTable().ajax.reload();
                    $('#TablaActividadesDiariasReporte').DataTable().ajax.reload();

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error al Eliminar!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}



/*************************-------------  BOTON DE PARTICIPANTES ---------------*******************/

function AbrirModalParticipantes(id) {

   //$('#modalParticipantes').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarDatosActividadParticipantes": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtidActividadParticipantes").val(resultado.id);
                $("#bxNombreActividadParticipantes").val(resultado.nombre);
                $("#txtFechaInicioParticipantes").val(resultado.fechaini);
                $("#txtFechaTerminoParticipantes").val(resultado.fechafin);
                $("#bxClienteParticipantes").val(resultado.cliente);
                $("#bxEstadoParticipantes").val(resultado.estado);

                $('#modalParticipantes').modal('show');
                BuscarParticipantesPopup(resultado.id);
                return;
            } else {
                mensaje_alerta("¡IMPORTANTE!", dato.data, "info");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function BuscarParticipantesPopup(id) {
    bloquearPantalla("Cargando...");
    var url = "../../models/M01_Actividades/M01MD01_Actividades/M01MD07_ListarParticipantes.php";
    var dato = {
        "ListarParticipantes": true,
        "idactividadPart": id
    };
    realizarJsonPost(url, dato, respuestaBuscarParticipantes, null, 10000, null);
}

function respuestaBuscarParticipantes(dato) {
    desbloquearPantalla();
    if (dato.status === "ok") {
        ListaParticipantesPopup = dato.data;
        CargarTablaParticipantes(ListaParticipantesPopup);
        return;
    }
}

var getTablaParticipantesPopup = null;

function CargarTablaParticipantes(data) {
    if (getTablaParticipantesPopup) {
        getTablaParticipantesPopup.destroy();
        getTablaParticipantesPopup = null;
    }
    getTablaParticipantesPopup = $('#TablaParticipantess').DataTable({
        "data": data,
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [
        ],
        "info": false,
        "searching": false,
        "pageLength": 10,
        "lengthMenu": [
            [10, -1],
            [10, "Todos"]
        ],
        "bLengthChange": false,
        "select": {
            style: 'single'
        },
        "keys": {
            keys: [13 /* ENTER */ , 38 /* UP */ , 40 /* DOWN */ ]
        },
        "columns": [{
                "data": "id",
                "render": function(data, type, row) {
                    return '<button class="btn btn-info btn-delete-action"  onclick="AbrirModalEliminar(\'' + data + '\')"><i class="fas fa-trash"></i></button>';
                }
            },
            { "data": "participante" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
}

function RegistrarParticipantesPopup() {
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnRegistrarParticipante": true,
        "txtidActividadParticipantes": $("#txtidActividadParticipantes").val(),
        "bxParticipantes": $("#bxParticipantes").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarParticipantesPopup(dato.id);

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function AbrirModalEliminar(id){
   // var idpart = id;
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnVerificarEliminarParticipante": true,
        "idp": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_eliminar_parametro("¿Seguro que desea eliminar al participante?", EliminarParticipante, dato.id);
                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function EliminarParticipante(idpart){
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnEliminarParticipante": true,
        "idparticipante": idpart
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarParticipantesPopup(dato.id);

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error de Registro!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}


/*********************************------------- BOTON DE ELIMINAR -------------***************************/

function AbrirModalEliminarActividad(id){
   //$('#modalEliminarActividad').modal('show');
   LlenarTipoActividadEliminar();
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarDatosEliminarActividad": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtIdActividad").val(resultado.id);
                $("#bxNombreActivi").val(resultado.nombre);
                $("#bxClienteActivi").val(resultado.cliente);
                $("#bxResponsableActivi").val(resultado.responsable);
                $("#txtFecInicioActivi").val(resultado.fechaini);
                $("#txtFecTerminoActivi").val(resultado.fechafin);

                $('#modalEliminarActividad').modal('show');
                return;

            } else {
                mensaje_alerta("¡IMPORTANTE!", dato.data, "info");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function LlenarTipoActividadEliminar(){
    document.getElementById('bxNombreActivi').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarTiposActividad": true
    }
    llenarCombo(url, datos, "bxNombreActivi");
}

function VerificarEliminarActividad(){
   // var idpart = id;
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnVerificarEliminarActividad": true,
        "idactividad": $("#txtIdActividad").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_eliminar_parametro(dato.data, EliminarActividad, dato.id);
                }, 100);
                return;
            } else {
                EliminarActividad(dato.id);
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}

function EliminarActividad(idact){
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnEliminarActividad": true,
        "idactividad": idact,
        "bxMotivoEliminarActividad": $("#bxMotivoEliminarActividad").val(),
        "txtDescripcionActivi": $("#txtDescripcionActivi").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarActividadesGenerados();
                    $('#TablaActividadesDiarias').DataTable().ajax.reload();
                    $('#TablaActividadesDiariasReporte').DataTable().ajax.reload();

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error al Eliminar!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}


/*******************************-----------BOTON FINALIZAR -----------------*******************************/


function AbrirModalFinalizarActividad(id){
   //$('#modalEliminarActividad').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnVerificarFinalizarActividad": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {

                accion_parametro(dato.data, FinalizarActividad, dato.id);

            } else {
                mensaje_alerta("¡IMPORTANTE!", dato.data, "info");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}


function FinalizarActividad(idact){
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = {
        "btnFinalizarActividad": true,
        "idactividad": idact
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD05_Procesos.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                setTimeout(function () {
                    mensaje_alerta("¡Correcto!", dato.data, "success");
                    BuscarActividadesGenerados();
                    $('#TablaActividadesDiarias').DataTable().ajax.reload();
                    $('#TablaActividadesDiariasReporte').DataTable().ajax.reload();

                }, 100);
                return;
            } else {
                mensaje_alerta("¡Error al Finalizar!", dato.data, "info");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}


/******************************-----------BOTON DE COMENTARIOS --------------****************************/


function AbrirModalComentariosActividades(id){
   LlenarTipoActividadComent();
   LlenarResponsablesPopup();
   //$('#modalComentariosActividad').modal('show');
   
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarComentariosActividad": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/M01MD08_Comentarios.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtIDActividadComentarios").val(resultado.id);
                $("#bxNombreActividadPopup").val(resultado.nombre);
                $("#txtDescripcionPopup").val(resultado.descripcion);
                $("#bxResponsablePopup").val(resultado.responsable);
                $("#txtFechaInicioPopup").val(resultado.fechaini);
                $("#txtFechaTerminoPopup").val(resultado.fechafin);
                $("#txtHoraInicioPopup").val(resultado.Horaini);
                $("#txtMinutosInicioPopup").val(resultado.Minutosini);
                $("#txtHoraTerminoPopup").val(resultado.Horafin);
                $("#txtMinutosTerminoPopup").val(resultado.Minutosfin);
                $("#bxEstadoPopup").val(resultado.estado);

                $('#modalComentariosActividad').modal('show');
                return;

            } else {
                mensaje_alerta("¡IMPORTANTE!", dato.data, "info");
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}




/************************************-------------  BOTON DE CERRAR SESION ---------------**********************/

function ConsultaCerrarSesion() {
  mensaje_sesion("Al confirmar saldrá del Modulo de Actividades.", CerrarSesion);
}

function CerrarSesion(){
  var url = $("#txtRuta").val();
    window.location.replace(url);  
}


function ValidarPerfil(){
    var data = {
        "btnValidarPerfil": true
    };
    $.ajax({
        type: "POST",
        url: "../../models/M01_Actividades/M01MD01_Actividades/validar_perfil.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {

                var x = document.getElementById("FiltroResponsable");
                x.style.display = "block";

                var y = document.getElementById("btnSuper");
                y.style.display = "block";

            } else {

                var x = document.getElementById("FiltroResponsable");
                x.style.display = "none";

                var y = document.getElementById("btnSuper");
                y.style.display = "none";

            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}
