<!doctype html>
<head>
    <meta charset="utf-8">

    <title>Admin AHT</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/all.min.css') }}">
    <!-- add icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="starter-template.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- add ckeditor -->
    <script type="text/javascript" src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>

    <style>
        body {
            padding: 0;
        }
        .starter-template {
            padding: 3rem 1.5rem;
        }
        .nav-item {
            display: flex;
        }
        .navright {
            text-align: right;
        }
        .bg-dark {
            background-color: #3c8dbc!important;
        }
        .navbar-nav>li {
            justify-content: flex-end;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" style="font-weight: 600; font-size: 28px;" href="{{ url('admin/tasks') }}">Admin AHT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" style="font-weight: 500; font-size: 16px;" href="{{ url('admin/users') }}">Users <span class="sr-only">(current)</span></a>
                <a class="nav-link" style="font-weight: 500; font-size: 16px;" href="{{ url('admin/tasks') }}">Tasks <span class="sr-only">(current)</span></a>
                <a class="nav-link" style="font-weight: 500; font-size: 16px;" href="{{ url('admin/news') }}">News <span class="sr-only">(current)</span></a>
                <a class="nav-link" style="font-weight: 500; font-size: 16px;" href="{{ url('admin/categories') }}">Categories <span class="sr-only">(current)</span></a>
                <!-- <a class="nav-link" href="{{ url('logout') }}">Logout <span class="sr-only">(current)</span></a> -->
            </li>
        </ul>
    </div>
    <!-- Hiện tên người đăng nhập -->
    <div class="navright" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <div class="nav-link" style="width:5%;">
                    <img src="https://kiemsoat.idmart.com.vn/wp-content/uploads/2019/06/icon-ng%C6%B0%E1%BB%9Di-d%C3%B9ng.png" alt="" style="width:100%;">
                    {{-- <?php 
                        $avatar = DB::select("select * from users order by id asc")
                    ?>
                    @if(isset($record->$avatar))
                        <img src="{{ Auth::user()->avatar }}" alt="" style="width:100%;">
                    @else
                        <img src="https://kiemsoat.idmart.com.vn/wp-content/uploads/2019/06/icon-ng%C6%B0%E1%BB%9Di-d%C3%B9ng.png" alt="" style="width:100%;">
                    @endif --}}
                </div>
                <a class="nav-link" style="font-weight: 500; font-size: 14px;" href="#">Xin chào {{ Auth::user()->email }}</a>
                <a class="nav-link" style="font-weight: 500; font-size: 14px;" href="{{ url('logout') }}">Logout <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template">

    @yield("do-du-lieu-vao-layout")

    </div>

</main>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>
