
<style>

    .modal-body{
        height:500px;
        overflow: scroll;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ข้อมูลเพิ่มเติม</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">ข้อมูลเพิ่มเติม</li>
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
                    <h3 class="card-title"> <button type="button" class="btn btn-block btn-primary" data-toggle="modal" id="add-content-btn">เพิ่มข้อมูลเพิ่มเติม</button></h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <table id="subject-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสcontent</th>
                                <th>หัวข้อ</th>
                                <th>ประเภท content</th>
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
                <h4 class="modal-title">เพิ่มcontent</h4>
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
                            <label>หัวข้อ
                            </label>
                            <input type="text" name="topic" class="form-control" id="topic">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>ประเภท
                            </label>
                            <select name="type" id="type" class="form-control">

                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label>url
                            </label>
                            <input type="text" name="url" class="form-control" id="url">
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <label>รายละเอียด
                            </label>
                            <textarea type="text" name="description" class="form-control" id="description"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>รูปภาพ
                            </label>
                            <img id="image" width="100%">
                            <div class="input-group">
                                <input type="file" name="image_profile" class="custom-file-input" id="exampleInputFile" style="visibility: hidden;">
                                <label class="upload-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">

                                        Content Html Editor
                                    </h3>
                                    <!-- tools box -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                            <i class="fas fa-times"></i></button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pad">
                                    <div class="mb-3">
                                        <textarea class="textarea" placeholder="Place some text here" id="data_html" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                    <p class="text-sm mb-0">
                                        Editor <a href="https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg">Documentation and license
                                            information.</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="my-footer">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        <button type="reset" class="btn btn-primary" id="btn-clear" style="border-color: #ff0909; background-color: white; color: #ff0909; ">Clear</button>
                    </div>

                    <!-- /.card-body -->



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
        var img = "";
        var id="";
        var edting=false;
        $(function() {
            postData("service/content.php?type=5").done(function(result) {
                $("#type").html(result.data.map(item => `<option value="${item.id}">${item.name}</option>`).join(""))
            })
            $('#add-content-btn').click(function() {
                edting=false;
                $("#sub_id").val('');
                $('#sub_name').val('');
                $('#credit').val('');
                $('#sub_id').prop("disabled", false);
                $('#modal-default').modal('show');
                $('.modal-title').html("เพิ่มรูป slider");
            });
            var table = $('#subject-table').DataTable({
                "ajax": {
                    "url": service.url + "content.php?type=1",
                    "dataSrc": "data"
                },
                "columns": [

                    {
                        "data": "id"
                    },
                    {
                        "data": "id"
                    },
                    {
                        "data": "topic"
                    },
                    {
                        "data": "type_name"
                    },
                    {
                        "data": "id"
                    },
                    {
                        "data": "id"
                    }
                ],
                "columnDefs": [{
                        width: '10%',
                        targets: 0,
                        "searchable": false,
                        "orderable": false,
                    },
                    {
                        width: '20%',

                        "targets": 1
                    }, {
                        width: '20%',

                        "targets": 2
                    }, {
                        width: '20%',

                        "targets": 3
                    }, {
                        width: '10%',
                        render: function(data, type, row) {
                            return `<button class="btn btn-warning edit-btn"  data-id='` + row['id'] + `' data-content='` + JSON.stringify(row) + `'>แก้ไข</button>`
                        },
                        targets: 4
                    }, {
                        width: '10%',
                        render: function(data, type, row) {
                            return `<button class="btn btn-danger delete-btn"  data-id='` + row['id'] + `'>ลบ</button>`
                        },
                        targets: 5
                    }
                ],
                drawCallback: function(settings) {

                    $('.delete-btn').click(function() {
                        var id = $(this).data('id');
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
                                postData('service/content.php?type=4', {
                                    id: id
                                }).done((result) => {
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
                    $(".edit-btn").click(function(){
                        edting=true;
                        id=$(this).data("id");
                        row=$(this).data('content');
                        console.log(row);
                        $("#modal-default").modal("show");
                        $("#topic").val(row.topic);
                        $("#description").val(row.description);
                        $("#url").val(row.url);
                        $("#type").val(row.type);
                        $("#image").attr("src",row.image);
                        img=row.image;
                        $(".note-editable.card-block").html(row.data_html);
                        $("#image").show();
                    });
                }
            });
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            $("#image").hide();
            $("#submit").click(function() {
                    if(edting){
                        type=3
                    }else{
                        type=2;
                    }
                    postData("service/content.php?type="+type, {
                        id:id,
                        topic: $("#topic").val(),
                        image: img,
                        description: $("#description").val(),
                        url: $("#url").val(),
                        data_html: $('#data_html').summernote('code'),
                        type: $("#type").val()
                    }).done(function(result) {

                        if (result.code == 1) {
                            Swal.fire(
                                'ข้อมูลถูกบันทึกเรียบร้อยแล้ว!',
                                '',
                                'success'
                            )
                            table.ajax.reload();
                            $('#modal-default').modal('hide');
                            $("#topic").val("");
                            $("#description").val("");
                            $("#url").val("");
                            $("#type").val("");
                            $("#image").attr("src","");
                            img="";
                            $(".note-editable.card-block").html("");
                        } else {
                            Swal.fire(
                                'ไม่สามารถบันทึกข้อมูลได้!',
                                '',
                                result.message
                            )
                        }
                    })
                
            })
            var input = document.querySelector('input[type=file]');

            // You will receive the Base64 value every time a user selects a file from his device
            // As an example I selected a one-pixel red dot GIF file from my computer
            input.onchange = function() {
                var file = input.files[0],
                    reader = new FileReader();

                reader.onloadend = function() {
                    // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
                    var b64 = reader.result;
                    console.log(b64); //-> "R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs="
                    img = b64;
                    console.log(img);
                    $("#image").show();
                    $('#image').attr('src', reader.result);
                };

                reader.readAsDataURL(file);
            };

            $(function() {
                // Summernote
                $('.textarea').summernote()
            })
        })
    </script>