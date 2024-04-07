<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admincategory.create')}}">Danh mục phim</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('genre.create')}}">Thể loại</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('movie.create')}}">Phim</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="{{route('episode.create')}}">Tập phim</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="{{route('leech')}}">Leech</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>