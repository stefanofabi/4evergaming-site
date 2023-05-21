@section('javascript')
<!-- Initialize Swiper -->
<script type="module">
  $(document).ready(function() {
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  });
</script>
@append

@section('css')
<style>
  .clientsSwipperImage {
    max-width: 400px;
    max-height: 200px;
  }
</style>
@append

<div class="d-none d-md-block">
  <div class="row mt-5">
    <h3 class="text-center"> Miles de clientes, grandes relaciones </h3>
  </div>

  <!-- Swiper -->
  <div class="swiper mySwiper mt-3">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://esportsteams.es/wp-content/uploads/2021/02/LOGO-PNG_LITE.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://www.zarla.com/images/zarla-ocho-players-1x1-2400x2400-20220325-rkm6mfhpfc64y8bw4vdr.png?crop=1:1,smart&width=250&dpr=2"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://seeklogo.com/images/E/esport-logo-B80AF9936C-seeklogo.com.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://s3.amazonaws.com/cdn.designcrowd.com/blog/2018/July/Powerful-Gaming-Logos/OG-Redbull-Logo.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://i.pinimg.com/originals/d5/19/de/d519defd6202682b3dba315c58521db7.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://graphicsfamily.com/wp-content/uploads/edd/2020/12/The-King-Esports-Gaming-Clan-Mascot-Logo-PNG-Transparent.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://seeklogo.com/images/K/kemain-ft-esport-logo-9B3138C2DC-seeklogo.com.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://i.imgur.com/JXWvy7q.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://img.pikbest.com/png-images/20210330/e-sports-game-logo_6276419.png!c1024wm0"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://play-lh.googleusercontent.com/WPBccM654_TWFUUC_U5Y3lOOWmOaaShV8nMyTpp4GktpoI7Xevsiysdko0_e7c0esDM=w600-h300-pc0xffffff-pd"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://i.pinimg.com/originals/69/a8/04/69a804c8143949464484240e358b3c63.png"></div>
      <div class="swiper-slide"><img class="clientsSwipperImage" loading="lazy" src="https://media1.thehungryjpeg.com/thumbs2/ori_3832133_67blciuxmdn0o4vlgrviu4ur0g7qropfe00rtkv5_hermes-esport-mascot-logo-design.png"></div>
    </div>
    
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>

<p class="mt-3 text-center"> 
  Compartí el perfil de tu Comunidad y ayudanos a hacerla crecer junto a nosotros. <br>
  <a class="btn btn-danger mt-2" href="#" onclick="alert('Function not available now')"> Agregar Comunidad </a>
</p>
