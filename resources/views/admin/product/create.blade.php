@extends('admin.layout')
@section('css')
  <link rel="stylesheet" href="{{ asset('assets/vendors/select-live/dselect.scss') }}">
  <style>
    .form-select{
      text-align:left !important;
    }
    .dropdown-menu{
      border: 1px solid #dce7f1;
    }
</style>
@endsection
@section('content')
  <div class="card">
    <div class="card-body row">
      <div class="col-md-8 col-12">
        <form action="{{ route('producSave') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control  @error('title') is-invalid @enderror" placeholder="Chicken nugget spicy" value="{{ old('title') }}" required>
            @error('title') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
              <option selected disabled>Select Category</option>
              @foreach (Auth::user()->shop->category as $item)
                <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('category') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control  @error('price') is-invalid @enderror" placeholder="1000" value="{{ old('price') }}" required>
            @error('price') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control  @error('stock') is-invalid @enderror" placeholder="10" value="{{ old('stock') }}" required>
            @error('stock') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
              <label for="desc">Description</label>
              <textarea name="desc" id="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" placeholder="Homade spicy chicken nuggets with healty chicken  . . ." required>{{ old('desc') }}</textarea>
              @error('desc')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <button type="submit" class="btn btn-primary float-end">Save</button>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{ asset('assets/vendors/select-live/dselect.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script>
  var select_box_element = document.querySelector('#category')
  dselect(select_box_element, {
      search: true
  });

  document.getElementById('desc').addEventListener('keyup', function() {
      this.style.overflow = 'hidden';
      this.style.height = 0;
      this.style.height = this.scrollHeight + 'px';
  }, false);

  const title = document.getElementById("title");
  title.addEventListener('keyup', function(e){
      let result = title.value.replace(/\s+/g, "-");
      let capital = title.value.replace(/[A-Z]/g, "$&");
      title.value = result.toLowerCase()
  });

  $('#title').keyup(function(){
    let title = this.value

    setTimeout(() => {
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        data: {"_token" : "{{ csrf_token() }}", title: title},
        url: '{{ route("productCheck") }}',
        success: function(data){

        },
        statusCode: {
          200: () => {
            $('#title').addClass('is-invalid');
            $('#title').removeClass('is-valid');
          },
          201: () => {
            $('#title').removeClass('is-invalid');
            $('#title').addClass('is-valid');
          }
        }
      })
    }, 100);

  })

</script>
@endsection