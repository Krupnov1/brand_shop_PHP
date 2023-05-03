<div class="admin">
	<h2>Заказы</h2>
	<table class="table">
	<tr>
	<th>№</th>
		<th>ID заказа</th>
		<th>Имя</th>
		<th>Почта</th>
		<th>Телефон</th>
		<th>ID товара</th>
		<th>Количество товара</th>
		<th>Дата и время заказа</th>
		<th>Статус</th>
		<th>Изменить статус</th>
		<th>Удалить заказ</th>
	</tr>

	<?php foreach($admin as $item):?>

		<tr data-id="<?=$item['id'] ?>" class="section"> 
			<td><?=$item['number'] ?></td>
			<td><?=$item['id'] ?></td>
			<td><?= $item['name'] ?></td>
			<td><?= $item['email'] ?></td>
			<td><?= $item['phone'] ?></td> 
			<td><?= $item['id_product'] ?></td>
			<td><?= $item['quantity'] ?></td>
			<td><?= $item['date'] ?></td>
			<td><input class="quantity admin_input" data-edit="<?=$item['id'] ?>" data-input="<?=$item['id_basket'] ?>" type="text" value="<?=$item['status'] ?>"></td>
			<td><button class="admin_edit" data-id="<?=$item['id'] ?>" value="<?=$item['id_product'] ?>">
				<i class="fas fa-times-circle"></i></button></td>
			<td><button class="act admin_delete" data-id="<?=$item['id'] ?>" data-prod-id="<?=$item['id_product'] ?>" data-quantity="<?=$item['quantity'] ?>">
				<span><i class="color fas fa-times-circle"></i></span></button></td>
		</tr>

	<?php endforeach; ?>

	</table>
</div>


<script>

let button = document.querySelectorAll('.admin_edit');
button.forEach((edit) => {
	edit.addEventListener('click', () => {
		let id = edit.getAttribute('data-id');
		let input = document.querySelectorAll('.admin_input');
			input.forEach((inp) => {
				if (inp.dataset.edit == id) {
					input = inp.value;
				}
			});
		(
			async () => {
				const response = await fetch('/admin/edit', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'}, 
					body: JSON.stringify({
						id: id,
						input: input
					})
				});
				const answer = await response.json();
			}	
		)();
	});
});


let button_del = document.querySelectorAll('.admin_delete');
button_del.forEach((del) => {
	del.addEventListener('click', () => {
		let id_order = del.getAttribute('data-id');

		if (del.dataset.id == id_order) {
			id = del.dataset.id
		};
		(
			async () => {
				const response = await fetch('/admin/delete', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'},
					body: JSON.stringify({
						id: id
					})
				});
				const answer = await response.json();
				let section = document.querySelectorAll('.section');
				section.forEach((sec) => {
					if (sec.dataset.id == id) {
						sec.remove();
					}
				});
			}
		)();
	});
});

</script>











