import "./styles/app.css";

// start the Stimulus application
import { createApp } from "vue";
// @ts-ignore
import App from "./App.vue";
import { router } from "./router/router";
import swal from "./plugins/swal";
import { createPinia } from "pinia";

const pinia = createPinia();

const app = createApp(App).use(router).use(pinia).use(swal);

app.mount("#app");
