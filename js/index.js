$(function(){
	
	//On purge les sections
	$('#cont').html('');
	$('#inscription').html('');
	// get cookie


	//On recupère le texte contenu dans la balise <span id="cookContent">
	var x = $('#cookContent').text();

	if(x.length < 31) //si la longueur est inférieure à 31 (le formulaire d'inscription limite la taille du pseudo à 30 caractères)
	{
		$('#cont').html('<img id="iconeNewRepertoire" src="img/new_repertoire.png"><span id="textBouton">Ajouter un répertoire</span>'); // on affiche le contenu correspondant
		

		$('#iconeNewRepertoire').mouseover(function()
		{
		//$(this).css('width', '120px');
			$(this).attr('src', 'img/New_repertoire_bis.png')
		});
		$('#iconeNewRepertoire').mouseout(function()
		{
		//$(this).css('width', '100px');
			$(this).attr('src', 'img/New_repertoire.png')
		});
		$('#iconeNewRepertoire').click(function(){
			window.location.href = 'newrep.php';
		})
		$('.anonyme').hide();// on masque les boutons de menus inadéquats

		if($('.repLigne').html() == undefined)//Si la balise contenant les repertoires est vide
		{
			$('#rep').html("<div id='bouh'<p>Hey " + $('#cookContent').text() + "!</p><p>Tu n'as encore aucun répertoire!</div>");
		}
		else //Sinon, on ne fait rien!
		{ 
		};

		// Word Cloud
		var newObjet = localStorage.getItem('objet');
		console.log('newObjet = ' + newObjet);
		const myData = JSON.parse(newObjet);
		$('#wordCloud').jQWCloud({
			words: myData,
			// title
			title: 'Mes tags',
			// min/max font size
			minFont: 18,
			maxFont: 50,
			// font offset
			fontOffset: 0,
			// shows the algorithm of creating the word cloud
			showSpaceDIV: false,
			// Enables the vertical alignment of words
			verticalEnabled: true,
			// color
			cloud_color: null,
			// font family
			cloud_font_family: null,
			// color of covering divs
			spaceDIVColor: 'white',
			// left padding of words
			padding_left: null,
			// classes with space to be applied on each word
			word_common_classes: null,
			word_mouseEnter : function(){$(this).css('text-decoration', 'underline');},
			word_mouseOut: function(){$(this).css('text-decoration', 'none');},
			word_click : function(){
				var value = $(this).text();
				Cookies.set("tag", value);
				window.location.href= "tag.php";
			}
		});
	}
	else //sinon (le cookie est absent, dans ce cas le texte contenu dans cette balise vaut une chaine de fonction de 179 caractères)
	{
		$('#inscription').html('<p>Pas encore membre?</p><p>Cliquez <a href="form_inscription.php">ici</a> pour vous inscrire et profiter de myRep!</p>'); // on affiche l'autre contenu
		$('#bienvenue').html('Utilisateur non enregistré');// On modifie le message de bienvenue
		$('#bienvenue').css('color', 'rgba(255, 0, 0, 0.6');// on le rend "joli"
		$('.membre').hide();// On masque les boutons obsoletes		
	};
	$('footer').mouseover(function()
	{
		$('footer').css('background-color', 'rgba(0, 0, 0, 0.7');
		$('#foot').css('color', 'rgba(255, 255, 255, 0.9');
	});
	$('footer').mouseout(function()
	{
		$('footer').css('background-color', 'rgba(0, 0, 0, 0.6');
		$('#foot').css('color', 'rgba(255, 255, 255, 0.4)');
	});
	$('#rep a').click(function(){ // On definit un cookie qui contient le texte du lien qui a été cliqué, et on passe à la page edit.php
		var data = this.text;
		var id = this.id;
		console.log(id);
		Cookies.set("titreClick", data);
		Cookies.set("Id_rep", id);
		window.location.href = 'edit.php';		
	});	
	//Gestion du DIV coulissant
	// On utilise toggle sur la classe et on definit des propriétés de transition css
	$('#iconeDivCoul').click(function() {
		$('.transform').toggleClass('transform-active');
	});
	// Activation des infobulles personalisées avec tooltipster
	$('.infobulle').tooltipster();

	//clic sur le lien de suppression de liste------------
	$('.edition a').click(function(){
		console.log(this.className);
		var listId = this.className;
		Cookies.set("listId", listId);
	});

	$('.remov').click(function(){
		confirmSubmit();//Astuce : Definir la fonction en Javascript et l'appeler en JQuery
	});

// afficher un popup avec formulaire d'ajout de ligne lors du clic sur "ajouter"
	function afficherPopup(message) {
		// crée la division qui sera convertie en popup
		$('body').append('<div id="popup" title="Ajouter une entrée à la liste"></div>');
		$("#popup").html(message);
		// transforme la division en popup
		var popup = $("#popup").dialog({
			autoOpen: true,
			width: 400,
			dialogClass: 'dialogstyleperso',
			buttons: [
				/*{
					text: "Ajouter",
					"class": 'ui-state-information',
					click: function () {
						$(this).dialog("close");
						$('#popup').remove();
					}
				},*/
				{
					text: "Annuler",
					"class": 'ui-state-information',
					click: function() {
						$(this).dialog("close");
						$('#popup').remove();
					}
				}
			]
		});

		// ajouter le style à la barre de titre
		// note : on n'utilise pas .dialogClass dans la définition de la boîte de dialogue car mettrait tout le fond en couleur
		$("#popup").prev().addClass('ui-state-information');
		return popup;
	}
	$('.modific').click(function(){
		afficherPopup('<form method="POST" action="modiflist.php"><input type="text" id="item" name="item" placeholder="Saisissez le texte" /><br /><input type="submit" value="Ajouter" /></form>');
	});

	// Contact form ---------------------------------------

	function contactForm(message){
		$('body').append('<div id="contactForm" title="Formulaire de contact"></div>');
		$('#contactForm').html(message);
		var contactForm = $('#contactForm').dialog({
			autoOpen: true,
			width: 500,
			dialogClass: 'dialogstyleperso',
			buttons: [
				/*{
					text: "Ajouter",
					"class": 'ui-state-information',
					click: function () {
						$(this).dialog("close");
						$('#popup').remove();
					}
				},*/
				{
					text: "Annuler",
					"class": 'ui-state-information',
					click: function() {
						$(this).dialog("close");
						$('#contactForm').remove();
					}
				}
			]
		});
		$('#contactForm').prev().addClass('ui-state-information');
		return contactForm;
	}
	$("#contact").click(function(){
		contactForm('<form method="POST" action="contact.php"><label for="email">Votre adresse email</label><input type="email" id="email" name="email" placeholder="yourmail@xyz.com" required /><br /><label for="mess">Votre message : </label><br /><textarea id="mess" name="mess" placeholder="Saisissez votre message" rows="4" required></textarea><br /><input type="submit" id="valid" value="Envoyer" />')
	})

});