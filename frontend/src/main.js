import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'
import router from './router'
import VueTheMask from 'vue-the-mask'

Vue.config.productionTip = false
Vue.prototype.$hostname = 'http://qs.localhost:8000';
Vue.use(VueResource)
Vue.use(VueTheMask)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
