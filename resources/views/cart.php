<?php

   include_once __DIR__ . '/_partials/_header.php';
	include_once __DIR__ . '/_partials/_toast.php';
?>
   <main class="w-full min-h-screen flex flex-col justify-center items-center px-4 py-8">
		<div class="w-16 h-16 flex items-center justify-center bg-orange-500 rounded-full mb-2">
			<img src="./public/images/shop.svg" alt="shop">
		</div>
		<p class="text-xl text-black text-center font-semibold">Shopping Cart</p>
		<p class="text-xs text-black text-center mb-12">Powered by <span class="text-orange-500">Dragonpay</span></p>

		<div class="w-[min(450px,100%)]">
			<?php
				if ($cart->getTotalQuantity() > 0) :
					foreach ($cart->getItems() as $item) :
			?>

				<div class="flex items-center justify-between border border-gray-200 rounded-md gap-4 p-4 mb-2">
					<div class="flex items-center gap-3">
						<div class="w-16 h-16 grid place-content-center bg-gray-100 rounded-md">
							<img 
								src="<?= BASE_URL . 'public/images/' . $item['product_id'] . '.png' ?>" 
								alt="<?= $item['name'] ?>" 
								class="w-14 object-contain"
							>
						</div>
						<div>
							<p class="text-base text-black font-medium"><?= $item['name'] ?></p>
							<p class="text-xs text-orange-500 font-bold"><?= $item['brand'] ?></p>
						</div>
					</div>
					<div class="text-right">
						<p class="text-sm text-gray-600 font-medium">₱<?= number_format($item['price'], 2) ?></p>
						<p class="text-xs text-orange-500 font-bold">x<?= $item['quantity'] ?></p>
					</div>
				</div>

			<?php
					endforeach;
				else :
			?>
				<div class="min-h-[300px] flex flex-col items-center justify-center bg-gray-100 mb-4">
					<img src="<?= BASE_URL . 'public/images/bag-2.svg' ?>" alt="shopping cart" class="w-12 mb-2">
					<p class="text-xs text-black text-center font-medium">Your cart is empty</p>
				</div>
			<?php
				endif;
			?>
			
<!-- 	
			<p class="text-sm text-gray-600 text-center font-medium mb-3">Choose a payment method</p>
			<div class="flex justify-center gap-2 mb-6">
				<div class="group payment-method" role="button">
					<p class="text-xs sm:text-sm text-center text-gray-600 group-[.active]:text-orange-500">Dragonpay</p>
				</div>
				<div class="group payment-method" role="button">
					<p class="text-xs sm:text-sm text-center text-gray-600 group-[.active]:text-orange-500">Credit Card</p>
				</div>
				<div class="group payment-method" role="button">
					<p class="text-xs sm:text-sm text-center text-gray-600 group-[.active]:text-orange-500">Cash on Delivery</p>
				</div>
			</div> -->
	
			<div class="grid grid-cols-2 bg-gray-50 rounded-md gap-2 p-6 mb-6">
				<p class="text-sm text-black font-medium">Item Quantity</p>
				<p class="text-sm text-gray-600 text-right">
					<?= $cart->getTotalQuantity() ?>
				</p>
				<p class="text-sm text-black font-medium">Total Amount</p>
				<p class="text-sm text-gray-600 text-right">
					₱<?= number_format($cart->getTotalAmount(), 2) ?>
				</p>
			</div>

			<button type="button" id="confirm-order-btn" class="group w-full h-16 flex items-center justify-center text-sm text-white text-center font-medium bg-orange-500 rounded-md py-4">
				<p class="group-disabled:hidden">Checkout</p>
				<img src="<?= BASE_URL . 'public/images/spinner.svg' ?>" alt="loader" class="w-8 h-8 hidden group-disabled:block">
			</button>
		</div>
   </main>

<?php
   include_once __DIR__ . '/_partials/_footer.php';
?>