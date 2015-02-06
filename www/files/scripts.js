$('section.expand a.expand-btn').on('click', function(e){
	e.preventDefault();
	$(this).parent().toggleClass('closed');
});

$('.tap-to-call, .top-btn').on('click', function(e){
	var btn = $(this),
		detector = $('.numberDetector');

	if (detector.html() !== '') {
		if (detector.find('a').length > 0) {
			btn.attr('href', detector.find('a').attr('href'));
		} else {
			btn.attr('href', 'tel:' + detector.html())
		}
	}
});