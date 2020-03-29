<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>ผู้ดูแลระบบ</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
          <li class="breadcrumb-item active">ผู้ดูแลระบบ</li>
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
              id="add-user-btn">เพิ่มผู้ดูแลระบบ</button></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <table id="user-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>username</th>
                <th>ชื่อ</th>
                <th>สกุล</th>
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
                  <label for="exampleInputEmail1"> username :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="username" name="username" class="form-control"
                    placeholder="ระบุ username">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อ :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="first_name" name="first_name" class="form-control" 
                    placeholder="ระบุชื่อ">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">สกุล :</label>
                  <label style="color: red;">*</label>
                  <input type="text" id="last_name" name="last_name" class="form-control"
                    placeholder="ระบุสกุล">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3" id="update_password_container">
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                     
                     
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="update_password">
                        <label for="update_password">
                          แก้ไขรหัสผ่าน
                        </label>
                      </div>
                    </div>
                  </div>
              <div class="col-sm-12 col-md-3 col-lg-3" id="password_container">
                <div class="form-group">
                  <label for="exampleInputEmail1">รหัสผ่าน :</label>
                  <label style="color: red;">*</label>
                  <input type="password" id="password" name="password" class="form-control"
                    placeholder="ระบุรหัสผ่าน">
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
    $('#add-user-btn').click(function () {
      $("#update_password_container").hide();
      $("#username").val('');
      $('#password').val('');
      $('#first_name').val('');
      $('#last_name').val('');
      $('#modal-default').modal('show');
      $('.modal-title').html("เพิ่มผู้ดูแลระบบ");
      $('#username').prop("disabled", false);
    });
    $('#update_password').change(function(){
        if($('#update_password')[0].checked){
            $('#password_container').show();
        }else{
            $('#password_container').hide();
        }
    })
    var table = $('#user-table').DataTable({
      "ajax": {
        "url": service.url+"user.php?type=1",
        "dataSrc": "data"
      },
      "columns": [

        { "data": "username" },
        { "data": "username" },
        { "data": "first_name" },
        { "data": "last_name" },
        { "data": "username" },
        { "data": "username" }
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
          targets: 3
        },
        {
          width: '20%',
          render: function (data, type, row) {
            return `<button class="btn btn-warning edit-btn" data-id='` + row['username'] + `' data-row='`+JSON.stringify(row)+`'>แก้ไข</button>`
          },
          targets: 4
        }, {
          width: '20%',
          render: function (data, type, row) {
            return `<button class="btn btn-danger delete-btn"  data-id='` + row['username'] + `'>ลบ</button>`
          },
          targets: 5
        }
      ],
      drawCallback: function (settings) {
        $('.edit-btn').click(function () {
            $("#update_password_container").show();
          var row=$(this).data('row');
          $('#username').prop("disabled", true);
          $('#modal-default').modal('show');
          $('#password').hide();
          // postData("service/user.php?type=5",{sub_id:sub_id}).done(result=>{
          //   setStudentValue(result.data[0]);
          // })
          console.log(row);
          $("#username").val(row.username);
          $('#first_name').val(row.first_name);
          $('#last_name').val(row.last_name);
          
          $('.modal-title').html("แก้ไขข้อมูลวิชา");
          $('#username').prop("disabled", true);

        })

        $('.delete-btn').click(function () {
          var username = $(this).data('id');
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
              postData('service/user.php?type=4', { username: username }).done((result) => {
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
          username: $('#username').val(),
          first_name: $('#first_name').val(),
          last_name: $('#last_name').val(),
          update_password: $('#update_password')[0].checked,
          password:$('#password').val()
        }
        var type = 2;
        if ($('#username').attr('disabled')) {
          type = 3;
        }
        postData('service/user.php?type=' + type, (data)).done((result) => {
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
        'strong_password',
        function (value, element, requiredValue) {
        
          return  /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(value)
              && /[a-z]/.test(value) // has a lowercase letter
              && /[A-Z]/.test(value) // has a lowercase letter
              && /\d/.test(value) // has a digit
        },
        'password is too weak'
    );
    $('#quickForm').validate({
      rules: {
        username: {
          required: true,
          remote: {
                url: "service/user.php?type=6",
                type: "post",
                data: {
                    username: function() {
                        return $("#username").val();
                    }
                }
            }
          
        },
        first_name: {
          required: true
        },
        last_name: {
          required: true
        },
        password:{
          required: true,
          minlength:6,
          strong_password:true
        }
      },
      messages: {
        username: {
          required: "กรุณาระบุ username",
          remote:"username ซ้ำกัน"
        },
        first_name: {
          required: "กรุณาระบุชื่อ"
        },
        last_name: {
          required: "กรุณาระบุสกุล"
        },
        password:{
          required:"กรุณากรอกรหัสผ่าน",
          minlength:"รหัสผ่านอย่างน้อยมี 6 ตัวอักษร"
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