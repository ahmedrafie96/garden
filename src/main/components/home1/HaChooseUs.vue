<template>
  			<section class="chooseUs-sec container pt-xl-22 pt-lg-20 pt-md-16 pt-10 pb-xl-12 pb-md-7 pb-2">
				<div class="row">
				
					<div class="col-12 col-lg-6 mb-lg-0 mb-4">
						<img :src="settings[0].image" alt="image description" class="img-fluid">
					</div>
					<div class="col-12 col-lg-6 pr-4">
						<h2 style="text-align:start;" class="headingII fwEbold playfair position-relative mb-6 pb-5">{{settings[0].translation.find(t=> t.locale == locale).title}}</h2>
						<p class="mb-xl-14 mb-lg-10">{{settings[0].translation.find(t=> t.locale == locale).text}}</p>
						<!-- chooseList -->
						
						<ul class="list-unstyled chooseList">
							<li  v-for="item in settings[0].items" class="d-flex justify-content-start mb-xl-7 mb-lg-5 mb-3">
								<span > <img width="50" height="50" style="margin:5px;" :src="item.image" alt=""></span>
								<div class="alignLeft d-flex justify-content-start flex-wrap">
									<h3 class="headingIII fwEbold mb-2">{{item.translation.find(t=> t.locale == locale).title}}</h3>
									<p>{{item.translation.find(t=> t.locale == locale).text}}</p>
								</div>
							</li>
							<!-- <li class="d-flex justify-content-start mb-xl-6 mb-lg-5 mb-4">
								<span class="icon icon-ic-plant"></span>
								<div class="alignLeft d-flex justify-content-start flex-wrap">
									<h3 class="headingIII fwEbold mb-2">Natural Sunlight</h3>
									<p>It is a long established fact that a reader will be distracted by the reable content of a page.</p>
								</div>
							</li>
							<li class="d-flex justify-content-start">
								<span class="icon icon-desert"></span>
								<div class="alignLeft d-flex justify-content-start flex-wrap">
									<h3 class="headingIII fwEbold mb-2">Clean Air</h3>
									<p>There are many variations of passages of lorem ipsum available, but the majority have suffered.</p>
								</div>
							</li> -->
						</ul>
					</div>
				</div>
			</section>
</template>

<script>
import { mapState } from 'vuex'

export default {
	props:['settings'],
	computed:{
		...mapState({
			locale:(state) => state.locales.locale
		})
	}
}
</script>

<style scoped>
.headingII:before{
	right: 0;
}
</style>