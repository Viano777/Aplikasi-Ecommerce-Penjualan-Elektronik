<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


if (isset($_POST['update_payment'])) {
   $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
   $payment_status = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING);

   try {
      $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
      $update_payment->execute([$payment_status, $order_id]);
      $message[] = 'Status pembayaran berhasil diperbarui!';
   } catch (PDOException $e) {
      $message[] = 'Gagal memperbarui status: ' . $e->getMessage();
   }
}

if (isset($_GET['delete'])) {
   $delete_id = filter_var($_GET['delete'], FILTER_SANITIZE_NUMBER_INT);

   try {
      $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
      $delete_order->execute([$delete_id]);
      header('Location: placed_orders.php');
      exit;
   } catch (PDOException $e) {
      $message[] = 'Gagal menghapus pesanan: ' . $e->getMessage();
   }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders.</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style2.css">
   
   <style>
/* Desain tombol cetak */
.btn-cetak {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  margin: 20px 0;
}
.btn-cetak:hover {
  background-color: #0056b3;
}

/* Hanya cetak area #areaCetak */
@media print {
  body * {
    visibility: hidden;
  }

  #areaCetak, #areaCetak * {
    visibility: visible;
  }

  #areaCetak {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
  }

  /* Sembunyikan tombol dan dropdown saat print */
  .btn-cetak,
  .option-btn,
  .delete-btn,
  .select,
  form {
    display: none !important;
  }
}

</style>

</head>
<body>



<?php include '../components/admin_header.php'; ?>

<section class="orders" id="areaCetak">


<h1 class="heading">Placed Orders.</h1>

<div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Placed On : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Nama : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Nomor Telfon : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Alamat : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Total Produk : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Total Harga : <span>Rp.<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> Metode Pembayaran : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select status-dropdown" data-current="<?= $fetch_orders['payment_status']; ?>">
   <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
   <option value="pending">Tertunda</option>
   <option value="Dalam Pengiriman">Dalam Pengiriman</option>
   <option value="Dibatalkan">Dibatalkan</option>
   <option value="completed">Selesai</option>
   </select>

        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Tidak ada pesanan</p>';
      }
   ?>

</div>
<button onclick="cetakArea()" class="btn-cetak">Cetak Data Pesanan</button>
</section>

</section>












<script src="../js/admin_script.js"></script>
<script>
function cetakArea() {
  window.print();
}
</script>

<script>
   function applyStatusColor(select) {
      const value = select.value.toLowerCase();
      select.classList.remove('pending', 'completed', 'in-transit', 'cancelled');

      if (value === 'pending') {
         select.classList.add('pending');
      } else if (value === 'completed' || value === 'selesai') {
         select.classList.add('completed');
      } else if (value.includes('perjalanan')) {
         select.classList.add('in-transit');
      } else if (value === 'dibatalkan') {
         select.classList.add('cancelled');
      }
   }

   // Terapkan warna saat halaman dimuat
   document.querySelectorAll('.status-dropdown').forEach(select => {
      applyStatusColor(select);
      select.addEventListener('change', () => applyStatusColor(select));
   });
</script>

</body>
</html>