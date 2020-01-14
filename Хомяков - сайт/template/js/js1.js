$(document).ready(function() {
	$(".like").bind("click", function() {
		var link = $(this);
		var id = link.data('id');
		$.ajax({
			url: "/like.php", 
			type: "POST",
			data: {id:id}, // Передаем ID нашей статьи
			dataType: "json", 
			success: function(result) {
				if (!result.error){ //если на сервере не произойло ошибки то обновляем количество лайков на странице
					link.addClass('active'); // помечаем лайк как "понравившийся"
					$('.counter',link).html(result.count);
				}else{
					alert(result.message);
				}
			}
		});
	});
});