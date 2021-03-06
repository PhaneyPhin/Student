


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
  <div class="card">
      <div class="card-header">ค้นหาข้อมูล</div>
      <div class="card-body">
        <form role="form" id="quickForm">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group">
                    <label for="year"> ปีการศึกษา :</label>
                    <label style="color: red;">*</label>
                    <input type="text" id="year" name="year" class="form-control"
                        placeholder="ระบุรหัสวิชา">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                        <label for="term"> ภาคการศึกษา :</label>
                        <label style="color: red;">*</label>
                        <select name="term" id="term" class="form-control">
                            <option>1</option>
                            <option>2</option>
                        </select>
                     </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                        <label for="term"> ระดับการศึกษา :</label>
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
                <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                        <label for="term"> ชื่อกลุ่ม :</label>
                        <label style="color: red;">*</label>
                        <select class="form-control select2bs4" style="width: 100%;" id="class_id" name="class_id">
                                        
                        </select>
                        </div>
                </div>
                
            </div>
            <div class="my-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary" id="btn-clear"
                    style="border-color: #ff0909; background-color: white; color: #ff0909; ">Clear</button>
                </div>
              </div>
        </form>
      </div>
  </div>
  <div class="row" id="table-study">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            ตารางเรียน
        </div>
        <!-- /.card-header -->

        <div class="card-body">
          <table id="table-study" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>วัน</th>
                <th>เวลา</th>
                <th>ชื่อวิชา</th>
                <th>อาจารย์</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
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
      $("#table-study").hide();
    function getClass(){
        postData("service/searching.php?type=1",{year:$("#year").val(),term:$('#term').val(),grade:$('#grade').val()}).done(result=>{
            $("#class_id").html(`<option value=""></option>`+result.data.map(item=>{
                return `<option value="${item.class_id}">${item.class_name}</option>`;
            }).join(""));
        });
    }
    getClass();
    $("#year").change(getClass);
    $("#term").change(getClass);
    $("#grade").change(getClass);
    $.validator.setDefaults({
              submitHandler: function () {
                postData("service/searching.php?type=2",{class_id:$("#class_id").val()}).done((result)=>{
                    $("#table-study").show();
                if(result.data.length==0){
                    $("#table-study tbody").html('<tr><td colspan="4>No Data Found</td></tr>')
                }else{
                    $("#table-study tbody").html(
                        result.data.map((item)=>{
                            // return "<tr><td>11</td><td>11</td><td>11</td><td>11</td></tr>";
                            return item.table.map((t,index)=>{
                                return  '<tr>' +  (index==0?'<td rowspan="'+item.count+'">'+item.day+'</td>':"")
                                    +'<td>'+t.start_time+'-'+t.end_time+'</td>'
                                    +'<td>'+t.sub_name+'</td>'
                                    +'<td>'+t.teacher_name+'</td></tr>';
                            }).join("");
                               
                        }).join("")
                    )
                }
                });
               
              }
            });
            $('#quickForm').validate({
              rules: {
                class_id:{
                    required:true
                }
              },
              messages: {
                  class_id:{
                      required:"กรุณาเลือกกลุ่มนักเรียน"
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
            // });
          });
  })
</script>