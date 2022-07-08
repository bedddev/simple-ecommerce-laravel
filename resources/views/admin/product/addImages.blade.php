@extends('admin.layout')
@section('css')
  <link rel="stylesheet" href="{{ asset('assets/vendors/dropzone/dropzone.min.css') }}">
  <style>
  .product-image-item{
    display: inline-block;
    height: 200px;
    width: 200px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-radius:8px;
  }

  .product-image-item img{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }
</style>
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <form method="post" action="{{route('productAddImagesSave')}}" enctype="multipart/form-data" class="dropzone" id="dropzone" style="border-radius:12px;">
      <input type="hidden" name="id_product" value="{{$product->id}}">
      <div class="dz-message" data-dz-message>
        <span>Upload Product Gallery</span><br>
        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.75 12.25H19.25V19.25H12.25V22.75H19.25V29.75H22.75V22.75H29.75V19.25H22.75V12.25ZM21 3.5C11.34 3.5 3.5 11.34 3.5 21C3.5 30.66 11.34 38.5 21 38.5C30.66 38.5 38.5 30.66 38.5 21C38.5 11.34 30.66 3.5 21 3.5ZM21 35C13.2825 35 7 28.7175 7 21C7 13.2825 13.2825 7 21 7C28.7175 7 35 13.2825 35 21C35 28.7175 28.7175 35 21 35Z" fill="black" fill-opacity="0.3"/></svg>
      </div>
      @csrf
    </form>

    <div class="row mt-5 product-images">
      
    </div>
    <hr/>
    <a href="{{ route('products') }}" class="btn btn-primary float-end">Save</a>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dropzone/dropzone.js') }}"></script>
<script>

function allDataImages(){
    $.ajax({
      type: "POST",
      dataType: 'json',
      data: {"_token": "{{ csrf_token() }}", id_products:'{{ $product->id }}'},
      url : '{{ route("productGetImages") }}',
      success: function(response){
       let data = "";
       $.each(response, function(key, value){
          data = data + '<div class="col-lg-3 col-md-3 col-12 d-flex justify-content-center">'
          data = data + '<div class="product-image-item mb-4">'
          data = data + '<button class="btn btn-danger delete-image-product" data-id="'+value.id+'" style="position:absolute;z-index:9;right:0;" onClick=alertconfirm("'+value.path+'")><i class="bi bi-trash"></i></button>'
          data = data + '<img src="{{ asset("shop/products/")}}/'+value.path+'">'
          data = data + '</div>'
          data = data + '</div>'
        })
        $('.product-images').html(data);

      }
    })
  }

  allDataImages();

  Dropzone.options.dropzone = {
      accept: function(file, done) {
            done();
          },
          init: function() {
          this.on("maxfilesexceeded", function(file){
              document.getElementById('alerts').classList.add('show');
              this.removeFile(file);
          });
      },
      renameFile: function(file) {
          function getFileExtension(filename){
          const extension = filename.split('.').pop();
          return extension;
          }
          const result1 = getFileExtension(file.name);
          var dt = new Date();
          var time = dt.getTime();
          return time + '.' + result1;
      },
      acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.docx",
      addRemoveLinks: true,
      timeout: 50000,
      removedfile: function(file)
      {
        var name = file.upload.filename;
          
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
              type: 'POST',
              url: '{{ route("productDeleteImages") }}',
              data: {"_token": "{{ csrf_token() }}", filename: name},
              success: function (data){
                allDataImages();
              },
              error: function(e) {
                  console.log(e);
              }
          });
          var fileRef;
          return (fileRef = file.previewElement) != null ?
          fileRef.parentNode.removeChild(file.previewElement) : void 0;
      },
      success: function(file, response)
      {
        allDataImages();
      },
      error: function(file, response)
      {
        return false;
      }
  };

  const alertconfirm = (path) => {
    Swal.fire({
        title: 'Sure to delete this image?',
        text: "This image will delete permanently",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
              type: 'POST',
              url: '{{ route("productDeleteImages") }}',
              data: {"_token": "{{ csrf_token() }}", filename: path},
              success: function (data){
                allDataImages();
                Toastify({
                  text: "Image deleted",
                  duration: 3000,
                  close:true,
                  gravity:"top",
                  position: "right",
                  backgroundColor: "#4fbe87",
                }).showToast();
              },
              error: function(e) {
                  console.log(e);
              }
          });
        }
    })
  }

</script>
@endsection