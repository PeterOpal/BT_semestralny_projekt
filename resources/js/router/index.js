import { createRouter, createWebHistory } from 'vue-router'
import MainView from "../views/MainView.vue";
import SpeakersView from "../views/SpeakersView.vue";
import RegisterView from "../views/RegisterView.vue";
import LoginView from "../views/LoginView.vue";
import DashboardView from "../views/Dashboard.vue";
import Stage from "../views/admin/Stage.vue"
import axios from 'axios';
import Sponsors from "../views/admin/Sponsors.vue";
import Testimonials from "../views/admin/Testimonials.vue";
import SponsorsView from "../views/PartnersView.vue"
import ContactView from "../views/ContactView.vue";
import CasoveOkna from "../views/admin/CasoveOkna.vue";
import ProgramView from "../views/ProgramView.vue";
import Sloty from "../views/admin/Sloty.vue";
import Speakers from "../views/admin/Speakers.vue";
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes: [
        {
            path: '/',
            name: 'home',
            component: MainView
        },
        {
            path: '/speakers',
            name: 'speakers',
            component: SpeakersView
        },
        {
            path: '/sponsors',
            name: 'sponsors',
            component: SponsorsView
        },
        {
            path: '/contact',
            name: 'contact',
            component: ContactView
        },
        {
            path: '/schedule',
            name: 'schedule',
            component: ProgramView
        },
        {
            path: '/register',
            component: RegisterView
        },
        {
            path: '/login',
            name: "login",
            component: LoginView
        },
        {
            path: '/dashboard',
            name: "Dashboard",
            component: DashboardView,
            beforeEnter: (to,from,next) =>{
                axios.get("api/authenticated").then(()=>{
                    next()
                }).catch(()=>{
                    return next({name: "login"})
                })
            }
        },
        {
            path: '/admin-stage',
            name: "Admin-stage",
            component: Stage,
            beforeEnter: (to, from, next) => {
                axios.get("api/authenticated").then(() => {
                    next();
                }).catch(() => {
                    return next({name: "login"});
                });
            }
        },
        {
            path: '/admin-sponsors',
            name: "Admin-sponsors",
            component: Sponsors,
            beforeEnter: (to, from, next) => {
                axios.get("api/authenticated").then(() => {
                    next();
                }).catch(() => {
                    return next({name: "login"});
                });
            }
        },
        {
            path: '/admin-testimonials',
            name: "Admin-testimonials",
            component: Testimonials,
            beforeEnter: (to, from, next) => {
                axios.get("api/authenticated").then(() => {
                    next();
                }).catch(() => {
                    return next({name: "login"});
                });
            }
        },
        {
            path: '/admin-sloty',
            name: "Admin-sloty",
            component: Sloty,
            beforeEnter: (to, from, next) => {
                axios.get("api/authenticated").then(() => {
                    next();
                }).catch(() => {
                    return next({name: "login"});
                });
            }
        },
        {
            path: '/admin-speakers',
            name: "Admin-speakers",
            component: Speakers,
            beforeEnter: (to, from, next) => {
                axios.get("api/authenticated").then(() => {
                    next();
                }).catch(() => {
                    return next({name: "login"});
                });
            }
        },
        {
            path: '/admin-casove-okna',
            name: "Admin-casove-okna",
            component: CasoveOkna,
            beforeEnter: (to, from, next) => {
                axios.get("api/authenticated").then(() => {
                    next();
                }).catch(() => {
                    return next({name: "login"});
                });
            }
        },

    ]
})

export default router
