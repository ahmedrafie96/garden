<template>
			<section dir="ltr" class="dealSecHolder container-fluid overflow-hidden py-xl-12 py-lg-10 py-md-8 py-5">
				<!-- mainHeader -->
				<header class="col-12 mainHeader mb-7 text-center">
					<h1 class="headingIV playfair fwEblod mb-5">{{$t('Daily_Deals')}}</h1>
					<span class="headerBorder d-block mb-md-5 mb-3"><img src="@/main/images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
					<div id="defaultCountdown" class="comming-timer"></div>
				</header>
				<!-- dealSlider -->
				<div class="dealSlider w-100 px-lg-10 px-md-5">
				
        	<div v-for="item in items " :key="item.id">
						<!-- featureCol -->
						<div class="featureCol position-relative w-100 px-3 mb-sm-8 mb-6">
							<div class="border">
								<div class="imgHolder position-relative w-100 overflow-hidden">
									<img width="198" style="height:220px;" :src="item.image.url" alt="image description" class="img-fluid w-100" @click="$router.push(`/product/${item.id}`)">
									<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
										<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
										<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
										<li class="mr-2 overflow-hidden"><router-link :to="`/product/${item.id}`" class="icon-eye d-block"></router-link></li>
										<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
									</ul>
								</div>
								<div class="text-center py-5 px-2">
									<span class="title d-block mb-2"><router-link :to="`/product/${item.id}`">{{item.name}}</router-link ></span>
									<span class="price d-block fwEbold">{{item.price}} $</span>
									<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">HOT</span>
									<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
								</div>
							</div>
						</div>
					</div>
			

          

					<div>
						<div class="featureCol position-relative w-100 px-3 mb-sm-8 mb-6">
							<div class="border">
								<div class="imgHolder position-relative w-100 overflow-hidden">
									<img width="198" style="height:220px;" :src="items[0].image.url" alt="image description" class="img-fluid w-100">
									<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
										<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a ></li>
										<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
										<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
										<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
									</ul>
								</div>
								<div class="text-center py-5 px-2">
									<span class="title d-block mb-2"><router-link :to="`/product/${items[0].id}`">{{items[0].name}}</router-link ></span>
									<span class="price d-block fwEbold">{{items[0].price}} $</span>
									<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">HOT</span>
								</div>
							</div>
						</div>
					</div>

				

				</div>
			</section>
</template>

<script>
export default {
  props:['items'],
  watch: {
    items(){
      setTimeout(()=>{
                var newDate = new Date(2021, 7, 20);

        jQuery("#defaultCountdown").countdown({until: newDate});
        jQuery(".dealSlider").slick({
          dots: true,
          speed: 800,
          infinite: true,
          slidesToShow: 5,
          slidesToScroll: 1,
          adaptiveHeight: true,
          autoplay: true,
          arrows: false,
          responsive: [
            {
              breakpoint: 1350,
              settings: {
                slidesToShow: 4,
              },
            },
            {
              breakpoint: 1170,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
        }, 1)

    }
  },
};
</script>

<style>
</style>