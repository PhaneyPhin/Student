<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>รูป slider</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
          <li class="breadcrumb-item active">รูป slider</li>
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
              id="add-subject-btn">เพิ่มรูป slider</button></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <table id="subject-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>รหัสภาพ</th>
                <th>รูปภาพ</th>
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
        <h4 class="modal-title">เพิ่มภาพ slider</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">

        <!-- /.card-header -->
        <!-- form start -->
        
          <div class="card-body">
            <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <label>รูปภาพ 
                        </label>
                        <img id="image" width="100%">
                        <div class="input-group">
                            <input type="file" name="image_profile" class="custom-file-input" id="exampleInputFile" style="visibility: hidden;">
                            <label class="upload-label" for="exampleInputFile">Choose file</label>
                        </div>
                        </div>
              
            </div>

            <!-- /.card-body -->

            <div class="my-footer">
              <button type="submit" class="btn btn-primary" id="submit">Submit</button>
              <button type="reset" class="btn btn-primary" id="btn-clear"
                style="border-color: #ff0909; background-color: white; color: #ff0909; ">Clear</button>
            </div>
        
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
    var img="";
  $(function () {
    $('#add-subject-btn').click(function () {

      $("#sub_id").val('');
      $('#sub_name').val('');
      $('#credit').val('');
      $('#sub_id').prop("disabled", false);
      $('#modal-default').modal('show');
      $('.modal-title').html("เพิ่มรูป slider");
    });
    var table = $('#subject-table').DataTable({
      "ajax": {
        "url": service.url+"slider.php?type=1",
        "dataSrc": "data"
      },
      "columns": [

        { "data": "image_id" },
        { "data": "image_id" },
        { "data": "image" },
        { "data": "image_id" }
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
        },{
          width: '20%',
          render: function (data, type, row) {
            return `<image src="`+row['image']+`" style="width:100%">`
          },
          targets: 2
        }, {
          width: '20%',
          render: function (data, type, row) {
            return `<button class="btn btn-danger delete-btn"  data-id='` + row['image_id'] + `'>ลบ</button>`
          },
          targets: 3
        }
      ],
      drawCallback: function (settings) {
       
        $('.delete-btn').click(function () {
          var image_id = $(this).data('id');
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
              postData('service/slider.php?type=4', { image_id: image_id }).done((result) => {
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
    
    $("#image").hide();
    $("#submit").click(function(){
        if(img==""){
            Swal.fire('warning',"กรุณาเลือกรูปภาพ","warning");
        }else{
            postData("service/slider.php?type=2",{image:img}).done(function(result){
                console.log(result);
                $("#content").append(`<img src='`+result.image+`'`);
                if(result.code==1){
                    Swal.fire(
                              'ข้อมูลถูกบันทึกเรียบร้อยแล้ว!',
                              '',
                              'success'
                            )
                            table.ajax.reload();
                            $('#modal-default').modal('hide');
                }else{
                    Swal.fire(
                              'ไม่สามารถบันทึกข้อมูลได้!',
                              '',
                              result.message
                            )
                }
            })
        }
    })
    var input = document.querySelector('input[type=file]');

        // You will receive the Base64 value every time a user selects a file from his device
        // As an example I selected a one-pixel red dot GIF file from my computer
        input.onchange = function () {
        var file = input.files[0],
            reader = new FileReader();

        reader.onloadend = function () {
            // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
            var b64 = reader.result;
            console.log(b64); //-> "R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs="
            img=b64;
            console.log(img);
            $("#image").show();
            $('#image').attr('src',reader.result);
        };
      
        reader.readAsDataURL(file);
        };
  })
</script>