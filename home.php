<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <center>
                Bienvenue !!!
                <marquee behavior="" direction="">
                    <?php echo $_SESSION['login_name'] ?>
                </marquee>

            </center>
        </div>
    </div>
</div>
<hr>
<?php 

    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
     $where2 = "";
    if($_SESSION['login_type'] == 2){
      $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }

    // $order_by = "";
    // if ($_SESSION['login_type'] == 1) {
    //   $order_by = " "
    // }



    ?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-success">
            <div class="card-header">
                <b>Etat d'avancement des Activités</b>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="30%">
                            <col width="35%">
                            <col width="15%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <th>#</th>
                            <th>Activités</th>
                            <th>Progression</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                $i = 1;
                $stat = array("Suspendu","Commencé","En cours...","En attente","En retard","Terminé");
                $where = "";
                if($_SESSION['login_type'] == 2){
                  $where = " where manager_id = '{$_SESSION['login_id']}' ";
                }elseif($_SESSION['login_type'] == 3){
                  $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                }
                $qry = $conn->query("SELECT * FROM proj_listt $where order by name asc");
                while($row= $qry->fetch_assoc()):
                  $prog= 0;
                $tprog = $conn->query("SELECT * FROM tasks_list where project_id = {$row['id']}")->num_rows;
                $cprog = $conn->query("SELECT * FROM tasks_list where project_id = {$row['id']} and status = 3")->num_rows;
                $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                $prod = $conn->query("SELECT * FROM users_productivity where project_id = {$row['id']}")->num_rows;
                if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
                if($prod  > 0  || $cprog > 0)
                  $row['status'] = 2;
                else
                  $row['status'] = 1;
                elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
                $row['status'] = 4;
                endif;
                  ?>
                            <tr>
                                <td>
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <a>
                                        <?php echo ucwords($row['name']) ?>
                                    </a>
                                    <br>
                                    <small>
                                        Fin: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?>
                                    </small>
                                </td>
                                <td class="project_progress">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57"
                                            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                                        </div>
                                    </div>
                                    <small>
                                        <?php echo $prog ?>% Complet
                                    </small>
                                </td>
                                <td class="project-state">
                                    <?php
                            if($stat[$row['status']] =='Suspendu'){
                              echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Commencé'){
                              echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='En cours...'){
                              echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='En attente'){
                              echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='En retard'){
                              echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Terminé'){
                              echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                            }
                          ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="./index.php?page=view_project&id=<?php echo $row['id'] ?>">
                                        <i class="fas fa-folder">
                                        </i>
                                        Voir
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-12">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3><?php echo $conn->query("SELECT * FROM proj_listt $where")->num_rows; ?></h3>

                        <p>Total Activités</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-layer-group"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-12">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3><?php echo $conn->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM tasks_list t inner join proj_listt p on p.id = t.project_id $where2")->num_rows; ?>
                        </h3>
                        <p>Total Tâches</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tasks"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-12">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3><?php echo $conn->query("SELECT * FROM userss")->num_rows; ?></h3>

                        <p>Total Utilisateurs</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-12">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3><?php echo $conn->query("SELECT * FROM land")->num_rows; ?></h3>

                        <p>Total Parcelles/Bassins</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-tree"></i>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>