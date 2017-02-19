/*****************************************************
 * Projet : krolanta - Supervision chaudiere OeKofen
 * Auteur : Stawen Dronek
 * Utilisation commerciale interdite sans mon accord
 ******************************************************/

$(document).ready(function() {
	
	function addFilesRow(json, path){
		
		var typeClass 	= (json.folder)?'class="warning"':'';
		var icon 		= (json.folder)?'<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>':'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>'
		var name 		= (json.folder)?'<a href=# class="folder" data-path="'+ path +'">'+ json.name + '</a>':'<a href="'+ json.url +'">'+ json.name + '</a>';
		var mosaic 		= '';
		var sample 		= '';
		
		if (!json.folder){
			
			if(typeof mosaic !== 'undefined'){
				mosaic = (json.mosaic)?'<button type="button" class="btn btn-xs" id="mosaic"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>':'';
			}
			if(typeof sample !== 'undefined'){
				sample = (json.sample)?'<button type="button" class="btn btn-xs" id="sample"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span></button>':'';
			}
		}
		
		$('#listFile > tbody:last').append('<tr '+ typeClass+ '> \
												<td> ' + icon + '</td>\
												<td> ' + name + '</td>\
		                                        <td> '+ mosaic + ' '+ sample  +' </td> \
		                                    </tr>');
	}
	
	function makeBreadcrumb(url){
		$("#breadcrumb").empty("");
		$('#breadcrumb').append(' <li><a href="#" class="ariane" data-path=""><span class="glyphicon glyphicon-home"></span></a></li>');

		if(typeof url !== 'undefined'){
			var ariane	= [];
			
			$.each(url.split('/'), function(key, val) {
				if(val!==''){
					ariane.push(val);
				}
			});
			
			var nb 		= ariane.length;
			var i		= 1;
			var path 	= "";
			
			$.each(ariane, function(key, val) {
				if(i !== nb){
					path = path + "/" + val;
					$('#breadcrumb').append('<li><a href="#" class="ariane" data-path="'+ path +'">'+ val +'</a></li>');
				}else{
					 $('#breadcrumb').append('<li class="active">'+ val +'</li>');
				}
				i=i+1;
			});
		}
		
	}
	
	function getFileList(path){
		$.api('GET', 'getLastDownload',{'path': path}, 'api').done(function(json) {
		
				$("#inwork").hide();
				$("#listFile> tbody").html("");
				
				makeBreadcrumb(path);
				if(json.list.length === 0){
				    $('#listFile > tbody:last').append('<tr> \
												<td> </td>\
												<td> Vide </td>\
		                                        <td> </td> \
		                                    </tr>');
				}
				$.each(json.list, function(key, val) {
					addFilesRow(val, json.path);
				});
		});
	}
	
	

	
	$("body").on("click", ".folder", function(b) {
		//console.log($(this).data('path'));
		getFileList($(this).data('path') + '/' + $(this).text());
	});
	
	$("body").on("click", ".ariane", function(b) {
		//console.log($(this).data('path'));
		getFileList($(this).data('path'));
	});
	
	$("body").on("click", ".btn", function() {
		
		if ($(this).is("#mosaic")) {
			var img = $(this).closest("tr").find("td:nth-child(2)").children().attr("href") + '.jpg';
			//console.log(img);
			$('#imgMosaic').attr('src', img);
			$('#modal_mosaic').modal('show');
			//console.log($(this).find("a"));
		}
		if ($(this).is("#sample")) {
			var vid = $(this).closest("tr").find("td:nth-child(2)").children().attr("href") + '.mp4';
			//console.log(vid);
			$('#vidSample').attr('src', vid);
			$(".embed-responsive video")[0].load();
			$('#modal_sample').modal('show');
			
		}
		
	});
	
	$('#modal_sample').on('hide.bs.modal', function(e) {
		$(".embed-responsive video")[0].pause();
	});
	
	
	
	getFileList('TORRENT');
	
});
