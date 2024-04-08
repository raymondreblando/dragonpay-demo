<header class="mb-6">
   <nav class="flex items-center justify-between gap-4">
      <div class="w-14 h-14 flex items-center justify-center bg-orange-500 rounded-full mb-2">
         <img src="./public/images/shop.svg" alt="shop">
      </div>

      <div class="flex items-center gap-4">
         <a href="<?= BASE_URL . 'orders' ?>" class="h-14 flex items-center justify-center text-xs text-blue-500 border border-gray-100 rounded-full px-6">View Orders</a>
         <a href="<?= BASE_URL . 'cart' ?>" class="relative w-14 h-14 grid place-content-center border border-gray-100 rounded-full">
            <img src="./public/images/bag-2.svg" alt="Shopping Cart">
            <span id="cart-quantity" class="absolute top-3 right-[4px] w-5 h-5 text-[10px] text-white text-center font-semibold leading-5 bg-orange-500 rounded-full"><?= $cart_quantity ?></span>
         </a>
      </div>
   </nav>
</header>