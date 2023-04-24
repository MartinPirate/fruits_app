import { defineStore } from "pinia";
import { axiosInstance } from "../plugins/axios";

export const useFavouriteFruitsStore = defineStore({
  id: "favouriteFruits",
  state: () => ({
    fruits: [] as FavouriteFruit[],
    fruit: null,
    loading: false,
    error: null,
  }),
  actions: {
    async fetchFavouriteFruits() {
      this.fruits = [];
      this.loading = true;
      try {
        this.fruits = await axiosInstance
          .get("/favourite-fruits")
          .then((response) => response.data.data);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
  },
});
