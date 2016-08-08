function init()
{
    var newImg = new Image();
    newImg.onload = function()
	{
		var imgHeight = $("#img").height();
		var imgWidth = $("#img").width();

		var dd = browserDimensions();
		var targetHeight = dd.height * 0.96;
		var maxWidth = dd.width * 0.96;

		var calcWidth = Math.min(Math.floor((imgWidth * targetHeight) / imgHeight), maxWidth);
		var calcHeight = Math.floor( calcWidth * imgHeight / imgWidth );

		$("#background").width(dd.width);
		$("#background").height(dd.height);
		$("#background").css('margin-left', -dd.width/2);
		$("#background").css('margin-top', -dd.height/2);

		$("#photo").width(calcWidth);
		$("#photo").height(calcHeight);
		$("#photo").css('margin-left', -calcWidth/2);
		$("#photo").css('margin-top', -calcHeight/2);

		$("#img").width(calcWidth);
		$("#img").height(calcHeight);

		$("#title_text").css('font-size', ((calcHeight*0.05) + 'px'));
		$("#date_text").css('font-size', ((calcHeight*0.04) + 'px'));
		$("#logo_image").height(calcHeight*0.1);

		$("#title").css('bottom', calcHeight*0.03);
		$("#title").css('left', calcHeight*0.03);

		$("#date").css('top', calcHeight*0.0075);
		$("#date").css('right', calcHeight*0.0075);

		$("#logo").css('top', calcHeight*0.02);
		$("#logo").css('left', calcHeight*0.02);

	}
    newImg.src = $("#img").attr("src");
}

$(init);

