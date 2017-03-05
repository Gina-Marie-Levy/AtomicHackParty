<?php
require('Action.php');
$comment_post_ID = 1;
$db = new Action();
$comments = $db->get_comments($comment_post_ID);
$has_comments = (count($comments) > 0);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Skimmer Alert!</title>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" href="css/main.css" type="text/css" />

</head>

<body id="index" class="home">
	
	<header id="banner" class="body">
		<h1><a href="#">Skimmer Alerts</a></h1>
		<nav><ul>
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Live Chat</a></li>
		</ul></nav>
	</header>
	
	<section id="content" class="body">
	  
	  <article class="hentry">	
			<header>
				<h2 class="entry-title"><a href="#" rel="bookmark" title="Alerting the Community of Where they Detected a Skimmer">Building a Community of Trust</a></h2>
			</header>
			
			<footer class="post-info">
				<abbr class="published" title="2012-02-10T14:07:00-07:00">
					4th March 2017
				</abbr>

				<address class="vcard author">
					By <a class="url fn" href="#">Gina Levy</a>
				</address>
			</footer>
			
			<div class="entry-content">
				<p>There has been an increase in number of people getting their credit cards number digitally stolen over the years. 
				This is done by skimmers that are commonly found in gas stations, stores, and in other sketchy areas.
				By banning together as a community we can voice our concerns and post where we have been last "hacked" 
				to help others avoid the same area and let the proper authorities know about it as well.</p>
			</div>
		</article>
		<img src="images/map.jpg" alt="Skimmer Map" style="float: center;">
		
	</section>

	<section id="comments" class="body">	 

</head>
<body>

<h3>State Cracking down on gas-pump skimmers</h3>

<iframe width="560" height="315" src="https://www.youtube.com/embed/M-c9IU11KmY" frameborder="0" allowfullscreen></iframe>

</section>

	
	<section id="comments" class="body">
	  
	  <header>
			<h2>Skimmer Alert Area</h2>
		</header>

    <ol id="posts-list" class="hfeed<?php echo($has_comments?' has-comments':''); ?>">
      <li class="no-comments">Be the first to add an alert comment.</li>
      <?php
        foreach ($comments as &$comment) {
          ?>
          <li><article id="comment_<?php echo($comment['id']); ?>" class="hentry">	
    				<footer class="post-info">
    					<abbr class="published" title="<?php echo($comment['date']); ?>">
    						<?php echo( date('d F Y', strtotime($comment['date']) ) ); ?>
    					</abbr>

    					<address class="vcard author">
    						By <a class="url fn" href="#"><?php echo($comment['comment_author']); ?></a>
    					</address>
    				</footer>

    				<div class="entry-content">
    					<p><?php echo($comment['comment']); ?></p>
    				</div>
    			</article></li>
          <?php
        }
      ?>
		</ol>
		
		<div id="respond">

      <h3>Leave Your Alert Comment</h3>

      <form action="post_comment.php" method="post" id="commentform">

        <label for="comment_author" class="required">Your name</label>
        <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">
        
        <label for="email" class="required">Your email</label>
        <input type="email" name="email" id="email" value="" tabindex="2" required="required">

        <label for="comment" class="required">Your area and message</label>
        <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>

        <input type="hidden" name="comment_post_ID" value="<?php echo($comment_post_ID); ?>" id="comment_post_ID" />
        <input name="submit" type="submit" value="Submit comment" />
        
      </form>
      
    </div>
			
	</section>

	<section id="comments" class="body">	 

      <style>
input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<form name="htmlform" method="post" action="html_form_send.php">
<table width="450px">
</tr>
<tr>
 <td valign="top">
  <label for="first_name">First Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
 
<tr>
 <td valign="top"">
  <label for="last_name">Last Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Email Address *</label>
 </td>
 <td valign="top">
  <input  type="text" name="email" maxlength="80" size="30">
 </td>
 
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Telephone Number</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="30" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
 
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit"> 
 </td>
</tr>
</table>
</form>
			
	</section>


	
	
	<footer id="contentinfo" class="body">
		<p>2017 <a href="#">Gina M. Levy</a></p>
	</footer>

<script>
$(function() {
  $('#commentform').submit(handleSubmit);
});

function handleSubmit() {
	var form = $(this);
	var data = {
		"comment_author": form.find('#comment_author').val(),
		"email": form.find('#email').val(),
		"comment": form.find('#comment').val(),
		"comment_post_ID": form.find('#comment_post_ID').val()
	};
	
	var socketId = getSocketId();
	if(socketId !== null) {
	  data.socket_id = socketId;
	}

	postComment(data);

	return false;
}

function postComment(data) {
  $.ajax({
    type: 'POST',
    url: 'post_comment.php',
    data: data,
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    },
    success: postSuccess,
    error: postError
  });
}

function postSuccess(data, textStatus, jqXHR) {
  $('#commentform').get(0).reset();
  displayComment(data);
}

function postError(jqXHR, textStatus, errorThrown) {
  // display error
}

function displayComment(data) {
  if ($("#" + data.id).length > 0) {
    // Ignore comment as it already exists
    return
  }
  var commentHtml = createComment(data);
  var commentEl = $(commentHtml);
  commentEl.hide();
  var postsList = $('#posts-list');
  postsList.addClass('has-comments');
  postsList.prepend(commentEl);
  commentEl.slideDown();
}

function createComment(data) {
  var html = '' +
  '<li><article id="' + data.id + '" class="hentry">' +
	  '<footer class="post-info">' +
		  '<abbr class="published" title="' + data.date + '">' +
				parseDisplayDate(data.date) +
			'</abbr>' +
			'<address class="vcard author">' +
				'By <a class="url fn" href="#">' + data.comment_author + '</a>' +
			'</address>' +
		'</footer>' +
		'<div class="entry-content">' +
			'<p>' + data.comment + '</p>' +
		'</div>' +
	'</article></li>';
	
	return html;
}

function parseDisplayDate(date) {
  date = (date instanceof Date? date : new Date( Date.parse(date) ) );
  var display = date.getDate() + ' ' +
                ['January', 'February', 'March',
                 'April', 'May', 'June', 'July',
                 'August', 'September', 'October',
                 'November', 'December'][date.getMonth()] + ' ' +
                date.getFullYear();
  return display;
}

$(function() {
  
  $(document).keyup(function(e) {
    e = e || window.event;
    if(e.keyCode === 85){
      displayComment({
        "comment_id": 'comment_1',
        "comment_post_ID": 1,
        "date": "Tue, 21 Feb 2012 18:33:03 +0000",
        "comment": "The realtime web rocks!",
        "comment_author": "Phil Leggetter"
      });
    }
  });
  
});

</script>
</body>
</html>