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
			<li><a href="#">Contact</a></li>
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

      <h3>Leave your Comment</h3>

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