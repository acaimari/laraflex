<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Laraflex</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        div#admin-template {
            width: 80%;
            margin: 0 auto;
            position: relative;
        }

        .square-template {
            position: absolute;
            border: 10px solid #FB505C;
            width: 100px;
            height: 200px;
        }

        .container-template-info {
            position: relative;
            top: 100px;
            left: 80px;
            background: #eee;
            padding: 20px;
        }

        .background-color-info {
            background: #FB505C;
            max-width: 150px;
            padding: 5px;
            display: block;
            font-size: 8px;
            font-family: montserrat;
            text-transform: uppercase;
            color: #eee;
            letter-spacing: 2px;
        }

        .no-bg-info {
            font-family: ailerons;
            text-transform: uppercase;
            margin-top: 0px;
            letter-spacing: 5px;
            font-size: 40px;
        }

        .template-text {
            text-align: justify;
            margin-top: 130px;
            font-family: montserrat;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 1px;
            line-height: 20px;
            padding: 40px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="/panel">
        <span class="icon-container">
            <i class='bx bxs-heart bx-border-circle'></i>
        </span>
        Laraflex
    </a>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @yield('content')
        </div>
    </div>
</div>

<footer class="bg-dark text-light text-center py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <p class="mb-0">Licencia MIT.</p>
            </div>
            <div class="col">
                <p class="mb-0">Año: <?php echo date('Y'); ?></p>
            </div>
            <div class="col">
                <p class="mb-0">Versión Laraflex: <?php echo env('LARAFLEX_VERSION'); ?></p>
            </div>
            <div class="col">
                <p class="mb-0">Versión Laravel: <?php echo app()->version(); ?></p>
            </div>
            <div class="col">
                <p class="mb-0">Versión PHP: <?php echo phpversion(); ?></p>
            </div>
            <div class="col">
                <p class="mb-0"><a href="http://laraflex.org">laraflex.org</a></p>
            </div>
        </div>
    </div>
</footer>

<style>
footer {
    width: 100%;
    position: fixed;
    bottom: 0;
    left: 0;
    padding-left: 0;
    padding-right: 0;
    margin-left: 0;
    margin-right: 0;
}

footer p {
    margin: 0;
}
</style>




<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
