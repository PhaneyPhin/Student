<!-- Content Header (Page header) -->
<?php
  session_start();
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>กลุ่มนักเรียน</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
          <li class="breadcrumb-item active">กลุ่มนักเรียน</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
         <?php
         
          if($_SESSION['isLogginedIn']){
            ?>
             <h3 class="card-title"> <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
              id="add-subject-btn">เพิ่มกลุ่มนักเรียน</button></h3>
            <?php
          }
         ?>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <table id="subject-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>ชื่อกลุ่มนักเรียน</th>
                <th>ชื่อวิชา</th>
                <th>ปีการศึกษา</th>
                <th>ภาคการศึกษา</th>
                <th>ระดับการศึกษา</th>
                <th>รายการนักศึกษา</th>
               
              </tr>
            </thead>

          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มกลุ่มนักเรียน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">

        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="quickForm">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1"> ปีการศึกษา :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="year" name="year" class="form-control" id="exampleInputEmail1"
                    placeholder="ระบุรปีการศึกษา">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">ภาคการศึกษา :</label>
                  <label style="color: red;">*</label>
                  <select name="term" id="term" class="form-control">
                      <option>1</option>
                      <option>2</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">ระดับการศึกษา :</label>
                  <label style="color: red;">*</label>
                  <select class="form-control" style="width: 100%;" name="grade" id="grade" >
                    <option value="0"></option>
                    <option value="1">ป.1</option>
                    <option value="2">ป.2</option>
                    <option value="3">ป.3</option>
                    <option value="4">ป.4</option>
                    <option value="5">ป.5</option>
                    <option value="6">ป.6</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อกลุ่มนักเรียน :</label>
                  <label style="color: red;">*</label>
                  <input type="text" class="form-control" id="class_name" name="class_name">
                </div>
              </div>
            </div>

            <!-- /.card-body -->

            <div class="my-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-primary" id="btn-clear"
                style="border-color: #ff0909; background-color: white; color: #ff0909; ">Clear</button>
            </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<style>
  .modal-dialog {
    max-width: 1000px;
  }

  .card-footer {
    float: right;
  }

  .modal-header {
    border-bottom: 1px solid #c1c4c7;
  }
</style>
<script>
  $(function () {
    $('#add-subject-btn').click(function () {

      $("#year").val('');
      $('#term').val('');
      $('#grade').val('');
      $('#class_name').val('');
      localStorage.setItem('class_id','');
      $('#modal-default').modal('show');
      $('.modal-title').html("เพิ่มกลุ่มนักเรียน");
    });
    var table = $('#subject-table').DataTable({
      "ajax": {
        "url": service.url+"view-grade.php?type=1&teacher_id=<?=$_SESSION['username']?>",
        "dataSrc": "data"
      },
      "columns": [
      { "data": "class_id" },
        { "data": "class_name" },
        { "data": "sub_name" },
        { "data": "year" },
        { "data": "term" },
        { "data": "grade" },
        { "data": "class_id" }
    
      
      ],
      "columnDefs": [
        {
          width: '20%',
          targets: 0,
            "searchable": false,
            "orderable": true,
        },
        {
          width: '20%',

          "targets": 1
        },
        {
          width: '20%',
          targets: 2
        },
        {
          width: '20%',
          targets: 3
        },
        {
          width: '20%',
          targets: 5,
          render: function (data, type, row) {
            switch(data){
                case "0":return '';
                default:return 'ป.'+data;
            }
          },
        },
         {
          width: '20%',
          render: function (data, type, row) {
            return `<button class="btn btn-info view-btn"  data-id='` + row['class_id'] + `' data-row='`+JSON.stringify(row)+`'>แสดง</button>`
          },
          targets: 6
        }
        
      ],
      drawCallback: function (settings) {
        $('.edit-btn').click(function () {
          var class_id = $(this).data('id');
          var year = $(this).data('year');
          var term = $(this).data('term');
          var grade= $(this).data('grade');
          var class_name=$(this).data('class_name');
          localStorage.setItem('class_id',class_id);
          $('#modal-default').modal('show');

          // postData("service/subject.php?type=5",{sub_id:sub_id}).done(result=>{
          //   setStudentValue(result.data[0]);
          // })
          $("#year").val(year);
          $('#term').val(term);
          $('#grade').val(grade);
          $('#class_name').val(class_name);
         
          $('.modal-title').html("แก้ไขข้อมูลกลุ่มนักเรียน");

        })
        $('.delete-btn').click(function () {
          var class_id = $(this).data('id');
          Swal.fire({
            title: 'คุณต้องการลบข้อมูลนี้ใช่หรือไหม?',
            text: "ข้อมูลที่ลบแล้วไม่สารถยอนกลับได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก'
          }).then((result) => {
            if (result.value) {
              postData('service/class.php?type=4', { class_id: class_id }).done((result) => {
                if (result.code == 1) {
                  Swal.fire(
                    'ข้อมูลถูกลยเรียบร้อยแล้ว!',
                    '',
                    'success'
                  )
                  table.ajax.reload();
                } else {
                  Swal.fire(
                    '',
                    result.message,
                    'error'
                  )
                }
              })
            }
          })
        })
        $('.view-btn').click(function(){
            var class_id=$(this).data('id');
            var row=$(this).data('row');
         
            console.table(`./study/student-list-grade.php?class_id=${class_id}&sub_id=${row.sub_id}&sub_name=${row.sub_name}`);
            
            $('#content-wrapper').load(encodeURI(`./study/student-list-grade.php?class_id=${class_id}&sub_id=${row.sub_id}&sub_name=${row.sub_name}`));
        })
      }
    });
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    $.validator.setDefaults({
      submitHandler: function () {
        var data = {
          class_id:localStorage.getItem('class_id'),
          year: $('#year').val(),
          term: $('#term').val(),
          grade: $('#grade').val(),
          class_name:$('#class_name').val()
        }
        var type = 2;
        if (localStorage.getItem('class_id')!='') {
          type = 3;
        }
        postData('service/class.php?type=' + type, (data)).done((result) => {
          if (result.code == 1) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
              showConfirmButton: false,
              timer: 1500
            })
            table.ajax.reload();
            $('#modal-default').modal('hide');
          } else {
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'error',
              text: result.message
            })
          }
        });
      }
    })
    $('#quickForm').validate({
      rules: {
        year: {
          required: true,
          number:true,
          min:2019,
          max:2100
        },
        term: {
          required: true
        },
        grade: {
          required: true,
          number:true,
          min:1
        },
        class_name:{
            required:true
        }
      },
      messages: {
        year: {
          number:"ปีการศึกษาต้องเป็นตัวเลข",
          max:"ปีการศึกษาต้องอยู่ในช่วง 2019-2100",
          min:"ปีการศึกษาต้องอยู่ในช่วง 2019-2100",
          required: "กรุณาระบุปีการศึกษา"
        },
        class_name:"กรุณาระบุชื่อกลุ่มนักเรียน",
        term: {
          required: "กรุณาระบุชื่อวิชา"
        },
        grade: "กรุณาระบุระดับการศึกษา"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    })
  })
</script>
<?php
  session_write_close();
?>