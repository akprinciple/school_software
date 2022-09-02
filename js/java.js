function time() {
	time = setTimeout('show()', 1000);
}
function display() {
	var x = document.getElementById('animation');
	x.style.display = "block";
	x.style.top = "50px";
}
function cancel() {
	var x = document.getElementById('animation');
	x.style.display = "none";
}
$(document).ready(function () {
	$("#members").click(function () {
		$("#users").slideToggle("slow");
	})
	$("#cli").click(function () {
		$("#re").slideToggle("slow");
	})
	$("#click").click(function () {
		$("#reg").slideToggle("slow");
	})
	$("#small_screen_bar").click(function () {
		$("#left_side").slideToggle("slow").css("display", "block").css("position", "absolute").css("z-index", "2");
	})
	$("#cancel_bar").click(function () {
		$("#left_side").slideToggle("slow").css("display", "none").css("position", "sticky").css("position", "static");
	})

	// $(".big_screen_bar").click(function () {
	// 	// $(".left_side").css("max-width", "0px");
	// 	// $(".col-md-10").css("width", "100%");
	// })

	$("#category").click(function () {
		$(".cat").toggle("slow");
	})
	$(".posts").click(function () {
		$(".post").toggle("slow");
	})
	$(".page").click(function () {
		$(".pages").toggle("slow");
	})
	$(".result_show").click(function () {
		$(".result").slideToggle("slow");
	})


});

$(document).ready(function () {
	$(".fa-bars").click(function () {
		$(".slider").slideToggle('slow');
	})
	$("#tap").click(function () {
		$("#showup").slideToggle("slow");
	})


});