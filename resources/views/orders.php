<?php
   include_once __DIR__ . '/_partials/_header.php';
   include_once __DIR__ . '/_partials/_toast.php';
?>
   <div class="w-[min(800px,95%)] min-h-screen px-4 py-10 mx-auto">
      <?php include_once __DIR__ . '/_partials/_nav.php' ?>
      <main>
         <div class="table-responsive">
            <table>
               <thead>
                  <th>TxnId</th>
                  <th>Referrence No</th>
                  <th>Amount</th>
                  <th>Status</th>
               </thead>
               <tbody>

                  <?php 
                     if (count($orders) > 0) :
                        foreach ($orders as $order) :
                  ?>
   
                     <tr>
                        <td><?= $order->txnid ?></td>
                        <td><?= $order->refno ?></td>
                        <td><?= $order->amount ?></td>
                        <td><?= $order->status ?></td>
                     </tr>
   
                  <?php
                        endforeach;
                     else:
                  ?>
                     <tr>
                        <td colspan="4">No records found</td>
                     </tr>
                  <?php
                     endif;
                  ?>

               </tbody>
            </table>
         </div>
      </main>
   </div>

<?php
   include_once __DIR__ . '/_partials/_footer.php';
?>