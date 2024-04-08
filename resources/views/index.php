<?php
   include_once __DIR__ . '/_partials/_header.php';
   include_once __DIR__ . '/_partials/_toast.php';
?>
   <div class="w-[min(800px,95%)] min-h-screen px-4 py-10 mx-auto">
   	<?php include_once __DIR__ . '/_partials/_nav.php' ?>
      <main>
         <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-2">
         <?php  
            foreach ($products as $product) : 
         ?>
            <div class="p-4">
               <div class="relative w-full min-h-[180px] flex items-center justify-center bg-gray-100 rounded-md py-6">
                  <span class="absolute top-2 left-2 bg-white text-[11px] text-black font-semibold rounded-sm px-[6px] py-[4px]">₱<?= number_format($product->price, 2) ?></span>
                  <img 
                     src="<?= './public/images/' . $product->product_id . '.png' ?>" 
                     alt="<?= $product->name ?>" 
                     class="w-32 object-contain"
                  >
               </div>
               <div class="flex flex-wrap justify-between gap-2 p-2">
                  <div>
                     <p class="text-sm text-black font-medium"><?= $product->name ?></p>
                     <p class="text-xs text-orange-500 font-medium"><?= $product->brand ?></p>
                  </div>
                  <button type="button" class="add-to-cart flex items-center justify-center shrink-0 w-8 h-8 bg-orange-500 rounded-full" data-index="<?= $product->product_id ?>">
                     <img src="./public/images/shopping-cart.svg" alt="add to cart" class="w-4 h-4">
                  </button>
               </div>
            </div>
         <?php 
            endforeach;
         ?>
         </div>
      </main>
   </div>

<?php
   include_once __DIR__ . '/_partials/_footer.php';
?>