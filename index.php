<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MY HANDPHONE</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylebaru7.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/iphone16.Png" alt="">
         </div>
         <div class="content">
            <span>Dapatkan iPhone 16 Terbaru!</span>
            <h3>Teknologi Canggih dengan Harga Spesial Hanya untuk Anda!</h3>
            <br>
            <a href="category.php?category=smartphone" class="btnldp">Beli Sekarang</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-2.png" alt="">
         </div>
         <div class="content">
            <span>Tampil Stylish dengan Jam Tangan Berkualitas!   </span>
            <h3>Dapatkan Penawaran Menarik Hanya di Sini!</h3>
            <br>
            <a href="category.php?category=watch" class="btnldp">Beli Sekarang</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-3.png" alt="">
         </div>
         <div class="content">
            <span>Dengarkan Lebih Jelas. Rasakan Lebih Dalam</span>
            <h3>Dapatkan Penawaran Menarik Hanya di Sini!</h3>
            <br>
            <a href="shop.php" class="btnldp">Beli Sekarang</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">
<h1 class="heading">Semua kategori</h1>
<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>
   
   <div class="swiper category-slider">

   <div class="swiper-wrapper">
   
   <a href="category.php?category=smartphone" class="swiper-slide slide">
   <img src="images/icon-iphone.png" alt="" width="200" height="auto">
      <h3>Smartphone</h3>
   </a>
   
   <a href="category.php?category=camera" class="swiper-slide slide">
      <img src="images/icon-ipad.png" alt="">
      <h3>Tablet</h3>
   </a>

   <a href="category.php?category=watch" class="swiper-slide slide">
      <img src="images/icon-wacths.png" alt="">
      <h3>Watch</h3>
   </a>

   <a href="category.php?category=watch" class="swiper-slide slide">
      <img src="images/icon-music.png" alt="">
      <h3>Music</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>
   </div>


</section>

<section class="home-products">

   <h1 class="heading">Produk Terbaru</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Rp.</span><?= $fetch_product['price']; ?><span></span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add to cart" class="btn-index" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop: true,
   spaceBetween: 20,
   autoplay: {
      delay: 2000, // dalam milidetik (3000ms = 3 detik)
      disableOnInteraction: false, // biar tetap autoplay meski user klik
   },
  pagination: {
      el: ".swiper-pagination",
      clickable: true,
            // kecepatan transisi (ms)

   },
});


var swiper = new Swiper(".category-slider", {
  slidesPerView: 4, // Menampilkan 3 slide dalam satu tampilan
  spaceBetween: 20,  // Menambahkan jarak 20px antara setiap slide
  loop: true,        // Mengaktifkan fitur loop, jadi setelah slide terakhir akan kembali ke pertama
  pagination: {
    el: ".swiper-pagination", // Elemen pagination, biasanya berupa dots di bawah slider
    clickable: true,          // Membuat pagination bisa diklik untuk navigasi langsung ke slide tertentu
  },
  navigation: {
    nextEl: ".swiper-button-next", // Tombol navigasi untuk slide ke kanan
    prevEl: ".swiper-button-prev", // Tombol navigasi untuk slide ke kiri
  },
});



var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>