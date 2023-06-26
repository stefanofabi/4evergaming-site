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
      @foreach ($communities as $community)
      <div class="swiper-slide">
        <a href="{{ $community->contact_url }}" target="_blank"> 
          <img class="clientsSwipperImage" loading="lazy" src="{{ asset('storage/communities/'.$community->logo) }}" title="{{ $community->name }}">
        </a>
      </div>
      @endforeach
    </div>
    
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>

<div class="mt-3 text-center"> 
    <div> Compartí el perfil de tu Comunidad y ayudanos a hacerla crecer junto a nosotros. </div>

    <div class="mt-2">   
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addCommunityModal"> Agregar Comunidad </button>
    </div>
</div>

@include('communities.create')
