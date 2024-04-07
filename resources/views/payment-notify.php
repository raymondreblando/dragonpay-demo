<?php
   include_once __DIR__ . '/_partials/_header.php';
   include_once __DIR__ . '/_partials/_toast.php';
?>

   <div class="w-[min(800px,95%)] min-h-screen flex flex-col items-center justify-center px-4 py-10 mx-auto">
      <div class="w-[min(350px,100%)] flex flex-col items-center justify-center">
         <img src="<?= BASE_URL . 'public/images/tick-circle.svg' ?>" alt="success" class="w-20 h-20 mb-4">
         <p class="text-lg text-black font-medium mb-4">Payment Successful</p>
         <p class="text-sm text-slate-500 text-center mb-8">Payment successfully completed. We are now processing your order and thank you for ordering with us. Have a nice day!</p>

         <div class="border border-gray-200 px-4 py-3 mb-8">
            <p class="text-sm text-slate-500 text-center">Referrence Number : <?= $refno ?></p>
         </div>

         <a href="<?= BASE_URL ?>" class="text-sm text-black hover:bg-gray-100 border border-gray-300 rounded-md px-4 py-3 transition-all mb-12">Order again</a>


         <p class="text-xs text-black">Powered by <span class="text-orange-500">Dragonpay</span></p>
      </div>
   </div>

<?php
   include_once __DIR__ . '/_partials/_footer.php';
?>