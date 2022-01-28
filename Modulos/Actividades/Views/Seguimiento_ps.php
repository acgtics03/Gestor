<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="image/logo.jpg" type="image/png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ACG - Actividades</title>
  <!-- loader
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>-->
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
  <link rel="stylesheet" href="main.css" />
  <link rel="stylesheet" href="datatables/datatables.min.css" />
  <link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="css/estilo-coment.css?v=<?php echo time(); ?>" />
</head>

<body class="bg-theme fondo">
  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  <?php
  require('models/menu.php');
  require('../models/producto_servicio.php');
  ?>

  <script src="code/highcharts.js"></script>
  <script src="code/modules/data.js"></script>
  <script src="code/modules/drilldown.js"></script>
  <script src="code/modules/exporting.js"></script>
  <script src="code/modules/export-data.js"></script>
  <script src="code/modules/accessibility.js"></script>
  <?php require('models/header.php');
  require('../models/consultaActividad_ps.php');
  ?>


  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="clearfix"></div>

    <div class="content-wrapper fondo">
      <div class="container-fluid">

        <div class="row mt-3">
          <div class="col-lg-6">
            <div class="card graf-11">
              <div class="card-body" style="height: 482px">
                <div><a href="ProductosServicios.php" style="color: blue;">
                    <-- Ir a Productos y/o Servicios</a> </div> <br>
                      <div class="card-header h-div">Detalle Producto y/o Servicio
                      </div>
                      <div class="card-body" style="background-color: white;">

                        <div style="display: inline;">
                          <div style="display: inline-block;">
                            <label for="" class="font">Tipo : </label>
                            <label for="" style="color: black;"><?php echo $consultar['tipo']; ?></label>
                          </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <div style="display: inline-block;">
                            <label for="" class="font">Empresa : </label>
                            <label for="" style="color: black;"><?php echo $consultar['empresa']; ?></label>
                          </div>
                        </div>
                        <div>
                          <label for="" class="font">Nombre : </label>
                          <label for="" style="color: black;"><?php echo $consultar['nombre']; ?></label>
                        </div>
                        <div style="display: inline-block">
                          <label class="font" style="display: inline">Descripcion : </label>
                          <div style="color: black;display: inline; font-size: 12px"><?php echo $consultar['descripcion']; ?></div>
                        </div>
                        <br><br>
                        <div>
                          <label for="" class="font">Responsable : </label>
                          <label for="" style="color: black;"><?php echo $consultar['responsable']; ?></label>
                        </div>
                        
                          <div>
                            <label for="" class="font">Area : </label>
                            <label for="" style="color: black;"><?php echo $consultar['area']; ?></label>
                          </div>
                          
                          <div>
                            <label for="" class="font">Estado : </label>
                            <label for="" style="color: black;"><?php echo $consultar['estado']; ?></label>
                          </div>
                      
                        <div style="display: inline;">
                          <div style="display: inline-block;">
                            <label for="" class="font">Inicio: </label>
                            <label for="" style="color: black;"><?php echo $consultar['inicio']; ?></label>
                          </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <div style="display: inline-block;">
                            <label for="" class="font">Inicio real : </label>
                            <label for="" style="color: black;"><?php echo $consultar['inicioreal']; ?></label>
                          </div>
                        </div><br>
                        <div style="display: inline;">
                          <div style="display: inline-block;">
                            <label for="" class="font">Termino: </label>
                            <label for="" style="color: black;"><?php echo $consultar['final']; ?></label>
                          </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <div style="display: inline-block;">
                            <label for="" class="font">Termino real : </label>
                            <label for="" style="color: black;"><?php echo $consultar['finreal']; ?></label>
                          </div>
                        </div>
                      </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card graf-11">
                <div class="card-body" style="height: 482px">
                    <form action="../models/insertarparticipante_ps.php" method="post">
                    <?php 
                          $activar="";
                          $ips = $_SESSION['re'];
                          
                          $ver_cargo = mysqli_query($conection, "SELECT idCargo, idArea FROM persona WHERE idusuario='$username'");
                          $cargo = mysqli_fetch_assoc($ver_cargo);
                          
                          $carg = $cargo['idCargo'];
                        
                          if($carg=='2' || $carg=='9'){
                              $activar="";
                          }else{
                          
                          $ver1 = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                          $ver11 = mysqli_fetch_assoc($ver1);
                          
                          $ips2 = $ver11['id'];
                          $activar2 = "";
                          if($ips!="$ips2"){
                              $activar = 'disabled';
                              $activar2 = 'hidden=""';
                          }}
                    ?>
                  <div class="card-header h-div">Participantes :
                  </div>
                  <div class="card-body" style="background-color: white;">
                    
                    <label for=""  style="color: black;" <?php echo $activar; ?>>Trabajador : </label>
                    <select <?php echo $activar; ?> name="boxtrabajador" id="boxtrabajador" class="form-control f-2-box">
                      <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                      <?php while ($datos = mysqli_fetch_assoc($consult)) { ?>
                        <option class="f-box" value="<?php echo $datos['ID'] ?>">
                          <?php echo $datos['datos']; ?>
                        </option>
                      <?php } ?>
                    </select>
                    <br>
                    
                    <input type="submit" id="btnañadir" name="btnañadir" value="+ Añadir" <?php echo $activar; ?>>
                    
                    <br><br>
                    
                    <div class="table-responsive tabla-r">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Trabajador</th>
                            <th>Correo</th>
                          </tr>
                        </thead>
                        <?php while ($verPart = mysqli_fetch_assoc($verParticipantes)) { ?>
                        <body>
                          <tr>
                            <td style="color: black; font-size: 12px;"><a <?php echo $activar2; ?> ><img src="image/eliminar.png" width="35px" height="35px"></a></td>
                            <td style="color: black; font-size: 12px;"><?php echo '('.$verPart['area'].') '.$verPart['datos']; ?></td>
                            <td style="color: black; font-size: 12px;"><?php echo $verPart['correo']; ?></td>
                          </tr>
                          <?php }
                        ?>
                        </body>
                      </table>
                    </div>

                    </form>

                  </div>


                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-6">
              <div class="card graf-11">
                <div class="card-body" style="height: 655px;">
                  <div class="card-header h-div">Actividades Hoy</div>
                  
                  <div class="card-body" style="background-color: white;">
                    <figure class="highcharts-figure">
                      <div id="container" style="width: 100%; height: 200px"></div>
                    </figure>

                  </div>
                  <script type="text/javascript">
                    var T1 = parseInt('<?php echo $ind11['total']; ?>');
                    var T2 = parseInt('<?php echo $ind22['total']; ?>');
                    var T3 = parseInt('<?php echo $ind33['total']; ?>');
                    var T4 = parseInt('<?php echo $ind44['total']; ?>');

                    var dias = '<?php echo $datodia; ?>';


                    // Create the chart
                    Highcharts.chart('container', {
                      chart: {
                        type: 'column'
                      },
                      title: {
                        text: dias
                      },
                      accessibility: {
                        announceNewData: {
                          enabled: true
                        }
                      },
                      xAxis: {
                        type: 'category'
                      },
                      yAxis: {
                        title: {
                          text: ''
                        }

                      },
                      legend: {
                        enabled: false
                      },
                      plotOptions: {
                        series: {
                          borderWidth: 0,
                          dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                          }
                        }
                      },

                      tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                      },

                      series: [{
                        name: "Estados",
                        colorByPoint: true,
                        data: [{
                            name: "Planificado",
                            color: '#FFC074',
                            y: T1,
                            drilldown: "Planificado"
                          },
                          {
                            name: "Proceso",
                            color: '#FEF47C',
                            y: T2,
                            drilldown: "Proceso"
                          },
                          {
                            name: "Finalizado",
                            color: '#8CFF89',
                            y: T3,
                            drilldown: "Finalizado"
                          },
                          {
                            name: "Detenido",
                            color: '#FF8574',
                            y: T4,
                            drilldown: "Detenido"
                          }
                        ]
                      }]
                    });
                  </script>
                  
                  <div class="card-header h-div">Actividades Totales</div>
                  
                  <div class="card-body" style="background-color: white;">
                    <figure class="highcharts-figure">
                      <div id="container2" style="width: 100%; height: 200px"></div>
                    </figure>

                  </div>
                  <script type="text/javascript">
                    var T5 = parseInt('<?php echo $ind55['total']; ?>');
                    var T6 = parseInt('<?php echo $ind66['total']; ?>');
                    var T7 = parseInt('<?php echo $ind77['total']; ?>');
                    var T8 = parseInt('<?php echo $ind88['total']; ?>');

                    var dias = '<?php echo $datodia; ?>';


                    // Create the chart
                    Highcharts.chart('container2', {
                      chart: {
                        type: 'column'
                      },
                      title: {
                        text: ''
                      },
                      accessibility: {
                        announceNewData: {
                          enabled: true
                        }
                      },
                      xAxis: {
                        type: 'category'
                      },
                      yAxis: {
                        title: {
                          text: ''
                        }

                      },
                      legend: {
                        enabled: false
                      },
                      plotOptions: {
                        series: {
                          borderWidth: 0,
                          dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                          }
                        }
                      },

                      tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                      },

                      series: [{
                        name: "Estados",
                        colorByPoint: true,
                        data: [{
                            name: "Planificado",
                            color: '#FFC074',
                            y: T5,
                            drilldown: "Planificado"
                          },
                          {
                            name: "Proceso",
                            color: '#FEF47C',
                            y: T6,
                            drilldown: "Proceso"
                          },
                          {
                            name: "Finalizado",
                            color: '#8CFF89',
                            y: T7,
                            drilldown: "Finalizado"
                          },
                          {
                            name: "Detenido",
                            color: '#FF8574',
                            y: T8,
                            drilldown: "Detenido"
                          }
                        ]
                      }]
                    });
                  </script>
                  
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card graf-11 reg-fond">
                <div class="card-body">
                  <div class="card-header">Registrar Actividad
                  </div>
                  <div class="card-body">
                  <form action="../models/insertarActividad_ps.php" method="post">
                  <div>
                   <label for="input-1">Nombre</label>
                   <?php
                   
                    require 'conexion.php';
                    $username = $_SESSION['user'];
    
                          $ver_area = mysqli_query($conection, "SELECT a.idArea as id FROM persona p, area a WHERE p.idArea=a.idArea AND p.idusuario='$username'");
                          $ver_arear = mysqli_fetch_assoc($ver_area);
                          
                          $idar = $ver_arear['id'];
                          
                          $noms = mysqli_query($conection, "SELECT idgestion as id ,nombre as nombre FROM tipos WHERE estado='Activo' AND (((categoria='ACTIVIDAD' AND area='$idar') OR (categoria='Todos' AND area='Todos')) OR (categoria='ACTIVIDAD' AND area='Todos'))");
                          ?>
                          <select name="nombre" id="nombre" class="form-control" required>
                            <option selected="true" class="f-box" disabled="disabled">Ninguno</option>
                            <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                              <option class="f-box" value="<?php echo $val['id']; ?>">
                                <?php echo $val['nombre']; ?>
                              </option>
                            <?php } ?>
                          </select>
                  </div>
                  <br>
                  <div>
                   <label for="input-1">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" id="input-1" placeholder="Escriba aqui" required></textarea>
                  </div>
                  <br>
                  <div>
                  <label for="input-1">Responsable</label>
                  <select name="boxresponsable" id="boxresponsable" class="form-control" >
                      <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                      <?php while ($dat = mysqli_fetch_assoc($con)) { ?>
                        <option class="f-box" value="<?php echo $dat['ID'] ?>">
                          <?php echo $dat['datos']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Fecha de inicio</label>
                      <input type="Date" name="fechaini" class="form-control" id="input-1" required>
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                        <div style="display: inline;">
                            <label for="input-1">Hora de inicio</label>  <br>        
                            <div style="display: inline-block">   
                            <script language="javascript" type="text/javascript">
                                function limitText(limitField, limitNum) {
                                      if (limitField.value.length > limitNum) {
                                          limitField.value = limitField.value.substring(0, limitNum);
                                      }
                                }
                              </script>
                              <input type="Number" name="Horaini" class="form-control campo-date" style="width: 94px;" min="1" max="23" id="input-1" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" required>
                              <datalist id="horas">
                                  <option>01</option>
                                  <option>02</option>
                                  <option>03</option>
                                  <option>04</option>
                                  <option>05</option>
                                  <option>06</option>
                                  <option>07</option>
                                  <option>08</option>
                                  <option>09</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                  <option>13</option>
                                  <option>14</option>
                                  <option>15</option>
                                  <option>16</option>
                                  <option>17</option>
                                  <option>18</option>
                                  <option>19</option>
                                  <option>20</option>
                                  <option>21</option>
                                  <option>22</option>
                                  <option>23</option>
                              </datalist>
                            </div>
                            <div style="display: inline-block">            
                              <label for="input-1">&nbsp;:&nbsp;</label>
                            </div>
                            <div style="display: inline-block">
                              <input type="Number" name="Minini" class="form-control campo-date" style="width: 94px;" id="input-1" list="minutos" placeholder="Minutos" min="00" max="59" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" required>
                              <datalist id="minutos">
                                  <option>00</option>
                                  <option>01</option>
                                  <option>02</option>
                                  <option>03</option>
                                  <option>04</option>
                                  <option>05</option>
                                  <option>06</option>
                                  <option>07</option>
                                  <option>08</option>
                                  <option>09</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                  <option>13</option>
                                  <option>14</option>
                                  <option>15</option>
                                  <option>16</option>
                                  <option>17</option>
                                  <option>18</option>
                                  <option>19</option>
                                  <option>20</option>
                                  <option>21</option>
                                  <option>22</option>
                                  <option>23</option>
                                  <option>24</option>
                                  <option>25</option>
                                  <option>26</option>
                                  <option>27</option>
                                  <option>28</option>
                                  <option>29</option>
                                  <option>30</option>
                                  <option>31</option>
                                  <option>32</option>
                                  <option>33</option>
                                  <option>34</option>
                                  <option>35</option>
                                  <option>36</option>
                                  <option>37</option>
                                  <option>38</option>
                                  <option>39</option>
                                  <option>40</option>
                                  <option>41</option>
                                  <option>42</option>
                                  <option>43</option>
                                  <option>44</option>
                                  <option>45</option>
                                  <option>46</option>
                                  <option>47</option>
                                  <option>48</option>
                                  <option>49</option>
                                  <option>50</option>
                                  <option>51</option>
                                  <option>52</option>
                                  <option>53</option>
                                  <option>54</option>
                                  <option>55</option>
                                  <option>56</option>
                                  <option>57</option>
                                  <option>58</option>
                                  <option>59</option>                          
                              </datalist>
                            </div>
                          </div>  
                    </div>                  
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Fecha de termino</label>
                      <input type="Date" name="fechafin" class="form-control" id="input-1" required>
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                        <div style="display: inline">
                          <label for="input-1">Hora de termino</label> <br> 
                            <div style="display: inline-block">            
                              <input type="Number" name="Horafin" class="form-control campo-date" min="1" max="23" style="width: 94px;" id="input-1" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
                              <datalist id="horas">
                                  <option>01</option>
                                  <option>02</option>
                                  <option>03</option>
                                  <option>04</option>
                                  <option>05</option>
                                  <option>06</option>
                                  <option>07</option>
                                  <option>08</option>
                                  <option>09</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                  <option>13</option>
                                  <option>14</option>
                                  <option>15</option>
                                  <option>16</option>
                                  <option>17</option>
                                  <option>18</option>
                                  <option>19</option>
                                  <option>20</option>
                                  <option>21</option>
                                  <option>22</option>
                                  <option>23</option>
                              </datalist>
                            </div>
                            <div style="display: inline-block">            
                              <label for="input-1">&nbsp;:&nbsp;</label>
                            </div>
                            <div style="display: inline-block">
                              <input type="Number" name="Minfin" class="form-control campo-date" style="width: 94px" id="input-1" list="minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" min="00" max="59">
                              <datalist id="minutos">
                                  <option>00</option>
                                  <option>01</option>
                                  <option>02</option>
                                  <option>03</option>
                                  <option>04</option>
                                  <option>05</option>
                                  <option>06</option>
                                  <option>07</option>
                                  <option>08</option>
                                  <option>09</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                  <option>13</option>
                                  <option>14</option>
                                  <option>15</option>
                                  <option>16</option>
                                  <option>17</option>
                                  <option>18</option>
                                  <option>19</option>
                                  <option>20</option>
                                  <option>21</option>
                                  <option>22</option>
                                  <option>23</option>
                                  <option>24</option>
                                  <option>25</option>
                                  <option>26</option>
                                  <option>27</option>
                                  <option>28</option>
                                  <option>29</option>
                                  <option>30</option>
                                  <option>31</option>
                                  <option>32</option>
                                  <option>33</option>
                                  <option>34</option>
                                  <option>35</option>
                                  <option>36</option>
                                  <option>37</option>
                                  <option>38</option>
                                  <option>39</option>
                                  <option>40</option>
                                  <option>41</option>
                                  <option>42</option>
                                  <option>43</option>
                                  <option>44</option>
                                  <option>45</option>
                                  <option>46</option>
                                  <option>47</option>
                                  <option>48</option>
                                  <option>49</option>
                                  <option>50</option>
                                  <option>51</option>
                                  <option>52</option>
                                  <option>53</option>
                                  <option>54</option>
                                  <option>55</option>
                                  <option>56</option>
                                  <option>57</option>
                                  <option>58</option>
                                  <option>59</option>                          
                              </datalist>
                            </div>
                          </div>
                    </div>                  
                  </div>

                  <br>
                  <?php $estado_ps = $consultar['estado'];
                        $vista_btn='';
                        if($estado_ps=="FINALIZADO" || $estado_ps=="DETENIDO"){
                            $vista_btn = 'disabled';
                        }
                  ?>
                  <input type="submit" class="btn btn-light px-5 btnRegistrar" name="btnGrabar" id="btnGrabar" value="Grabar" <?php echo $vista_btn; ?>>

                  </form>

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-12">
              <div class="card reg-tab2">
                <div class="card-header"><?php echo $_SESSION['tipo'].' / '.strtoupper ($_SESSION['nomps']); ?>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive">
                          <br>

                          <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                            <thead>
                              <tr>
                                <th class="th1"></th>
                                <th class="th1">INICIO</th>
                                <th class="th1">TERMINO</th>
                                <th class="th1">E</th>
                                <th class="th1">NOMBRE</th>
                                <th class="th1">DESCRIPCION</th>
                                <th class="th1">RESPONSABLE</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              require('../models/SegActividadPS.php');
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!--End Row-->

          </div>
          <!-- End container-fluid-->

        </div>

      </div>
      <!--End wrapper-->


      <!-- Bootstrap core JavaScript-->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>

      <!-- simplebar js -->
      <script src="assets/plugins/simplebar/js/simplebar.js"></script>
      <!-- sidebar-menu js -->
      <script src="assets/js/sidebar-menu.js"></script>

      <!-- Custom scripts -->
      <script src="assets/js/app-script.js"></script>


      <!-- jQuery, Popper.js, Bootstrap JS -->
      <script src="jquery/jquery-3.3.1.min.js"></script>

      <!-- datatables JS -->
      <script type="text/javascript" src="../datatables/datatables.min.js"></script>

      <!-- para usar botones en datatables JS -->
      <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
      <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
      <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
      <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
      <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

      <!-- código JS propìo-->
      <script type="text/javascript" src="../main.js"></script>



</body>

</html>