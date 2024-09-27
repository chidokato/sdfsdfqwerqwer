@extends('admin.layout.main')

@section('css')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.1/ckeditor5.css">
<style type="text/css">
    .file-upload{ background: #e9e9e9; }
    .remove-upload{ position:absolute; top:0; right:0;text-align:center; }
</style>
@endsection

@section('content')
@include('admin.alert')
<form method="post" action="{{route('advertise.update', [$data->id])}}" enctype="multipart/form-data">
@csrf
@method('PUT')
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <button type="submit" class="btn-success form-control"><i class="far fa-save"></i> Save</button>
        </li>
    </ul>
</nav>

<div class="d-sm-flex align-items-center justify-content-between mb-3 flex" style="height: 38px;">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Advertise</h2>
</div>

<div class="row">
  <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Content</h6>
            </div>
            <div class="tab-content overflow">
                <div class="tab-pane active" id="en">
                  <div class="card-body">
                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="{{$data->name}}" name="name" placeholder="..." type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Content</label>
                                    <div class="main-container">
                                        <textarea name="content" class="form-control" id="editor">{!! $data->content !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @foreach($images as $val)
                                <div class="file-upload">
                                    <input type="hidden" value="{{$val->id}}" name="id_edit[]">
                                    <div class="file-upload-content" onclick="$(this).siblings('.image-upload-wrap').find('.file-upload-input').trigger('click')">
                                        <img class="file-upload-image" src="uploads/{{$val->img}}" />
                                    </div>
                                    <div class="image-upload-wrap">
                                        <input name="img_edit[]" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                    </div>
                                    <div class="input-group">
                                        <input value="{{$val->link}}" name="link_edit[]" placeholder="insert link" type="text" class="form-control">
                                        <select name="row_edit[]" class="form-control">
                                            <option {{$val->row == 'col-md-12' ? 'selected':''}} value="col-md-12">1</option>
                                            <option {{$val->row == 'col-md-6' ? 'selected':''}} value="col-md-6">2</option>
                                            <option {{$val->row == 'col-md-4' ? 'selected':''}} value="col-md-4">3</option>
                                        </select>
                                    </div>
                                    <button id="dell_images" data-id="{{ $val->id }}" class="btn btn-danger remove-upload" type="button">X</button>
                                </div>
                                @endforeach

                                <div id="upload-container">
                                </div>
                                
                                <div class="text-center">
                                    <button class="btn btn-success" id="add-upload" type="button"><i class="fa fa-plus" aria-hidden="true"></i> ADD IMAGES</button>
                                </div>
                            </div>
                            
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>



@endsection

@section('js')

<script type="text/javascript">
    $(document).on('click', '#dell_images', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'admin/delimg/' + id,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    alert('Deleted photos successfully!');
                    $('#image-' + id).remove();
                } else {
                    alert('An error occurred while deleting the photo.');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('An error has occurred.');
            }
        });
    });
</script>

<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.1/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.1/"
        }
    }
</script>

<script type="module">
    import {
        ClassicEditor,
        Paragraph,
        Bold,
        Italic,
        Font,
        Link,
        SourceEditing,
        RemoveFormat,
        Enter,
        Alignment
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#editor'), {
            plugins: [Paragraph, Bold, Italic, Font, Link, SourceEditing, RemoveFormat, Enter, Alignment ],
            toolbar: [
                'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'link', '|', 'sourceEditing', '|', 'removeFormat',
                'alignment:left', 'alignment:center', 'alignment:right'
            ]
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script type="text/javascript">
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // Tìm tới phần tử cụ thể bên trong phần file-upload hiện tại
            var $fileUpload = $(input).closest('.file-upload');
            $fileUpload.find('.image-upload-wrap').hide();
            $fileUpload.find('.file-upload-image').attr('src', e.target.result);
            $fileUpload.find('.file-upload-content').show();
            $fileUpload.find('.image-title').html(input.files[0].name);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        removeUpload(input);
    }
}

function removeUpload(input) {
    var $fileUpload = $(input).closest('.file-upload');
    $fileUpload.find('.file-upload-input').val(null);
    $fileUpload.find('.file-upload-image').attr('src', 'data/no_image.jpg');
    $fileUpload.find('.file-upload-content').hide();
    $fileUpload.find('.image-upload-wrap').show();
}

$(document).ready(function() {
    $('#add-upload').on('click', function() {
        var fileUploadHtml = `
            <div class="file-upload">
                <div class="file-upload-content" onclick="$(this).siblings('.image-upload-wrap').find('.file-upload-input').trigger('click')">
                    <img class="file-upload-image" src="admin_asset/img/No_Image_Available.jpg" />
                </div>
                <div class="image-upload-wrap">
                    <input name="img[]" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                </div>
                <div class="input-group">
                    <input name="link[]" placeholder="insert link" type="text" class="form-control">
                    <select name="row[]" class="form-control">
                        <option value="col-md-12">1</option>
                        <option value="col-md-6">2</option>
                        <option value="col-md-4">3</option>
                    </select>
                </div>
                <button class="btn btn-danger remove-upload" type="button">X</button>
            </div>
        `;

        $('#upload-container').append(fileUploadHtml);
    });

    $(document).on('click', '.remove-upload', function() {
        $(this).closest('.file-upload').remove(); // Xóa phần tử file-upload
    });
});



</script>



@endsection