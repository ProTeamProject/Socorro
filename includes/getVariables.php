<?php

//Get current month int
  $month = '10';
  $year = 2017;
  $sid = 4;

function updateVariables($month) {
  $month = $_GET['month'];
  $year = 2018;
  $sid = 4;
}

updateVariables($_GET['month']);




?>
