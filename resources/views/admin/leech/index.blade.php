@extends('layouts.app')
 
@section('content')
<div class="container-fluid">
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
    <div class="card">
      <label>Page</label>
        <form action="{{route('getpage')}}" method="POST">
          @csrf
            <select class="form-select" name="page">
              @for ($i = 0; $i < 1070; $i++)
              <option value="{{$i}}">{{$i}}
              </option>
              @endfor
            </select>
            <button>Search</button>
        </form>
    <table class="table table-responsive" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Image Thumb</th>
      <th scope="col">Slug</th>
      <th scope="col">_Id</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($resp['items'] as $key => $res)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$res['origin_name']}}</td>
      <td><img style="width: 70px; height: 70px" src="{{$resp['pathImage'].$res['thumb_url']}}"></td>
      <td><img style="width: 70px; height: 70px" src="{{$resp['pathImage'].$res['poster_url']}}"></td>
      <td>{{$res['slug']}}</td>
      <td>{{$res['_id']}}</td>
      <td>
        <a href="{{route('leech_detail',['slug'=>$res['slug']])}}" class="btn btn-danger">Details Movie</a>
        <form action="{{route('addleech',['slug'=>$res['slug']])}}" method="POST">
          @csrf
          <button class="btn btn-primary">Add Movie</button> 
        </form>
      </td>

    </tr>
    @endforeach

  </tbody>
</table>
</div>
@endsection
