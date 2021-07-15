import Vue from 'vue'
import FlagIcon from 'vue-flag-icon'
import App from './App.vue'
import router from './router'
import store from '../store'
import './plugins/base'
import './plugins/chartist'
import './plugins/vee-validate'
import vuetify from './plugins/vuetify'
import i18n from '../store/i18n/i18n'
import * as VueGoogleMaps from "vue2-google-maps";
import './plugins/registrar'
import ckeditor from './plugins/ckeditor';

Vue.use(FlagIcon);
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyDZgmD8nmJyFpjkvZbtMd7b-YWYBPx9CMA",
  },
  installComponents: true,
});
 
Vue.config.productionTip = false
new Vue({
  router,
  store,
  vuetify,
  i18n,
  ckeditor,
  render: h => h(App),
}).$mount('#app')
let locale = localStorage.getItem("locale");
if (!locale) {
  locale = navigator.language;
}
store.dispatch('locales/change', locale);
