<?php
require __DIR__."/dbconnect/swapi-class.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>.select2-container{width: 300px !important;}</style>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="assets/css/main.style.css">
</head>
<body>
    <div class="container">
    <!-- Title Document -->
    <div class="row mt-4"></div>
    <div class="col-md-12">
        <h1>Swapi - Resources</h1>
    </div>
    <div class="alert alert-info"></div>
<table id="list-response-table" class='table table-bordered table-hover'>
<thead>
    <tr class="table-info">
    <th scope="col" class="wt-20-pr">Resources</th>
    <th scope="col" class="wt-100-pr"></th>
    </tr>
</thead>
<tbody id="list-rows">
<tr>
<td scope="row">Starships</td>
<td>
<div class="row">
    <div class="col-md-6">
    <select class="select-starships" id="select-starships">
    </select>
    </div>
    <div class="col-md-3 totalRegsStarships"></div>
    <div class="col-md-3 total-death-stars-container"><label class="totalStars">0</label>
</div>
</div>
</td>
</tr>
<tr>
<td scope="row">Vehicles</td>
<td>
    <div class="row">
    <div class="col-md-6">
    <select class="select-vehicles" id="select-vehicles">
    </select>
    </div>
    <div class="col-md-3 totalRegsVehicles"></div>
    <div class="col-md-3 total-vehicles-container"><label class="totalStars">0</label>
</div>
    </div>
</td>
</tr>
</tbody>
</table>

<!-- Descriptions -->
<div class="title-resource-reports"></div>
<div class="total-records-text"></div>

<!-- Add Rows -->
<!-- <div class="row" style="display:none">
    <div class="col-md-3">
        Name
    </div>
    <div class="col-md-3">
        Name
    </div>
    <div class="col-md-3">
        Name
    </div>
    <div class="col-md-3">
        Name
    </div>
</div> -->
<div class="alert alert-info messg-resp" style="display:block !important">a</div>
<!-- Table Reports -->
<table class='tbl-reports table table-bordered table-hover'>
    <tr class="table-info"><th>Name</th>
    <th>Model</th>
    <th>Manufacturer</th>
    <th>Class</th>
    <th>Created</th>
    <th>Actions</th></tr>
    <tbody class="tbl-body-reports">
    </tbody>
</table>
</div>
</body>
<script src="assets/js/App.js"></script>
<script></script>
</html>