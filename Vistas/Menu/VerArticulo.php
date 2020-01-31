<?php
$nombre="";
$idcategoria="";
$stock="";
$descripcion="";
$codigo="";
$idarticulo="";
$condicion="1";
require 'header.php';
 $conn=null;
$host='localhost';
$user='root';
$pwd='';
$db='farmacia';
require_once("../Conexion/conexion.php");
try
{
            
      $success='Conexion Exitosa !!!! ';
      $conn=new PDO ('mysql:host='.$host.';dbname='.$db,$user,$pwd);
      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      

} catch (PDOException $e)
  {
      $error='Base Datos Desconocida !!!! ';
      $_SESSION['error']='Base Datos Desconocida !!!! ';
      echo "<script type='text/javascript'>window.location='404.php';</script>";
      echo '<p>Error al Conectar a la base de datos</p>';
      exit;
  }


?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                                <?php
                                    if(isset($_SESSION['error'])){
                                        echo
                                        "
                                        <div class='alert alert-default text-center'>
                                            ".$_SESSION['error']."
                                        </div>
                                        ";
                                        unset($_SESSION['error']);
                                    }
                                    if(isset($_SESSION['success'])){
                                        $_SESSION['success'];
                                        unset($_SESSION['success']);
                                    }
                                ?>
            </div>
        </div>
    </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Ventas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Escala Ventas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php  
          $conn=null;
          $host='localhost';
          $user='root';
          $pwd='';
          $db='farmacia';
          require_once("../Conexion/conexion.php");
          try
          {
            
              $success='Conexion Exitosa !!!! ';
              $conn=new PDO ('mysql:host='.$host.';dbname='.$db,$user,$pwd);
              $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $sql="SELECT COUNT(*) FROM login";
              $stmt=$conn->prepare($sql);
              $stmt->execute(array('id usuario'=>"idusuario"));
              $resultados=$stmt->fetchColumn();

          } catch (PDOException $e)
          {
              $error='Base Datos Desconocida !!!! ';
              $_SESSION['error']='Base Datos Desconocida !!!! ';
              echo "<script type='text/javascript'>window.location='404.php';</script>";
              echo '<p>Error al Conectar a la base de datos</p>';
              exit;
          }

            ?>
        <h3><?php echo $resultados; ?>  </h3>
              <p>Usuarios Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Ordenes Compras</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              Ver <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          
                          <!--BOTONES DE AÑADIR Y HACER EL REPORTE DE ESTA CLASE VerArticulo --->

                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                   <?php

                   if (isset($_GET['id'])) 
                  {
                            $idarticulo=$_GET['id'];
                            $consulta=$conn->prepare("SELECT * FROM articulo WHERE idarticulo='".$_GET['id']."' ");

                            $consulta->bindParam(':id',$idarticulo);
                            $consulta->execute();
                            if($consulta->rowCount()>=1)
                            {
                                $resultados=$consulta->fetch();//declaramos la variale resultados donde tendra
                                // la fila traidA DE LA BASE DE DATOS
                                
                            }
                            else
                            {
                              echo "Ocurrio Un Error";
                            }
                            //var_dump($consulta);

                    

                  }
                    else
                    {
                      echo "No Hay ID Articulo Modificar";
                    }

                   ?>
                   
                    <!-- finn de la Tabla--->
                   <div class="panel-body" id="formularioregistros" name="formularioregistros">
                        <form name="formulario" action="" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idarticulo"  id="idarticulo" value="<?php echo $resultados[0]; ?> " >
                            <input type="text" readonly="readonly" class="form-control" name="nombre"   id="nombre" value="<?php echo $resultados[3]; ?> " maxlength="100" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="idcategoria" name="idcategoria" readonly="readonly" class="form-control selectpicker" data-live-search="true" required>
                              <option><?php echo $resultados[1]; ?></option>
                            </select>
                          </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Stock(*):</label>
                            <input type="text" class="form-control" readonly="readonly"  name="stock"  value="<?php echo $resultados[4]; ?> " id="stock" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" readonly="readonly"  value="<?php echo $resultados[5]; ?> " id="descripcion" maxlength="256" placeholder="Descripción">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Código:</label>
                            <input type="text" class="form-control" name="codigo" readonly="readonly" value="<?php echo $resultados[2]; ?> "  id="codigo" placeholder="Código Barras">
                            <br> 
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-edit" type="button"><a href="EditarArticulos.php" class="fa fa-arrow-circle-left">Atras</button></a>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div> 
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
   
<?php

require 'footer.php';
?>
