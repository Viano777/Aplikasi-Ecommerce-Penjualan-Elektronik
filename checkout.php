<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylebaru7.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>Pesanan Anda</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= 'Rp.'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Keranjang Anda Kosong!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">Total : <span>Rp.<?= $grand_total; ?></span></div>
      </div>

      <h3>Buat Pesanan Anda</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Nama :</span>
            <input type="text" name="name" placeholder="Masukkan Nama Anda" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>Nomor Telfon :</span>
            <input type="number" name="number" placeholder="Masukkan Nomor Anda" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" placeholder="Masukkan Email Anda" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Metode Pembayaran :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">Cash On Delivery</option>
               <option value="credit card">Credit Card</option>
               <option value="QRIS">Qris</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Alamat :</span>
            <input type="text" name="flat" placeholder="Masukkan Alamat Anda" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Detail Alamat Anda:</span>
            <input type="text" name="street" placeholder="Masukkan Detail Alamat Anda" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Kota :</span>
            <input type="text" name="city" placeholder="Masukkkan Kota " class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
   <span>Provinsi:</span>
   <select name="state" class="box" required>
      <option value="" disabled selected>Pilih Provinsi</option>
      <option value="Aceh">Aceh</option>
      <option value="Sumatera Utara">Sumatera Utara</option>
      <option value="Sumatera Barat">Sumatera Barat</option>
      <option value="Riau">Riau</option>
      <option value="Kepulauan Riau">Kepulauan Riau</option>
      <option value="Jambi">Jambi</option>
      <option value="Sumatera Selatan">Sumatera Selatan</option>
      <option value="Bengkulu">Bengkulu</option>
      <option value="Lampung">Lampung</option>
      <option value="Bangka Belitung">Bangka Belitung</option>
      <option value="DKI Jakarta">DKI Jakarta</option>
      <option value="Jawa Barat">Jawa Barat</option>
      <option value="Banten">Banten</option>
      <option value="Jawa Tengah">Jawa Tengah</option>
      <option value="DI Yogyakarta">DI Yogyakarta</option>
      <option value="Jawa Timur">Jawa Timur</option>
      <option value="Bali">Bali</option>
      <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
      <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
      <option value="Kalimantan Barat">Kalimantan Barat</option>
      <option value="Kalimantan Tengah">Kalimantan Tengah</option>
      <option value="Kalimantan Selatan">Kalimantan Selatan</option>
      <option value="Kalimantan Timur">Kalimantan Timur</option>
      <option value="Kalimantan Utara">Kalimantan Utara</option>
      <option value="Sulawesi Utara">Sulawesi Utara</option>
      <option value="Sulawesi Tengah">Sulawesi Tengah</option>
      <option value="Sulawesi Selatan">Sulawesi Selatan</option>
      <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
      <option value="Gorontalo">Gorontalo</option>
      <option value="Sulawesi Barat">Sulawesi Barat</option>
      <option value="Maluku">Maluku</option>
      <option value="Maluku Utara">Maluku Utara</option>
      <option value="Papua">Papua</option>
   </select>
</div>

<div class="inputBox">
   <span>Negara :</span>
   <input type="text" name="country" value="Indonesia" class="box" readonly>
</div>

         <div class="inputBox">
            <span>Kode Pos :</span>
            <input type="number" min="0" name="pin_code" placeholder="Masukkan Kode Pos Anda" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Checkout">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>