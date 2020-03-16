
<!-- Content Header (Page header) -->
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>แก้ไขข้อมูลส่วนตัว</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">แก้ไขข้อมูลส่วนตัว</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">

        <div class="card">
        <div class="card-header">
            <h4 class="modal-title">แก้ไขข้อมูลสวนตัว</h4>
           

        </div>
        <div class="card-body">
                    <?php
                session_start();
                include('./service/connections/connect.php');
                if( $_SESSION['isLogginedIn']){
                    $sql="select * from users where username='".$_SESSION['username']."'";
                    $data=getOfDB($sql);
                    $data=$data[0];
            ?>

            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="quickForm">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1"> username :</label>
                    <label style="color: red;">*</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?=$data['username']?>"
                        placeholder="ระบุ username" disabled>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                    <label for="exampleInputEmail1">ชื่อ :</label>
                    <label style="color: red;">*</label>
                    <input type="text" id="first_name" name="first_name" class="form-control"   value="<?=$data['first_name']?>"
                        placeholder="ระบุชื่อ">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                    <label for="exampleInputEmail1">สกุล :</label>
                    <label style="color: red;">*</label>
                    <input type="text" id="last_name" name="last_name" class="form-control"  value="<?=$data['last_name']?>"
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
            <script>
            $(function () {
            
                $('#update_password').change(function(){
                    if($('#update_password')[0].checked){
                        $('#password_container').show();
                    }else{
                        $('#password_container').hide();
                    }
                })
                $('#password_container').hide();
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
                        $("#modal-update").modal('hide')
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
                    username: {
                    required: true
                    },
                    first_name: {
                    required: true
                    },
                    last_name: {
                    required: true
                    },
                },
                messages: {
                    username: {
                    required: "กรุณาระบุ username"
                    },
                    first_name: {
                    required: "กรุณาระบุชื่อ"
                    },
                    last_name: {
                    required: "กรุณาระบุสกุล"
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

            <?php
                }else{
                    ?>
                    <div class="modal fade" id="modal-update">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">แก้ไขรหัสผ่าน</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <form role="form" id="update-form">
                                    <div class="row" style="margin-top: 20px;">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="update_teacher_id"> รหัสอาจารย์</label>
                                                <input type="text" id="update_teacher_id" name="update_teacher_id" class="form-control"placeholder="ระบุรหัสอาจารย์" disabled>
                                            </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="password"> รหัสผ่าน</label>
                                                <input type="password" id="password" name="password" class="form-control"  placeholder="ระบุรหัสอาจารย์">
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
                        </div>
                    </div>
                    <form role="form" id="quickForm">
                <div class="card-body">
                  <div class="card-header  mycard-header">
                    <h3 class="card-title">ข้อมูลอาจารย์</h3>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> รหัสอาจารย์</label>
                        <input type="text" id="teacher_id" name="teacher_id" class="form-control" id="exampleInputEmail1" placeholder="ระบุรหัสอาจารย์" disabled>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ชื่ออาจารย์</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="ระบุชื่ออาจารย์">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">สกุล</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="ระบุสกุลอาจารย์">
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
                          <label>โครงสร้าง  
                          </label>
                          <select class="form-control" style="width: 100%;" name="structure" id="structure" >
                         
                            <option>ผู้จัดการ</option>
                            <option>ผู้อำนวยการ</option>
                            <option>รองผู้อำนวยการ</option>
                            <option>ฝ่ายวิชาการ</option>
                            <option>ฝ่ายงบประมาณ</option>
                            <option>ฝ่ายบริหารงานทั่วไป</option>
                            <option>ฝ่ายบุคคล</option>
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
                  <div class="row">
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="forgrade">
                            <label class="form-check-label">ครูประจำชั้น</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3" id="grade-panel">
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
                  </div>
                  <div class="card-header mycard-header" style="margin-top: 20px;">
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
                  <button type="button" class="btn btn-primary update-btn">แก้ไขรหัสผ่าน</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-warning">Reset</button>
                 </div>
              </form>
              <script>
      var img="";
      var update_password=false;
     
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
        $(".update-btn").click(function(){
                  update_password=true;
                  $("#modal-update").modal("show");
                  $("#update_teacher_id").val("<?=$_SESSION['username']?>");
        })
        $('#grade-panel').hide();
        $('#addStudent').click(function(){
          $('.modal-title').html('เพิ่มข้อมูลอาจารย์');
          $('#modal-default').modal('show');
            $('#teacher_id').prop("disabled", false);
            update_password=false;
            setTeacherValue({
              teacher_id: "",
            first_name: "",
            last_name: "",
            card_id: "",
            date_of_birth: "",
            address_no: "",
            address_part: "",
            admin_id: "",
            grade: "0",
            image: "",
            religion: "",
            postcode: "",
            province: "",
            amphur: "",
            tambon: "",
            structure:""
            })
        })
        postData("service/teacher.php?type=5",{teacher_id:"<?=$_SESSION['username']?>"}).done(result=>{
                      setTeacherValue(result.data[0]);
                    })
         $('#teacher_id').prop("disabled", true);
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
            
                if(update_password){
                  var data={
                    teacher_id:$("#update_teacher_id").val(),
                    password:$("#password").val()
                  };
                  postData('service/teacher.php?type=6',data).done(function(result){
                    if(result.code==1){
                          Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
                            showConfirmButton: false,
                            timer: 1500
                          })
                          table.ajax.reload();
                          
                          $('#modal-update').modal('hide')  
                        }else{
                          Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title:'error',
                            text: result.message
                          })
                        }
                      })
                }else{
                  var data={
                  teacher_id:$('#teacher_id').val(),
                  first_name:$('#first_name').val(),
                  last_name:$('#last_name').val(),
                  card_id:$("#card_id").val(),
                  date_of_birth:moment($("#date_of_birth").val(),"DD/MM/YYYY").format('YYYY-MM-DD'),
                  religion:$('#religion').val(),
                  grade:$('#grade').val(),
                  address_no:$('#address_no').val(),
                  address_part:$('#address_part').val(),
                  admin_id:$('#postcode').val(),
                  structure:$('#structure').val(),
                  img:img
                }
                var type=2;
                if($('#teacher_id').attr('disabled')){
                  type=3;
                }
                postData('service/teacher.php?type='+type,(data)).done((result)=>{
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
              }
            });
            $('#update-form').validate({
              rules: {
                update_teacher_id: {
                  required: true,
                },
                password: {
                  required: true,
                  minlength: 6,
                }
              },
              messages: {
                update_teacher_id: {
                  required: "กรุณาระบุรหัสอาจารย์"
                },
                password: {
                  required: "กรุณาระบุรหัสผ่าน",
               
                  minlength: "รหัสผ่านอย่างน้อย 6 หลัก"
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
            });
            $('#quickForm').validate({
              rules: {
                teacher_id: {
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
                teacher_id: {
                  required: "กรุณาระบุรหัสอาจารย์"
                },
                first_name: {
                  required: "กรุณาระบุชื่ออาจารย์"
                  //minlength: "Your password must be at least 5 characters long"
                },
                last_name: "กรุณาระบุชื่อสกุลอาจารย์",
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
          $('#forgrade').change(function(){
              $('grade').val('');
              if($('#forgrade')[0].checked){
                  $('#grade-panel').show();

              }else{
                $('#grade-panel').hide();
              }
          })
        });
        function setTeacherValue(val){
            val.password="";

          if(val.for_grade!='0'){
            forgrade.checked=true;
            $("#grade").show();
          }
          for(var key in val){
           if(val!='password'){
                $('#'+key).val(val[key]);
            if(key=="image"){
              $("#image").attr("src",val[key]);
            }
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
              $("#image").attr("src",b64);
              img=b64;
            };

            reader.readAsDataURL(file);
          };
      </script>
                    <?php
                }
            ?>
        </div>
        </div>
</section>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
   
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
