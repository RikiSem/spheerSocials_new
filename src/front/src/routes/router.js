import {createRouter, createWebHistory} from "vue-router";
import AuthPage from "../Pages/AuthPage.vue";
import MainPage from "../Pages/MainPage.vue";
import UserSocialsPage from "../Pages/UserSocialsPage.vue";
import SocialPage from "../Pages/SocialPage.vue";


const routes = [
    {
        path: '/',
        name: 'AuthPage',
        component: AuthPage
    },
    {
        path: '/user/:userId/settings',
        name: 'homePage',
        component: MainPage
    },
    {
        path: '/user/:userId/socials',
        component: UserSocialsPage
    },
    {
        path: '/social/:id/:userId/feed',
        name: 'socialFeed',
        component: SocialPage
    }
]

const router = createRouter({
    routes,
    history: createWebHistory()
});

export default router;
