
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Router Import
import {routes} from './routes';


//Import Userr Class
import User from './Helpers/User';
window.User = User


//Notification Noty
import Notification from './Helpers/Notification';
window.Notification = Notification



//Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast

//End Sweet Alert

window.Reload = new Vue();

const router = new VueRouter({
    routes,
    mode: 'history'
})



const app = new Vue({
    el: '#app',
    router
});
