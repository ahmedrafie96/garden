<template>
			<section class="featureSec container-fluid overflow-hidden pt-xl-12 pt-lg-10 pt-md-80 pt-5 pb-xl-10 pb-lg-4 pb-md-2 px-xl-14 px-lg-7">
				<!-- mainHeader -->
				<header class="col-12 mainHeader mb-7 text-center">
					<h1 class="headingIV playfair fwEblod mb-4">{{$t('Featured_Products')}}</h1>
					<span class="headerBorder d-block mb-md-5 mb-3"><img src="@/main/images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
				</header>
				<div class="col-12 p-0 overflow-hidden d-flex flex-wrap">
					<!-- featureCol -->

					<div   v-for="item in items" class="featureCol px-3 mb-6" :key="item.id">
						<div class="border">
							<div class="imgHolder position-relative w-100 overflow-hidden">
								<img width="198" style="height:220px;" :src="item.image.url" alt="image description" class="img-fluid w-100" @click="$router.push(`/product/${item.id}`)">
								<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0" dir="ltr">
									<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
									<li class="mr-2 overflow-hidden" @click="addItem(item)"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
									<li class="mr-2 overflow-hidden"><router-link :to="`/product/${item.id}`" class="icon-eye d-block"></router-link></li>
									<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
								</ul>
							</div>
							<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
								<span class="title d-block mb-2"><router-link :to="`/product/${item.id}`">{{item.name}}</router-link ></span>
								<span class="price d-block fwEbold">{{item.price}}$</span>
							</div>
						</div>
					</div>
					<!-- featureCol -->

				
					<!-- featureCol -->
					

				</div>
			</section>
</template>

<script>
export default {
props:['items'],
}
</script>

<style>

</style>