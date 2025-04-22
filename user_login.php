<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      echo json_encode(['status' => 'success']);
   } else {
      echo json_encode(['status' => 'error', 'message' => 'Email atau password salah']);
   }
   exit;
   
   

   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylebaru7.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      
      <!-- Tombol dengan animasi -->
      <button type="button" class="btn no-anim" id="loginButton">
   <span>Login Now</span>
</button>

   
      
      <p>Don't have an account?</p>
      <a href="user_register.php" class="option-btn">Register Now.</a>
      <p>
      <a href="admin/admin_login.php" class="admin-btn">Login Admin</a>
   </form>
</section>















<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('loginButton').addEventListener('click', function(event) {
   event.preventDefault();

   let email = document.querySelector('input[name="email"]').value;
   let pass = document.querySelector('input[name="pass"]').value;

   if(email === "" || pass === "") {
      Swal.fire({
         icon: 'error',
         title: 'Gagal!',
         text: 'Email atau password tidak boleh kosong!',
         customClass: {
            popup: 'custom-popup'
         }
      });
      return;
   }

   let formData = new FormData();
   formData.append('email', email);
   formData.append('pass', pass);
   formData.append('submit', 'true'); 

   fetch('', {
      method: 'POST',
      body: formData
   })
   .then(response => response.json()) // ubah jadi JSON
   .then(data => {
      if(data.status === 'error') {
         Swal.fire({
            icon: 'error',
            title: 'Login Gagal!',
            text: data.message,
            customClass: {
               popup: 'custom-popup'
            }
         });
      } else if(data.status === 'success') {
         Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Selamat datang!',
            customClass: {
               popup: 'custom-popup'
            }
         }).then(() => {
            window.location.href = 'index.php';
         });
      }
   })
   .catch(error => {
      console.error('Error:', error);
      Swal.fire({
         icon: 'error',
         title: 'Oops!',
         text: 'Terjadi kesalahan saat login.',
      });
   });
});
</script>



</body>
</html>