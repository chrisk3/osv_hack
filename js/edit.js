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

	$('#slide').on('click', '.title', function() {
		var item = $(this);
		var id = item.attr('id');
		var slideid = item.attr('data-slideid');
		item.html('');

		$.post('php/editslide.php', { id: id, slideid: slideid }, function(data) {
			item.attr('class', 'editing');
			item.html(data);
			item.after("<button id='titlebutton' data-slideid=" + slideid + " data-id=" + id + ">Save</button");
		}, "json");
	});

	$('#slide').on('click', '#titlebutton', function() {
		var button = $(this);
		var saveid = button.attr('data-id');
		var saveslideid = button.attr('data-slideid');
		var input = $("input[data-inputid=" + saveid + "]");
		var content = input.val();
		$.post('php/editslide.php', { saveid: saveid, saveslideid: saveslideid, content: content }, function(data) {
			button.remove();
			input.remove();
			$("#slide").prepend("<h1 class='title' id='title' data-slideid=" + saveslideid + ">" + data + "</h1>");
		});
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

	$('#slidelist').on('click', '.list', function() {
		var slideid = $(this).attr('data-slideid');
		$('#slide').children().remove();
		$.post('php/getslide.php', { slideid: slideid }, function(data){
			$('#slide').html(data);
		}, "json");
	});

	$('#add').click(function(){
		var presentation = $(this).attr('data-presentation');
		$.post('php/getslide.php', { presentation: presentation }, function(data) {
			$('#slidelist').append(data);
		}, "json");
	});
});