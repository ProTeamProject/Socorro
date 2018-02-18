<?php

  include_once '../includes/db.php';
  session_start();

  if (!isset($_SESSION['u_id'])) {
    header("Location: ../index.php");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Socorro - New Problem</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="../css/form.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
</head>

<body>
  <?php include '../header.php' ?>
  <main id="panel" class="main__section">
    <section id="new" class="h-padding-xlarge animated fadeIn">
      <h2 class="animated fadeInUp"><a class="back__button" href="/dashboard">Back to Dashboard</a></h2>
        <div class="heading">
      <h1 class="animated fadeInUp">New Problem ID: #generate new id</h1>
      <div class="date__status__container">
        <p class="date__status animated fadeInUp">
          Created on <?php $date = date('jS F Y H:i'); echo $date; ?>
        </p>
      </div>
    </div>

    <form action="../includes/addproblem.php" method="post">
    <div class="accordian__container">
      <button id="accordion_caller_info" class="accordion animated FadeIn">
      <i class="fa fa-user" aria-hidden="true"></i> Caller Info
    </button>
      <div class="panel">

          <div class="form-group" id="caller-info">
            <input list="items" id="item" type="text" required="required"/>
            <label class="control-label" for="input">Caller Name</label><i class="bar"></i>
<datalist id="items">
<option value="John Smith"  data-job = "IT Director" data-id="129" data-dept="IT" data-ext="23572" selected="true">Ext 23572</option>
<option value="Johh Smith" data-job = "IT Manager" data-id="129" data-dept="IT" data-ext="23572">Ext 36542</option>
<option value="Billy Middleton"  data-job = "HR" data-id="129" data-dept="IT" data-ext="23572">Ext 09675</option>
<option value="Jane Doe"  data-job = "Events Coordinator" data-id="129" data-dept="IT" data-ext="23572">Ext 15746</option>
<option value="Jane Austin"  data-job = "Marketing" data-id="129" data-dept="IT" data-ext="23572">Ext 17823</option>
<option value="Charles Dickins"  data-job = "Distribution Manager" data-id="129" data-dept="IT" data-ext="23572">Ext 87564</option>
    </datalist>

<button id="button" class="button__load"><span>Retrieve User Info</span></button>
<div class="caller__info__output" style="height:30px;">

</div>
<!--
            <input list="caller-names" type="text" id="caller-name" required="required"/>
            <label class="control-label" for="input">Caller Name</label><i class="bar"></i>

            <button id="sub" class="button__load"><span>Retrieve User Info</span></button>
            <datalist id="caller-names">
                <option data-id="blahcbakc" value="John Smith">Ext 23442</option>
                <option data-id="eowfniwief" value="John Smith">Ext 23342</option>
                <option data-id="owienfomw" value="Billy No Mates">Ext 23452</option>
                <option data-id="lxlkmoiwmdwe" value="Tim Johnson">Ext 22842</option>
            </datalist>

            -->
          </div>


      </div>

      <button id="accordion_problem_info" class="accordion animated FadeIn"><i class="fa fa-info-circle" aria-hidden="true"></i>
Problem Info</button>
      <div class="panel">
        <div id="alert" class="alert info animated FadeIn">
      <span class="closebtn"><i id="min-icon" class="fa fa-window-minimize" aria-hidden="true"></i></span>
      <span id="solution-text"><strong>Suggested Solutions</strong>    Show More</span>
      <span class="openbtn"><i id="bulb-icon" class="fa fa-lightbulb-o" style="display:none;" aria-hidden="true"></i></span>
    </div>
          <div class="form-group">
            <textarea required="required" onkeyup="increaseHeight(this);"></textarea>
            <label class="control-label" for="textarea" >Problem Description</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <select>
              <option>Printing</option>
              <option>Hardware</option>
              <option>Software</option>
              <option>Internet</option>
              <option>Email</option>
            </select>
            <label class="control-label" for="select">Problem Type</label><i class="bar"></i>
          </div>
          <div class="checkbox">
            <label>
              <input id="checkbox-create-problem-type" type="checkbox"/><i class="helper"></i>Create New Problem Type
            </label>
          </div>
          <div style="display:none;" id="new-problem-type" class="form-group">
            <input type="text" />
            <label class="control-label" for="input">New Problem Type</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <input type="text" required="required"/>
            <label class="control-label" for="input">Software Serial Number</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <input type="text" required="required"/>
            <label class="control-label" for="input">Hardware Serial Number</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <select>
              <option>MacOS</option>
              <option>Windows</option>
              <option>Linux</option>
            </select>
            <label class="control-label" for="select">Operating System</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <input type="text" required="required"/>
            <label class="control-label" for="input">Software</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <input type="text" required="required"/>
            <label class="control-label" for="input">Hardware</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <a href="#openModal"><button class="button__main" style="color:black">Assign Specialist</button></a>
          </div>
          <div class="checkbox">
            <label>
              <input id="checkbox-solved" type="checkbox"/><i class="helper"></i>Problem Solved (Closed)
            </label>
            <a href="#openModal2"><button id="solution-button"class="button__main" style="display:none;color:black;margin-top:20px;">Enter Solution</button></a>
          </div>
          <div style="height:90px;">

          </div>

      </div>

      <button id="accordion_status" class="accordion animated FadeIn"><i class="fa fa-commenting" aria-hidden="true"></i> Status</button>
      <div class="panel">
        <div class="status__container">
          <div class="status">
            <div class="form-group desc">
              <textarea required="required" onkeyup="increaseHeight(this);"></textarea>
              <label class="control-label" for="textarea" >Opening Status</label><i class="bar"></i>
            </div>
          </div>

        </div>

      </div>
      </div>
      <div class="button-container">
        <button class="button" name="submit"><span>Create New Problem</span></button>
      </div>

  </form>



  <footer class="footer v-padding-xlarge">
    <p>
      ProTeam Project - Team 10
    </p>
  </footer>

    </section>

  </main>
  <div id="openModal" class="modalDialog">
    <div>	<a href="#close" title="Close" class="close">X</a>
          <h2 class="text-centered">Assign Specialist</h2>

              <p style="color:white;">
                <strong>Problem Type: </strong>Hardware
              </p>
              <div class="problems__inner__dash__specialists" style="color:white;">
                  <div class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">Jim Pickins</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">10</p>
                    <div class="status__closed">
                      <p class="status__text">Busy</p>
                    </div>
                  </div>

                  <div id="specialist-entry_2" class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">Bert Rodgers</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">5</p>
                    <div class="status__open">
                      <p class="status__text">Available</p>
                    </div>
                  </div>

                  <div id="specialist-entry_3" class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">Ronny Dilbert</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">3</p>
                    <div class="status__open">
                      <p class="status__text">Available</p>
                    </div>
                  </div>

                  <div class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">John Middleton</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">13</p>
                    <div class="status__closed">
                      <p class="status__text">Busy</p>
                    </div>
                  </div>
              </div>
            <div class="button__container">
            <button class="button__load" style="margin-bottom:10px;">Save</button>
        </div>
    </div>
  </div>
  <div id="openModal2" class="modalDialog">
    <div>	<a href="#close" title="Close" class="close">X</a>
          <h2 class="text-centered">Add Solution</h2>

              <div class="form-group desc">
                <textarea onkeyup="increaseHeight(this);"></textarea>
                <label class="control-label" for="textarea">Solution</label><i class="bar"></i>

              <div class="checkbox">
                <label>
                  <input id="checkbox-solved" type="checkbox"/><i class="helper"></i>Problem Solved (Closed)
                </label>
              </div>
            </div>
            <div class="button__container">
            <button class="button__load" style="margin-bottom:10px;">Save</button>
        </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>
