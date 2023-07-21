<div class="row col-lg-3 m-auto">
	<div class="card product" style="width: 20rem;">

		<img class="card-img-top" width="100%" height="200" src="<?php echo $server; ?>img/products/<?php echo $r['image'];?> ?>" alt="Card Image Caption">

		<div class="card-body">
			<h4 class="card-title"><?php echo $r['title']; ?></h4>
			<p class="card-text"><?php echo $r['brand']; ?></p>
			<p class="price">₹<?php echo $r['price']; ?></p>

			<!-- Button add to cart -->
			<button data-pid="<?php echo $r['id']; ?>" type="button" class="btn buy-button">
				<span class="text-white">
					<i class="fa fa-shopping-cart text-white"></i> 
					Add to cart
				</span>
			</button>

		</div>
	</div>
</div>