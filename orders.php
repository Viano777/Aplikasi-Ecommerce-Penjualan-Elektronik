<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
$payment = $fetch_orders['payment_status'] ?? '';
$status_class = '';

if ($payment == 'pending') {
   $status_class = 'pending';
} elseif ($payment == 'completed' || $payment == 'Selesai') {
   $status_class = 'completed';
} elseif (strtolower($payment) == 'sedang dalam perjalanan') {
   $status_class = 'in-transit';
} elseif ($payment == 'Dibatalkan') {
   $status_class = 'cancelled';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylebaru7.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">Pesanan Ditempatkan.</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Silakan login untuk melihat pesanan Anda</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
               $payment = $fetch_orders['payment_status'] ?? '';
               $status_class = '';
            
               if ($payment == 'pending') {
                  $status_class = 'pending';
               } elseif ($payment == 'completed' || $payment == 'Selesai') {
                  $status_class = 'completed';
               } elseif (strtolower($payment) == 'sedang dalam perjalanan') {
                  $status_class = 'in-transit';
               } elseif ($payment == 'Dibatalkan') {
                  $status_class = 'cancelled';
               }
            
   ?>
   <div class="box">
      <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Phone Number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Payment Method : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Total price : <span>Rp.<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>Status Pembayaran :
   <span class="status <?= $status_class ?>">
      <?= htmlspecialchars($payment); ?>
   </span>
</p>

   </div>
   <?php
      }
      }else{
         echo '<p class="empty">belum ada pesanan yang ditempatkan!</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>