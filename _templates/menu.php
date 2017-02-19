 <?php
 /*****************************************************
* Projet : Okovision - Supervision chaudiere OeKofen
* Auteur : Stawen Dronek
* Utilisation commerciale interdite sans mon accord
******************************************************/

function getMenu(){
	//global $page;
	$page = basename($_SERVER['SCRIPT_NAME']);
	
	$menu = array(  'index.php' => array(
	                                    'txt' => 'Fichiers',
	                                    'icon' => 'glyphicon glyphicon-folder-open',
	                                    'logged' => true),
					'torrent.php' => array(
					                    'txt' => 'Torrents',
					                    'icon' => 'glyphicon glyphicon-cloud-download',
					                    'logged' => true)
			);	
	
	foreach ($menu as $url => $title){
	    if($title['logged'] && !session::getInstance()->getVar('logged')) continue;
		$active = '';
		if ($page == $url) $active=' class="active"';  
	    echo '<li'.$active.'> <a href='.$url.'><span class="'.$title['icon'].'" aria-hidden="true"></span>   '.$title['txt'].'</a></li>';
	}
}

?>
 <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Krolanta</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav top-nav navbar-right">
            <?php getmenu(); ?>
			<li class="dropdown">
			  <?php if( !session::getInstance()->getVar('logged') ){   ?>
			    <a href="#" data-toggle="modal" data-target="#login-modal"> 
			        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;
			     </a>
			  <?php } else { ?>
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			    </a>
			    <ul class="dropdown-menu">
			       <li><a id="btlogout" href="">Deconnexion</a></li>
			    </ul>    
            <?php } ?>    
            </li>
			
           </ul>
		  
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    	  <div class="modal-dialog">
    	      <div class="modal-content">    
        	    <div class="modal-header">
    			    <h2>Login</h2>
                </div>
                <div class="modal-body">
                    <form id="formlogin" class="form-signin">
                        <p><label for="inputUser" class="sr-only">Identifiant</label>
                        <input type="text" id="inputUser" class="form-control" placeholder="Identifiant" required autofocus>
                        <label for="inputPassword" class="sr-only">Mot de passe</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required></p>
                        <p><button class="btn btn-lg btn-primary btn-block"id="btlogin">Login</button></p>
                        <br/>
                    </form>
                    
    			</div>
    	    </div>  	
		  </div>
    </div>

    
    <br/>