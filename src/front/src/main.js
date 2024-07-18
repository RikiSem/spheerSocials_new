import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './App.vue';
import components from './Components/UI';
import directives from './Directives';
import router from "./routes/router.js";
import store from "./Store";

const app = createApp(App);
components.forEach(component => {
    app.component(component.name, component);
})
directives.forEach(directive => {
    app.directive(directive.name, directive);
})

app.config.globalProperties.coreUrl = 'http://localhost:8080';

app
    .use(router)
    .use(store)
    .mount('#app');
