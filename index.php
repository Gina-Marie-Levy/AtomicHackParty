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

	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

	<script src="js/app.js"></script>


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

</body>
</html>