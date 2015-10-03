function closeApplet() {
	p = $('.popup__overlay');
	p.css('display', 'none');
}
function printToConsole(word) {
	document.getElementById("signMsg").value = word;
	console.log(word);
}

function getQuery() {
	return encodeURI(document.getElementById("msg").value);
}

$(document).ready(function() {
	p = $('.popup__overlay')
	$('#popup__toggle').click(function() {
		p.css('display', 'block');
	})
	p.click(function(event) {
		e = event || window.event
		if (e.target == this) {
			$(p).css('display', 'block')
		}
	})
	$('.popup__close').click(function() {
		p.css('display', 'none')
	})
});
