<template>
  <section class="introSec bg-lightGray pt-xl-12 pb-xl-7 pt-10 pb-10">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 mb-lg-0 mb-6">
          <img
            :src="paragraph.image"
            alt="image description"
            class="img-fluid"
          />
        </div>
        <div class="col-12 col-lg-6">
          <div id="accordion" class="accordionList pt-lg-12">
            <div class="card mb-2" v-for="menu in paragraph.menus">
              <div class="card-header px-xl-5 py-xl-3" id="headingOne">
                <h5 class="mb-0">
                  <button
                    class="btn btn-link fwEbold text-uppercase text-left w-100 p-0"
                    data-toggle="collapse"
                    data-target="#collapseOne"
                    aria-expanded="true"
                    aria-controls="collapseOne"
                  >
                    {{menu.title}}
                    <i class="fas fa-sort-down float-right"></i>
                  </button>
                </h5>
              </div>
              <div
                id="collapseOne"
                class="collapse show"
                aria-labelledby="headingOne"
                data-parent="#accordion"
              >
                <div class="card-body px-xl-5 py-0">
                  <p class="mb-7">
                      {{menu.text}}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props:{
    paragraph:{
      default:()=>{
        return {
          image:'',
          menus:[]
        }
      }
    }
  }
};
</script>

<style>
</style>