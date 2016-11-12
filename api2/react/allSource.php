<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>工大二手交易平台</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../../css/index.css"/>
</head>
<body>
	<?php 
		include '../components/header.php';
		include '../components/sidebar.php';
	 ?>

	<div class="main-content">
        
        <?php 
            include '../components/newPublic.php';
         ?>

    </div>


	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../../js/materialize.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.loadTemplate-1.4.3.min.js"></script>
    <script type="text/javascript" src="../../js/vue.js"></script>
    <script type="text/javascript" src="../react/js/all.js"></script>
    <script type="text/javascript" src="../../js/index.js"></script>
</body>
</html>