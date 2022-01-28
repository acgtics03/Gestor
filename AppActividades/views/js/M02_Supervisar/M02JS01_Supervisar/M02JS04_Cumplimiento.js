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



  $('#btnCerrarSesion').click(function() {
        ConsultaCerrarSesion();
     });


    ValidarPerfil();
    BuscarActividadesGenerados();
    InicializarAtributosTablaBusquedaCabActividades();
    LlenarTablaActividadesGeneradosReporte();

    LlenarFiltroResponsables();
    LlenarFechas();


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

    $('#btnbuscarc').click(function() {
       BuscarActividadesGenerados();
    });

     $('#bxfiltroAreac').change(function() {
        $("#bxfiltroResponsablec").val("");
        var url = '../../models/M02_Supervisar/M02MD01_Supervisar/M02MD04_ListarTipos.php';
        var datos = {
            "ReturnListaMiembros": true,
            "area": $('#bxfiltroAreac').val()
        }
        document.getElementById('bxfiltroResponsablec').selectedIndex = 0;
        llenarCombo(url, datos, "bxfiltroResponsablec");
    });


    $('#btnlimpiarc').click(function() {
       BuscarActividadesGenerados();
       LlenarFiltroResponsables();
       Limpiar();
    });


}


function LlenarFiltroResponsables(){
    document.getElementById('bxfiltroResponsablec').selectedIndex = 0;
    var url = '../../models/M01_Actividades/M01MD01_Actividades/M01MD03_ListarTiposActividad.php';
    var datos = {
        "btnListarFiltroResponsables": true
    }
    llenarCombo(url, datos, "bxfiltroResponsablec");
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
                $("#txtfiltroFecInicioc").val(dato.fecha1);
                $("#txtfiltroFecTerminoc").val(dato.fecha2);
            }
        },
        error: function(error) {
            console.log(error);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}





function BuscarActividadesGenerados() {
    bloquearPantalla("Buscando...");
    var url = "../../models/M02_Supervisar/M02MD01_Supervisar/M02MD03_ListarActividades.php";
    var dato = {
        "ReturnListaActividadesc": true,
        "txtfiltroFecInicioc": $("#txtfiltroFecInicioc").val(),
        "txtfiltroFecTerminoc": $("#txtfiltroFecTerminoc").val(),
        "bxfiltroEstadoc": $("#bxfiltroEstadoc").val(),
        "bxfiltroIdentificadorc": $("#bxfiltroIdentificadorc").val(),
        "bxfiltroClientec": $("#bxfiltroClientec").val(),
        "bxfiltroResponsablec": $("#bxfiltroResponsablec").val(),
        "bxfiltroAreac": $("#bxfiltroAreac").val()
    };
    realizarJsonPost(url, dato, respuestaBuscarActividadesGenerados, null, 10000, null);
}

function respuestaBuscarActividadesGenerados(dato) {
    desbloquearPantalla();
    console.log(dato);
    LlenarTabalaActividadesGenerados(dato.data);
    $('#TablaActividadesReportes').DataTable().ajax.reload();
}

var getTablaBusquedaCabGenerado = null;

function LlenarTabalaActividadesGenerados(datos) {
    if (getTablaBusquedaCabGenerado) {
        getTablaBusquedaCabGenerado.destroy();
        getTablaBusquedaCabGenerado = null;
    }

    getTablaBusquedaCabGenerado = $('#TablaActividadesc').DataTable({
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
            "url": "../../models/M02_Supervisar/M02MD01_Supervisar/M02MD03_ListarActividades.php", // ajax source
            "type": "POST",
            "error": validarErrorGrilla,
            "data": function(d) {
                return $.extend({}, d, {
                    "ReturnListaActividadesc": true,
                    "txtfiltroFecInicioc": $("#txtfiltroFecInicioc").val(),
                    "txtfiltroFecTerminoc": $("#txtfiltroFecTerminoc").val(),
                    "bxfiltroEstadoc": $("#bxfiltroEstadoc").val(),
                    "bxfiltroIdentificadorc": $("#bxfiltroIdentificadorc").val(),
                    "bxfiltroClientec": $("#bxfiltroClientec").val(),
                    "bxfiltroResponsablec": $("#bxfiltroResponsablec").val(),
                    "bxfiltroAreac": $("#bxfiltroAreac").val()
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

    $('#TablaActividadesReportes').DataTable(options);
}


function Limpiar(){
    LlenarFechas();
    document.getElementById('bxfiltroAreac').selectedIndex = 0;
    document.getElementById('bxfiltroResponsablec').selectedIndex = 0;
    document.getElementById('bxfiltroClientec').selectedIndex = 0;
    document.getElementById('bxfiltroIdentificadorc').selectedIndex = 0;
     document.getElementById('bxfiltroEstadoc').selectedIndex = 0;
}


function format(data) {

    return '<div class="table-child">' +
        '<table  class="table table-striped table-bordered  w-100" id="TablaTareasReporte" style="margin-top: -1px !important;">' +
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
    $('#TablaActividadesc').on('key-focus.dt', function(e, datatable, cell) {

        getTablaBusquedaCabGenerado.row(cell.index().row).select();
        var data = getTablaBusquedaCabGenerado.row(cell.index().row).data();
    });

    $('#TablaActividadesc').on('click', 'tbody td', function(e) {
        e.stopPropagation();
        var rowIdx = getTablaBusquedaCabGenerado.cell(this).index().row;
        getTablaBusquedaCabGenerado.row(rowIdx).select();
    });
    $('#TablaActividadesc tbody').on('click', 'td.details-control', function() {
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
    var url = "../../models/M02_Supervisar/M02MD01_Supervisar/M02MD02_ListarActividades.php";
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

    getTablaBusquedaTareasGenerado = $('#TablaTareasReporte').DataTable({
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



/************************************--------------REASIGNAR --------------------****************************/

function AbrirModalReasignar(id) {

   //$('#modalReasignar').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnCargarDatosActividadReasignar": true,
        "IdRegistro": id
    };
    $.ajax({
        type: "POST",
        url: "../../models/M02_Supervisar/M02MD01_Supervisar/M02MD01_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                var resultado = dato.data;

                $("#txtidactividad").val(resultado.id);
                $("#bxNombreActividadParticipantes").val(resultado.nombre);
                $("#txtFechaInicioParticipantes").val(resultado.fechaini);
                $("#txtFechaTerminoParticipantes").val(resultado.fechafin);
                $("#bxClienteParticipantes").val(resultado.cliente);
                $("#bxEstadoParticipantes").val(resultado.estado);
                $("#bxResponsableAct").val(resultado.responsable);

                $('#modalReasignar').modal('show');
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

function Reasignar() {

   //$('#modalReasignar').modal('show');
   bloquearPantalla("Buscando...");
    var data = {
        "btnReasignarActividad": true,
        "IdRegistro": $("#txtidactividad").val(),
        "bxAreaParticipantes": $("#bxAreaParticipantes").val(),
        "bxParticipantes": $("#bxParticipantes").val()
    };
    $.ajax({
        type: "POST",
        url: "../../models/M02_Supervisar/M02MD01_Supervisar/M02MD01_Procesos.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                mensaje_alerta("¡Correcto!", dato.data, "success");
                BuscarActividadesGenerados();
            } else {
                mensaje_alerta("¡Error al Reasignar!", dato.data, "info");
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

               var x = document.getElementById("bxfiltroAreac");
                x.style.display = "block";


            } else {

                var x = document.getElementById("bxfiltroAreac");
                x.style.display = "none";

            }

            var y = document.getElementById("btnSuper");
                y.style.display = "block";

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}
