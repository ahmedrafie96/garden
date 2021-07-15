<template>
  <div class="container" v-if="product.description">
    <div class="row">
      <div class="col-12">
        <!-- tabSetList -->
        <ul class="list-unstyled tabSetList d-flex justify-content-center mb-9">
          <li class="mr-md-20 mr-sm-10 mr-2">
            <a href="#tab1-0" class="active playfair fwEbold pb-2"
              >{{$t('discreption')}}</a
            >
          </li>
        </ul>
        <!-- tab-content -->
        <div class="tab-content mb-xl-11 mb-lg-10 mb-md-8 mb-5">
          <div id="tab1-0" class="active">
            <p v-html="product.description">
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props:['product']
};
</script>

<style>
</style>