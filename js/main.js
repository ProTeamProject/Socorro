
var acc = document.getElementsByClassName("accordion");
var i;
var pagetype;



onload = function getPage() {
  if (document.getElementById("dashboard") != null) {
    pagetype = "dash";
  } else if (document.getElementById("new") != null) {
    pagetype = "new";
  } else if (document.getElementById("problemid") != null) {
    pagetype = "id";
  }
}



//load repeated html elements
$("#headerDiv").load("../header.html");
$("#headerSpecialistDiv").load("../header_specialist.html");

if (pagetype == "new") {

  var checkbox = document.getElementById('checkbox-solved');
  checkbox.checked = false;
}

/*
$(".dashboard__checkbox__container :checkbox").click(function() {
       $("div").hide();
       $("#filters :checkbox:checked").each(function() {
           $("." + $(this).val()).show();
       });
    });

    */


$(function() {

    $("#button").click(function() {
        var val = $('#item').val()
        var xyz = $('#items option').filter(function() {
            return this.value == val;
        }).data('job');
        var id = $('#items option').filter(function() {
            return this.value == val;
        }).data('id');
        var dept = $('#items option').filter(function() {
            return this.value == val;
        }).data('dept');
        var ext = $('#items option').filter(function() {
            return this.value == val;
        }).data('ext');
        var msg = xyz ? '<p><strong>Caller ID:</strong> ' + id +  ', <strong>Job:</strong> ' + xyz + ', <strong>Department:</strong> ' + dept + ', <strong>Extension:<strong> ' + ext + '</p>' : 'No Match';
        var element = $(msg);
        $(".caller__info__output").empty();
        $(".caller__info__output").append(element);
    })

})

var close = document.getElementsByClassName("closebtn");
var open = document.getElementsByClassName("openbtn");
var i;
var dismissed;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        var d = document.getElementById('bulb-icon');
        var minIcon = document.getElementById('min-icon');
        var f = document.getElementById('solution-text');
        div.style.width = "10%";
        //div.style.margin = "0px 0px 0px 90%";
        d.style.display = "block";
        f.style.display = "none";
        minIcon.style.display = "none";
        dismissed = true;
    }
}

for (i = 0; i < close.length; i++) {
    open[i].onclick = function(){
        var div = this.parentElement;
        var d = document.getElementById('bulb-icon');
        var minIcon = document.getElementById('min-icon');
        var f = document.getElementById('solution-text');
        div.style.width = "100%";
        //div.style.margin = "0px 0px 0px 90%";
        d.style.display = "none";
        f.style.display = "block";
        minIcon.style.display = "block";
        dismissed = true;
    }
}



$( "#specialist-entry_1" ).click(function() {
  $( this ).toggleClass( "specialist" );
  $( "#specialist-entry_2" ).removeClass( "specialist" );
  $( "#specialist-entry_3" ).removeClass( "specialist" );
  $( "#specialist-entry_4" ).removeClass( "specialist" );
});
$( "#specialist-entry_2" ).click(function() {
  $( this ).toggleClass( "specialist" );
  $( "#specialist-entry_1" ).removeClass( "specialist" );
  $( "#specialist-entry_3" ).removeClass( "specialist" );
  $( "#specialist-entry_4" ).removeClass( "specialist" );
});

$( "#specialist-entry_3" ).click(function() {
  $( this ).toggleClass( "specialist" );
  $( "#specialist-entry_2" ).removeClass( "specialist" );
  $( "#specialist-entry_1" ).removeClass( "specialist" );
  $( "#specialist-entry_4" ).removeClass( "specialist" );
});

$( "#specialist-entry_4" ).click(function() {
  $( this ).toggleClass( "specialist" );
  $( "#specialist-entry_2" ).removeClass( "specialist" );
  $( "#specialist-entry_3" ).removeClass( "specialist" );
  $( "#specialist-entry_1" ).removeClass( "specialist" );
});



function increaseHeight(e){
       e.style.height = 'auto';
       var newHeight = (e.scrollHeight > 32 ? e.scrollHeight : 32);
       e.style.height = newHeight.toString() + 'px';
}

function changeMaxHeight() {
  acc.style.maxHeight = '100%';
}



$(".problems__inner__dash > a .closed").hide();
$(".dashboard__checkbox__container :checkbox").change(function() {
    $(".problems__inner__dash > a").hide();
    $(".dashboard__checkbox__container :checkbox:checked").each(function() {
        $(".problems__inner__dash ." + $(this).val()).show();
    });
});

/*
function populatePage(json, json_pending) {
  for(var k in json) {
    var element = $('<a class="' + json[k]['problem_status'] + '"href="/problem"><div class="problem__entry h-padding-small ' + json[k]['problem_status'] + '" id="problem_27"><p class="pid">' + '#' + json[k]['problem_id'] + '</p><p class="caller__name">' + json[k]['caller_name'] + '</p><p class="date__created">' + json[k]['date_submitted'] + '</p><p class="updated">' + json[k]['last_updated'] + '</p><p class="problem__type">' + json[k]['problem_type'] + '</p><div class="status__' + json[k]['problem_status'] + '"><p class="status__text">' + json[k]['problem_status'] + '</p></div></div></a>');
    $(".problems__inner__dash").append(element);
  }
  for(var k in json_pending) {
    var element2 = $('<a href="/problem"><div class="problem__entry h-padding-small ' + json_pending[k]['problem_status'] + '" id="problem_27"><p class="pid">' + '#' + json_pending[k]['problem_id'] + '</p><p class="caller__name">' + json_pending[k]['caller_name'] + '</p><p class="date__created">' + json_pending[k]['date_submitted'] + '</p><p class="updated">' + json_pending[k]['last_updated'] + '</p><p class="problem__type">' + json_pending[k]['problem_type'] + '</p><div class="status__' + json_pending[k]['problem_status'] + '"><p class="status__text">' + json_pending[k]['problem_status'] + '</p></div></div></a>');
    $(".problems__inner__dash__pending").append(element2);
  }
}
*/



function loadMore() {
  //show load icon with delay
  document.getElementById("loader").style.display = "block";
  document.getElementById("button-load").style.display = "none";
  myVar = setTimeout(showPageContent, 300);
}

function showPageContent() {
  document.getElementById("button-load").style.display = "block";
  document.getElementById("loader").style.display = "none";
}

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
}

$("#menu-button").click(function(){
  $(this).toggleClass("active");
  $("#line-1").toggleClass("active");
  $("#line-2").toggleClass("active");
  $("#line-3").toggleClass("active");
  $("#menu").slideToggle("slow");
});

$(window).on("scroll", function() {
    if($(window).scrollTop() > 50) {
        $(".header").addClass("active");
    } else {
        //remove the background property so it comes transparent again (defined in your css)
       $(".header").removeClass("active");
    }
});

$('#software-number').on('input', function() {
  var text = $(this).val();
  $.ajax({
    type: 'GET',
    url: '../includes/softwaresearch.php',
    data: 'txt=' + text,
    success: function(data){
      $("#alert-area").html(data);
    }
  });
});

$('#hardware-number').on('input', function() {
  var text = $(this).val();
  $.ajax({
    type: 'GET',
    url: '../includes/hardwaresearch.php',
    data: 'txt=' + text,
    success: function(data){
      $("#alert-area-2").html(data);
    }
  });
});

$('#hardware-number').on('change', function() {
  var text = $(this).val();
  $.ajax({
    type: 'GET',
    url: '../includes/hardwaresearch.php',
    data: 'txt=' + text,
    success: function(data){
      $("#specialist-area").html(data);
    }
  });
});

$('#specialist-box').on('change', function() {
  var text = $(this).val();
  $.ajax({
    type: 'GET',
    url: '../includes/specialist.php',
    data: 'txt=' + text,
    success: function(data){
      $("#specialist-area").html(data);
    }
  });
});

function showSearch() {
  //retrieve search term
  if (pagetype == "dash") {
    var page = document.getElementById("panel");
  } else {
    var page = document.getElementById("panel");
  }
  var term = document.getElementById("search").value;
  var search = document.getElementById("searchresults");
  var cancel = document.getElementById("cancelsearch");
  var output = document.getElementById("searchterm");
  output.innerHTML = term;
  $.ajax({
  	type: 'GET',
  	url: '../includes/search.php',
  	data: 'txt=' + term,
  	success: function(data){
  		$("#search-results").html(data);
  	}
  });

  //hide/show dashboard and search
  if (term.length==0) {
    closeNav();
  } else {
    page.style.display = "none";
    search.style.display = "block";
    cancel.style.display = "block";
    openNav();
  }
}

$("#status-type").on('change', function() {
    if ($(this).val() == 'Call'){
        document.getElementById('name-input').style.display = 'block';
    } else {
        document.getElementById('name-input').style.display = 'none';
    }
});

var mac = ["10.0 Cheetah", "10.1 Puma", "10.2 Jaguar", "10.3 Panther", "10.4 Tiger", "10.5 Leopard", "10.6 Snow Leopard", "10.7 Lion", "10.8 Mountain Lion", "10.9 Mavericks", "10.10 Yosemite", "10.11 El Capitan", "10.12 Sierra", "10.13 High Sierra"];

for (var i=0;i<mac.length;i++){
  $('<option/>').val(mac[i]).html(mac[i]).appendTo('#os-version');
}

$("#os-type").on('change', function() {
  var mac = ["10.0 Cheetah", "10.1 Puma", "10.2 Jaguar", "10.3 Panther", "10.4 Tiger", "10.5 Leopard", "10.6 Snow Leopard", "10.7 Lion", "10.8 Mountain Lion", "10.9 Mavericks", "10.10 Yosemite", "10.11 El Capitan", "10.12 Sierra", "10.13 High Sierra"];
  var windows = ["XP", "Vista", "7", "8", "10"];
  var linux = ["Ubuntu", "Fedora", "Arch Linux", "CentOS", "Debian"];
    if ($(this).val() == "MacOS") {
      $('#os-version').empty();
      for (var i=0;i<mac.length;i++){
        $('<option/>').val(mac[i]).html(mac[i]).appendTo('#os-version');
      }
    } else if ($(this).val() == "Windows") {
      $('#os-version').empty();
      for (var i=0;i<windows.length;i++){
        $('<option/>').val(windows[i]).html(windows[i]).appendTo('#os-version');
      }
    } else if ($(this).val() == "Linux") {
      $('#os-version').empty();
      for (var i=0;i<linux.length;i++){
        $('<option/>').val(linux[i]).html(linux[i]).appendTo('#os-version');
      }
    }
});

$("#checkbox-solved").on('change', function() {
    if (document.getElementById('solution-button').style.display == 'none'){
        document.getElementById('solution-button').style.display = 'block';
    } else {
        document.getElementById('solution-button').style.display = 'none';
    }
});

$("#checkbox-create-problem-type").on('change', function() {
    if (document.getElementById('new-problem-type').style.display == 'none'){
        document.getElementById('new-problem-type').style.display = 'block';
        document.getElementById('problem-type').style.display = 'none';
    } else {
        document.getElementById('new-problem-type').style.display = 'none';
        document.getElementById('problem-type').style.display = 'block';
    }
});

$("#checkbox-solved-status").on('change', function() {
    if (document.getElementById('enter-solution').style.display == 'none'){

        document.getElementById('enter-solution').style.display = 'block';
    } else {
        document.getElementById('enter-solution').style.display = 'none';
    }
});

function clearSearch() {
  document.getElementById("search").value = "";
  showSearch(pagetype);
  document.getElementById('search').focus();
}

function toggleClosed() {
  var closedProblems = document.getElementsByClassName("closed");
  if (closedProblems[0].style.display == "none") {
    for(var i =0, il = closedProblems.length;i<il;i++){
      $(closedProblems[i]).fadeIn(500,function(){
          $(this).css({display:'flex', "visibility":"visible"}).slideDown();
      });
    }
    document.getElementById("toggle").innerHTML = "Hide Closed Problems";
  } else {
    for (var i =0, il = closedProblems.length;i<il;i++){
      $(closedProblems[i]).fadeOut(500,function(){
          $(this).css({"visibility":"hidden",display:'none',transition: 'none'}).slideUp();
      });
    }
    document.getElementById("toggle").innerHTML = "Show Closed Problems";

  }
}

function openNav() {
    document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  if (pagetype == "dash") {
    var page = document.getElementById("panel");
  } else {
    var page = document.getElementById("panel");
  }
  var search = document.getElementById("searchresults");
  var cancel = document.getElementById("cancelsearch");
  var output = document.getElementById("searchterm");
    page.style.display = "block";
    search.style.display = "none";
    cancel.style.display = "none";
    document.getElementById("myNav").style.height = "0%";
}

$(window).click(function() {
//Hide the menus if visible
});

$('#menu').click(function(event){
    event.stopPropagation();
});

$(".info-item .btn").click(function(){
  $(".container").toggleClass("log-in");
});
$(".container-form .btn").click(function(){
  $(".container").addClass("active");
});
