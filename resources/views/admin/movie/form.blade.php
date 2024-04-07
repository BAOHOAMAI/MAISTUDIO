@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>
        <div class="card-header">Quản lý danh mục</div>

        <div class="card-body">
            @if (session('success'))
                <script>
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "{{ session('success') }}",
                      showConfirmButton: false,
                      timer: 1500,
                      width : '400px',
                      height: '200px',
                    });
                </script>
            @endif
            @if (!isset($movie))
            <form method="POST" action="{{route('movie.store')}}" enctype="multipart/form-data">
            @csrf
            @else 
            <form method="POST" action="{{route('movie.update',$movie->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @endif
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug();" value="{{isset($movie) ? $movie->title : ''}}">
                        @error('title')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" value="{{isset($movie) ? $movie->slug : ''}}">
                        @error('slug')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($movie) ? $movie->duration : ''}}">
                        @error('duration')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="episode" class="form-label">Episode</label>
                    <input type="text" name="episode" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($movie) ? $movie->episode_total : ''}}">
                        @error('episode')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="rated" class="form-label">Rated</label>
                    <input type="text" name="rated" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($movie) ? $movie->rated : ''}}">
                         @error('rated')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="user_rated" class="form-label">User Rated</label>
                    <input type="text" name="user_rated" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($movie) ? $movie->user_rated : ''}}">
                        @error('user_rated')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="trailer_title" class="form-label">Trailer Title</label>
                    <input type="text" name="trailer_title" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($movie) ? $movie->trailer_title : ''}}">
                        @error('trailer_title')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="trailer_link" class="form-label">Trailer Link</label>
                    <input type="text" name="trailer_link" class="form-control" placeholder="Nhập dữ liệu" value="{{isset($movie) ? $movie->trailer_link : ''}}">
                        @error('trailer_link')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea id="Description" name="description" rows="4" cols="50" style="resize: none;" class="form-control">{{ isset($movie) ? $movie->description : ''}}</textarea>
                         @error('genre')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="Category" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                       @foreach($category as $key => $cate)
                          <option value="{{$cate->id}}">{{$cate->title}}</option>
                      @endforeach
                    </select>                
                </div>
                <div class="mb-3">
                    <label for="movie" class="form-label">Genre</label></br>
                    @foreach($genre as $key => $gen)
                        @if (isset($movie))
                      <input value="{{$gen->id}}" name="genre[]" type="checkbox" {{isset($movie_genre) && $movie_genre->contains($gen->id) ? 'checked' : ''}}>{{$gen->title}}</input>
                        @else 
                      <input value="{{$gen->id}}" name="genre[]" type="checkbox">{{$gen->title}}</input>
                        @endif
                    @endforeach
                        @error('genre')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="Active" class="form-label">Active</label> 
                    <select class="form-select" name="status">
                      <option value="0">Không</option>
                      <option value="1">Hiển thị</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($movie))
                    <img style="width: 15%;" src="{{asset('uploads/movie/'.$movie->image)}}">
                    @endif
                        @error('image')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image_thumb</label>
                    <input type="file" name="image_thumb" class="form-control">
                    @if(isset($movie))
                    <img style="width: 15%;" src="{{asset('uploads/movie_thumb/'.$movie->image_thumb)}}">
                    @endif
                         @error('image_thumb')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <button type="submit" class="btn btn-success">{{ isset($movie) ? "Cập nhật" : "Thêm dữ liệu"}}</button>
            </form>
        </div>
    </div>
</div>
@endsection
