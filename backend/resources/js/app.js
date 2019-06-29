/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import VueRouter from 'vue-router'
//
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);
import {
    Form,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform'

Vue.use(VueRouter)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)

const routes = [
    { path: '/admin/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/admin/category', component: require('./components/Category.vue').default },
    { path: '/admin/location', component: require('./components/Location.vue').default },
    { path: '/admin/tourist-route', component: require('./components/TouristRoute.vue').default },
    { path: '/admin/tourist-route/add', component: require('./components/TouristRouteAdd.vue').default },
    { path: '/admin/tourist-route/edit/:tr_id', name: 'editTouristRoute', component: require('./components/TouristRouteEdit.vue').default, props: true, },
    { path: '/admin/developer', component: require('./components/Developer.vue').default },
    { path: '/admin/users', component: require('./components/Users.vue').default },
    { path: '/admin/profile', component: require('./components/Profile.vue').default },
    { path: '/admin/*', component: require('./components/NotFound.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})


Vue.filter('upText', function (text) {
    let res = text.split(" ");


    for (let index = 0; index < res.length; index++) {
        const element = res[index];
        res[index] = element.charAt(0).toUpperCase() + element.slice(1).toLowerCase();
    }

    let result = "";
    for (let index = 0; index < res.length - 1; index++) {
        result = result + res[index] + " ";
    }
    result = result + res[res.length - 1];

    return result;
});

Vue.filter('myDate', function (created) {
    return moment(created).format('MMMM Do YYYY');
});

Vue.filter('formatPrice', function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
});

window.Fire = new Vue();

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast;

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mr-2',
        cancelButton: 'btn btn-danger mr-2'
    },
    buttonsStyling: false,
})

window.swalWithBootstrapButtons = swalWithBootstrapButtons;


Vue.component('pagination', require('laravel-vue-pagination'));

import vSelect from 'vue-select'

Vue.component('v-select', vSelect)

vSelect.props.components.default = () => ({
    Deselect: {
        render: createElement => createElement('span', '❌'),
    },
    OpenIndicator: {
        render: createElement => createElement('span', '🔽'),
    },
});

import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload)

import VueUploadMultipleImage from 'vue-upload-multiple-image'
Vue.component('vue-upload-multiple-image', VueUploadMultipleImage)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('my-component', require('./components/MyComponent.vue').default);
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

Vue.component(
    'destination-add',
    require('./components/tourist_route_add/DestinationsAddComponent.vue').default
);

Vue.component(
    'tourist-route-detail-add',
    require('./components/tourist_route_add/TouristRouteDetailAddComponent.vue').default
);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const api = 'http://localhost:8000/api';
Vue.prototype.$Api = api;

const host = 'http://localhost:8000';
Vue.prototype.$Host = host;

const app = new Vue({
    el: '#app',
    router,
    data: {
        search: ''
    },
    // methods: {
    //     searchit: _.debounce(() => {
    //         Fire.$emit('searching');
    //     }, 1000),

    //     printme() {
    //         window.print();
    //     }
    // }
});
