<template>
  <section
    v-if="counters.length > 0"
    class="counterSec container pt-xl-12 pb-xl-24 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-5 pb-10"
  >
    <div class="row">
      <div class="col-12">
        <!-- progressCounter -->
        <ul
          class="progressCounter list-unstyled mb-2 d-flex flex-wrap text-capitalize text-center"
        >
          <li class="mb-md-0 mb-3" v-for="counter in counters">
            <strong class="d-block fwEbold counter mb-2">{{counter.value}}</strong>
            <strong class="d-block text-uppercase txtWrap"
              >{{counter.title}}</strong
            >
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    counters: {
      default: () => {
        return [];
      },
    },
  },
};
</script>

<style>
</style>