<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Footer Page</title>

   <!-- Link ke CSS eksternal -->
   <link rel="stylesheet" href="stylebaru7.css">


</head>
<body>
   
<footer class="footer">

   <section class="grid">

      <div class="box">
         <h3>Tautan Cepat</h3>
         <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i> Shop</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i> Contact</a>
      </div>

      <div class="box">
         <h3>Tautan Tambahan</h3>
         <a href="user_login.php"> <i class="fas fa-angle-right"></i> Login</a>
         <a href="user_register.php"> <i class="fas fa-angle-right"></i> Register</a>
         <a href="cart.php"> <i class="fas fa-angle-right"></i> Cart</a>
         <a href="orders.php"> <i class="fas fa-angle-right"></i> Orders</a>
      </div>

      <div class="box">
         <h3>Hubungi Kami.</h3>
         <a href="tel:9800000000"><i class="fas fa-phone"></i> +62 895 2333 2059</a>
         <a href="tel:9900000000"><i class="fas fa-phone"></i> +62 895 2444 2059</a>
         <a href="mailto:harshchy143@gmail.com"><i class="fas fa-envelope"></i> myphone@gmail.com</a>
         <a href="https://www.google.com/myplace"><i class="fas fa-map-marker-alt"></i> Surabaya. Jawa Timur, IDN </a>
      </div>

      <div class="box">
         <h3>Ikuti Kami</h3>
         <a href="https://www.facebook.com/harshchaudharynp" target="_blank"><i class="fab fa-facebook-f"></i>facebook</a>
         <a href="https://twitter.com/HarshCh53587355" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
         <a href="https://www.instagram.com/harshchy__/" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
         <a href="https://www.linkedin.com/in/harsh-chaudhary-15763a150/" target="_blank"><i class="fab fa-linkedin"></i>Linkedin</a>
      </div>

   </section>

   <div class="credit">&copy; copyright @ <?= date('Y'); ?> <span></span> | All rights reserved!</div>

</footer>