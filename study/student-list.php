<?php
    include('../service/connections/connect.php');
    $class_id=$_GET['class_id'];
    $sql="select * from class where class_id='$class_id'";
    $class=getOfDB($sql);
    if(count($class)>0){
      $class=$class[0];
    }
    // var_dump($class);
?>

 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Student (กลุ่ม <?=$class['class_name']?> ปีการศึกษา <?=$class['year']?> ภาคการศึกษาที่ <?=$class['term']?>)</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Class</a></li>
            <li class="breadcrumb-item active">Student</li>
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
            <h3 class="card-title">    <button type="button" class="btn btn-block btn-primary"  id="addStudent">เพิ่มนักเรียน</button></h3>
          </div>
          <!-- /.card-header -->
         
          <div class="card-body">
            <table id="student-table" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>รหัสนักเรียน</th>
                <th>ชื่อ-สกุล</th>
                <th>เลขประจำตัวประชาชน</th>
                <th>ระดับชั้น </th>
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
            <h4 class="modal-title">เพิ่มนักเรียน </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="modal-body">
              <div class="row">
                   <div class="col-12">
                      <div class="form-group" id="student-form">
                        <label>รหัสนักศึกษา </label>
                        
                        <select  multiple="multiple" class="form-control duallistbox" style="width: 100%;" id="student_id" name="student_id">
                        
                        </select>
                      </div>
                    </div>
            
                <!-- /.form-group -->
              </div>
              <div class="my-footer">
              <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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

      .modal-dialog{
        max-width: 1000px;
      }
      .mycard-header{
        padding: 0;
        padding-bottom: 10px
      }
      .upload-label {
          position: absolute;
          top: 0;
          right: 0;
          left: 0;
          z-index: 1;
          height: calc(2.25rem + 2px);
          padding: 0.375rem 0.75rem;
          font-weight: 400;
          line-height: 1.5;
          color: #495057;
          background-color: #ffffff;
          border: 1px solid #ced4da;
          border-radius: 0.25rem;
          box-shadow: none;
        }
    </style>
    <script>
      var img="";
      var table;
      var student_demo=null;
      function getStudent(){
        $('#student-form').html(`
                    <label>รหัสนักศึกษา </label>
                        
                        <select  multiple="multiple" class="form-control duallistbox" style="width: 100%;" id="student_id" name="student_id">
                        
                        </select>
        `);
        postData("service/student-list.php?type=7",{year:"<?=$class['year']?>",term:"<?=$class['term']?>"}).done((function(result){
          ;
          console.log(result)
          if(result.success){
            $('#student_id').html();
            $('#student_id').html(
            result.data.map(item=>`<option value="${item.student_id}">${item.student_id}</option>`).join(" ")
            )
            postData("service/student-list.php?type=8",{class_id:"<?=$class['class_id']?>"}).done(function(inClassStudent){
              if(inClassStudent.success){
                $('#student_id').append(inClassStudent.data.map(item=>`<option selected>${item.student_id}</option>`).join(" "));
                $('.duallistbox').bootstrapDualListbox();
              }else{
                Swal.fire('',inClassStudent.message,'error');
              }
            });
          
          }else{
            Swal.fire('',result.message,'error');
          }
        }));
      }
      function getamphur(){
        var province=$("#province").val();
        postData("service/locations/location.php?type=2&province="+province,{}).done((function(result){
          ;
          $('#amphur').html();
          $('#amphur').html(
            `<option value=""></option>`+
           result.map(item=>`<option value="${item.amphur_en}">${item.amphur_th}</option>`).join(" ")
          )
        }));
      }
      function gettambon(){
        var province=$("#province").val();
        var amphur=$('#amphur').val();
        postData("/service/locations/location.php?type=3&province="+province+"&amphur="+amphur,{}).done((function(result){
          ;
          $('#tambon').html();
          $('#tambon').html(
            `<option value=""></option>`+
           result.map(item=>`<option value="${item.tambon_en}">${item.tambon_th}</option>`).join(" ")
          )
        }));
      }
      function getpostcode(){
        var province=$("#province").val();
        var amphur=$('#amphur').val();
        var tambon=$('#tambon').val();
        postData("/service/locations/location.php?type=4&province="+province+"&amphur="+amphur+"&tambon="+tambon,{}).done((function(result){
          ;
          $('#postcode').html();
          $('#postcode').html(
            `<option value=""></option>`+
           result.map(item=>`<option value="${item.admin_id}">${item.postcode}</option>`).join(" ")
          )
        }));
      }
      $(function () {
        // getStudent();
       
        $('#addStudent').click(function(){
          $('.modal-title').html('เพิ่มข้อมูลนักเรียน');
          getStudent();
          $('#modal-default').modal('show');
            $('#student_id').prop("disabled", false);
            setStudentValue({
              student_id: "",
            first_name: "",
            last_name: "",
            card_id: "",
            date_of_birth: "",
            address_no: "",
            address_part: "",
            admin_id: "",
            grade: "",
            image: "",
            religion: "",
            postcode: "",
            province: "",
            amphur: "",
            tambon: ""
            })
        })
        table=$('#student-table').DataTable( {
              "ajax": {
                  "url": service.url+"student-list.php?type=1&class_id=<?=$class['class_id']?>",
                  "dataSrc": "data"
              },
              "columns": [
      
                { "data": "student_id" },
                { "data": "first_name" },
                { "data": "card_id" },
                { "data": "grade" }
           
                          ],
              "columnDefs": [
                {
                  width:'20%',
                  targets:0
                },
                {
                    width:'20%',
                    "render": function ( data, type, row ) {
                        return  row['first_name']+' '+row['last_name'];
                    },
                    "targets": 1
                },
                {
                  width:'20%',
                  targets:2
                },
                {
                  width:'20%',
                  targets:3
                },{
                  width:'20%',
                  render: function (data,type,row){
                    return  `<button class="btn btn-danger delete-btn"  data-student_id='`+row['student_id']+`' data-class_id='`+row['class_id']+`'>ลบ</button>` 
                  },
                  targets: 4
                }
               ],
               drawCallback:function(settings){
                
                $('.delete-btn').click(function(){
                      var student_id=$(this).data('student_id');
                      var class_id=$(this).data('class_id');
                      Swal.fire({
                      title: 'คุณต้องการลบข้อมูลนี้ออจากจากกลุ่มใช่หรือไหม?',
                      text: "ข้อมูลที่ลบแล้วไม่สารถยอนกลับได้!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ลบ',
                      cancelButtonText:'ยกเลิก'
                    }).then((result) => {
                      if (result.value) {
                        postData('service/student-list.php?type=4',{student_id:student_id,class_id:class_id}).done((result)=>{
                          if(result.code==1){
                            Swal.fire(
                              'ข้อมูลถูกลยเรียบร้อยแล้ว!',
                              '',
                              'success'
                            )
                            table.ajax.reload();
                          }else{
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
     
         
        });
        $("#submit").click(function(){
          var student_id=$("#student_id").val();
          var class_id="<?=$class['class_id']?>";
          postData("service/student-list.php?type=2",{student_id:JSON.stringify(student_id),class_id:class_id}).done(function(result){
            if(result.success){
              Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  table.ajax.reload();
                  $('#modal-default').modal('hide');  
             
            }else{
              Swal.fire('',result.message,'error');
            }
          });
        });
        function setStudentValue(val){
          for(var key in val){
            $('#'+key).val(val[key]);
            
          }
          setTimeout(()=>{
            $('#province').val(val.province).change();
          },300)
          setTimeout(()=>{
            $('#amphur').val(val.amphur).change();
          },600)
          setTimeout(()=>{
            $('#tambon').val(val.tambon).change();
          },900)
          setTimeout(()=>{
            $('#postcode').val(val.postcode).change();
          },1200)
          if(val.province!=""){
            getamphur();
          }
        }
       
        // var input = document.querySelector('input[type=file]');

        //   // You will receive the Base64 value every time a user selects a file from his device
        //   // As an example I selected a one-pixel red dot GIF file from my computer
        //   input.onchange = function () {
        //     var file = input.files[0],
        //       reader = new FileReader();

        //     reader.onloadend = function () {
        //       // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
        //       var b64 = reader.result.replace(/^data:.+;base64,/, '');
        //       console.log(b64); //-> "R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs="
        //       img=b64;
        //     };

        //     reader.readAsDataURL(file);
        //   };
      </script>