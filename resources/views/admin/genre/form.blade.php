@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
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
            @if (!isset($genre))
            <form method="POST" action="{{route('genre.store')}}">
            @csrf
            @else 
            <form method="POST" action="{{route('genre.update',$genre->id)}}">
            @csrf
            @method('PUT')
            @endif
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug();" value="{{isset($genre) ? $genre->title : ''}}">
                        @error('title')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" value="{{isset($genre) ? $genre->slug : ''}}">
                        @error('slug')
                            <div class="error-message" style="color: red">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea id="Description" name="description" rows="4" cols="50" style="resize: none;" class="form-control">{{ isset($genre) ? $genre->description : ''}}</textarea>
                        @error('description')
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
                <button type="submit" class="btn btn-success">{{ isset($genre) ? "Cập nhật" : "Thêm dữ liệu"}}</button>
            </form>
        </div>
    </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Slug</th>
      <th scope="col">Description</th>
      <th scope="col">Active/Inactive</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($list as $key => $genre)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$genre->title}}</td>
      <td>{{$genre->slug}}</td>
      <td>{{$genre->description}}</td>
      <td>
        @if($genre->status)
            Hiển thị
        @else 
            Không hiển thị
        @endif
      </td>
      <td>
        <form method="POST" action="{{route('genre.destroy',$genre->id)}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Xóa</button>
        </form>
        <a class="btn btn-warning" href="{{route('genre.edit',$genre->id)}}">Sửa</a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
</div>
@endsection
