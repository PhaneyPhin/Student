 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
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
            <h4 class="modal-title">เพิ่มนักเรียน</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="modal-body">
              <form role="form" id="quickForm">
                <div class="card-body">
                  <div class="card-header  mycard-header">
                    <h3 class="card-title">ข้อมูลนักเรียน</h3>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> รหัสนักเรียน</label>
                        <input type="text" id="student_id" name="student_id" class="form-control" id="exampleInputEmail1" placeholder="ระบุรหัสนักเรียน">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อนักเรียน</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="ระบุชื่อนักเรียน">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">สกุลนักเรียน</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="ระบุสกุลนักเรียน">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">เลขประจำตัวประชาชน</label>
                        <input type="text" id="card_id" name="card_id" class="form-control" id="exampleInputPassword1" placeholder="ระบุเลขประจำตัวประจำชาชน">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>วัน/เดือน/ปี เกิด:</label>
      
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="text" id="date_of_birth" name="date_of_birth"  class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>ศาสนา  
                        </label>
                        <select class="form-control" style="width: 100%;" name="religion" id="religion" >
                       
                          <option>ศาสนาพุทธ</option>
                          <option>อิสลาม</option>
                          <option>ศาสนาอิสลาม</option>
                          <option>อื่น ๆ</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>ระดับชั้น 
                        </label>
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
                    <div class="col-sm-6 col-md-3">
                      <label>รูปภาพ 
                      </label>
                      <div class="input-group">
                        <img id="image" width="100%"/>
                        <input type="file" name="image_profile" class="custom-file-input" id="exampleInputFile" style="visibility: hidden;">
                        <label class="upload-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="card-header mycard-header">
                    <h3 class="card-title">ที่อยู่</h3>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                    
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>บ้านเลขที่ :</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="address_no" name="address_no" placeholder="ระบุบ้านเลขที่">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>หมู่ที่ :</label>
                        <div class="input-group">
                          <input type="text" class="form-control"  id="address_part" name="address_part" placeholder="ระบุหมู่ที่">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>จังหวัด </label>
                        <select class="form-control select2bs4" style="width: 100%;" id="province" name="province">
                        
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>อำเภอ  </label>
                        <select class="form-control select2bs4" style="width: 100%;" id="amphur" name="amphur">
                      
                        </select>
                      </div>
                    </div>
                   
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>ตำบล   </label>
                        <select class="form-control select2bs4" style="width: 100%;" name="tambon" id="tambon">
                        
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label>รหัสไปรษณีย์
                        </label>
                        <select class="form-control select2bs4" style="width: 100%;" name="postcode" id="postcode">
                        
                        </select>
                      </div>
                    </div>
                  </div>
                 <div class="my-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-warning">Reset</button>
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
      function getProvince(){
        postData("service/locations/location.php?type=1",{}).done((function(result){
          ;
          $('#province').html();
          $('#province').html(
            `<option value=""></option>`+
           result.map(item=>`<option value="${item.province_en}">${item.province_th}</option>`).join(" ")
          )
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
        $('')
        $('#addStudent').click(function(){
          $('.modal-title').html('เพิ่มข้อมูลนักเรียน');
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
        var table=$('#student-table').DataTable( {
              "ajax": {
                  "url": service.url+"student/student.php?type=1",
                  "dataSrc": "data"
              },
              "columns": [
      
                { "data": "student_id" },
                { "data": "first_name" },
                { "data": "card_id" },
                { "data": "grade" },
                { "data": "student_id"},
                { "data": "student_id"}
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
                },
                {
                  width:'20%',
                  render: function (data,type,row){
                    return  `<button class="btn btn-warning edit-btn" data-id='`+data+`'>แก้ไข</button>` 
                  },
                  targets: 4
                },{
                  width:'20%',
                  render: function (data,type,row){
                    return  `<button class="btn btn-danger delete-btn"  data-id='`+data+`'>ลบ</button>` 
                  },
                  targets: 5
                }
               ],
               drawCallback:function(settings){
                $('.edit-btn').click(function(){
                    var student_id=$(this).data('id');
                    console.log(student_id);
                    $('#modal-default').modal('show')   ;   
                    $('.modal-title').html("แก้ไขข้อมูลนักเรียน");
                    postData("service/student/student.php?type=5",{student_id:student_id}).done(result=>{
                      setStudentValue(result.data[0]);
                      
                    })
                    $('#student_id').prop("disabled", true);
                    
                    
                })
                $('.delete-btn').click(function(){
                      var student_id=$(this).data('id');
                      Swal.fire({
                      title: 'คุณต้องการลบข้อมูลนี้ใช่หรือไหม?',
                      text: "ข้อมูลที่ลบแล้วไม่สารถยอนกลับได้!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ลบ',
                      cancelButtonText:'ยกเลิก'
                    }).then((result) => {
                      if (result.value) {
                        postData('service/student/student.php?type=4',{student_id:student_id}).done((result)=>{
                          if(result.code==1){
                            Swal.fire(
                              'ข้อมูลถูกลยเรียบร้อยแล้ว!',
                              '',
                              'success'
                            )
                            table.ajax.reload();
                            $("#image").attr("src","");
                            img="";
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
     
        getProvince();
         $("#province").change(function(){
            getamphur();
         })
         $("#amphur").change(function(){
           gettambon();
         });
         $('#tambon').change(function(){
           getpostcode();
         })
         $('#date_of_birth').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
            format: 'DD/MM/YYYY'
           },
            maxYear: parseInt(moment().format('YYYY'),10)
          }, function(start, end, label) {
            // var years = moment().diff(start, 'years');
            // alert("You are " + years + " years old!");
          });
          // $('#date_of_birth').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })
          
          $.validator.setDefaults({
              submitHandler: function () {
                var data={
                  student_id:$('#student_id').val(),
                  first_name:$('#first_name').val(),
                  last_name:$('#last_name').val(),
                  card_id:$("#card_id").val(),
                  date_of_birth:moment($("#date_of_birth").val(),"DD/MM/YYYY").format('YYYY-MM-DD'),
                  religion:$('#religion').val(),
                  grade:$('#grade').val(),
                  address_no:$('#address_no').val(),
                  address_part:$('#address_part').val(),
                  admin_id:$('#postcode').val(),
                  img:img
                }
                var type=2;
                if($('#student_id').attr('disabled')){
                  type=3;
                }
                postData('service/student/student.php?type='+type,(data)).done((result)=>{
                 if(result.code==1){
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  table.ajax.reload();
                    $('#modal-default').modal('hide')                
                 }else{
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title:'error',
                      text: result.message
                    })
                 }
                });
              }
            });
            $('#quickForm').validate({
              rules: {
                student_id: {
                  required: true,
                },
                first_name: {
                  required: true
                },
                last_name: {
                  required: true
                },
                card_id:{
                  required:true
                },
                date_of_birth:{
                  required:true
                },
                address_no:{
                  required:true
                },
                address_part:{
                  required:true
                },
                province:{
                  required:true
                },
                amphur:{
                  required:true
                },
                tambon:{
                  required:true
                },
                postcode:{
                  required:true
                }
              },
              messages: {
                student_id: {
                  required: "กรุณาระบุรหัสนักเรียน"
                },
                first_name: {
                  required: "กรุณาระบุชื่อนักเรียน"
                  //minlength: "Your password must be at least 5 characters long"
                },
                last_name: "กรุณาระบุชื่อสกุลนักเรียน",
                card_id: "กรุณาระบุเลขประจำตัวประชาชน",
                date_of_birth: "กรุณาระบุวัน/เดือน/ปี เกิด",
                address_no: "กรุณาระบุบ้านเลขที่",
                address_part: "กรุณาระบุหมู่ที่"
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
        });
        function setStudentValue(val){
          for(var key in val){
            if(key=="image"){
              $("#image").attr("src",val[key]);
            }
           else{
            $('#'+key).val(val[key]);
           }
            
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
              $("#image").attr("src",img);
            };

            reader.readAsDataURL(file);
          };
      </script>