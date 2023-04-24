<template>
  <div class="container mx-auto">
    <div class="px-4 pt-6">
      <PageHeader />
      <div class="flex flex-wrap gap-3 mt-4 mb-8">
        <div v-for="fruit in fruits" :key="fruit.id">
          <Favourite :fruit="fruit" required />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import Favourite from "../components/Favourite.vue";
import PageHeader from "../components/PageHeader.vue";
import { reactive } from "vue";
import { axiosInstance } from "../plugins/axios";
import { storeToRefs } from "pinia";
import { useFruitStore } from "../store/store";
import { useFavouriteFruitsStore } from "../store/favouriteFruit";

const { fruits, loading, error } = storeToRefs(useFavouriteFruitsStore());
const { fetchFavouriteFruits } = useFavouriteFruitsStore();

fetchFavouriteFruits();
</script>
