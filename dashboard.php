<?php
  include('./service/connections/connect.php');
  session_start();
  $sql="
    select (select count(*) from students) as num_student,
    (select count(*) from teachers) as num_teacher,
    (select count(*) from room) as num_room,
    (select count(*) from subject) as num_subject 
  ";
  function map_label($class){
    return $class['class_name'];
  }
  function map_count($class){
    return $class['num_student'];
  }
  $data=getOfDB($sql);
  $data=$data[0];

  $sql="select count(*) as num_student,CONCAT('ป.',grade) as grade from students group by grade";
  $students=getOfDB($sql);
  function grade_map($student){
    return $student['grade'];
  }
  function grade_number($student){
    return $student['num_student'];
  }
  $grade=array_map('grade_map',$students);
  $num_student=array_map('grade_number',$students);


  $year_terms=getOfDB("select distinct year,term from class order by year,term desc");


?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="num-teacher"><?=$data['num_teacher']?></h3>

                <p>อาจารย์</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
             <?php
              if($_SESSION['isLogginedIn']){
                ?>
                   <a data-href="./teacher.php" class="link small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php
              }
             ?>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="num_student"><?=$data['num_student']?><sup style="font-size: 20px"></sup></h3>

                <p>นักศึกษา</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <?php
              if($_SESSION['isLogginedIn']){
                ?>
                   <a data-href="./student.php" class="link small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php
              }
             ?>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id='num-room'><?=$data['num_room']?></h3>

                <p>ห้อง</p>
              </div>
              <div class="icon">
                <i class="fas fa-home"></i>
              </div>
              <?php
              if($_SESSION['isLogginedIn']){
                ?>
                   <a data-href="./room.php" class="link small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php
              }
             ?>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="num-subject"><?=$data['num_subject']?></h3>

                <p>วิชา</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <?php
              if($_SESSION['isLogginedIn']){
                ?>
                   <a data-href="./subject.php" class="link small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php
              }
             ?>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6"><div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">กราฟการแจกแจงนักเรียนตามระดับชัน</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                </div></div>
                <?php 
                  foreach($year_terms as $year_term){

                  
                ?>
                <div class="col-12 col-sm-12 col-md-6"><div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">กลุมนักเรียน ปีการศึกษา <?=$year_term['year']?> ภาคการศึกษา ที่ <?=$year_term['term']?> </h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="donutChart<?=$year_term['year']."_".$year_term['term']?>" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                </div></div>
                <?php
                  }
                ?>
        </div>
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>

  $(function(){
    $('.link').click(function(){
      if($(this).data('href')){
        $('#content-wrapper').load($(this).data('href'));
        
        $(this).addClass('active')
      }
    });
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: <?=json_encode($grade)?>,
      datasets: [
        {
          data: <?=json_encode($num_student)?>,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'pie',
      data: donutData,
      options: donutOptions      
    })

    <?php
      foreach($year_terms as $year_term){
        $sql="select c.*,count(sc.student_id) as num_student from class c
          inner join study_class sc on c.class_id=sc.class_id
        where year='".$year_term['year']."' and term='".$year_term['term']."' GROUP BY c.class_id ORDER BY c.class_name" ;
        $class_data=getOfDB($sql);
        

        $label=array_map('map_label',$class_data);
        $count=array_map("map_count",$class_data);

    ?>
      // console.log(<?=json_encode($class_data)?>);
        var donutChartCanvas<?=$year_term['year']."_".$year_term['term']?>  = $('#donutChart<?=$year_term['year']."_".$year_term['term']?>').get(0).getContext('2d')
        var donutData<?=$year_term['year']."_".$year_term['term']?>       = {
          labels: <?=json_encode($label)?>,
          datasets: [
            {
              data: <?=json_encode($count)?>,
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
          ]
        }
        var donutOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        var donutChart<?=$year_term['year']."_".$year_term['term']?>  = new Chart(donutChartCanvas<?=$year_term['year']."_".$year_term['term']?> , {
            type: 'doughnut',
            data: donutData<?=$year_term['year']."_".$year_term['term']?> ,
            options: donutOptions      
          })
    <?php
       
      }
    ?>
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    
  })
</script>
<?php
  session_write_close();
?>
