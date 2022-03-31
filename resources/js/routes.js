

//Auth
let login     = require('./components/auth/login.vue').default;
let register  = require('./components/auth/register.vue').default;
let forget    = require('./components/auth/forget.vue').default;
let logout    = require('./components/auth/logout.vue').default;


//End Auth
let home = require('./components/home.vue').default;

//Employee Components
let employee      = require('./components/employee/index.vue').default;
let storeemployee = require('./components/employee/create.vue').default;
let editemployee  = require('./components/employee/edit.vue').default;

//Supplier Components
let supplier      = require('./components/supplier/index.vue').default;
let storesupplier = require('./components/supplier/create.vue').default;
let editsupplier  = require('./components/supplier/edit.vue').default;

//Category Components
let category      = require('./components/category/index.vue').default;
let storecategory = require('./components/category/create.vue').default;
let editcategory  = require('./components/category/edit.vue').default;

export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forget', component: forget, name: 'forget' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },

    //Employee Routes
    { path: '/employee', component: employee, name: 'employee' },
    { path: '/store-employee', component: storeemployee, name: 'store-employee' },
    { path: '/edit-employee/:id', component: editemployee, name: 'edit-employee' },

    //Supplier Routes
    {path: '/supplier', component: supplier, name:'supplier'},
    {path:'/store-supplier',component: storesupplier, name:'store-supplier'},
    {path:'/edit-supplier/:id',component: editsupplier, name:'edit-supplier'},

    //Category Routes
    {path: '/category', component: category, name:'category'},
    {path:'/store-category',component: storecategory, name:'store-category'},
    {path:'/edit-category/:id',component: editcategory, name:'edit-category'},
  ]