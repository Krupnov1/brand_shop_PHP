<div class="wrapper arrivalsProduct">
	<div class="productDetails">
		<span>Product Details</span>
		<div class="prodCategor">
			<span class="categor1">unite price</span>
			<span class="categor2">Quantity(Edit)</span>
			<span class="categor3">shipping</span>
			<span class="categor4">Subtotal</span>
			<span class="categor5">Action</span>
		</div>
	</div>
	
	<?php if (!empty($basket)): ?>

		<?php foreach($basket as $item): ?>

			<section data-id="<?= $item['id_basket']?>" class="productCart">
				<div class="peopleCart">
					<img src="/img/<?= $item['image_file']?>" alt="<?= $item['image_alt']?>">
					<div class="peopleTxt">
						<h4><?= $item['name'] ?></h4>
						<span class="peopleSpanOne">Color: </span><span class="peopleSpanTwo"></span><br>
						<span class="peopleSpanOne">Size:</span><span class="peopleSpanTwo"></span>
					</div>
				</div>
				<div class="shirtCart">
					<div class="uni"><span>Р <?= $item['price'] ?></span></div>

					<div class="qua">
						<input class="quantity" data-edit="<?=$item['id_product']?>" data-input="<?=$item['id_basket']?>" type="text" name="quantity" value="<?= $item['quantity'] ?>">
						<button class="edit" data-id="<?=$item['id_product']?>" name="id_product" value="<?=$item['id_product']?>"><i class="fas fa-times-circle"></i></button>
					</div>
					

					<div class="ship"><span>FREE</span></div>
					<div class="sub"><span>P <?= $item['price'] * $item['quantity']?></span></div>

					<button class="act delete" data-id="<?=$item['id_basket']?>" data-prod-id="<?=$item['id_product']?>" data-quantity="<?=$item['quantity']?>">
						<span><i class="color fas fa-times-circle"></i></span></button>

				</div>
			</section>

		<?php endforeach; ?>

	<?php else: ?>
		<h1 id="info">Корзина пуста</h1>
	<?php endif; ?>

	<div class="shopCart">
		<div class="clearShop">

			<span>ОФОРМИТЕ ЗАКАЗ</span>
		</div>
		<div class="contShop">
			<span>CONTINUE SHOPPING</span>
		</div>
	</div>
	<div class="containerForm">
		<div class="adress">
			<p class="blockOrdersNone">Ваш заказ оформлен!!!</p>
			<form class="adressOne" action="" method="post">
				<h4>Ваше имя, почта и телефон</h4>
				<input id="name" type="text" placeholder="Имя" name="name">
				<input id="email" type="text" placeholder="E-mail" name="email">
				<input id="phone" type="text" placeholder="Телефон" name="phone">
			</form>
			<button id="order">Оформить</button>
		</div>
		<div class="discount">
			<form class="discountOne" action="#">
				<h4>coupon  discount</h4>
				<label for="state">Enter your coupon code if you have one</label>
				<input type="text" id="state" placeholder="State">
				<button>Apply coupon</button>
			</form>
		</div>
		<div class="total">
			<div class="subTtl">

				<?php foreach($sum as $item): ?>

				<span class="sub-total">Sub total P<?= $item['sum']?></span><br>
				<span class="grand">GRAND TOTAL<span class="grdTtl">P <?= $item['sum']?></span></span>

				<?php endforeach; ?>

			</div>
			<button>proceed to checkout</button>
		</div>
	</div>	
</div>


<script>

let button = document.querySelectorAll('.edit');
button.forEach((edit) => {
	edit.addEventListener('click', () => {
		let id_product = edit.getAttribute('data-id');
		let quantity = document.querySelectorAll('.quantity'); 
			quantity.forEach((quant) => {
				if (quant.dataset.edit == id_product) {
					quantity = quant.value;
				}
			});
		(
			async () => {
				const response = await fetch('/basket/edit', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'},
					body: JSON.stringify({
						id_product: id_product,
						quantity: quantity
					})
				}); 
				const answer = await response.json();
			}	
		)();
	});
});

let button_del = document.querySelectorAll('.delete');
button_del.forEach((del) => {
	del.addEventListener('click', () => {
		let id_basket = del.getAttribute('data-id');
		let id_product = del.getAttribute('data-prod-id');
		let quantity = document.querySelectorAll('.quantity');
		quantity.forEach((quan) => {
			if (quan.dataset.input == id_basket) {
				quantity = quan.value;
			}
		});
		(
			async () => {
				const response = await fetch('/basket/delete', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'},
					body: JSON.stringify({
						id_basket: id_basket,
						quantity: quantity,
						id_product: id_product
					})
				});
				const answer = await response.json();
				if(quantity == '1') {
					let section = document.querySelectorAll('.productCart');
					section.forEach((sec) => {
						if (sec.dataset.id == id_basket) {
							sec.remove();
						}
					});
					document.getElementById('count').innerText = answer.count;
				} else {
					let input = document.querySelectorAll('.quantity');
					input.forEach((inp) => {
						let id_input = inp.dataset.input;
						if (id_input == id_basket) {
							inp.defaultValue = String(quantity - 1);
						}
					});
				} 
			}
		)();
	});
});

let button_order = document.getElementById('order');
button_order.addEventListener('click', () => {
	let name = document.getElementById('name').value;
	let email = document.getElementById('email').value;
	let phone = document.getElementById('phone').value;

	(
		async () => {
			const response = await fetch('/order/add', {
			method: 'POST',
			headers: {'Content-Type': 'application/json; charset=utf-8'},
				body: JSON.stringify({
					name: name,
					email: email,
					phone: phone
				})
			});
			const answer = await response.json();

			document.querySelector('.blockOrdersNone').classList.remove("blockOrdersNone");
			document.querySelector(".adressOne").reset();	
		}
	)();
});


</script>
	