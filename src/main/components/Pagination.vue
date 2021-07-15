<template>
  <div class="col-12 mb-sm-0 mb-6">
    <!-- pagination -->
    <ul
      class="list-unstyled pagination d-flex justify-content-center align-items-end"
    >
      <li>
        <a
          href="javascript:void(0);"
          @click="
            $emit('paginated', meta.current_page - ($vuetify.rtl ? 1 : -1))
          "
          ><i :class="`fas fa-chevron-${$vuetify.rtl ? 'right' : 'left'}`"></i
        ></a>
      </li>
      <li
        v-for="id in meta.last_page"
        :class="meta.current_page == id ? 'active' : ''"
        :key="id"
        @click="$emit('paginated', id)"
      >
        <a href="javascript:void(0);">{{ id }}</a>
      </li>
      <!-- <li><a href="javascript:void(0);">2</a></li> -->
      <!-- <li>...</li> -->
      <li>
        <a
          href="javascript:void(0);"
          @click="
            $emit('paginated', meta.current_page - (!$vuetify.rtl ? 1 : -1))
          "
          ><i :class="`fas fa-chevron-${!$vuetify.rtl ? 'right' : 'left'}`"></i
        ></a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["meta"],
};
</script>

<style>
</style>