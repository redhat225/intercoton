	  $(document).ready(function() {
	    $('.final-tiles-gallery').finalTilesGallery({
	      margin: 20,
	      gridSize: 40,
	      layout: 'columns'
	  });

	    $('.tabs-cooperative-link').on('click', function(){
	    	$('.tabs-cooperative-link').removeClass('is-active');
	    	$(this).addClass('is-active');
	    });
	});
