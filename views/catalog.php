<div class="catalogs">

	<?php foreach ($catalog as $item) : ?>

		<section class="product">
			<div class="productMiddle">
					<div class="productBackground">
						<div class="product_fon">
							<a href="/product/card/?id=<?= $item['id'] ?>">Подробное описание</a> 
						</div>
					</div>
						<div class="imgProduct">
							<img src="/img/<?= $item['image_file'] ?>" alt="<?= $item['image_alt'] ?>" width='320' height='341'>
						</div>
				<h3 class="productText"><?= $item['name'] ?></h3>
				<h4 class="productText">(<?= $item['likes'] ?>)</h4>
			</div>
		</section>

	<?php endforeach; ?>

</div>
<div class="further"><a href="/product/catalog/?page=<?= $page ?>">Далее</a></div>