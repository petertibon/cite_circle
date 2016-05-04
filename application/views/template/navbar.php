<?php if  ( $this->aauth->is_loggedin() ){?>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">WebSiteName</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><?php echo anchor('home','Home')?></li>
	      <li><?php echo anchor('login/logout','Logout')?></li>
	    </ul>
	  </div>
	</nav>
<?php }else{?>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">WebSiteName</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><?php echo anchor('home','Home')?></li>
	   		<li>
			<?php echo anchor('login','Login')?>
			</li>
	      <li><?php echo anchor('register','Register')?></li>
	      <li><a href="#">Page 3</a></li>
	    </ul>
	  </div>
	</nav>
<?php }?>