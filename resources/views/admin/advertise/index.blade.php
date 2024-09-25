@extends('admin.layout.main')

@section('css')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.1/ckeditor5.css">
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
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
<!-- A friendly reminder to run on a server, remove this during the integration. -->
<script>
        window.onload = function() {
            if ( window.location.protocol === "file:" ) {
                alert( "This sample requires an HTTP server. Please serve this file with a web server." );
            }
        };
</script>
@endsection