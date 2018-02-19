<?php

$message = '<!DOCTYPE html>
<html>

<head>
<style type="text/css">
  #logo{
    background-color: #1AA6CE;
  }
  #socorroLogo{
    width: 600px;
    height: 100px;
    margin: auto;
    display: block;
    padding-top: 20px;
    padding-bottom: 50px;

      }
  body{
    background-color: #F3F3F3;
  }
  .content{
    font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;
    background-color: #F3F3F3;

  }
  #heading {
    text-align: center;
    border: 3px;
    padding: 15px;
  }
  #problemType{
    text-align: center;
    border: 3px;
    padding: 15px;
    font-weight: bold;
    font-size: 22px;
  }
  #button{
    text-align: center;
    border: 3px;
    padding: 15px;


  }
  #Greetings{
    text-align: center;
    border: 3px;
    padding: 15px;
  }
  input[type=submit] {
    background: #B6E8F6;
    border: 1px solid #eee;
    box-shadow: 3px 3px 3px #eee;
    border-radius: 20px;
    font-size: 36px;
    font-weight: bold;

  }
    input[type=submit]:hover {
    background: #1AA6CE;
    border: 1px solid #eee;
    box-shadow: 3px 3px 3px #eee;
    border-radius: 20px;
    font-size: 36px;
    font-weight: bold;
  }

  }
</style>
</head>
<body>
  <div id="logo">
    <img src="logo.png" id="socorroLogo">
  </div>
  <div class="content">
      <div id="Greetings">
          <h1>Greetings Operator</h1>
      </div>
      <div id="heading">
          <h2>You have a new problem assigned!</h2>
      </div>
      <div id="problemType">
        <p>Problem Type:</p>
      </div>
      <div id="button">
        <form action = "http://213.39.41.76/problem/index.php?id="'. $pid . '>
          <input type = "submit" value = "Go To Problem" />
        </form>
      </div>
      <div>

      </div>
  </div>
</body>
</html>';


 ?>
