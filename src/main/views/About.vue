<template>
		<main>
			<!-- introBannerHolder -->
			<intro-banner-holder :title="$t('about')" :sub_route="$t('about')" />

			<div v-if="settings.content ?settings.content.paragraphs:false">

				<section :dir="$vuetify.rtl?'rtl':'ltr'"  v-for="paragraph in settings.content.paragraphs" class="abtSecHolder grid_sec container pt-xl-24 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-5">
			
					<div class="col-12 col-lg-6 pt-xl-12 pt-lg-8">
						<h2 class="playfair fwEbold position-relative mb-7 pb-5 under_line" :dir="$vuetify.rtl?'rtl':'ltr'">
							<strong class="d-block">{{paragraph.translations.find(t=>t.locale==locale).title}}</strong>
							<!-- <strong class="d-block">For a Better World</strong> -->
						</h2>
						<p class="pr-xl-16 pr-lg-10 mb-lg-0 mb-6" style="padding:0 !important;" v-html="paragraph.translations.find(t=>t.locale==locale).text"></p>
					</div>
					<div class="col-12 col-lg-6">
						<img width="570"  style="height:440px" :src="paragraph.image" alt="image description" class="img-fluid">
					</div>
			
			</section>
			</div>

			<section class="counterSec container pt-xl-12 pb-xl-24 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-5 pb-10" >
				<div class="row">
					<div class="col-12">
						<!-- progressCounter -->
						<ul class="progressCounter list-unstyled mb-2 d-flex flex-wrap text-capitalize text-center">
							<li class="mb-md-0 mb-3">
								<strong class="d-block fwEbold counter mb-2">229</strong>
								<strong class="d-block text-uppercase txtWrap">Happy Clients</strong>
							</li>
							<li class="mb-md-0 mb-3">
								<strong class="d-block fwEbold counter mb-2">109</strong>
								<strong class="d-block text-uppercase txtWrap">completed project</strong>
							</li>
							<li class="mb-md-0 mb-3">
								<strong class="d-block fwEbold counter mb-2">22</strong>
								<strong class="d-block text-uppercase txtWrap">awesome staff</strong>
							</li>
							<li class="mb-md-0 mb-3">
								<strong class="d-block fwEbold counter mb-2">11</strong>
								<strong class="d-block text-uppercase txtWrap">winning awards</strong>
							</li>
						</ul>
					</div>
				</div>
			</section>
			<section class="introSec bg-lightGray pt-xl-12 pb-xl-7 pt-10 pb-10" v-if="settings.multi_p">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-6 mb-lg-0 mb-6">
							<img :src="settings.multi_p.image" alt="image description" class="img-fluid">
						</div>
						<div class="col-12 col-lg-6">
							<div id="accordion" class="accordionList pt-lg-12">
								<!-- <div  class="card mb-2">
									
									<div class="card-header px-xl-5 py-xl-3" >
										<h5 class="mb-0">
											<button class="btn btn-link fwEbold text-uppercase text-left w-100 p-0" data-toggle="collapse" :data-target="`#${collapses[i]}`" aria-expanded="false" :aria-controls="collapses[i]">
											{{
												paragraph.translations.find( (t) => (t.locale ==locale) ).title
																								
												}} <i class="fas fa-sort-down float-right"></i>
											</button>
										</h5>
									</div>
									<div :id="collapses[i]" class="collapse show" :aria-labelledby="headings[i]" data-parent="#accordion">
										<div class="card-body px-xl-5 py-0">
											<p v-html="paragraph.translations.find( (t) => (t.locale ==locale) ).text" class="mb-7"></p>
										</div>
									</div>
								</div> -->

								 <div :key="i" v-for="(paragraph , i) in settings.multi_p.paragraphs" class="card mb-2">
									<div class="card-header px-xl-5 py-xl-3" :id="headings[i]">
										<h5 class="mb-0">
											<button class="btn btn-link fwEbold text-uppercase text-left w-100 collapsed p-0" data-toggle="collapse" :data-target="`#${collapses[i]}`" aria-expanded="false" :aria-controls="collapses[i]">
																						{{
												paragraph.translations.find( (t) => (t.locale ==locale) ).title
																								
												}} <i class="fas fa-sort-down float-right"></i>
											</button>
										</h5>
									</div>
									
									<div :id="collapses[i]" class="collapse" :aria-labelledby="headings[i]" data-parent="#accordion">
										<div class="card-body px-xl-5 py-0">
											<p v-html="paragraph.translations.find( (t) => (t.locale ==locale) ).text" class="mb-7"></p>
										</div>

									</div>
								</div>

															<!-- 	<div class="card mb-2">
									<div class="card-header px-xl-5 py-xl-3" id="headingThree">
										<h5 class="mb-0">
											<button class="btn btn-link fwEbold text-uppercase text-left w-100 collapsed p-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											nothing to fear <i class="fas fa-sort-down float-right"></i>
											</button>
										</h5>
									</div>
									<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="card-body px-xl-5 py-0">
											<p class="mb-7">To succeed you must believe. When you believe, you will succeed. Surround yourself with angels, positive energy, beautiful people, beautiful souls, clean heart, angel. Let me be clear, you have to make it through the jungle to make it to paradise, that’s the key, Lion! Lion!</p>
										</div>
									</div>
								</div>
								<div class="card mb-2">
									<div class="card-header px-xl-5 py-xl-3" id="headingFour">
										<h5 class="mb-0">
											<button class="btn btn-link fwEbold text-uppercase text-left w-100 collapsed p-0" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
											make the world better <i class="fas fa-sort-down float-right"></i>
											</button>
										</h5>
									</div>
									<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
										<div class="card-body px-xl-5 py-0">
											<p class="mb-7">To succeed you must believe. When you believe, you will succeed. Surround yourself with angels, positive energy, beautiful people, beautiful souls, clean heart, angel. Let me be clear, you have to make it through the jungle to make it to paradise, that’s the key, Lion! Lion!</p>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</section>
			<section  v-show="false" dir="ltr" class="processStepSec container pt-xl-23 pb-xl-10 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-0">
				<div class="row">
					<header class="col-12 mainHeader mb-3 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">{{$t('Delivery_Process')}}</h1>
						<span class="headerBorder d-block mb-5"><img src="@/main/images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
					</header>
				</div>
				<div class="row">
					<div class="col-12 pl-xl-23 mb-lg-3 mb-10">
						<div class="stepCol position-relative bg-lightGray py-6 px-6">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 01</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Choose your products</h2>
							<p class="mb-5">There are many variations of passages of lorem ipsum available, but the majority have suffered alteration in some form, by injected humour. Both betanin</p>
						</div>
					</div>
					<div class="col-12 pr-xl-23 mb-lg-3 mb-10">
						<div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 02</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Connect nearest stored</h2>
							<p class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
						</div>
					</div>
					<div class="col-12 pl-xl-23 mb-lg-3 mb-10">
						<div class="stepCol position-relative bg-lightGray py-6 px-6">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 03</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Share your location</h2>
							<p class="mb-5">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore</p>
						</div>
					</div>
					<div class="col-12 pr-xl-23 mb-lg-3 mb-10">
						<div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 04</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Get delivered fast</h2>
							<p class="mb-5">On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment.</p>
						</div>
					</div>
				</div>
			</section>
			<section class="teamSec pt-xl-12 pb-xl-21 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-0 pb-4">
				<div class="container">
					<div class="row">
						<header class="col-12 mainHeader mb-9 text-center">
							<h1 class="headingIV playfair fwEblod mb-4">{{$t('meet_our_team')}}</h1>
							<span class="headerBorder d-block mb-5"><img src="@/main/images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						</header>
					</div>
					<div class="row" v-if="settings.team">
						<div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6" v-for="(member,i) in settings.team" :key="i" >
							<article class="teamBlock overflow-hidden">
								<span class="imgWrap position-relative d-block w-100 mb-4">
									<img :src="member.image" class="img-fluid" alt="image description">
									<ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
										<li><a :href="member.facebook" class="fab fa-facebook-f"></a></li>
										<li><a :href="member.twitter" class="fab fa-twitter"></a></li>
										<li><a :href="member.instagram" class="fab fa-instagram"></a></li>
									</ul>
								</span>
								<div class="textDetail w-100 text-center">
									<h3>
										<strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">{{member.translations.find(t=>t.locale==locale).name}}</a></strong>
										<strong class="text-capitalize d-block desination">{{member.translations.find(t=>t.locale==locale).title}}</strong>
									</h3>
								</div>
							</article>
						</div>
						
					</div>
				</div>
			</section>
			<div class="container-fluid px-xl-20 mb-xl-24 mb-lg-20 mb-md-16 mb-10">
				<!-- subscribeSecBlock -->
			      <ha-subscribe-holder />

			</div>
			<!-- footerHolder -->

		</main>



<!-- 

        <intro-banner-holder :slider="settings"  :title="$t('about')" :sub_route="$t('about')" />
    <about-section-holder :content="settings.content" />
    <counter-section :counters="settings.counters" />
    <about-intro-section :paragraph="settings.paragraph" />
     <process-step-section /> -->
    <!-- <team-section :team="settings.team"/>  -->
</template>

<script>
import { mapState } from 'vuex';
export default {
mounted(){
    this.$store.dispatch("setting/index");
	window.scrollTo(0,0);
  },
  data() {
    return {
headings:['headingOne', 'headingTwo', 'headingThree' , 'headingFour' ,'headingFive'  ,'headingSix' ,'headingSeven'  ],
collapses:['collapseOne', 'collapseTwo', 'collapseThree' , 'collapseFour' ,'collapseFive'  ,'collapseSix' ,'collapseSeven'  ],
      posts:[],
      items:[],
      discover_posts:[],
	  
    }
  },
  computed: { 
    ...mapState({
      settings: (state) => state.setting.all,
	  locale : (state)=>state.locales.locale
    }),
	
  },
}
</script>

<style scoped>
.grid_sec:nth-child(odd) > div{
	 float: left;
}
.grid_sec:nth-child(even) > div{
	 float: right;
}
.grid_sec[dir="rtl"]:nth-child(odd) > div{
	 float: right;
}
.grid_sec[dir="rtl"]:nth-child(even) > div{
	 float: left;
}
.under_line[dir="rtl"]::before{
	right: 0;
	left: auto;
}
</style>