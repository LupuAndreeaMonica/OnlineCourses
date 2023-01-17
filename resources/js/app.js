import Vue from 'vue'
import VModal from 'vue-js-modal'
import App from './components/App'

Vue.use(VModal)

new Vue({
    el: '#app',
    template: '<App/>',
    components: { App }
})
