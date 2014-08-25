$('#form').on('submit', function(){
	var that = $(this),
		contents = that.serialize();

		$.ajax({
			url: 'proccess.php',
			dataType: 'json',
			type: 'post',
			data: contents,
			success: function(data){
				if (data.success) {
					$('.message').addClass('alert alert-success').text(data.feedback);

					$('#form input').val('');
					$('#form textarea').val('');
				} else {
					$('.message').addClass('alert alert-warning').text(data.feedback).show("slow");
					$(':input').on("focus", function(){
						$('.message').hide("slow");
					})
				}
			}
		});

	return false;
});