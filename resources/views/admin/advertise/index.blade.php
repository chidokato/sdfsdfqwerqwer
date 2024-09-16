@extends('admin.layout.main')

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
                                  <textarea name="content" class="form-control editor">{!! $data->content !!}</textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-alignment@42.0.1/+esm" type="text/javascript"></script>
<script>
    document.querySelectorAll('.editor').forEach((editorElement) => {
    ClassicEditor
        .create(editorElement, {
            alignment: {
                options: [ 'left', 'right' ]
            },
            ckfinder: {
                uploadUrl: '{{ route("upload") }}?_token={{ csrf_token() }}'
            },
            toolbar: [
                'undo', 'redo', 'imageUpload', '|', 
                'bold', 'italic', 'heading', 'bulletedList', 'numberedList', 
                'link', 'insertTable', 'blockQuote', 'removeFormat', 'alignment',
            ],
            image: {
                toolbar: [
                    'imageTextAlternative', 'linkImage', 'imageStyle:inline', 
                    'imageStyle:block', 'imageStyle:side'
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
});

</script>
@endsection