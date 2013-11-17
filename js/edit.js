$(document).ready(function() {
	$('#slide').on('click', '.listitem', function() {
		var item = $(this);
		var id = item.attr('id');
		var slideid = item.attr('data-slideid');
		item.html('');

		$.post('php/editslide.php', { id: id, slideid: slideid }, function(data) {
			item.attr('class', 'editing');
			item.html(data);
			item.after("<button data-slideid=" + slideid + " data-id=" + id + ">Save</button");
		}, "json");
	});

	$('#slide').on('click', 'button', function() {
		var button = $(this);
		var saveid = button.attr('data-id');
		var saveslideid = button.attr('data-slideid');
		var input = $("input[data-inputid=" + saveid + "]");
		var content = input.val();
		$.post('php/editslide.php', { saveid: saveid, saveslideid: saveslideid, content: content }, function(data) {
			button.remove();
			input.remove();
			$("li[id=" + saveid + "]").append(data);
			$("li[id=" + saveid + "]").attr('class', 'listitem');
		});
	});
});