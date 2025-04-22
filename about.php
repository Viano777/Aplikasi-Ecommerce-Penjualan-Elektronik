<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylebaru7.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">



      <div class="content" style="text-align: justify;">
         <h3>Tentang kami:</h3>
         <p>TechZone adalah reseller terkemuka untuk produk-produk teknologi premium di Indonesia, yang mengkhususkan diri dalam menawarkan berbagai pilihan smartphone, aksesoris, perangkat elektronik, dan software dari merek-merek ternama.

         <p>TechZone menawarkan one-stop shopping untuk kebutuhan digital Anda. Pelanggan dapat menikmati pengalaman belanja yang interaktif, di mana mereka dapat menyentuh, merasakan, dan menguji berbagai produk teknologi terbaru yang kami tawarkan.

         <p>TechZone juga menyediakan berbagai layanan purna jual, termasuk panduan, dukungan teknis, serta tips penggunaan untuk memastikan pengalaman terbaik bagi pelanggan setelah melakukan pembelian. Kami berkomitmen untuk memberikan layanan after-sales yang sangat baik, memberikan bantuan penuh kepada pengguna dalam setiap tahap penggunaan produk mereka.

            
      </div>
      

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading"></h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

     


   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>