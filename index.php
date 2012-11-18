 <!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<title>Feeds for Me</title>
		<link rel="stylesheet" href="global.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		</head>
	<body>
		<div id="header">
			<h1>My Feeds</h1>
			<div id="navBar">
				<ul id="myFeeds">
					<li><a href="#">Techcrunch</a></li>
				</ul>
			</div>
		</div>

		<div id="mainContainer">
			<div id="feedContainer">
				<!-- Location of feeds and posts -->
			</div>
		</div>
		
  <!-- Google Reader API calls and Filling in feed -->
	<script type="text/javascript">
		/*** GLOBAL VARS ***/ 
		FEED_LIMIT = 10;
		/*******************/		

    google.load("feeds", "1");

    function initialize() {
      var feed = new google.feeds.Feed("http://feeds.feedburner.com/TechCrunch/");
			feed.setNumEntries( FEED_LIMIT );
      feed.load(function(result) {
        if (!result.error) {
          var feedContainer = $("#feedContainer");
          for (var i = 0; i < result.feed.entries.length; ++i) {
            var entry = result.feed.entries[i];
						var postImg = $(entry.content).closest("img");
						var imgWidth = postImg.attr("width");
						var imgHeight = postImg.attr("height");
						var imgSrc = postImg.attr("src");
						var imgHTML = "<img width=\"" + imgWidth + "\"height=\"" + imgHeight + "\" src=\"" + imgSrc + "\" />";
						var title = "headline" + i;
						var postTemplate = "" +
							"<div class=\"postContainer\">" +
								"<span class=\"postImg\">" + imgHTML  + "</span>" +
								"<span class=\"postHeadline\" id=\"" + title + "\">" + entry.title + "</span>" +
								"<span class=\"postDate\">" + entry.publishedDate + "</span><br><br><br><br>" +
								"<div class=\"postContent\">" + entry.content + "</div><br><br><br><br><br>" +
							"</div>";
						
						feedContainer.append(postTemplate);
						$("#" + title ).bind("click", displayPost);  //Bind click event listener to open view to display post
          }
					$(".postContent").hide();
        }
      });
    }
    google.setOnLoadCallback(initialize);
		
		/** Function to display post contents when user clicks on headline **/
		function displayPost(){
			var postView = "" +
					"<div id =\"postView\"><div id=\"view\">" + 
						"<h2>" + $(this).parent().children(".postHeadline").html() + "</h2>" + 
						$(this).parent().children(".postContent").html() + 
					"<p id=\"closeView\">x</p></div></div>";
			$("body").append(postView);
			$("#closeView").bind("click", removeView); //bind click to event listener to close view
		}

		/** function to remove view **/
		function removeView(){
			$("#postView").remove();
		}

		/** JS for posting comments **/
		/** Code adapted from http://mark.koli.ch/2009/09/use-javascript-and-jquery-to-get-user-selected-text.html **/
		$(document).ready( function() {
			$(this).bind("mouseup", inputComments);
		});		

		function inputComments(){
			var commentLocStr = getHighlightedText();
			var commentBox = "<div class=\"commentBox\"><textarea name=\"comment\"></textarea></div>";
			if ( commentLocStr != '' ){
				$("#postView:text").find( commentLocStr ).parent().append(commentBox);
				console.log($("#postView").closest( "\"" + commentLocStr + "\"" ).length);//.parent().html());
			}
		}

		function getHighlightedText(){ //called from inputComments
			var selectedText = "";
 			if(window.getSelection)
    		selectedText = window.getSelection();
  		else if(document.getSelection)
    		selecteText = document.getSelection();
  		else if(document.selection)
    		selectedText = document.selection.createRange().text;
			return selectedText;
		}
		/***** END JS for comments ****/
	</script>
  <!-- END Google Reader API calls -->

	</body>
</html>
