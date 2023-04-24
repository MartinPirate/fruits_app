<template>
  <Header />

  <div class="container mx-auto">
    <div class="px-4 pt-6">
      <FruitsList :fruits="fruits" />
    </div>
  </div>
</template>

<script setup lang="ts">
import FruitsList from "./views/FruitsList.vue";
import Header from "./Header.vue";
import { initFlowbite } from "flowbite";
import { onMounted, reactive } from "vue";
import { storeToRefs } from "pinia";
import { useFruitStore } from "./store/store";

onMounted(() => {
  initFlowbite();
});

const { fruits, loading, error } = storeToRefs(useFruitStore());
const { fetchFruits } = useFruitStore();

fetchFruits();
</script>
