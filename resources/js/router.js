import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./views/Home";
import Login from "./views/Login";
import Register from "./views/Register";
import Logout from "./Actions/Logout"

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: "/",
            component: Home,
            meta: { title: 'Búsqueda'}
        },
        {
            path: '/login',
            component: Login,
            meta: { title: 'Iniciar Sesión'}
        },
        {
            path: '/register',
            component: Register,
            meta: { title: 'Registrarse'}
        },
        {
            path: '/logout', component: Logout,
        },
    ],
    mode: 'history'
})
