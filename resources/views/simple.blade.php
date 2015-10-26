<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>LCIS - @yield('title')</title>
        <link rel="stylesheet" href="<?php echo asset('assets/css/bootstrap.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('assets/css/material.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('assets/css/style.css') ?>">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo asset('assets/images/LC logo.jpg'); ?>">
        @yield('header')
    </head>
    <body class="mdl-color--yellow-200">
        @yield('body')
        <footer>
            <script type="text/javascript" src="<?php echo asset('assets/js/jquery.min.js') ?>"></script>
            <script type="text/javascript" src="<?php echo asset('assets/js/bootstrap.js') ?>"></script>
            <script type="text/javascript" src="<?php echo asset('assets/js/material.js') ?>"></script>
            <script type="text/javascript">
                $.material.init();
            </script>
            @yield('footer')
        </footer>
    </body>
</html>
