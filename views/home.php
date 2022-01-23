<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <title>Heyworld Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container_fluid">
    <section>
        <div class="text-center">Welcome to my project</div>
        <form action="<?php echo $routes->get('showInfo')->getPath() ?>" method="post">
            <div class="form-group">
                <label for="longitude">Longitude :</label>
                <input type="text" name="longitude" class="form-control" id="longitude" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude :</label>
                <input type="text" name="latitude" class="form-control" id="latitude"required>
            </div>

            <button type="submit" class="btn btn-default" style="background-color: aqua">Display Info</button>
        </form>
        <section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>