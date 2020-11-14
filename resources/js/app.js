/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//vuex
import store from './store/index';
//routes
import VueRouter from 'vue-router';
import {routes} from './routes';
//fontawesome
import {library} from '@fortawesome/fontawesome-svg-core'
import {faUserSecret} from '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
//element-ui
import ElementUi from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css'
//bootstrap
import {LayoutPlugin} from 'bootstrap-vue'
import {BootstrapVue, IconsPlugin, BootstrapVueIcons, FormPlugin} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// misc
import Avatar from 'vue-avatar';
import infiniteScroll from 'vue-infinite-scroll'
import moment from 'moment';
import 'vue-mdc/dist/vue-mdc.css';
import StarRating from 'vue-star-rating';
import VueScrollactive from 'vue-scrollactive';
import VueChatScroll from 'vue-chat-scroll'
import VModal from 'vue-js-modal'
// Vuetify
import Vuetify from 'vuetify'
import colors from 'vuetify/es5/util/colors'
import 'vuetify/dist/vuetify.min.css'

require('./bootstrap');

window.Vue = require('vue');

library.add(faUserSecret);
Vue.use(ElementUi);
Vue.use(VueRouter);
Vue.use(VueScrollactive);
Vue.use(infiniteScroll);
Vue.use(VModal, {dialog: true});
Vue.use(Vuetify, {
    theme: {
        light: {
            primary: colors.purple,
            secondary: colors.grey.darken1,
            accent: colors.shades.black,
            error: colors.red.accent3,
        }
    }
});

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.use(FormPlugin);
Vue.use(BootstrapVueIcons);
Vue.use(LayoutPlugin);
Vue.use(VueChatScroll);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('profile-component', require('./components/ProfileComponent.vue').default);
Vue.component('create-article-component', require('./components/CreateArticle.vue').default);
Vue.component('all-articles-component', require('./components/AllArticles.vue').default);
Vue.component('article-listing-base', require('./components/ArticleListingBase.vue').default);
Vue.component('create-secret-component', require('./components/CreateSecret.vue').default);
Vue.component('all-secrets-component', require('./components/AllSecrets.vue').default);
Vue.component('notification', require('./pages/Notification.vue').default);
Vue.component('landing-menu-bar', require('./pages/LandingMenuBar.vue').default);
Vue.component('landing', require('./pages/Landing.vue').default);
Vue.component('sidebar', require('./components/Sidebar').default);
Vue.component('main-nav', require('./components/MainNav').default);
Vue.component('article-section', require('./pages/Article.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('star-rating', StarRating);
Vue.component('customized-star-rating', require('./components/CustomizedStarRating.vue').default);
Vue.component('pricing', require('./pages/Pricing.vue').default);
Vue.component('home', require('./pages/Home.vue').default);
Vue.component('chat-component', require('./components/ChatComponent').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('all-counselling-request', require('./components/AllCounsellingRequest.vue').default);
Vue.component('locked-secret', require('./components/lockedSecret').default);
Vue.component('unlocked-secret', require('./components/unlockedSecret').default);
Vue.component('info-notification', require('./components/InfoNotification').default);
Vue.component('event-notification', require('./components/EventNotification').default);
Vue.component('voucher-option', require('./components/voucher/voucherOptionComponent').default);
Vue.component('voucher-redemption-success', require('./components/voucher/voucherRedemptionSuccessComponent').default);

Vue.config.productionTip = false;

//Vue.prototype.$userId = document.querySelector("meta[name='user_id']").getAttribute('content');

Vue.filter('dateFormat', function (value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});

const router = new VueRouter({
    mode: 'history',
    routes
});

export const app = new Vue({
    Vuetify,
    el: '#app',
    store,
    router,
    components: {
        Avatar,
    },
});
