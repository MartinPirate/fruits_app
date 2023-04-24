<script lang="ts" setup>
const props = defineProps<{
  fruit: any;
  required: true;
}>();
</script>

<template>
  <div
    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
  >
    <a href="#">
      <h6
        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
      >
        {{ props.fruit.name }}
      </h6>
    </a>

    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
      Nutrients:
    </h2>
    <ol
      class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400"
    >
      <li>
        <span class="font-semibold text-gray-900 dark:text-white">Fats</span>
        with
        <span class="font-semibold text-gray-900 dark:text-white">{{
          props.fruit.fats
        }}</span>
      </li>
      <li>
        <span class="font-semibold text-gray-900 dark:text-white"
          >Calories</span
        >
        with
        <span class="font-semibold text-gray-900 dark:text-white">{{
          props.fruit.calories
        }}</span>
      </li>
      <li>
        <span class="font-semibold text-gray-900 dark:text-white"
          >Carbohydrates</span
        >
        with
        <span class="font-semibold text-gray-900 dark:text-white">{{
          props.fruit.carbs
        }}</span>
      </li>
      <li>
        <span class="font-semibold text-gray-900 dark:text-white">protein</span>
        with
        <span class="font-semibold text-gray-900 dark:text-white">{{
          props.fruit.protein
        }}</span>
      </li>
    </ol>

    <!--        <button
                class=" mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Remove from Favourites
        </button>-->
  </div>
</template>
