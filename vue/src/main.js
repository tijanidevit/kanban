import Vue from 'vue'
import App from './App.vue'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
Vue.use(VModal)

Vue.config.productionTip = false
export const bus = new Vue();

new Vue({
  render: h => h(App),
}).$mount('#app')
