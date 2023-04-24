import { defineStore } from "pinia";
import { axiosInstance } from "../plugins/axios";
import Swal from "sweetalert2";

export const useFruitStore = defineStore({
  id: "fruits",
  state: () => ({
    fruits: [] as Fruit[],
    fruit: null,
    loading: false,
    error: null,
  }),
  getters: {
    filteredFruits: (state) => {
      return (name: string) =>
        state.fruits.filter((fruit) => fruit.family === name || fruit.family === name);
    },
  },
  actions: {
    async fetchFruits() {
      this.fruits = [];
      this.loading = true;
      try {
        this.fruits = await axiosInstance
          .get("/fruits")
          .then((response) => response.data.data);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async toggleFavouriteFruit(fruit: Fruit) {
      try {
        await fetch(`/api/toggle_favourite/${fruit.id}`, {
          method: "POST",
          body: JSON.stringify({ isFavorite: !fruit.isFavourite }),
          headers: {
            "Content-Type": "application/json",
          },
        }).then((response) => {
          if (response.ok) {
            return response.json().then((data) => {
              Swal.fire("Success", data.message, "success");

              const index = this.fruits.findIndex(
                (f: Fruit) => f.id === fruit.id
              );
              this.fruits[index] = data.data[0];
            });
          } else {
            return response.json().then((data) => {
              Swal.fire("Error", data.message, "error");
            });
          }
        });
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
  },
});
