<div id="sidebar">
	<a href="/"><h1 id="logo">sisterhood of the unbuttoning pants - coming soon</h1></a>
	<div id="twitter">
	</div>
</div>

<div id="main">
	
	<ul id="navigation">
		<li<?php if(is_category('pantsarazzi')) echo ' class="current"';?>><a href="/category/pantsarazzi" id="nav-pantsarazzi">pantsarazzi</a></li>
		<li<?php if(is_category('pants-rants')) echo ' class="current"';?>><a href="/category/pants-rants" id="nav-pantsrants">pantsrants</a></li>
		<li<?php if(is_category('pants-reviews')) echo ' class="current"';?>><a href="/category/pants-reviews" id="nav-pantsreviews">pantsreviews</a></li>
		<li<?php if(is_category('pants-stance')) echo ' class="current"';?>><a href="/category/pants-stance" id="nav-pantsstance">pantsstance</a></li>
		<li<?php if(is_page('the-sisters')) echo ' class="current"';?>><a href="/the-sisters" id="nav-thesisters">thesisters</a></li>
	</ul>
	<?php
		if(!is_home()) {
			echo '<hr class="subdivider">';
		}
	?>

	<?php
	
		if(is_home()) {
			?>
			<p id="intro">
				Welcome to the Sisterhood! If you have ever been full, stuffed, and forced to undo a button because you just love food so much, then you are one of us... This site is for the overindulged, the overserved, and proud of it...
			</p>
			<?php
		}
	
	?>