$(document).ready(function() {

	$("a.has-parent").click(function() {
		$(this).toggleClass("is-active");
		var children = $(this).attr("data-children");
		$("ul[data-children=" + children + "]").toggle();
	});

	// Get currently page
	var currentPage = $("a.is-active").closest("ul");
	$("a.has-parent[data-children=" + currentPage.attr("data-children") + "]").toggleClass("is-active");
	currentPage.show();

	// Random color assign to tile
	var randomColor = ["is-primary", "is-link", "is-info", "is-success", "is-danger", "is-dark"];
	$(".tile.is-child.notification").each(function() {
		var color = randomColor[Math.floor(Math.random() * randomColor.length)];
		//$(this).addClass(color);
	});
});