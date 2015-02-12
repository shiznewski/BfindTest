$('section.expand a.expand-btn').on('click', function(e){
	e.preventDefault();
	$(this).parent().toggleClass('closed');
});

