import Vue from 'vue'
import VueMeta from 'vue-meta'
import FlagIcon from 'vue-flag-icon'
import './registerServiceWorker'
import router from './router'
import store from '../store'
import vuetify from './plugins/vuetify';
import jQuery from 'jquery';
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

import 'popper.js';
import 'bootstrap';
import './plugins/registrar';
import App from './App.vue'
import i18n from '../store/i18n/i18n'
import VueSocialauth from './plugins/social-auth';
import VueFacebook from './plugins/vue_facebook';
import VuesSocialSharing from './plugins/vue_social_share';
Vue.config.productionTip = false;
import * as VueGoogleMaps from "vue2-google-maps";
import VueSocialSharing from 'vue-social-sharing';
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyDZgmD8nmJyFpjkvZbtMd7b-YWYBPx9CMA",
  },
  installComponents: true,
});
Vue.prototype.jQuery = jQuery;
Vue.use(VueMeta)
Vue.use(VueSocialauth);
Vue.use(FlagIcon);
Vue.use(VueFacebook);
Vue.use(VueSocialSharing);
new Vue({
  created: function () {
    // window.fbAsyncInit = function() {
    //     FB.init({
    //       appId            : '1471878553204666',
    //       autoLogAppEvents : true,
    //       xfbml            : true,
    //       version          : 'v3.1'
    //     });
    // };
    // <script async defer crossorigin="anonymous"
    // src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=1471878553204666&autoLogAppEvents=1"
    // nonce="aKJh4WZs"></script>

    window.fbAsyncInit = function () {
      FB.init({
        appId: '152204063514919',
        cookie: true,
        xfbml: true,
        version: 'v3.1'
      });

      FB.AppEvents.logPageView();
      window.FB = FB;

    };

    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {
        return;
      }
      js = d.createElement(s);
      js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // (function (d, s, id) {
    //   var js, fjs = d.getElementsByTagName(s)[0];
    //   if (d.getElementById(id)) return;
    //   js = d.createElement(s);
    //   js.id = id;
    //   js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=1471878553204666&autoLogAppEvents=1",
    //     fjs.parentNode.insertBefore(js, fjs);
    // }(document, 'script', 'facebook-jssdk'));
  },
  router,
  store,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app')

store.dispatch('auth/load');
let locale = localStorage.getItem("locale");
if (!locale) {
  locale = navigator.language;
}
store.dispatch('locales/change', locale);
// require('./registerServiceWorker');

/*


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

*/