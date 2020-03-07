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
        <h4 class="modal-title">เพิ่มวิชา</h4>
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
                  <label for="exampleInputEmail1"> รหัสวิชา :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="sub_id" name="sub_id" class="form-control" id="exampleInputEmail1"
                    placeholder="ระบุรหัสวิชา">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อวิชา :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="sub_name" name="sub_name" class="form-control" id="exampleInputEmail1"
                    placeholder="ระบุชื่อวิชา">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">หน่วยกิต :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="credit" name="credit" class="form-control" id="exampleInputEmail1"
                    placeholder="ระบุหน่วยกิต">
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
  $(function () {
    $('#add-subject-btn').click(function () {

      $("#sub_id").val('');
      $('#sub_name').val('');
      $('#credit').val('');
      $('#sub_id').prop("disabled", false);
      $('#modal-default').modal('show');
      $('.modal-title').html("เพิ่มข้อมูลวิชา");
    });
    var table = $('#subject-table').DataTable({
      "ajax": {
        "url": service.url+"subject.php?type=1",
        "dataSrc": "data"
      },
      "columns": [

        { "data": "sub_id" },
        { "data": "sub_name" },
        { "data": "class_name" },
        { "data": "teacher_id" },
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
            return `<button class="btn btn-warning edit-btn" data-id='` + row['sub_id'] + `' data-sub_name='` + row['sub_name'] + `' data-credit='` + row['credit'] + `'>แก้ไข</button>`
          },
          targets: 8
        }, {
          render: function (data, type, row) {
            return `<button class="btn btn-danger delete-btn"  data-id='` + row['sub_id'] + `'>ลบ</button>`
          },
          targets: 9
        }
      ],
      drawCallback: function (settings) {
        $('.edit-btn').click(function () {
          var sub_id = $(this).data('id');
          var sub_name = $(this).data('sub_name');
          var credit = $(this).data('credit');
          $('#sub_id').prop("disabled", true);
          $('#modal-default').modal('show');

          // postData("service/subject.php?type=5",{sub_id:sub_id}).done(result=>{
          //   setStudentValue(result.data[0]);
          // })
          $("#sub_id").val(sub_id);
          $('#sub_name').val(sub_name);
          $('#credit').val(credit);
          $('.modal-title').html("แก้ไขข้อมูลวิชา");
          $('#sub_id').prop("disabled", true);

        })
        $('.delete-btn').click(function () {
          var sub_id = $(this).data('id');
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
              postData('service/subject.php?type=4', { sub_id: sub_id }).done((result) => {
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
          sub_id: $('#sub_id').val(),
          sub_name: $('#sub_name').val(),
          credit: $('#credit').val()
        }
        var type = 2;
        if ($('#sub_id').attr('disabled')) {
          type = 3;
        }
        postData('service/subject.php?type=' + type, (data)).done((result) => {
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
        sub_id: {
          required: true
        },
        sub_name: {
          required: true
        },
        credit: {
          required: true
        },
      },
      messages: {
        sub_id: {
          required: "กรุณาระบุรหัสวิชา"
        },
        sub_name: {
          required: "กรุณาระบุชื่อวิชา"
        },
        credit: {
          required: "กรุณาระบุหน่วยกิต"
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