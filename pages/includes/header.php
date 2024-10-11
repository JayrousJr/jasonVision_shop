<?php
require_once '../core/init.php';
include 'includes/func.inc.php';

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden;">

<head>
    <meta charset="utf-8">
    <title>Jason Vision</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Sudi Ahmad">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href="css/toastr.css" rel="stylesheet" />
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href="fonts/font-awesome.css" rel="stylesheet" />
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/sweetalert.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables/dataTables.buttons.min.css">
    <link rel="stylesheet" href="../css/custom.css">

    <style>
    .sele {
        background-color: #73aaef;
        color: black;
    }

    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;

    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;

    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0b72e0;
        color: white;

    }
    </style>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <script language="javascript">
    var popupWindow = null;

    function centeredPopup(url, winName, w, h, scroll) {
        LeftPosition = (screen.width) ? (screen.width - w) / 2 : 0;
        TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;
        settings =
            'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll +
            ',resizable'
        popupWindow = window.open(url, winName, settings)
    }
    </script>
    <script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    </script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
   <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/logo.png">

</head>