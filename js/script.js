let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});

Swal.fire({
   title: 'Login Berhasil!',
   icon: 'success',
   text: 'Selamat datang!',
   customClass: {
      popup: 'custom-popup',  // Menambahkan class custom pada box
      icon: 'custom-icon'     // Menambahkan class custom pada ikon
    },
    didOpen: () => {
      // Animasi centang menggunakan CSS
      const icon = document.querySelector('.swal2-icon');
      icon.style.animation = 'checkmark-animation 0.5s ease-out forwards';
    }
  });
 