/*****************************************************
 * Projet : Okovision - Supervision chaudiere OeKofen
 * Auteur : Stawen Dronek
 * Utilisation commerciale interdite sans mon accord
 ******************************************************/
/* global lang, Highcharts, sessionToken, $ */
$(document).ready(function() {

	$(".tip").tooltip({
    	placement: "right",
    	html: true
	});
	
	$.growlUpdateAvailable = function() {
		$.notify({
			icon: 'glyphicon glyphicon-thumbs-up',
			message: lang.text.updateAvailable,
			url: "about.php",
			target: "_self"
		}, {
			z_index: 9999,
			type: 'info',
			placement: {
				from: "bottom",
				align: "right"
			},
			delay: 120000
		});
	};

	$.growlValidate = function(text) {
		$.notify({
			icon: 'glyphicon glyphicon-save',
			message: text
		}, {
			z_index: 9999,
			type: 'success'
		});
	};

	$.growlErreur = function(text) {
		$.notify({
			icon: 'glyphicon glyphicon-exclamation-sign',
			message: text
		}, {
			z_index: 9999,
			type: 'danger'
		});
	};

	$.growlWarning = function(text) {
		$.notify({
			icon: 'glyphicon glyphicon-exclamation-sign',
			message: text
		}, {
			z_index: 9999,
			type: 'warning'
		});
	};
	
	$.api = function(mode, cmd, tab, where, typeSync) {

		//var tmp = cmd.split('.');
		//var urlFinal = 'type=' + tmp[0] + '&action=' + tmp[1];
		var urlFinal;
		//gestion si pas d'arguments supplementaires
		tab = typeof tab !== 'undefined' ? tab : {};
		where = typeof where !== 'undefined' ? where : {};
		typeSync = typeof typeSync !== 'undefined' ? typeSync : true;	
		token = typeof token !== 'undefined' ? token : {};
		
		if(where === 'api'){
			urlFinal = 'http://api.krolanta.fr/index.php?';
			
		}else if(where === 'www'){
			urlFinal = 'http://www.krolanta.fr/ajax.php?';
		}
		
		urlFinal = urlFinal + 'token=' + token + '&action=' + cmd;
	
		var jxhr =  $.ajax({
			url: urlFinal,
			type: mode,
			data: $.param(tab),
			async: typeSync
		}).error(function(e) {
			var msg = 'Prob de communication : ' + cmd;
			//console.log(e);
			$.growlErreur(msg);
		});
		//console.log(jxhr);
		jxhr.done(function(json){
			//console.log(json);
			if (!json.response){
				if(json.sessionToken === 'invalid') {
					$.growlErreur('Erreur de communication : Token Invalid');
					setTimeout(function(){},2500);
					window.location.replace("index.php");
				}
			}
		});
		
		return jxhr;
	};

	
	$("#btlogin").click(function(e){
		var user = $('#inputUser').val();
		var pass = $('#inputPassword').val();
		
		if(user !== '' && pass !== ''){
		
			$.api('POST', 'login', {user: user, pass: pass}, 'www' ,false).done(function(json) {
						
				if(!json.response){
					e.preventDefault();
					$.growlErreur(lang.error.userPassIncorrect);
				}
			});
		}
		
	});
	
	$("#btlogout").click(function(){
		
		$.api('GET', 'logout',{},'www',false).done(function(json) {
				if(json.response){
					window.location.replace("index.php");
				}
			
		});
	});
	


});