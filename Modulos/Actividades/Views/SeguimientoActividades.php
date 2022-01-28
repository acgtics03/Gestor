<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="big5">

  <link rel="icon" href="image/logo.jpg" type="image/png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Actividades</title>
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

  <script src="../Js/actividades.js"></script>
  <script src="../Js/aviso_principal.js"></script>

  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">
  <script src="../librerias/alertifyjs/alertify.js"></script>
  <script src="../librerias/select2/js/select2.js"></script>


  <script language="JavaScript">
    function popUp(URL) {
      day = new Date();
      id = day.getTime();
      eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=490');");
    }
  </script>

</head>

<body class="bg-theme fondo">
  <?php
  require('models/menu.php');
  date_default_timezone_set('America/Lima');
  //session_start();
  require 'conexion.php';
  $username = $_SESSION['user'];
  require('models/header.php');

    if(empty($username)){
        session_destroy();
        echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="../../../index.php"';
        echo '</script>';
    }
    

  ?>

  <script src="code/highcharts.js"></script>
  <script src="code/modules/exporting.js"></script>
  <script src="code/modules/export-data.js"></script>
  <script src="code/modules/accessibility.js"></script>


  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="clearfix"></div>

    <div class="content-wrapper fondo">
      <div class="container-fluid">

        <div class="row mt-3">
          <div class="col-lg-6">
            <div class="card graf-11">
              <div class="card-body">
                <h5 class="card-header h-div">ACTIVIDADES PLANIFICADAS Y EN PROCESO</h5>
                <br>
                <div class="table-responsive tabla-t">
                  <table class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Inicio</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $ver_id = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                      $ver_idr = mysqli_fetch_assoc($ver_id);

                      $i_d = $ver_idr['id'];

                      $consulta = mysqli_query($conection, "SELECT t.nombre as nombre, a.fecha as fecha, a.fechafin as fechafin, a.estado as estado, date_format(a.Horaini, '%H:%i') as Hini, 
                      (SELECT cc.sDescripcion as empresa FROM centrocosto cc WHERE cc.iCodigo=a.empresa) as cliente
                      FROM actividades a, tipos t 
                      WHERE t.idgestion=a.nombre AND a.responsable='$i_d' AND a.identificador='DIARIO' AND 
                      (a.estado='PLANIFICADO' OR a.estado='PROCESO')");

                      while ($dat = mysqli_fetch_assoc($consulta)) {
                      ?>
                        <tr style="color: black;">
                          <td class="centrar" style="font-size: 12px"><?php $valorestado = $dat['estado'];
                                                                      if ($valorestado == 'PLANIFICADO') {
                                                                        echo '<img src="../Views/image/planificado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                                      } else {
                                                                        if ($valorestado == 'PROCESO') {
                                                                          echo '<img src="../Views/image/proceso.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                                        } else {
                                                                          if ($valorestado == 'FINALIZADO') {
                                                                            echo '<img src="../Views/image/finalizado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                                          } else {
                                                                            if ($valorestado == 'DETENIDO') {
                                                                              echo '<img src="../Views/image/detenido.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                                            }
                                                                          }
                                                                        }
                                                                      } ?></td>
                          <td style="font-size: 12px"><?php echo $dat['cliente']; ?></td>
                          <td style="font-size: 12px"><?php echo $dat['nombre']; ?></td>
                          <td style="font-size: 12px"><?php echo $dat['fecha'] . " " . $dat['Hini']; ?></td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card reg-fond">
              <div class="card-body">
                <h5 class="card-title">Registrar Actividad</h5>
                <div>
                  <div class="form-group">
                    <form action="../models/insertarActividad.php" method="post">
                      <label for="input-1">Nombre (*)</label>
                      <?php
                      $ver_area = mysqli_query($conection, "SELECT idArea as area FROM persona WHERE idusuario='$username'");
                      $ver_arear = mysqli_fetch_assoc($ver_area);

                      $are = $ver_arear['area'];

                      $noms = mysqli_query($conection, "SELECT nombre as nombre, idgestion as id FROM tipos WHERE estado='Activo' AND 
                      (((categoria='ACTIVIDAD' AND area='$are') OR (categoria='Todos' AND area='$are')) OR ((categoria='ACTIVIDAD' AND area='Todos') OR (categoria='Todos' AND area='Todos'))) ORDER BY nombre");
                      ?>
                      <select name="nombre" id="nombre" class="form-control col" required>
                        <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                        <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                          <option class="f-box" value="<?php echo $val['id']; ?>">
                            <?php echo $val['nombre']; ?>
                          </option>
                        <?php } ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="input-1">Descripcion (*)</label>
                    <textarea name="descripcion" class="form-control" id="input-1" placeholder="Describa la actividad" maxlength="200" style="word-wrap: break-word; resize: none;" onkeypress="cancelar()" required></textarea>
                    <script type="text/javascript">
                         function cancelar() {
                            var key = event.keyCode;
                            
                            if (key === 13) {
                                event.preventDefault();
                            }
                        }
                    </script>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="input-4">Cliente (*)</label>
                      <?php
                      $Datos = mysqli_query($conection, "SELECT iCodigo as codigo, sDescripcion as descripcion FROM centrocosto WHERE iEstado ='1' ORDER BY sDescripcion ASC");
                      ?>
                      <select name="empresa" id="lista_empresa" class="form-control"  required>
                        <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                        <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                          <option class="f-box" value="<?php echo $valoo['codigo']; ?>">
                            <?php echo $valoo['descripcion']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="input-4">Tipo (*)</label>
                      <?php
                      $Datos = mysqli_query($conection, "SELECT idArea as id, Area as area FROM area ORDER BY Area ASC");
                      ?>
                      <select name="area" id="lista_area" class="form-control" required>
                        <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                        <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                          <option class="f-box" value="<?php echo $valoo['id']; ?>">
                            <?php echo $valoo['area']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>

                  </div>

                  <div class="form-group row">
                    <div class="col">
                      <label for="input-1">Fecha inicio (*)</label>
                      <input type="Date" name="fecha" class="form-control" id="input-1" required>
                    </div>
                    <div class="col">
                      <label for="input-1">Fecha termino (*)</label>
                      <input type="Date" name="fechafin" class="form-control" id="input-1" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <div style="display: inline;">
                        <label for="input-1">Hora de inicio (*)</label> <br>
                        <div style="display: inline-block">
                          <script language="javascript" type="text/javascript">
                            function limitText(limitField, limitNum) {
                              if (limitField.value.length > limitNum) {
                                limitField.value = limitField.value.substring(0, limitNum);
                              }
                            }
                          </script>
                          <input type="Number" name="Horaini" class="form-control campo-date" style="width: 100px;" min="1" max="23" id="input-1" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" required>
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
                          <input type="Number" name="Minini" class="form-control campo-date" style="width: 100px;" id="input-1" list="minutos" placeholder="Minutos" min="00" max="59" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" required>
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
                    <div style="display: inline-block; margin-left: 5%">
                      <div style="display: inline">
                        <label for="input-1">Hora de inicio real</label> <br>
                        <div style="display: inline-block">
                          <input type="Number" name="Horainireal" class="form-control campo-date" min="1" max="23" style="width: 100px;" id="input-1" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                          <input type="Number" name="Mininireal" class="form-control campo-date" style="width: 100px" id="input-1" list="minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" min="00" max="59">
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
                      <div style="display: inline">
                        <label for="input-1">Hora de termino</label> <br>
                        <div style="display: inline-block">
                          <input type="Number" name="Horafin" class="form-control campo-date" min="1" max="23" style="width: 100px;" id="input-1" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                          <input type="Number" name="Minfin" class="form-control campo-date" style="width: 100px" id="input-1" list="minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" min="00" max="59">
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
                    <div style="display: inline-block; margin-left: 5%">
                      <div style="display: inline">
                        <label for="input-1">Hora de termino real</label> <br>
                        <div style="display: inline-block">
                          <input type="Number" name="Horafinreal" class="form-control campo-date" min="1" max="23" style="width: 100px;" id="input-1" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
                          <input type="Number" name="Minfinreal" class="form-control campo-date" style="width: 100px" id="input-1" list="minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" min="00" max="59">
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
                    <label for="input-4">Responsable</label>
                    <?php
                    $Datos = mysqli_query($conection, "SELECT u.idusuario as usuario, concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u WHERE u.usuario=p.idusuario AND p.estatus='Activo' and ( p.idJefeInmediato='$username' OR p.idusuario='$username') ORDER BY apellido ASC");
                    ?>
                    <select name="responsable" id="lista_responsable" class="form-control">
                      <?php while ($row3 = mysqli_fetch_assoc($Datos)) { ?>
                        <option class="f-box" value="<?php echo $row3['usuario']; ?>">
                          <?php echo $row3['datos']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <br>

                  <input type="submit" class="btn btn-light px-5 btnRegistrar" name="btnRegistrar" id="btnRegistrar" value="Registrar">
                  <label for="" style="margin-left: 20%; font-size: 12px;">Campos obligatorios (*)</label>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End Row-->

        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="card reg-tab2">
              <div class="card-header">GESTION DE ACTIVIDADES
                <br>
                <div class="container">
                  <div class="row" style=" width: 100%">
                    <div class="col-lg-12" style=" width: 100%">
                      <div class="table-responsive">
                        <br>
                        
                       <!-- <form action="" method="POST">
                            <div class="row" <?php echo $campo_busqueda; ?>><br>
                              <div class="col">
                                  <label>Desde : </label>
                                  <input type="date" class="form-control" id="txtdesde" name="txtdesde">
                            </div>
                              <div class="col">
                                  <label>Hasta : </label>
                                  <input type="date" class="form-control" id="txthasta" name="txthasta">
                             </div>
                              <div class="col">
                                  <label>Estado : </label>
                                  <select name="bxestado" id="bxestado" class="form-control" required>
                                    <option class="f-box" selected="true" disabled="disabled">Seleccionar</option>
                                    <option class="f-box" value="PLANIFICADO">PLANIFICADO</option>
                                    <option class="f-box" value="PROCESO">PROCESO</option>
                                    <option class="f-box" value="FINALIZADO">FINALIZADO</option>
                                    <option class="f-box" value="DETENIDO">DETENIDO</option>
                                  </select>
                              </div>
                              <div class="col">
                                  <label>Cliente : </label>
                                   <?php
                                  $Datos = mysqli_query($conection, "SELECT iCodigo as codigo, sDescripcion as descripcion FROM centrocosto WHERE iEstado ='1' ORDER BY sDescripcion ASC");
                                  ?>
                                  <select name="bxcliente" id="bxcliente" class="form-control"  required>
                                    <option class="f-box" selected="true" disabled="disabled">Seleccionar</option>
                                    <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                                      <option class="f-box" value="<?php echo $valoo['codigo']; ?>">
                                        <?php echo $valoo['descripcion']; ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                              </div>
                              <div class="col">
                                  <label style="color: #e9bf4000">boton :</label><br>
                                  <input type="submit" class="form-control btn btn-success" style="background-color: blue; height: 55%;" value="Buscar" name="btnBuscarAct" id="btnBuscarAct">
                              </div>
                              <div class="col">
                                  <label style="color: #e9bf4000">boton :</label><br>
                                  <input type="submit" class="form-control btn btn-secondary" style="background-color: #919191; height: 55%;" value="Limpiar" name="btnLimpiarAct" id="btnLimpiarAct">
                              </div>
                            </div>
                        </form>
                        <br>-->
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                          <thead>
                            <tr>
                              <th class="th1"></th>
                              <th class="th1">INICIO</th>
                              <th class="th1">FIN</th>
                              <th class="th1"></th>
                              <th class="th1">NOMBRE</th>
                              <th class="th1">DESCRIPCION</th>
                              <th class="th1">RESPONSABLE</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $ID_ACT = "";

                            $ver_id = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                            $ver_idr = mysqli_fetch_assoc($ver_id);

                            $i_d = $ver_idr['id'];

                            $consulta_per = mysqli_query($conection, "SELECT idCargo as ic FROM persona WHERE idusuario='$username'");
                            $consulta_perr = mysqli_fetch_assoc($consulta_per);

                            $i_dr = $consulta_perr['ic'];
                            
                            

                            if ($i_dr == '2' || $i_dr == '9') {
                            
                            $consultaAct = mysqli_query($conection, "SELECT a.idactividades as ID,t.nombre as nombre, a.fecha as fecha, a.fechafin as fechafin, a.descripcion as descripcion, a.Horaini as Horaini, a.Horafin as Horafin,
                            a.estado as estado, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as dato, a.nombre as nom, u.idusuario as user, a.responsable as respons 
                            FROM actividades a, persona p, usuario u , participantes_tareas pt, tipos t, gestion_estados ge 
                            WHERE a.responsable=u.idusuario AND a.estado=ge.nombre AND u.usuario=p.idusuario AND t.idgestion=a.nombre AND a.idactividades=pt.idactividad AND (a.responsable='$i_d' OR pt.participante='$i_d') AND 
                            a.identificador='DIARIO' AND a.estado!='ELIMINADO' GROUP BY a.idactividades ORDER BY ge.idgestione ASC");

                            } else {

                              $consultaAct = mysqli_query($conection, "SELECT a.idactividades as ID,t.nombre as nombre, a.fecha as fecha, a.fechafin as fechafin, a.descripcion as descripcion, a.Horaini as Horaini, a.Horafin as Horafin,
                            a.estado as estado, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as dato, a.nombre as nom, u.idusuario as user, a.responsable as respons 
                            FROM actividades a, persona p, usuario u , participantes_tareas pt, tipos t, gestion_estados ge 
                            WHERE a.responsable=u.idusuario AND a.estado=ge.nombre AND u.usuario=p.idusuario AND t.idgestion=a.nombre AND a.idactividades=pt.idactividad AND (a.responsable='$i_d' OR pt.participante='$i_d') AND 
                            a.identificador='DIARIO' AND a.estado!='ELIMINADO' GROUP BY a.idactividades ORDER BY ge.idgestione, a.fecha, a.Horaini ASC");
                            }
                            while ($acti = mysqli_fetch_assoc($consultaAct)) {

                              $datos23 = $acti['ID'] . "||" .
                                $acti['nom'] . "||" .
                                $acti['descripcion'] . "||" .
                                $acti['fecha'] . "||" .
                                $acti['fechafin'] . "||" .
                                $acti['Horaini'] . "||" .
                                $acti['Horafin'] . "||" .
                                $acti['estado'] . "||" .
                                $acti['respons'];


                              //$ids= $ps['ID'];

                              $vinc = $acti['ID'];
                              $idacti = $acti['ID'];
                              $var_estado = $acti['estado'];
                              $dado = "";

                              $ver_usu2 = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                              $usua2r = mysqli_fetch_assoc($ver_usu2);

                              $contActividades = mysqli_query($conection, "SELECT * FROM tareas WHERE vinculo='$vinc' AND estado!='ELIMINADO'");
                              $total_Act = mysqli_num_rows($contActividades);

                              $contActividadesF = mysqli_query($conection, "SELECT * FROM tareas WHERE vinculo='$vinc' AND (estado='FINALIZADO' OR estado='DETENIDO')");
                              $total_ActF = mysqli_num_rows($contActividadesF);

                              $ver_cargo = mysqli_query($conection, "SELECT idCargo as cargo FROM persona WHERE idusuario='$username'");
                              $cargo = mysqli_fetch_assoc($ver_cargo);

                              $carg = $cargo['cargo'];

                              $indicador1 = "";
                              $idres = $usua2r['id'];

                              $rs = $acti['respons'];
                              $espacio = "";

                              $parte1 = '#modalEdicion2';
                              $parte2 = "TrabajadorACT('$datos23')";

                              $parte3 = "TrabajadorEliminar('$datos23')";
                              $parte4 = '#modalEliminarActividad';

                              $img = "editar2";
                              $img2 = "detalle";
                              $img3 = "eliminar";
                              $img4 = "btnfinalizado";
                              $par = "TrabajadorComentario('$datos23')";
                              if ($carg == '2' || $carg == '9') {
                                $vista = '';

                                $parte1 = '#modalEdicion2';
                                $parte2 = "TrabajadorACT('$datos23')";

                                $parte3 = "TrabajadorEliminar('$datos23')";
                                $parte4 = '#modalEliminarActividad';

                                if ($var_estado == 'FINALIZADO') {

                                  $parte3 = "Aviso7()";
                                  $parte4 = '';
                                  $img4 = "btnfinalizado2";
                                  $img3 = "eliminar2";
                                } else {
                                  $parte3 = "TrabajadorEliminar('$datos23')";
                                  $parte4 = '#modalEliminarActividad';
                                }

                                if ($total_Act == '0' && $total_ActF == '0') {
                                  $indicador2 = "Aviso11()"; // El Producto o Servicio debe tener como mínimo una actividad finalizada.
                                  $indicador1 = "#";
                                } else {
                                  if ($total_Act == $total_ActF) {
                                    if ($var_estado == 'FINALIZADO') {
                                      $indicador1 = "#";
                                      $indicador2 = "Aviso12()";
                                      $img4 = "btnfinalizado2";
                                    } else {
                                      $indicador1 = "../models/finalizar_act.php?CA=" . $acti['ID'] . "";
                                      $indicador2 = "#";
                                    }
                                  } else {
                                    $indicador2 = "Aviso13()"; // aviso: es necesario finalizar las actividades
                                    $indicador1 = "#";
                                  }
                                }
                              } else {
                                if ($idres != $rs) {
                                  $parte1 = '';
                                  $parte2 = "Aviso()";

                                  $parte3 = "Aviso2()";
                                  $parte4 = '';

                                  $indicador2 = "Aviso5()"; // Usted no esta autorizado para FINALIZAR el registro seleccionado.
                                  $indicador1 = "#";

                                  $img = "editar22";
                                  $img3 = "eliminar2";
                                  $img4 = "btnfinalizado2";
                                } else {
                                  $vista = '';
                                  $espacio = "&nbsp;&nbsp;&nbsp;";

                                  if ($var_estado == 'FINALIZADO') {
                                    $parte1 = '';
                                    $parte2 = "Aviso6()";
                                    $img4 = "btnfinalizado2";
                                    $img = "editar22";

                                    $parte3 = "Aviso7()";
                                    $img3 = "eliminar2";
                                    $parte4 = '';
                                  } else {
                                    $parte1 = '#modalEdicion2';
                                    $parte2 = "TrabajadorACT('$datos23')";

                                    $parte3 = "TrabajadorEliminar('$datos23')";
                                    $parte4 = '#modalEliminarActividad';
                                  }
                                  if ($total_Act == '0' && $total_ActF == '0') {
                                    $indicador2 = "Aviso11()"; // El Producto o Servicio debe tener como mínimo una actividad finalizada.
                                    $indicador1 = "#";
                                  } else {
                                    if ($total_Act == $total_ActF) {
                                      if ($var_estado == 'FINALIZADO') {
                                        $indicador1 = "#";
                                        $indicador2 = "Aviso12()";
                                        $img4 = "btnfinalizado2";
                                        $img = "editar22";
                                        $img3 = "eliminar2";
                                      } else {
                                        $indicador1 = "../models/finalizar_act.php?CA=" . $acti['ID'] . "";
                                        $indicador2 = "#";
                                      }
                                    } else {
                                      $indicador2 = "Aviso13()"; // aviso: es necesario finalizar las actividades
                                      $indicador1 = "#";
                                    }
                                  }
                                }
                              }


                              $consulta_dato = mysqli_query($conection, "SELECT valor as valor FROM control_act WHERE user='$username'");
                              $consulta_dator = mysqli_num_rows($consulta_dato);
                              $consulta_datos = mysqli_fetch_assoc($consulta_dato);


                              if (empty($variable_ruta)) {
                                $nueva_variable = $consulta_datos['valor'];
                              } else {
                                if ($consulta_dator > 0) {
                                  $actualiza = mysqli_query($conection, "UPDATE control_act SET valor='$variable_ruta' WHERE user='$username'");
                                  $consulta_valor = mysqli_query($conection, "SELECT valor as valor FROM control_act WHERE user='$username'");
                                  $consulta_valorr = mysqli_fetch_assoc($consulta_valor);

                                  $nueva_variable = $consulta_valorr['valor'];
                                } else {
                                  $insertar = mysqli_query($conection, "INSERT INTO control_act(valor, user) VALUES ('$variable_ruta','$username')");
                                  $consulta_valor2 = mysqli_query($conection, "SELECT valor as valor FROM control WHERE user='$username'");
                                  $consulta_valor2r = mysqli_fetch_assoc($consulta_valor2);

                                  $nueva_variable = $consulta_valor2r['valor'];
                                }
                              }

                              $variable_act = $nueva_variable;


                              $consultar_tareas = mysqli_query($conection, "SELECT count(*) as total FROM tareas WHERE vinculo='$idacti' AND estado!='ELIMINADO'");
                              $ct = mysqli_fetch_assoc($consultar_tareas);

                              $consultar_tareasF = mysqli_query($conection, "SELECT count(*) as total FROM tareas WHERE vinculo='$idacti' AND estado='FINALIZADO'");
                              $ctf = mysqli_fetch_assoc($consultar_tareasF);

                              $a = $ctf['total'];
                              $b = $ct['total'];
                              
                              $consultar_id_usu = mysqli_query($conection, "SELECT idusuario as usu FROM usuario WHERE usuario='$username'");
                              $consultar_id_usur = mysqli_fetch_assoc($consultar_id_usu);
                              
                              $idusuar = $consultar_id_usur['usu'];
                              $idresponsable = $acti['respons'];
                              $color_fondo = "";
                              if($idusuar!=$idresponsable){
                                  $color_fondo = 'style="color: orange"';
                              }

                            ?>
                              <tr <?php echo $color_fondo; ?>>
                                <td><a href="" data-toggle="modal" data-target="<?php echo $parte1; ?>" onclick="<?php echo $parte2; ?>"><img src="image/<?php echo $img; ?>.png" width="35px" height="35px" alt=""></a>

                                  &nbsp;&nbsp;&nbsp;<?php echo "<a href='SegActividades.php?CA=" . $acti['ID'] . "'><img src='image/" . $img2 . ".png' width='35px' height='35px' alt=''></a>"; ?>

                                  &nbsp;&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="<?php echo $parte4; ?>" onclick="<?php echo $parte3; ?>"><img src="image/<?php echo $img3; ?>.png" width="35px" height="35px"></a>

                                  &nbsp;&nbsp;&nbsp;<?php echo "<a href='" . $indicador1 . "' onclick='" . $indicador2 . "'><img src='image/" . $img4 . ".png' width='35px' height='35px' alt='Finalizar Act.'></a>"; ?>

                                  &nbsp;&nbsp;&nbsp;<a href="Comentarios.php?Jyk=<?php echo $acti['ID']; ?>"><img src="image/comentario.png" width="35px" height="35px" alt="Comentarios"></a>
                                </td>

                                <td><?php echo $acti['fecha']; ?></td>
                                <td><?php echo $acti['fechafin']; ?></td>
                                <td class="centrar"><?php
                                                    $valorestado = $acti['estado'];
                                                    if ($valorestado == 'PLANIFICADO') {
                                                      echo '<img src="../Views/image/planificado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                    } else {
                                                      if ($valorestado == 'PROCESO') {
                                                        echo '<img src="../Views/image/proceso.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                      } else {
                                                        if ($valorestado == 'FINALIZADO') {
                                                          echo '<img src="../Views/image/finalizado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                        } else {
                                                          if ($valorestado == 'DETENIDO') {
                                                            echo '<img src="../Views/image/detenido.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">' . $valorestado . '</p>';
                                                          }
                                                        }
                                                      }
                                                    } ?></td>
                                <td><?php echo $a . ' / ' . $b . ' - ' . $acti['nombre']; ?></td>
                                <td><?php echo $acti['descripcion']; ?></td>
                                <td><?php echo $acti['dato']; ?></td>
                              </tr>
                            <?php }
                            ?>
                          </tbody>
                        </table>
                        <br>

                        <!-- POP UP EDITAR ACTIVIDAD -->
                        <div class="modal fade" id="modalEdicion2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-sm" role="document">

                            <div class="modal-content ach">
                              <div class="modal-header">
                                <h4 class="modal-title t-titulo" id="myModalLabel">Actualizar datos</h4>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                              </div>
                              <div class="modal-body">

                                <input type="text" hidden="" id="ID_act" name="ID_act">
                                <div style="display: inline-block">
                                  <label class="titulo">Nombre</label><br>
                                  <?php
                                  $ver_area = mysqli_query($conection, "SELECT idArea as area FROM persona WHERE idusuario='$username'");
                                  $ver_arear = mysqli_fetch_assoc($ver_area);

                                  $are = $ver_arear['area'];

                                  $noms = mysqli_query($conection, "SELECT nombre as nombre, idgestion as id FROM tipos WHERE estado='Activo' AND 
                                                  (((categoria='ACTIVIDAD' AND area='$are') OR (categoria='Todos' AND area='$are')) OR ((categoria='ACTIVIDAD' AND area='Todos') OR (categoria='Todos' AND area='Todos')))");
                                  ?>
                                  <select name="nombre_act" id="nombre_act" class="combo-box" style="width: 350px" required>
                                    <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                                    <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                                      <option class="f-box" value="<?php echo $val['id']; ?>">
                                        <?php echo $val['nombre']; ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <br><br>
                                <div style="display: inline-block">
                                  <label class="titulo">Descripcion</label><br>
                                  <textarea name="descripcion_act" type="Text" id="descripcion_act" class="c-campos"></textarea>
                                </div>
                                <br><br>
                                <div style="display: inline-block;">
                                  <label class="titulo">Estado</label><br>
                                  <select name="estado_act" id="estado_act" class="combo-box">
                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                    <option class="f-box">PLANIFICADO</option>
                                    <option class="f-box">PROCESO</option>
                                    <option class="f-box">DETENIDO</option>
                                  </select>
                                </div>

                                <br><br>
                                <div style="display: inline-block">
                                  <label class="titulo">Fecha inicio</label><br>
                                  <input class="cam-fecha" name="fecha_act" type="Date" id="fecha_act" placeholder="yy-mm-dd">
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block">
                                  <label class="titulo">Hora inicio</label><br>
                                  <input class="cam-fecha" name="Hini_act" type="Time" id="Hini_act" placeholder="yy-mm-dd">
                                </div>
                                <br><br>
                                <div style="display: inline-block">
                                  <label class="titulo">Fecha termino</label><br>
                                  <input class="cam-fecha" name="fechafin_act" type="Date" id="fechafin_act" placeholder="yy-mm-dd">
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block">
                                  <label class="titulo">Hora termino</label><br>
                                  <input class="cam-fecha" name="Hfin_act" type="Time" id="Hfin_act" placeholder="yy-mm-dd">
                                </div>


                                
                              </div>

                            </div>
                           
                          </div>
                        </div>

                        <!-- POP UP ELIMINAR ACTIVIDAD -->
                        <div class="modal fade" id="modalEliminarActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-sm" role="document">

                            <div class="modal-content ach">
                              <div class="modal-header">
                                <h4 class="modal-title t-titulo" id="myModalLabel">Eliminar actividad
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                              </div>
                              <div class="modal-body">

                                <input type="text" hidden="" id="ID_a" name="ID_a">

                                <label class="titulo">Nombre : </label>
                                <?php
                                $ver_area = mysqli_query($conection, "SELECT idArea as area FROM persona WHERE idusuario='$username'");
                                $ver_arear = mysqli_fetch_assoc($ver_area);

                                $are = $ver_arear['area'];

                                $noms = mysqli_query($conection, "SELECT nombre as nombre, idgestion as id FROM tipos WHERE estado='Activo' AND 
                                                  (((categoria='ACTIVIDAD' AND area='$are') OR (categoria='Todos' AND area='$are')) OR ((categoria='ACTIVIDAD' AND area='Todos') OR (categoria='Todos' AND area='Todos')))");
                                ?>
                                <select name="nombre_a" id="nombre_a" class="combo-box" style="width: 300px" disabled>
                                  <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                                  <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                                    <option class="f-box" value="<?php echo $val['id']; ?>">
                                      <?php echo $val['nombre']; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                                <br><br>
                                <label class="titulo">Descripcion : </label><br>
                                <textarea type="text" id="descripcion_a" name="descripcion_a" style="border: none; font-size:12px; width: 100%" disabled></textarea>
                                <br><br>
                                <p style="color:red; font-size: 11px;">Para eliminar el registro seleccionado le pedimos complete los <br> siguientes campos para justificar la razon por la que se eliminará <br> el registro.</p>
                                <div>
                                  <label class="titulo">Motivo : </label><br>
                                  <?php $consulta = mysqli_query($conection, "SELECT idmeps as id, motivo as motivo FROM motivos_eliminaps WHERE estado='ACTIVO' ORDER BY motivo ASC"); ?>
                                  <select name="boxmotiv" id="boxmotiv" class="combo-box cam-empresa" style="width: 360px" required>
                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                    <?php while ($m = mysqli_fetch_assoc($consulta)) { ?>
                                      <option class="f-box" value="<?php echo $m['id']; ?>">
                                        <?php echo $m['motivo']; ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <br>
                                <div style="display: inline-block">
                                  <label class="titulo">Descripcion : </label><br>
                                  <textarea name="descrip" type="Text" id="descrip" class="c-campos" placeholder="Describa el motivo" required></textarea>
                                </div>
                                <br><br>

                                <button type="button" class="btn btn-warning btneliminar" id="eliminadatos" data-dismiss="modal">Eliminar</button>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- POP UP COMENTARIOS -->

                        <div class="modal fade" id="modalComentarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content ach" style="width: 760px; margin-top: 20%; margin-left: -50%;">
                              <div class="modal-header">
                                <h4 class="modal-title t-titulo" id="myModalLabel">Comentarios
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <div style="display: inline-block;">
                                  <input type="text" id="ID_ac" name="ID_ac">
                                  <label class="titulo">Nombre : </label><br>
                                  <?php
                                  //Busca id nombre (tabla tipo)
                                  $consulta_nombre = mysqli_query($conection, "SELECT idgestion as id, nombre as nom FROM tipos WHERE estado='Activo'");

                                  ?>
                                  <select name="nombre_ac" id="nombre_ac" class="combo-box" style="width: 100%" disabled>
                                    <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                                    <?php while ($val = mysqli_fetch_assoc($consulta_nombre)) { ?>
                                      <option class="f-box" value="<?php echo $val['id']; ?>">
                                        <?php echo $val['nom']; ?>
                                      </option>
                                    <?php } ?>
                                  </select><br>
                                  <br>
                                  <label class="titulo">Descripcion : </label><br>
                                  <textarea type="text" id="descripcion_ac" name="descripcion_ac" style="border: none; font-size:12px; width: 100%; height: 100px;" disabled></textarea>

                                  <br>
                                  <?php

                                  //Busca id responsable (tablas persona-actividad)
                                  $consulta_resp = mysqli_query($conection, "SELECT u.idusuario as id, concat(p.apellido,' ',p.nombre) as nombres  FROM usuario u, persona p WHERE u.usuario=p.idusuario");

                                  ?>
                                  <br><br>

                                  <label class="titulo" style="color:blue">Escribir comentario : </label><br>
                                  <textarea name="comentario" type="Text" id="comentario" class="c-campos" placeholder="Describa el motivo" maxlength="180" style="height: 100px; font-family: Helvetica; font-size: 12px; padding: 12px; width: 320px" required></textarea>


                                  <br>
                                  <button type="button" class="btn btn-warning btneliminar" id="comentar" name="comentar" data-dismiss="modal">Comentar</button>

                                </div>
                                <div style="display: inline-block; margin-left: 10px;">

                                  <div class="content-tab">
                                    <table class="table-coment">
                                      <thead>
                                        <tr>
                                          <th class="cabecera">Comentarios</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                      $fac = "";
                                      if(!empty($_GET['fac'])) {
                                        $fac = $_GET['fac'];
                                      }
                                        $consultar_comentarios = mysqli_query($conection, "SELECT ca.idactividad as idc, ca.comentario as coment, date_format(ca.hora, '%H:%i') as hora, ca.fecha as fec, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as datos FROM coment_actividades ca, usuario u, persona p WHERE ca.idusuario=u.idusuario AND u.usuario=p.idusuario AND ca.idactividad='$fac'");
                                        while ($coment = mysqli_fetch_assoc($consultar_comentarios)) { ?>
                                          <tr>
                                            <td>
                                              <label class="contacto"><?php echo $coment['datos'] . ' (' . $coment['fec'] . ' - ' . $coment['hora'] . ')'; ?></label><br>
                                              <textarea class="coment" disabled><?php echo $coment['coment']; ?>
                                                      </textarea>
                                            </td>
                                          </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>



                      </div>
                    </div>
                  </div>
                </div>
                <br><br><br>
              </div>
               
            </div>

          </div>
          <!--End Row-->

          <!--start overlay-->
          <div class="overlay toggle-menu"></div>
          <!--end overlay-->

        </div>
        <!-- End container-fluid-->

      </div>
      <!--End content-wrapper-->

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
    <script type="text/javascript" src="datatables/datatables.min.js"></script>

    <!-- para usar botones en datatables JS -->
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <!-- c車digo JS prop足o-->
    <script type="text/javascript" src="main.js"></script>



</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#guardarnuevo').click(function() {

    });


    $('#actualizadatos').click(function() {
      actualizarActividad();
    });

    $('#eliminadatos').click(function() {
      EliminarDatos();
    });

    $('#comentar').click(function() {
      InsertarComentario();
    });

  });
</script>