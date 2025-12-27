<?php
require('data.php');
$page = array(
    'title' => 'Error',
    'description' => 'An error occurred while processing your request.',
    'keywords' => 'error, not found',
    'css' => array(
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        '/css/styles.min.css?v=1.0',
    ),
    'header-class' => '',
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('inc/head.php'); ?>
</head>
<body>
    <?php require('inc/sidebar.html'); ?>
    <div id="wrapper">
        <?php require('inc/header.php'); ?>
        <div class="clearfix"></div>
        <div class="container mt-5 mb-5">
            <div class="alert alert-danger" role="alert">
                <?= $errorMessage ?? "Sorry, something went wrong. Please try again later." ?>
            </div>
            <div class="text-center">
                <a href="/" class="btn btn-primary">Go to Home</a>
            </div>
        </div>
        <?php require('inc/footer.php'); ?>
    </div>
</body>
</html>
