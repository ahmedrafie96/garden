<template>
			<section class="featureSec container-fluid overflow-hidden pt-xl-12 pt-lg-10 pt-md-80 pt-5 pb-xl-10 pb-lg-4 pb-md-2 px-xl-14 px-lg-7">
				<!-- mainHeader -->

				<div class="col-12 p-0 overflow-hidden d-flex flex-wrap">
					<!-- featureCol -->
					<div v-for="item in items" class="featureCol px-3 mb-6">
						<div class="border">
							<div class="imgHolder position-relative w-100 overflow-hidden">
								<img   :src="item.image.url" alt="image description" class="img-fluid w-100">
								<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0" dir="ltr">
									<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
									<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
									<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
									<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
								</ul>
							</div>
							<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
								<span class="title d-block mb-2"><router-link :to="`/product/${item.id}`">{{item.name}}</router-link ></span>
								<span class="price d-block fwEbold">{{item.price}} $</span>
							</div>
						</div>
					</div>

				</div>
			</section>

</template>

<script>
export default {
  props: ["items", "featured_items"],
  data() {
    return {
      fab: false,
    };
  },
  methods: {
    like(item) {
      if (item.liked) {
        console.log("test");
        this.$store.dispatch("product_reaction/delete", item);
      } else {
        this.$store.dispatch("product_reaction/store", item);
      }
    },
    added_to_cart(item) {
      this.$emit("added_to_cart", item);
    },
  },
  mounted() {
    this.$store.dispatch("country/index", { id });
  },
};
</script>

<style>
</style>