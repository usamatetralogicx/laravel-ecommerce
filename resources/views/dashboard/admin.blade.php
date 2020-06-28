<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>	</title>
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />


	
</head>

<body>

	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('dashboard')}}">Company name</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
    </li>
  </ul>
</nav>
  
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link @if(request()->url()==route('dashboard')) {{'active'}} @endif" href="{{url('show')}}">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(request()->url()==url('product')) {{'active'}} @endif dropdown-toggle"    data-toggle="dropdown" href="{{url('product')}}">
              <span data-feather="shopping-cart"></span>
              Products
            </a>

          <div class="dropdown-menu" aria-labelledby="categoryDropdown">
        <a class="dropdown-item" href="{{url('product')}}">Add Product</a>
        <a class="dropdown-item " href="{{route('show_pro')}}">All Product</a>
        
      </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{route('users')}}"  data-toggle="dropdown" href="#">
              <span data-feather="users"></span>
              Users
            </a>
          <div class="dropdown-menu" aria-labelledby="categoryDropdown">
        <a class="dropdown-item" href="{{route('users')}}">Add User</a>
        <a class="dropdown-item " href="{{route('show_users')}}">All User</a>
      </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link @if(request()->url() == url('categories')) {{'active'}} @endif dropdown-toggle"  data-toggle="dropdown" href="#">
              <span data-feather="bar-chart-2"></span>
              Categories
            </a>
          
          <div class="dropdown-menu" aria-labelledby="categoryDropdown">
        <a class="dropdown-item" href="{{route('get_cat')}}">Add Category</a>
        <a class="dropdown-item " href="{{url('categories')}}">All Categories</a>
        <a class="dropdown-item" href="{{route('show')}}">Trashed Categories</a>
      </div>
      </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>
    @yield('breadcrumbs')
    @yield('content')

	<script  type="text/javascript" src="{{ asset('js/app.js') }}" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
<script>
	feather.replace()
</script>
@yield('scripts')
</body>
</html>