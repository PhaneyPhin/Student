 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ห้องเรียน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
            <li class="breadcrumb-item active">ห้องเรียน</li>
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
            <h3 class="card-title">    <button type="button" class="btn btn-block btn-primary"  data-toggle="modal" data-target="#modal-default">เพิ่มห้องเรียน</button></h3>
          </div>
          <!-- /.card-header -->
         
          <div class="card-body">
            <table id="room-table" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>ลำดับ</th>
                <th>รหัสห้องเรียน</th>
                <th>ชื่อห้องเรียน</th>
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
            <h4 class="modal-title">เพิ่มห้องเรียน</h4>
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
                    <div class="col-sm-12 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> รหัสห้องเรียน :</label>
                        <label style="color: red;">*</label>
                        <input type="text" id="room_id" name="room_id" class="form-control" id="exampleInputEmail1" placeholder="ระบุรหัสห้องเรียน">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อห้องเรียน :</label>
                        <label style="color: red;">*</label>
                        <input type="text" id="room_number" name="room_number" class="form-control" id="exampleInputEmail1" placeholder="ระบุชื่อห้องเรียน">
                      </div>
                    </div>
                  </div>
            
                <!-- /.card-body -->

                <div class="my-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-primary" id="btn-clear" style="border-color: #ff0909; background-color: white; color: #ff0909; ">Clear</button>
                </div>
              </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <style>
      .modal-dialog{
        max-width: 1000px;
      }
      .card-footer{
        float: right;
      }
      .modal-header{
        border-bottom: 1px solid #c1c4c7;
      }
    </style>

<script>
    $(function () {
     
      $.validator.setDefaults({
        submitHandler: function () {
          var data = {
          room_id: $('#room_id').val(),
          room_number: $('#room_number').val()
        }
        var type = 2;
        if ($('#room_id').attr('disabled')) {
          type = 3;
        }
        postData('service/room.php?type=' + type, (data)).done((result) => {
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
            room_id :{
                required: true
            },
            room_number: {
                required: true
            },
        },
        messages: {
         room_id:{
            required: "กรุณาระบุรหัสห้องเรียน"
         },
         room_number:{
             required: "กรุณาระบุชื่อห้องเรียน"
         },
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
      });
      var table = $('#room-table').DataTable({
      "ajax": {
        "url": service.url+"room.php?type=1",
        "dataSrc": "data"
      },
      "columns": [

        { "data": "room_id" },
        { "data": "room_id" },
        { "data": "room_number" },
        { "data": "room_id" },
        { "data": "room_id" }
      ],
      "columnDefs": [
        {
          width: '20%',
          targets: 0,
            "searchable": false,
            "orderable": false,
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
          render: function (data, type, row) {
            return `<button class="btn btn-warning edit-btn" data-id='` + row['room_id'] + `' data-room_number='` + row['room_number'] + `' >แก้ไข</button>`
          },
          targets: 3
        }, {
          width: '20%',
          render: function (data, type, row) {
            return `<button class="btn btn-danger delete-btn"  data-id='` + row['room_id'] + `'>ลบ</button>`
          },
          targets: 4
        }
      ],
      drawCallback: function (settings) {
        $('.edit-btn').click(function () {
          var room_id = $(this).data('id');
          var room_number = $(this).data('room_number');
         
          $('#room_id').prop("disabled", true);
          $('#modal-default').modal('show');

          // postData("service/subject.php?type=5",{sub_id:sub_id}).done(result=>{
          //   setStudentValue(result.data[0]);
          // })
          $("#room_id").val(room_id);
          $('#room_number').val(room_number);
          $('.modal-title').html("แก้ไขข้อมูลวิชา");
          $('#sub_id').prop("disabled", true);

        })
        $('.delete-btn').click(function () {
          var room_id = $(this).data('id');
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
              postData('service/room.php?type=4', { room_id: room_id }).done((result) => {
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

    })
  </script>