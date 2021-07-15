<template>
  <div class="row">
    <div class="col-12">
      <!-- paggSlider -->
      <div class="paggSlider">
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
        <div>
          <div class="imgBlock">
            <img
              src="http://placehold.it/170x190"
              alt="image description"
              class="img-fluid"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    jQuery(".paggSlider").slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      asNavFor: ".productSliderImage",
      arrows: false,
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 1170,
          settings: {
            slidesToShow: 5,
          },
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
          },
        },
      ],
    });
  },
};
</script>

<style>
</style>