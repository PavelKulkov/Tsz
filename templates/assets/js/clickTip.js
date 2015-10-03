$(function() { 
 $('a.linktip').wrap('<span class="tip" />');
  $('span.tip').each(function(){
	myTip = $(this),
	tipLink = myTip.children('a'),
	tBlock = myTip.children('span').length,
	tTitle = typeof tipLink.attr('title') != 'undefined',
	tipText = tipLink.attr('title');
	tipLink.removeAttr("title");
	if(tBlock === 0 && tTitle === true){myTip.append('<span class="answer">' + tipText + '</span>')};

    var tip = myTip.find('span.answer , span.answer-left').hide();

    tipLink.has('em').click(showTip).siblings('span').append('<b class="close">X</b>');

    tipLink.not($('em').parent()).hoverIntent(
		showTip,
	function(){
		tip.fadeOut(200);}
    );

    tip.on('click', '.close', function(){                  
		tip.fadeOut(200);}
    );

    function showTip(e){
       xM = e.pageX, 
       yM = e.pageY,
       tipW = tip.width(),
       tipH = tip.height(),
       winW = $(window).width(),
       winH = $(window).height(),
       scrollwinH = $(window).scrollTop(),
       scrollwinW = $(window).scrollLeft(),
       curwinH = $(window).scrollTop() + $(window).height();
    if ( xM > scrollwinW + tipW * 2 ) {tip.removeClass('answer').addClass('answer-left');}
       else {tip.removeClass('answer-left').addClass('answer');}
    if ( yM > scrollwinH + tipH && yM > curwinH / 2 ) {tip.addClass('a-top');} 
       else {tip.removeClass('a-top');}
    tip.fadeIn(100).css('display','block');
   e.preventDefault();
   };
 });
});