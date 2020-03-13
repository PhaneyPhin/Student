<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>ตารางเรียน</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
          <li class="breadcrumb-item active">ตารางเรียน</li>
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
          <h3 class="card-title"> <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
              id="add-subject-btn">เพิ่มตารางเรียน</button></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <table id="subject-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>ชื่อวิชา</th>
                <th>ชื่อกลุ่มนักเรียน</th>
                <th>ชื่ออาจารย์</th>
                <th>วัน</th>
                <th>เวลาเข้าเรียน</th>
                <th>เวลาออก</th>
                <th>ห้อง</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
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
        <h4 class="modal-title">เพิ่มตารางเรียน</h4>
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
                  <label for="exampleInputEmail1"> ชื่อวิชา :</label>
                  <label style="color: red;">*</label>
                  <select class="form-control select2bs4" style="width: 100%;" id="sub_id" name="sub_id">
                        
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อกลุ่มนักเรียน (ปี-ภาคการศึกษา) :</label>
                  <label style="color: red;">*</label>
                  <select class="form-control select2bs4" style="width: 100%;" id="class_id" name="class_id">
                        
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่ออาจารย์ :</label>
                  <label style="color: red;">*</label>
                  <select class="form-control select2bs4" style="width: 100%;" id="teacher_id" name="teacher_id">
                        
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">ห้อง :</label>
                  <label style="color: red;">*</label>
                  <select class="form-control select2bs4" style="width: 100%;" id="room_id" name="room_id">
                        
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">วัน :</label>
                  <label style="color: red;">*</label>
                  <select class="form-control" style="width: 100%;" id="day" name="day">
                        <option></option>
                        <option>วันจันทร์</option>
                        <option>วันอังคาร</option>
                        <option>วันพุธ</option>
                        <option>วันพฤหัสบดี</option>
                        <option>วันศุกร์</option>
                        <option>วันเสาร์</option>
                        <option>วันอาทิตย์</option>

                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">เวลาเข้าเรียน :</label>
                  <label style="color: red;">*</label>
                  <div class="input-group date" id="start_time" data-target-input="nearest">
                      <input type="text" id="start_time_select" name="start_time_select" class="form-control timepicker-input start_time" data-target="#start_time"/>
                      <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">เวลาออก :</label>
                  <label style="color: red;">*</label>
                  <div class="input-group date"  id="end_time" data-target-input="nearest">
                      <input type="text" id="end_time_select" name="end_time_select" class="form-control timepicker-input end_time" data-target="#end_time"/>
                      <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                  </div>
                </div>
                </div>
              </div>
            </div>

            <div class="my-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-primary" id="btn-clear"
                style="border-color: #ff0909; background-color: white; color: #ff0909; ">Clear</button>
            </div>
        </form>
      </div>
    </div>
  </div>
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
   var start_hour=0,start_minute=0,end_hour=23,end_minute=59,isEditing=false,editing_row=-1;
   function e(v){
      return v>10?v:'0'+v;
    }
  $(function () {
   
    postData("service/subject.php?type=1").done(result=>{
      $("#sub_id").html(`<option value=""></option>`+result.data.map(item=>{
        return `<option value="${item.sub_id}">${item.sub_name}</option>`;
      }).join(""));
     
    });
    postData("service/class.php?type=1").done(result=>{
      $("#class_id").html(`<option value=""></option>`+result.data.map(item=>`<option value="${item.class_id}">${item.class_name} (${item.year}-${item.term})</option>`).join(""))
    })
    postData("service/teacher.php?type=1").done(result=>{
      $("#teacher_id").html(`<option value=""></option>`+result.data.map(item=>`<option value="${item.teacher_id}">${item.first_name} ${item.last_name}</option>`).join(""))
    })
    postData("service/room.php?type=1").done(result=>{
      $("#room_id").html(`<option value=""></option>`+result.data.map(item=>`<option value="${item.room_id}">${item.room_number}</option>`).join(""))
    })
    $('.select2bs4').select2({
            theme: 'bootstrap4'
    })
    $('#start_time').datetimepicker({ format: 'LT'})
    $('#end_time').datetimepicker({ format: 'LT'})
    
    $('#add-subject-btn').click(function () {
      isEditing=false;
      editing_row=-1;
      $("#sub_id").val('');
      $('#sub_name').val('');
      $('#credit').val('');
      $('#sub_id').prop("disabled", false);
      $('#modal-default').modal('show');
      $('.modal-title').html("เพิ่มตารางเรียน");
    });
    var table = $('#subject-table').DataTable({
      "ajax": {
        "url": service.url+"teaching.php?type=1",
        "dataSrc": "data"
      },
      "columns": [

        { "data": "teaching_id" },
        { "data": "sub_name" },
        { "data": "class_name" },
        { "data": "teacher_name" },
        { "data":"day"},
        { "data":"start_time"},
        { "data":"end_time"},
        { "data":"room_number"},
        { "data": "teaching_id" },
        { "data": "teaching_id" }
      ],
      "columnDefs": [
        {
        
          targets: 0,
            "searchable": false,
            "orderable": false,
        },
        {
      
          "targets": 1
        },
        {
       
          targets: 2
        },
        {
    
          targets: 3
        },
        {
          render: function (data, type, row) {
            return `<button class="btn btn-warning edit-btn" data-id='` + row['teaching_id'] + `' data-row='`+JSON.stringify(row)+`' data-sub_name='` + row['sub_name'] + `' data-credit='` + row['credit'] + `'>แก้ไข</button>`
          },
          targets: 8
        }, {
          render: function (data, type, row) {
            return `<button class="btn btn-danger delete-btn"  data-id='` + row['teaching_id'] + `'>ลบ</button>`
          },
          targets: 9
        }
      ],
      drawCallback: function (settings) {
        $('.edit-btn').click(function () {
          var row=($(this).data('row'));
          console.log(row);
          $('#modal-default').modal('show');

          // postData("service/subject.php?type=5",{sub_id:sub_id}).done(result=>{
          //   setStudentValue(result.data[0]);
          // })
          // row=JSON.parse(row);
      
          function setValue(values){
            values.forEach(function(data){
              $('#'+data).val(row[data]).change();
            
            })
          }
          isEditing=true;
          setValue(["sub_id","teacher_id","room_id","class_id","day"]);
          function setTime(time){
            var hour=parseInt(time.substring(0,2));
            var type="AM";
            if(hour>12){
              type="PM";
              hour-=12;
            }else if(hour==12){
              type="PM";
            }

            return e(hour)+time.substring(2,5)+" "+type;
          }
          $("#start_time_select").val(setTime(row.start_time));
          $("#end_time_select").val(setTime(row.end_time));
          editing_row=row.teaching_id;
          // console.log(row['sub_id']);
          // $("#sub_id").val(row['sub_id']).change();
          $('.modal-title').html("แก้ไขตารางเรียน");
         

        })
        $('.delete-btn').click(function () {
          var teaching_id = $(this).data('id');
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
              postData('service/teaching.php?type=4', { teaching_id: teaching_id }).done((result) => {
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
          teaching_id:editing_row,
          sub_id: $('#sub_id').val(),
          teacher_id: $('#teacher_id').val(),
          class_id: $("#class_id").val(),
          room_id: $("#room_id").val(),
          day:$("#day").val(),
          start_time:e(start_hour)+":"+e(start_minute)+":00",
          end_time:e(end_hour)+":"+e(end_minute)+":00",
        }
        console.table(data)
        var type = 2;
        if (isEditing) {
          type = 3;
        }
        postData('service/teaching.php?type=' + type, (data)).done((result) => {
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
    
    $.validator.addMethod(
        'end_time',
        function (value, element, requiredValue) {
            if(value.length>1&&value.indexOf(" ")!=-1&&value.indexOf(":")!=-1){
              var x=value[1];
              if(x==":"){
                value="0"+value;
              }
              if(value.length==8){
                var y=value.split(" ");
                if((y[1]=='AM'|| y[1]=="PM")&&y[0].indexOf(":")==2){
                    var time=y[0].split(":");
                    var hour=((time[0]!="12"&&y[1]=='PM')?(12+parseInt(time[0])):parseInt(time[0]))%24;
             
                    var minute=parseInt(time[1]);
                    end_hour=hour;
                    end_minute=minute;
                    if(hour<24&&minute<60&&60*end_hour+end_minute>60*start_hour+start_minute){
                      
                      console.log(hour,minute,start_hour,start_minute);
                      return true;
                    }else{
                      return false;
                    }

                }else{
                  return false
                }
              }else{
                return false
              }
            }else{
              return false;
            }
           
        },
        'เวลาออกไม่ถูกต้อง'
    );
    $.validator.addMethod(
        'start_time',
        function (value, element, requiredValue) {
            if(value.length>1&&value.indexOf(" ")!=-1&&value.indexOf(":")!=-1){
              var x=value[1];
              if(x==":"){
                value="0"+value;
              }
              if(value.length==8){
                var y=value.split(" ");
                if((y[1]=='AM'|| y[1]=="PM")&&y[0].indexOf(":")==2){
                    var time=y[0].split(":");
                    var hour=((time[0]!="12"&&y[1]=='PM')?(12+parseInt(time[0])):parseInt(time[0]))%24;
             
                    var minute=parseInt(time[1]);
                    start_hour=hour;
                      start_minute=minute;
                    if(hour<24&&minute<60&&60*end_hour+end_minute>60*start_hour+start_minute){
                      
                      return true;
                    }else{
                      return false;
                    }

                }else{
                  return false
                }
              }else{
                return false
              }
            }else{
              return false;
            }
           
        },
        'เวลาเข้าเรียนไม่ถูกต้อง'
    );
    $('#quickForm').validate({
      rules: {
        sub_id: {
          required: true
        },
        class_id: {
          required: true
        },
        teacher_id: {
          required: true
        },
        room_id:{
          required: true
        },
        day:{
          required: true
        },
        start_time_select:{
          required: true,
          start_time:true
        },
        end_time_select:{
          required: true,
          end_time:true
        }
      },
      messages: {
        sub_id: {
          required: "กรุณาระบุรหัสวิชา"
        },
        class_id: {
          required: "กรุณาระบุกลุ่มนักเรียน"
        },
        teacher_id: {
          required: "กรุณาระบุอาจารย์"
        },
        room_id:{
          required: "กรุณาเลือกห้อง"
        },
        day:{
          required:"กรุณาเลือกวัน"
        },
        start_time_select:{
          required: "กรุณาเลือกเวลาเข้าเรียน"
        },
        end_time_select:{
          required:"กรุณาเลือกเวลาออก"
          
        }
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