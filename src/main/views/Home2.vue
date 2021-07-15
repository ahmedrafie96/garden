<template>
  	<div id="pageWrapper">
		<!-- header -->
		<header id="header" class="position-relative">
			<!-- headerHolderCol -->
			<div class="headerHolderCol pt-lg-4 pb-lg-5 py-3">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-4">
							<a href="javascript:void(0);" class="tel d-flex align-items-end"><i class="icon-call mr-2"></i>  Hotline: (602) 462 8889</a>
						</div>
						<div class="col-12 col-sm-4 text-center">
							<span class="txt d-block">Wellcome To Botanical Store</span>
						</div>
						<div class="col-12 col-sm-4">
							<!-- langListII -->
							<ul class="nav nav-tabs langListII justify-content-end border-bottom-0">
								<li class="dropdown">
									<span>Currency: </span>
									<a class="d-inline dropdown-toggle text-uppercase" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="true" aria-expanded="false">USD</a>
									<div class="dropdown-menu text-uppercase pl-4 pr-4 border-0">
										<a class="dropdown-item" href="javascript:void(0);">USD</a>
										<a class="dropdown-item" href="javascript:void(0);">VND</a>
										<a class="dropdown-item" href="javascript:void(0);">euro</a>
									</div>
								</li>
								<li class="dropdown m-0">
									<span>Languages: </span>
									<a class="d-inline dropdown-toggle text-uppercase" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="true" aria-expanded="false">EN</a>
									<div class="dropdown-menu pl-4 pr-4">
										<a class="dropdown-item" href="javascript:void(0);">English</a>
										<a class="dropdown-item" href="javascript:void(0);">Vietnamese</a>
										<a class="dropdown-item" href="javascript:void(0);">French</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- headerHolder -->
			<div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
				<div class="row">
					<div class="col-6 col-sm-2">
						<!-- mainLogo -->
						<div class="logo">
							<a href="/"><img src="@/main/images/logo.png" alt="Botanical" class="img-fluid"></a>
						</div>
					</div>
					<div class="col-6 col-sm-7 col-lg-8 static-block">
						<!-- mainHolder -->
						<div class="mainHolder pt-lg-5 pt-3 justify-content-center">
							<!-- pageNav2 -->
							<nav class="navbar navbar-expand-lg navbar-light p-0 pageNav2 position-static">
								<button type="button" class="navbar-toggle collapsed position-relative" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<div class="collapse navbar-collapse" id="navbarNav">
									<ul class="navbar-nav mx-auto text-uppercase d-inline-block">
										<li class="nav-item active dropdown">
											<a class="dropdown-toggle d-block" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">home</a>
											<ul class="list-unstyled text-capitalize dropdown-menu mt-0 py-0">
												<li class="d-block mx-0"><a href="/">Home 1</a></li>
												<li class="d-block mx-0"><a href="home2.html">Home 2</a></li>
												<li class="d-block mx-0"><a href="home3.html">Home 3</a></li>
											</ul>
										</li>
										<li class="nav-item dropdown">
											<a class="dropdown-toggle d-block" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Store</a>
											<ul class="list-unstyled text-capitalize dropdown-menu mt-0 py-0">
												<li class="d-block mx-0"><router-link to="/store">Shop Left Sidebar</router-link ></li>
												<li class="d-block mx-0"><a href="shop-detail.html">Single Product</a></li>
											</ul>
										</li>
										<li class="nav-item">
											<a class="d-block" href="about-us.html">About</a>
										</li>
										<li class="nav-item dropdown">
											<a class="dropdown-toggle d-block" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog</a>
											<ul class="list-unstyled text-capitalize dropdown-menu mt-0 py-0">
												<li class="d-block mx-0"><a href="blog.html">Blog Left Sidebar</a></li>
												<li class="d-block mx-0"><a href="blog-detail.html">Blog Detail</a></li>
											</ul>
										</li>
										<li class="nav-item dropdown">
											<a class="dropdown-toggle d-block" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
											<ul class="list-unstyled text-capitalize dropdown-menu mt-0 py-0">
												<li class="d-block mx-0"><a href="cart-page.html">Cart Page</a></li>
											</ul>
										</li>
										<li class="nav-item">
											<a class="d-block" href="contact-us.html">contact</a>
										</li>
									</ul>
								</div>
							</nav>
						</div>
					</div>
					<div class="col-sm-3 col-lg-2">
						<!-- wishListII -->
						<ul class="nav nav-tabs wishListII pt-5 justify-content-end border-bottom-0">
							<li class="nav-item ml-0"><a class="nav-link icon-search" href="javascript:void(0);"></a></li>
							<li class="nav-item"><a class="nav-link position-relative icon-cart" href="javascript:void(0);"><span class="num rounded d-block">2</span></a></li>
							<li class="nav-item"><a class="nav-link icon-profile" href="javascript:void(0);"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<!-- main -->
		<main>
			<!-- bannerBlockHolder -->
			<section class="bannerBlockHolder position-relative">
				<div class="slick-fade">
					<div>
						<!-- align -->
						<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url(http://placehold.it/1920x900)">
							<div class="container position-relative holder pt-xl-10">
								<div class="row">
									<div class="col-12 col-xl-7">
										<div class="txtwrap pr-xl-10">
											<span class="title d-block text-uppercase fwEbold position-relative pl-2 mb-md-5 mb-sm-3">wellcome to botanical</span>
											<h1 class="fwEbold position-relative mb-md-7 mb-sm-4">Houseplant <span class="text-break d-block">The Perfect Choice.</span></h1>
											<p class="mb-md-15 mb-sm-10">Lorem ipsum is simply dummy text of the printing and typesetting industry.</p>
											<a href="shop.html" class="btn btnTheme btnShop fwEbold text-white md-round py-3 px-4">Shop Now <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>
						<!-- align -->
						<div class="align w-100 bgCover" style="background-image: url(http://placehold.it/1920x900);">
							<div class="container position-relative holder pt-14">
								<!-- py-12 pt-lg-30 pb-lg-25 -->
								<div class="row">
									<div class="col-12 text-center">
										<div class="txtwrap pr-md-10">
											<h1 class="fwEbold position-relative mb-0">NUTRIENTS PLANTS</h1>
											<strong class="year d-block fwEbold mb-3">2019</strong>
											<span class="sub-title d-block text-uppercase mb-md-12 mb-6">OCCASSIONAL BOUQUET</span>
											<a href="shop.html" class="btn btnTheme btnShop fwEbold text-white md-round py-3 px-4">Shop Now <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="slickNavigatorsWrap">
					<a href="#" class="slick-prev"><i class="icon-leftarrow"></i></a>
					<a href="#" class="slick-next"><i class="icon-rightarrow"></i></a>
				</div>
			</section>
			<!-- contactListBlock -->
			<div class="contactListBlock container overflow-hidden pt-xl-24 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-4 pt-10 pb-1">
				<div class="row">
					<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
						<!-- contactListColumn -->
						<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
							<span class="icon icon-van"></span>
							<div class="alignLeft pl-2">
								<strong class="headingV fwEbold d-block mb-1">Free shipping order</strong>
								<p class="m-0">On orders over  $100</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
						<!-- contactListColumn -->
						<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
							<span class="icon icon-gift"></span>
							<div class="alignLeft pl-2">
								<strong class="headingV fwEbold d-block mb-1">Special gift card</strong>
								<p class="m-0">The perfect gift idea</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
						<!-- contactListColumn -->
						<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-4 px-md-2 px-3 d-flex">
							<span class="icon icon-recycle"></span>
							<div class="alignLeft pl-2">
								<strong class="headingV fwEbold d-block mb-1">Return &amp; exchange</strong>
								<p class="m-0">Free return within 3 days</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
						<!-- contactListColumn -->
						<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
							<span class="icon icon-call"></span>
							<div class="alignLeft pl-2">
								<strong class="headingV fwEbold d-block mb-1">Support 24 / 7</strong>
								<p class="m-0">Customer support</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container pt-xl-11 pb-xl-12 pt-lg-10 pb-lg-10 pt-md-8 pb-md-8 pt-5 pb-5">
				<div class="row">
					<div class="col-12">
						<!-- quotationBlock -->
						<blockquote class="quotationBlock text-center d-block m-0">
							<q class="d-block playfair mb-7">We ship healthy potted plants right to your doorstep. Each plant comes with simple care instructions from our plant experts.</q>
							<cite class="d-block">
								<img src="@/main/images/signature.png" alt="signature" class="img-fluid mb-6">
								<span class="d-flex flex-nowrap align-items-center justify-content-center">
									<strong class="fwEbold mr-1">Sarah Jefferson</strong>
									<span class="text-uppercase fwEbold pt-1">- CEO</span>
								</span>
							</cite>
						</blockquote>
					</div>
				</div>
			</div>
			<!-- featureSec -->
            <hb-feature-section-1/>
			<!-- categorySecBlock -->
			<hb-category-section/>
			<!-- featureSec -->
			<hb-feature-section/>
			
				<!-- testimonailBlock -->
				<hb-testimonial-block />

			<!-- latestSec -->
			<hb-latest-section/>
			<!-- footerHolder -->
            <hb-footer-holder />
		</main>
		<!-- footer -->
		<hb-footer/>
	</div>
</template>

<script>
export default {

}
</script>

<style>

</style>