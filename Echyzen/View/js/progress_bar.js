jQuery(document).ready(function(){
	//http://jsfiddle.net/yePcb/3/
	progressBar = {
		countElem : 0,
		loadedElem : 0,
		
		init: function() {
			
			//initialisation
			this.countElem = $('img').length;
			
			// permet d'avoir accès à la class dans la fonction each
			var that = this;
			
			
			/*
				<div id="progressBar">
					<div id="progressBarInside"></div>
				</div>
			*/
			//Construction & ajout de la progressBar
			var $progressBar = '<div id="progressBar"><div id="progressBarInside"></div></div>';
			$('body').append($progressBar);

			

			/*var $container = $('<div/>').attr('id', 'progressBarElem');
			//ajout du container fraichement créer dans le body
			$container.appendTo($('body'));*/
			
			//var $container = '<div id="progressBarElem"></div>';
			//$('body').append($container);

			
			
			//parcours des elements a prendre en compte pour le chargement
			$("img").each(function() {
				//$test = '<img src="' + $(this).attr('src') + '" />';
				$(this).on('load error', function(){
						that.loadedElem++;
						that.updateProgressBar();
					});
					//$('body').append($test)
					
			
			});
			
			// permet d'éliminer les img non load car déjà dans le cache
				$('#progressBarInside').css("width", "100%");
				/*$('#progressBarInside').animate({
					width :  '100%'
				}, 0);*/
			
		},
		
		updateProgressBar : function() {
			
			
			$('#progressBarInside').stop().animate({
				width :  (this.loadedElem / this.countElem) * 100 + '%'
				//width :  '100%'
			}, 0);
		}
	}

	progressBar.init();

});