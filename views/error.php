<?php
require('data.php');
$page = array(
    'title' => 'Error',
    'description' => 'An error occurred while processing your request.',
    'keywords' => 'error, not found',
    'header-class' => '',
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('inc/head.php'); ?>
</head>
<body>
    <?php require('inc/sidebar.php'); ?>
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
