$_DOMAIN = 'http://localhost/shareanime/admin/';
$('#formSignin button').on('click', function() {
    $this = $('#formSignin button');
    $this.html('Đang tải ...');
    $user_signin = $('#formSignin #user_signin').val();
    $pass_signin = $('#formSignin #pass_signin').val();
    if ($user_signin == '' || $pass_signin == '')
    {
        $('#formSignin .alert').removeClass('hidden');
        $('#formSignin .alert').html('Vui lòng điền đầy đủ thông tin.');
        $this.html('Đăng nhập');
    }
    else
    {
        $.ajax({
            url : $_DOMAIN + 'signin.php',
            type : 'POST',
            data : {
                user_signin : $user_signin,
                pass_signin : $pass_signin
            }, success : function(data) {
                $('#formSignin .alert').removeClass('hidden');
                $('#formSignin .alert').html(data);
                $this.html('Đăng nhập');
            }, error : function() {
                $('#formSignin .alert').removeClass('hidden');
                $('#formSignin .alert').html('Không thể đăng nhập vào lúc này, hãy thử lại sau.');
                $this.html('Đăng nhập');
            }
        });
    }
}); 
function ChangetoSlug() {
    var title,slug;
    title= $('.title').val();
    slug = title.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    $('.slug').val(slug);
}
function GetSlug(title) {
    var slug;
    slug = title.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}
function GetNameLN(title) {
    var slug;
    slug = title.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "_");
    slug = slug.replace(/\-\-\-\-\-/gi, '_');
    slug = slug.replace(/\-\-\-\-/gi, '_');
    slug = slug.replace(/\-\-\-/gi, '_');
    slug = slug.replace(/\-\-/gi, '_');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}
    $('.slug').on('click', function(event) {
    ChangetoSlug();
    title= $('.title').val();
});
$('#formaddcate input[type=radio]').on('click', function(event) {
    if ($('#formaddcate .type_cate_1:checked').prop('checked') == true) {
       $('.parent_add_cate').addClass('hidden');
       $('.parent_add_cate select').html('');
    }else if ($('#formaddcate .type_cate_2:checked').prop('checked')==true) {
        $type_cate_2 = $('#formaddcate .type_cate_2').val();
        $.ajax({
            url: $_DOMAIN+'categories.php',
            type: 'POST',
            data: {
                action: 'load_add_cate',
                type_cate : $type_cate_2
            },
            success : function (data) {
                $('.parent_add_cate').removeClass('hidden');
                $('.parent_add_cate select').html(data);
            },
            error : function () {
                $('.parent_add_cate').removeClass('hidden');
                $('.parent_add_cate select').html("Đã có lỗi xảy ra, vui lòng thử lại sau.");
            }
        });
    }else if ($('#formaddcate .type_cate_3:checked').prop('checked')==true) {
        $type_cate_3 = $('#formaddcate .type_cate_3').val();
        $.ajax({
            url: $_DOMAIN+'categories.php',
            type: 'POST',
            data: {
                action: 'load_add_cate',
                type_cate: $type_cate_3
            },
            success : function (data) {
                $('.parent_add_cate').removeClass('hidden');
                $('.parent_add_cate select').html(data);
            },
            error : function () {
                $('.parent_add_cate').removeClass('hidden');
                $('.parent_add_cate select').html("Đã có lỗi xảy ra, vui lòng thử lại sau.");
            }
        });
    }
});
$('#formeditcate input[type=radio]').on('click', function(event) {
    if ($('#formeditcate .type_cate_1:checked').prop('checked') == true) {
       $('.parent_edit_cate').addClass('hidden');
       $('.parent_edit_cate select').html('');
    }else if ($('#formeditcate .type_cate_2:checked').prop('checked')==true) {
        $type_cate_2 = $('#formeditcate .type_cate_2').val();
        $.ajax({
            url: $_DOMAIN+'categories.php',
            type: 'POST',
            data: {
                action: 'load_edit_cate',
                type_cate : $type_cate_2
            },
            success : function (data) {
                $('.parent_edit_cate').removeClass('hidden');
                $('.parent_edit_cate select').html(data);
            },
            error : function () {
                $('.parent_edit_cate').removeClass('hidden');
                $('.parent_edit_cate select').html("Đã có lỗi xảy ra, vui lòng thử lại sau.");
            }
        });
    }else if ($('#formeditcate .type_cate_3:checked').prop('checked')==true) {
        $type_cate_3 = $('#formeditcate .type_cate_3').val();
        $.ajax({
            url: $_DOMAIN+'categories.php',
            type: 'POST',
            data: {
                action: 'load_edit_cate',
                type_cate: $type_cate_3
            },
            success : function (data) {
                $('.parent_edit_cate').removeClass('hidden');
                $('.parent_edit_cate select').html(data);
            },
            error : function () {
                $('.parent_edit_cate').removeClass('hidden');
                $('.parent_edit_cate select').html("Đã có lỗi xảy ra, vui lòng thử lại sau.");
            }
        });
    }
});
    $('#formeditcate button').on('click', function(event) {
        $(this).html("Đang tải...");
        $lable =$('#title').val();
        $url =$('#slug').val();
        $type =$('#formeditcate input[name="edit_type_cate"]:radio:checked').val();
        $parent =$('#formeditcate #parent_edit_cate').val();
        $sort =$('#formeditcate #sort_edit_type').val();
        $id_edit = $('#formeditcate').attr('data-id');
        $.ajax({
            url: $_DOMAIN+'/categories.php',
            type: 'POST',
            data: {
                action :'edit_type',
                lable: $lable,
                url : $url,
                type : $type,
                parent :$parent,
                sort : $sort,
                id_edit :$id_edit
            },
            success: function (data) {
               $('#formeditcate .alert').removeClass('hidden');
                $('#formeditcate .alert').html(data); 
                $(this).html('Tạo');
            },
            error : function () {
                $('#formeditcate .alert').removeClass('hidden');
                $('#formeditcate .alert').html('Không thể tạo chuyên mục vào lúc này, hãy thử lại sau.'); 
            }
        });
    });
    $('#formaddcate button').on('click', function(event) {
        $(this).html("Đang tải...");
        $lable =$('#title').val();
        $url =$('#slug').val();
        $type =$('#formaddcate input[name="add_type_cate"]:radio:checked').val();
        $parent =$('#formaddcate #parent_add_cate').val();
        $sort =$('#formaddcate #sort_add_type').val();
        if ($lable=='' || $url=='' || $parent=='' || $sort=='' ) {
           $('#formaddcate .alert').removeClass('hidden');
           $('#formaddcate .alert').html('Vui lòng điền đầy đủ thông tin.');
           $(this).html('Tạo');
        }else {
            $.ajax({
                url: $_DOMAIN+'categories.php',
                type: 'POST',
                data: {
                    action: 'add_type',
                    lable: $lable,
                    url : $url,
                    type : $type,
                    parent : $parent,
                    sort : $sort
                },
                success: function (data) {
                    $('#formaddcate .alert').removeClass('hidden');
                    $('#formaddcate .alert').html(data);
                    $(this).html('Tạo');
                },
                error: function() {
                    $('#formaddcate .alert').removeClass('hidden');
                    $('#formaddcate .alert').html('Không thể tạo chuyên mục vào lúc này, hãy thử lại sau.');
                }
            })   
        }
    });
    $('.list input[type="checkbox"]:eq(0)').change(function(event) {
        $('.list input[type="checkbox"]').prop('checked',$(this).prop('checked'));
    });
    $('#del_cate_list').on('click', function(event) {
        $check= confirm("Bạn có chắc muốn xóa không, điều này không thể hoàn tác ?");
        if ($check) {
            $id_cate=[];
            $('.list input[type="checkbox"]:checkbox:checked').each(function(i) {
                $id_cate[i]= $(this).val();
            });
            if ($id_cate.length==0) {
                alert("Vui lòng chọn dòng cần xóa!");                
            }else {
                $.ajax({
                    url: $_DOMAIN+'categories.php',
                    type: 'POST',
                    data: {
                        action:'delete_type_list',
                        id_cate : $id_cate
                    },
                    success:function (data) {
                        location.reload();
                    },
                    error:function () {
                        alert("Có lỗi xảy ra, vui lòng thử lại");
                    }
                })
            }
        }else {
            $('.list input[type="checkbox"]').prop('checked', '');
            return false;
        }
    });
    $('#del_cate').on('click', function(event) {
        $confirm =confirm("Bạn có chắc muốn xóa chuyên mục này ?");
        if ($confirm) {
            $id= $(this).attr('data-id');
            $.ajax({
                url: $_DOMAIN+'categories.php',
                type: 'POST',
                data: {id_del: $id,
                action: 'del-this'
                },
                success : function(data) {
                    location.href = $_DOMAIN + 'categories/';
                }
            })
        }else{
            return false;
        }
    });
    function imgpre() {
       img = $('#img_up').val();
       count = $('#img_up').get(0).files.length;
       $('#formUPimg .box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
        $('#formUPimg .box-pre-img').removeClass('hidden');
        if (img!='') {
        $('#formUPimg .box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
        $('#formUPimg .box-pre-img').removeClass('hidden');
        for (var i = 0; i <count; i++) {
            $('#formUPimg .box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[i]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;"/>');
        }
        }else {
         $('#formUPimg .box-pre-img').html('');
        $('#formUPimg .box-pre-img').addClass('hidden');
        }
    }
    $('#formUPimg button[type=reset]').on('click', function(event) {
       $('#formUPimg .box-pre-img').html('');
        $('#formUPimg .box-pre-img').addClass('hidden');
    });
    $('#formUPimg').submit(function(event) {
    img = $('#img_up').val();
    count = $('#img_up').get(0).files.length;
    error_size = 0;
    error_type= 0;
    $('#formUPimg button[type=submit]').html('Đang tải ...');
    if (img) {
        for (var i = 0; i < count; i++) {
            size_img = $('#img_up')[0].files[i].size;
           if (size_img>5242880) {
            error_size +=1;
           }else {
            error_size +=0; 
           }

        }
        for (var i = 0; i < count; i++) {
           type_img= $('#img_up')[0].files[i].type;
           if (type_img == 'image/jpeg' || type_img == 'image/png' || type_img == 'image/gif') {
               error_type+=0;
           }else {
               error_type+=1;
           }
        }
        if (error_size >=1) {
            $('#formUPimg button[type=submit]').html('Upload');
            $('#formUPimg .alert').removeClass('hidden');
            $('#formUPimg .alert').html('Một trong các tệp đã chọn có dung lượng lớn hơn mức cho phép.');
        }
        else if(count>20) {
            $('#formUPimg button[type=submit]').html('Upload');
            $('#formUPimg .alert').removeClass('hidden');
            $('#formUPimg .alert').html('Quá 20 tệp tin cho phép');
        }else if (error_type>=1) {
            $('#formUPimg button[type=submit]').html('Upload');
            $('#formUPimg .alert').removeClass('hidden');
            $('#formUPimg .alert').html('Định dạng một trong các tệp sai');
        }else {
            $(this).ajaxSubmit({
                beforeSubmit:function () {
                    target:   '#formUPimg .alert', 
                    $('#formUPimg .box-progress-bar').removeClass('hidden');
                    $('#formUPimg .box-progress-bar').width('0%');
                },
                uploadProgress:function (event, position, total, percentComplete) {
                    $('#formUPimg .progress-bar').animate({width:percentComplete + '%' });
                    $("#formUPimg .progress-bar").html(percentComplete + '%');
                },
                success:function (data) {
                    $('#formUPimg button[type=submit]').html('Upload');
                    $('#formUPimg .alert').attr('class', 'alert alert-success'); 
                    $('#formUPimg .alert').html(data);
                },
                error:function () {
                    $('#formUPimg button[type=submit]').html('Upload');
                    $('#formUPimg .alert').attr('class', 'alert alert-danger');
                    $('#formUPimg .alert').removeClass('hidden');  
                    $('#formUPimg .alert').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
                },
                resetFrom:true
            })
        }
        return false;
    }
    else {
        $('#formUPimg button[type=submit]').html('Upload');
        $('#formUPimg .alert').removeClass('hidden');
        $('#formUPimg .alert').html('Vui lòng chọn tệp hình ảnh.');
    }
    });
    $('#del_img_list').on('click',  function(event) {
        $confirm = confirm("Bạn có chắc muốn xóa những ảnh này không?");
        if ($confirm==true) {
            $id_img=[];
            $('#list_pic input[type="checkbox"]:checkbox:checked').each(function(i) {
                $id_img[i]=$(this).val();
            });
            if ($id_img.length==0) {

                alert("Vui lòng chọn ảnh cần xóa!");
            }else{
                $.ajax({
                    url: $_DOMAIN+'picture.php',
                    type: 'POST',
                    data: {
                        action :'del-list-img',
                        id_img: $id_img
                },
                success:function (data) {
                    location.reload();
                },
                error:function () {
                    alert('Đã có lỗi xảy ra, hãy thử lại.');
                }
                })
                
            }
        }else{
            return false;
        }
    });
    $('.del-img').on('click', function(event) {
        $confirm = confirm('Bạn có chắc chắn muốn xoá ảnh này không?');
        if ($confirm==true) {
            $id =$(this).attr('data_id');
            $.ajax({
                    url: $_DOMAIN+'picture.php',
                    type: 'POST',
                    data: {
                        action :'del-img',
                        id: $id
                },
                success:function (data) {
                    location.reload();
                },
                error:function () {
                    alert('Đã có lỗi xảy ra, hãy thử lại.');
                }
                })
        }else {
            return false;
        }
    });
    $('#formaddpost button').on('click',  function(event) {
        $title_post= $('#formaddpost #title_post').val();
        $slug_post =$('#formaddpost #url_post').val();
        if ($title_post=='' || $slug_post=='') {
            $('#formaddpost .alert').removeClass('hidden');
            $('#formaddpost .alert').html('Vui lòng điền đầy đủ thông tin');
        }else {
            $.ajax({
                url: $_DOMAIN+'post.php',
                type: 'POST',
                data: {
                    title: $title_post,
                    slug :$slug_post,
                    action:'add_post'
                 },
                 success:function (data) {
                     $('#formaddpost .alert').removeClass('hidden');
                     $('#formaddpost .alert').html(data);
                 },
                 error:function () {
                    $('#formaddpost .alert').removeClass('hidden');
                    $('#formaddpost .alert').html('Có lỗi xảy ra, vui lòng thử lại');
                 }
            })            
        }
    });
    $('#formsearchpost #btn-search').on('click', function(event) {
        $search = $('#text_search').val();
        if ($search!='') {
            $.ajax({
                url: $_DOMAIN+'post1.php',
                type: 'POST',
                data: {
                    search: $search,
                    action: 'search'
                },
                success:function (data) {
                    $('#list_post').html(data);
                    $('#bnt-page').hide();
                },
                error:function () {
                 }
            })
        }
    });
    $('#formsearchpost #text_search').on('keyup', function(event) {
        $search = $(this).val();
            $.ajax({
                url: $_DOMAIN+'post1.php',
                type: 'POST',
                data: {
                    search: $search,
                    action: 'search'
                },
                success:function (data) {
                    $('#list_post').html(data);
                    $('#bnt-page').hide();
                },
                error:function () {
                 }
            })
    });
    $('#cate_edit-1').on('change', function(event) {
        $parent_id= $(this).val();
        $.ajax({
            url: $_DOMAIN+'post2.php',
            type: 'POST',
            data: {
                parent_id: $parent_id,
                action: 'load_cate_2'
            },
            success:function (data) {
                $('#cate_edit-2').html(data);
                $parent_id=$('#cate_edit-2').val();
                $.ajax({
                    url: $_DOMAIN+'post2.php',
                    type: 'POST',
                    data: {
                        parent_id: $parent_id,
                        action: 'load_cate_3'
                        
                    },
                    success:function (data) {
                        $('#cate_edit-3').html(data);
                    }
                })
            },
            error:function () {
               alert("errro");
            }
        })
    });
    $('#cate_edit_2').on('change', function() {
    $parent_id = $(this).val();
 
    $.ajax({
        url : $_DOMAIN + 'post2.php',
        type : 'POST',
        data : {
            parent_id : $parent_id,
            action : 'load_cate_3'
        }, success : function(data) {
            $('#cate_edit_3').html(data);
        }
    });
});
    $('#formeditpost button').on('click', function(event) {
        $id_edit_post= $('#formeditpost').attr('data-id');
        $status_edit = $('#formeditpost input[name="stt_edit_post"]:radio:checked').val();
        $title_edit=$('#title_edit').val();
        $slug_edit= $('#slug_edit').val();
        $url_edit = $('#url_edit').val();
        $dercs_edit = $('#desc_edit').val();
        $kw_edit = $('#kw_edit').val();
        $cate_1_edit = $('#cate_edit-1').val();
        $cate_2_edit = $('#cate_edit-2').val();
        $cate_3_edit = $('#cate_edit-3').val();
        $body_edit = CKEDITOR.instances['body_edit_post'].getData();
        if ($id_edit_post=='' || $status_edit=='' || $title_edit=='' || $slug_edit=='' || $url_edit=='' || $dercs_edit=='' || $kw_edit=='' || $body_edit=='') {
           $('#formeditpost .alert').removeClass('hidden');
           $('#formeditpost .alert').html('vui lòng điền đủ thông tin!');
        }else {
            $.ajax({
                url: $_DOMAIN+'post3.php',
                type: 'POST',
                data: {
                    id_edit_post :$id_edit_post,
                    status_edit:$status_edit,
                    title_edit:$title_edit,
                    slug_edit:$slug_edit,
                    url_edit:$url_edit,
                    dercs_edit :$dercs_edit,
                    kw_edit :$kw_edit,
                    cate_1_edit : $cate_1_edit,
                    cate_2_edit :$cate_2_edit ,
                    cate_3_edit :$cate_3_edit,
                    body_edit :$body_edit,
                    action:'edit_post'
                },
                success:function (data) {
                    $('#formeditpost .alert').html(data);
                },
                error:function () {
                    $('#formeditpost .alert').removeClass('hidden');
                    $('#formeditpost .alert').html('Có lỗi xảy ra, vui lòng thử lại!');
                }
            })
            
        }
    });
    $('#del_post_list').on('click', function(event) {
        $confirm=confirm("Bạn có chắc muốn xóa những bài viết này không?");
        if ($confirm) {
           $id_post=[];
           $('#list_post input[type="checkbox"]:checkbox:checked').each(function(i) {
               $id_post[i] = $(this).val();
               if ($id_post.length==0) {
                   alert("Vui lòng chọn bài cần xóa!");
               }else {
                   $.ajax({
                       url: $_DOMAIN+'post3.php',
                       type: 'POST',
                       data: {
                        id_post: $id_post,
                        action: 'del_list_post'
                    },
                    success:function (data) {
                        location.reload();
                    }
                   })  
               }
           });
        }
    });
    $('#del_post').on('click', function(event) {
        $confirm = confirm("Bạn có chắc muốn xóa bài viết này không?");
        if ($confirm) {
            $id_edit=$(this).attr('data-id');
            $.ajax({
                url: $_DOMAIN+'post3.php',
                type: 'POST',
                data: {
                    id_edit: $id_edit,
                    action: 'del_post'
                },
                success:function () {
                  location.href = $_DOMAIN + 'posts/';
                }
            })
        }
    });
    $('.del-post-id').on('click', function(event) {
        $confirm = confirm("Bạn có chắc muốn xóa bài viết này không?");
        if ($confirm) {
            $id_edit=$(this).attr('data-id');
            $.ajax({
                url: $_DOMAIN+'post3.php',
                type: 'POST',
                data: {
                    id_edit: $id_edit,
                    action: 'del_post'
                },
                success:function () {
                  location.reload();
                }
            })
        }
    });
    $('#formstatus button').on('click', function(event) {
        $status= $('#formstatus input[name="stt_web"]:radio:checked').val();
        $.ajax({
            url: $_DOMAIN+'setting.php',
            type: 'POST',
            data: {
                status: $status,
                action:'edit_stt'
            },
            success:function (data) {

                $('#formstatus .alert').removeClass('hidden');
                $('#formstatus .alert').attr('class', 'alert alert-success');
                $('#formstatus .alert').html("Thay đổi thành công");
                 location.reload();

            },
            error:function () {
                $('#formstatus .alert').removeClass('hidden');
                $('#formstatus .alert').html("Có lỗi xảy ra, vui lòng thử lại");
            }
        })
    });
    $('#edit_info_web button').on('click',  function(event) {
        $title = $('#title_web').val();
        $kw = $('#kw_web').val();
        $desrc = $('#desrc_web').val();
        if ($title=='' || $kw=='' || $desrc=='') {
            $('#edit_info_web .alert').removeClass('hidden');
            $('#edit_info_web .alert').html("Vui lòng nhập đầy đủ thông tin");
        }else{
            $.ajax({
            url: $_DOMAIN+'setting.php',
            type: 'POST',
            data: {
                kw: $kw,
                title : $title,
                desrc :$desrc,
                action:'edit_info'
            },
            success:function (data) {
                $('#edit_info_web .alert').removeClass('hidden');
                $('#edit_info_web .alert').attr('class', 'alert alert-success');
                $('#edit_info_web .alert').html("Thay đổi thành công");
                 // location.reload();
                 alert(data);
            },
            error:function () {
                $('#edit_info_web .alert').removeClass('hidden');
                $('#edit_info_web .alert').html("Có lỗi xảy ra, vui lòng thử lại");
            }
            })
        }
    });
    $('#formAddAcc button').on('click', function() {
    $un_add_acc = $('#un_add_acc').val();
    $pw_add_acc = $('#pw_add_acc').val();
    $repw_add_acc = $('#repw_add_acc').val();
 
    if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '')
    {
        $('#formAddAcc .alert').removeClass('hidden');
        $('#formAddAcc .alert').html('Vui lòng điền đầy đủ thông tin.');
    }
    else
    {
        $.ajax({
            url : $_DOMAIN + 'accounts.php',
            type : 'POST',
            data : {
                un_add_acc: $un_add_acc,
                pw_add_acc : $pw_add_acc,
                repw_add_acc : $repw_add_acc,
                action : 'add_acc'
            }, success : function(data) {
                $('#formAddAcc .alert').html(data);
            }, error : function() {
                $('#formAddAcc .alert').removeClass('hidden');
                $('#formAddAcc .alert').html('Đã có lỗi xảy ra, hãy thử lại.');
            }  
        });
    }
});
    $('#del_acc_list').on('click', function(event) {
        $check= confirm("Bạn có chắc muốn xóa không, điều này không thể hoàn tác ?");
        if ($check) {
            $id_acc=[];
            $('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i) {
            $id_acc[i] = $(this).val();
            });
            if ($id_acc.length==0) {
                alert("Vui lòng chọn 1 hoặc nhiều tài khoản");
            }else{
                $.ajax({
                    url: $_DOMAIN+'accounts.php',
                    type: 'POST',
                    data: {
                       id_acc : $id_acc,
                       action: 'del_list_acc'
                    },
                    success:function () {
                        location.reload();
                    }
                })               
            }
        }else{
            return false;
        }
        
    });
    $('.del_acc_list').on('click',  function(event) {
        $check= confirm("Bạn có chắc muốn xóa không, điều này không thể hoàn tác ?");
        if ($check) {
            $id_acc = $(this).attr('data-id');
            $.ajax({
               url: $_DOMAIN+'accounts.php',
                    type: 'POST',
                    data: {
                   id_acc : $id_acc,
                   action: 'del_id_acc'
                   },
                   success:function () {
                       location.reload();
                   }
            })
            
        }else{
            return false;
        }
    });
    $('#lock_acc_list').on('click', function(event) {
        $check= confirm("Bạn có chắc muốn khóa những tài khoản này không?");
        if ($check) {
            $id_acc=[];
            $('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i) {
            $id_acc[i] = $(this).val();
            });
            if ($id_acc.length==0) {
                alert("Vui lòng chọn 1 hoặc nhiều tài khoản");
            }else{
                $.ajax({
                    url: $_DOMAIN+'accounts.php',
                    type: 'POST',
                    data: {
                       id_acc : $id_acc,
                       action: 'unlock_list_acc'
                    },
                    success:function () {
                        location.reload();
                    }
                })               
            }
        }else{
            return false;
        }
    });
    $('.lock_acc_list').on('click',  function(event) {
            $id_acc = $(this).attr('data-id');
            $.ajax({
               url: $_DOMAIN+'accounts.php',
                    type: 'POST',
                    data: {
                   id_acc : $id_acc,
                   action: 'lock_id_acc'
                   },
                   success:function () {
                       location.reload();
                   }
            })
    });
    $('#unlock_acc_list').on('click', function(event) {
        $check= confirm("Bạn có chắc muốn khóa những tài khoản này không?");
        if ($check) {
            $id_acc=[];
            $('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i) {
            $id_acc[i] = $(this).val();
            });
            if ($id_acc.length==0) {
                alert("Vui lòng chọn 1 hoặc nhiều tài khoản");
            }else{
                $.ajax({
                    url: $_DOMAIN+'accounts.php',
                    type: 'POST',
                    data: {
                       id_acc : $id_acc,
                       action: 'unlock_list_acc'
                    },
                    success:function () {
                        location.reload();
                    }
                })               
            }
        }else{
            return false;
        }
    });
    $('.unlock_acc_list').on('click',  function(event) {
            $id_acc = $(this).attr('data-id');
            $.ajax({
               url: $_DOMAIN+'accounts.php',
                    type: 'POST',
                    data: {
                   id_acc : $id_acc,
                   action: 'unlock_id_acc'
                   },
                   success:function () {
                       location.reload();
                   }
            })
    });
    function preUpAvt() {
    img_avt = $('#img_avt').val();
    $('#formUpAvt .box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
    $('#formUpAvt .box-pre-img').removeClass('hidden');
  
    // Nếu đã chọn ảnh
    if (img_avt != '')
    {
        $('#formUpAvt .box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
        $('#formUpAvt .box-pre-img').removeClass('hidden');
        $('#formUpAvt .box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[0]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;"/>');
    } 
    // Ngược lại chưa chọn ảnh
    else
    {
        $('#formUpAvt .box-pre-img').html('');
        $('#formUpAvt .box-pre-img').addClass('hidden');
    }
}
// Upload ảnh đại diện
$('#formUpAvt').submit(function(e) {
    img_avt = $('#img_avt').val();
    $('#formUpAvt button[type=submit]').html('Đang tải ...');
  
    // Nếu có chọn ảnh
    if (img_avt) {
        size_img_avt = $('#img_avt')[0].files[0].size;
        type_img_avt = $('#img_avt')[0].files[0].type;
 
        e.preventDefault();
        // Nếu lỗi về size ảnh
        if (size_img_avt > 5242880) { // 5242880 byte = 5MB 
            $('#formUpAvt button[type=submit]').html('Upload');
            $('#formUpAvt .alert-danger').removeClass('hidden');
            $('#formUpAvt .alert-danger').html('Tệp đã chọn có dung lượng lớn hơn mức cho phép.');
        // Nếu lỗi về định dạng ảnh
        } else if (type_img_avt != 'image/jpeg' && type_img_avt != 'image/png' && type_img_avt != 'image/gif') {
            $('#formUpAvt button[type=submit]').html('Upload');
            $('#formUpAvt .alert-danger').removeClass('hidden');
            $('#formUpAvt .alert-danger').html('File ảnh không đúng định dạng cho phép.');
        } else {
            $(this).ajaxSubmit({ 
                beforeSubmit: function() {
                    target:   '#formUpAvt .alert-danger', 
                    $("#formUpAvt .box-progress-bar").removeClass('hidden');
                    $("#formUpAvt .progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){ 
                    $("#formUpAvt .progress-bar").animate({width: percentComplete + '%'});
                    $("#formUpAvt .progress-bar").html(percentComplete + '%');
                },
                success: function (data) {     
                    $('#formUpAvt button[type=submit]').html('Upload');
                    $('#formUpAvt .alert-danger').attr('class', 'alert alert-success'); 
                    $('#formUpAvt .alert-success').html(data);
                },
                error: function() {
                    $('#formUpAvt button[type=submit]').html('Upload');
                    $('#formUpAvt .alert-danger').removeClass('hidden');  
                    $('#formUpAvt .alert-danger').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
                },
                resetForm: true
            }); 
            return false;
        }
    // Ngược lại không chọn ảnh
    } else {
        $('#formUpAvt button[type=submit]').html('Upload');
        $('#formUpAvt .alert-danger').removeClass('hidden');
        $('#formUpAvt .alert-danger').html('Vui lòng chọn tệp hình ảnh.');
    }
});
$('#del_avt').on('click', function() {
    $confirm = confirm('Bạn có chắc chắn muốn xoá ảnh đại diện này không?');
    if ($confirm == true)
    {
        $.ajax({
            url : $_DOMAIN + 'profile.php',
            type : 'POST',
            data : {
                action : 'delete_avt'
            }, success : function() {
                location.reload();
            }, error : function() {
                alert('Đã có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
    else {
        return false;
    }
});
// Cập nhật thông tin khác
$('#formUpdateInfo button').on('click', function() {
    $('#formUpdateInfo button').html('Đang tải ...');
    $dn_update = $('#dn_update').val();
    $email_update = $('#email_update').val();
    $fb_update = $('#fb_update').val();
    $gg_update = $('#gg_update').val();
    $tt_update = $('#tt_update').val();
    $phone_update = $('#phone_update').val();
    $desc_update = $('#desc_update').val();
 
    if ($dn_update && $email_update) {
        $.ajax({
            url : $_DOMAIN + 'profile.php',
            type : 'POST',
            data : {
                dn_update : $dn_update,
                email_update : $email_update,
                fb_update : $fb_update,
                gg_update : $gg_update,
                tt_update : $tt_update,
                phone_update : $phone_update,
                desc_update : $desc_update,
                action : 'update_info'
            }, success : function(data) {
                $('#formUpdateInfo .alert').removeClass('hidden');
                $('#formUpdateInfo .alert').html(data);
            }, error : function() {
                $('#formUpdateInfo .alert').removeClass('hidden');
                $('#formUpdateInfo .alert').html('Đã có lỗi xảy ra, vui lòng thử lại.');
            }
        });
        $('#formUpdateInfo button').html('Lưu thay đổi');
    } else {
        $('#formUpdateInfo button').html('Lưu thay đổi');
        $('#formUpdateInfo .alert').removeClass('hidden');
        $('#formUpdateInfo .alert').html('Vui lòng điền đầy đủ thông tin.');
    }
});
$('#formChangePw button').on('click', function() {
    $('#formChangePw button').html('Đang tải ...'); 
    $old_pw_change = $('#old_pw_change').val();
    $new_pw_change = $('#new_pw_change').val();
    $re_new_pw_change = $('#re_new_pw_change').val();
 
    if ($old_pw_change && $new_pw_change && $re_new_pw_change) {
        $.ajax({
            url : $_DOMAIN + 'profile.php',
            type : 'POST',
            data : {
                old_pw_change : $old_pw_change,
                new_pw_change : $new_pw_change,
                re_new_pw_change : $re_new_pw_change,
                action : 'change_pw'
            }, success : function(data) {
                $('#formChangePw .alert').removeClass('hidden');
                $('#formChangePw .alert').html(data);
            }, error : function() {
                $('#formChangePw .alert').removeClass('hidden');
                $('#formChangePw .alert').html('Đã có lỗi xảy ra, vui lòng thủ lại.');
            }
        });
        $('#formChangePw button').html('Lưu thay đổi');
    } else {
        $('#formChangePw button').html('Lưu thay đổi');
        $('#formChangePw .alert').removeClass('hidden');
        $('#formChangePw .alert').html('Vui lòng điền đầy đủ thông tin.');
    }
});
$('#formaddln button').on('click',  function(event) {
    $name_ln = $('#name_lightnovel').val();
    $url_ln = GetSlug($name_ln);
    $namechapter = GetNameLN($name_ln);
    if (!$name_ln) {
        $('#formaddln .alert').removeClass('hidden');
        $('#formaddln .alert').html("Vui lòng điền đầy đủ thông tin");
    }else{
        $.ajax({
            url: $_DOMAIN+'lightnovel.php',
            type: 'POST',
            data: {
                name_ln: $name_ln,
                url_ln: $url_ln,
                namechapter: $namechapter,
                action: 'add_lightnovel'
            },
            success:function (data) {
                $('#formaddln .alert').removeClass('hidden');
                $('#formaddln .alert').html(data);
                location.href = $_DOMAIN+'lightnovel';
            },
            errro:function () {
                $('#formaddln .alert').removeClass('hidden');
                $('#formaddln .alert').html("Có lỗi xảy ra, vui lòng thử lại");
            }
        })
    }
});
$('#formaddchapter button').on('click',  function(event) {
    $namechapter= $('#name_chapter').val();
    $derscchapter= $('#dersc_chapter').val();
    $content= CKEDITOR.instances['body_edit_post'].getData();
    $id_ln=$('#formaddchapter').attr('data-id');
    if ($namechapter=='' || $derscchapter=='' || $content=='') {
        $('#formaddchapter .alert').removeClass('hidden');
        $('#formaddchapter .alert').html("Vui lòng nhập đủ thông tin");
    }else{
        $.ajax({
            url: $_DOMAIN+'lightnovel.php ',
            type: 'POST',
            data: {
                namechapter: $namechapter,
                derscchapter: $derscchapter,
                content : $content,
                idln:$id_ln,
                action: 'add_chapter'
            },
            success:function (data) {
                $('#formaddchapter .alert').removeClass('hidden alert-warning');
                $('#formaddchapter .alert').addClass('alert-success');
                $('#formaddchapter .alert').html(data);
                // location.reload();
            }
        })
        
    }

});
$('#formeditln button').on('click',  function(event) {
    $kind=[];
    $('#formeditln input[type="checkbox"]:checkbox:checked').each(function(i) {
        $kind[i]= $(this).val();
    });
    $nameln=$('#name_ln_edit').val();
    $urlln=$('#url_ln_edit').val();
    $desrcln=$('#desrc_ln_edit').val();
    $cate_edit_1 = $('#cate_edit-1').val();
    $cate_edit_2 = $('#cate_edit-2').val();
    $cate_edit_3 = $('#cate_edit-3').val();
    $id_ln=$('#formeditln').attr('data-id');
    if ($nameln=='' || $urlln=='' || $desrcln=='' || $cate_edit_1=='' || $cate_edit_2=='' || $cate_edit_3=='' || $kind.length==0) {
        $('#formeditln .alert').removeClass('hidden');
        $('#formeditln .alert').html("Vui lòng nhập đủ thông tin");
    }else {
        $.ajax({
            url: $_DOMAIN+'lightnovel.php ',
            type: 'POST',
            data: {
                kind : $kind,
                nameln:$nameln,
                urlln:$urlln,
                desrcln:$desrcln,
                cate_edit_1:$cate_edit_1,
                cate_edit_2:$cate_edit_2,
                cate_edit_3:$cate_edit_3,
                id_ln:$id_ln,
                action: 'edit_ln'
            },
            success:function (data) {
                $('#formeditln .alert').removeClass('hidden alert-warning');
                $('#formeditln .alert').addClass('alert-success');
                $('#formeditln .alert').html(data);
                // location.href= $_DOMAIN+"lightnovel";
            }
        })
        
    }
});