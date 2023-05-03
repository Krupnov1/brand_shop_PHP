<div class="wrapper contacts">
	<h1>Отзывы</h1>
	<?=$message?>
	<form class="review_form" action="" method="post">
		<input hidden type="text" name="id" value="<?=$row['id']?>">
		<input id="review_name" class="inputTexts" type="text" placeholder="Ваше имя" name="name" value="<?=$row['name']?>"><br>
		<input id="review_text" class="inputTexts" type="text" placeholder="Ваш отзыв" name="texts" value="<?=$row['texts']?>"><br>
		<input id="review_button" class="inputTexts" type="submit" value="<?=$buttonText?>">
	</form>
	<?php foreach ($reviews as $item): ?>

		<?if ($isAdmin == 'admin'):?>

			<form action="" method="post" class="reviews" data-id="<?=$item['id']?>">
				<b class="name"><?=$item['name']?></b>: <span class="text"><?=$item['texts']?></span>
				<input class="reviews_edit inputTexts" data-edit="<?=$item['id']?>" type="submit" value="Изменить">
				<input class="reviews_delete inputTexts" data-del="<?=$item['id']?>" type="submit" value="Удалить"> 
			</form>

		<?else:?>
			<div class="reviews"><b class="name"><?=$item['name']?></b>: <span class="text"><?=$item['texts']?></span></div>
		<?endif;?>

	<?php endforeach;?>
		
</div>

<script>

let button_review = document.getElementById('review_button');
button_review.addEventListener('click', () => {
	let name = document.getElementById('review_name').value;
	let text = document.getElementById('review_text').value;
	
	(
		async () => {
			const response = await fetch('/reviews/add', {
			method: 'POST',
			headers: {'Content-Type': 'application/json; charset=utf-8'},
				body: JSON.stringify({
					name: name,
					text: text
				})
			});
			const answer = await response.json();
			document.querySelector(".review_form").reset();	
		}
	)();
});


let reviews_edit = document.querySelectorAll('.reviews_edit');
reviews_edit.forEach((edit) => {
	edit.addEventListener('click', () => {
		let id = edit.dataset.edit;
		let name = document.getElementById('review_name').value;
		let texts = document.getElementById('review_text').value;
		(
			async () => {
				const response = await fetch('/reviews/edit', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'},
					body: JSON.stringify({
						id: id,
						name: name,
						texts: texts
					})
				}); 
				const answer = await response.json();
			}	
		)();
	});
});


let reviews_delete = document.querySelectorAll('.reviews_delete');
reviews_delete.forEach((del) => {
	del.addEventListener('click', () => {
		let id_delete = del.dataset.del;
		let form = document.querySelectorAll('.reviews');
		form.forEach((form) => {
			if (form.dataset.id == id_delete) {
				id = id_delete;
			}		
		});
		(
			async () => {
				const response = await fetch('/reviews/delete', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'},
					body: JSON.stringify({
						id: id,
					})
				}); 
				const answer = await response.json();
			}	
		)();
	});
});

</script>


