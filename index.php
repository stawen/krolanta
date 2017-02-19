<?php
/*****************************************************
* Projet : Okovision - Supervision chaudiere OeKofen
* Auteur : Stawen Dronek
* Utilisation commerciale interdite sans mon accord
******************************************************/

	include_once 'config.php';
	include_once '_templates/header.php';
	include_once '_templates/menu.php';
?>   

    <div class="container" role="main">
		
		
			<?php if( !session::getInstance()->getVar('logged') ){   ?>
				<div class="page-header" align="center">
						<img src="/images/krolanta.png" >
    			</div>
			
			<?php } else {?>
			<div class="page-header">
				
				<div id="inwork" ><br/><br/><span class="glyphicon glyphicon-refresh glyphicon-spin"></span>&nbsp; Work in progress.....</div>

				<ol class="breadcrumb left" id="breadcrumb">
				 
				</ol>
				<table id="listFile" class="table table-hover">
			        <thead>
			            <tr>
			            	<th class="col-md-1"></th>
			                <th class="col-md-10"></th>
			                <th class="col-md-1"></th>
			           </tr>
			        </thead>
			    
			        <tbody>
			        </tbody>
			
			    </table>
						
						
						
			</div>
			
			<?php } ?>
		</div>	
		 
		 
		 
		 <!-- modal -->
		
		<div class="modal fade" id="modal_mosaic" tabindex="-1" role="dialog" aria-labelledby="modal_mosaic" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <!--div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        
		      </div-->
		      <div class="modal-body">
		        <img src="" id="imgMosaic"  style="width:100%;">
		      </div>
		    </div>
		  </div>
		</div>
		 
		 <div class="modal fade" id="modal_sample" tabindex="-1" role="dialog" aria-labelledby="modal_sample" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <!--div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        
		      </div-->
		      <div class="modal-body">
		      	<div align="center" class="embed-responsive embed-responsive-16by9">
    				<video controls autoplay class="embed-responsive-item">
        				<source id="vidSample" src="" type="video/mp4" />
    				</video>
    			</div>
		      </div>
		    </div>
		  </div>
		</div>
		 
		 	

<?php
include('_templates/footer.php');
?>
<!--appel des scripts personnels de la page -->
<?php if( session::getInstance()->getVar('logged') ){   ?>
	<script src="js/index.js"></script>
<?php }?>	
	</body>
</html>