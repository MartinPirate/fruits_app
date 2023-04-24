import { App } from "vue";
import Swal from "sweetalert2";

export default {
  install: (app: App) => {
    app.config.globalProperties.$swal = Swal;
  },
};
