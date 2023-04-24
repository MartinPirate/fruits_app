<template>
  <div class="flex flex-col items-center mt-8">
    <!-- count text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">{{
        firstItemIndex
      }}</span>
      to
      <span class="font-semibold text-gray-900 dark:text-white">{{
        lastItemIndex
      }}</span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{
        totalItems
      }}</span>
      Entries
    </span>
    <div class="inline-flex mt-2 xs:mt-0 mb-4">
      <!-- Buttons -->
      <button
        :disabled="currentPage === 1"
        @click="prevPage"
        :class="[
          'inline-flex items-center px-4 py-2 text-sm font-medium text-white  rounded-l',
          currentPage === 1 ? 'bg-gray-500' : 'bg-gray-900',
        ]"
      >
        <svg
          aria-hidden="true"
          class="w-5 h-5 mr-2"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
        Prev
      </button>
      <button
        :disabled="currentPage === totalPages"
        @click="nextPage"
        :class="[
          'inline-flex items-center px-4 py-2 text-sm font-medium text-white border-0 border-l border-gray-700 rounded-r',
          currentPage === totalPages ? 'bg-gray-500' : 'bg-gray-900',
        ]"
      >
        Next
        <svg
          aria-hidden="true"
          class="w-5 h-5 ml-2"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, PropType } from "vue";

const props = defineProps({
  currentPage: {
    type: Number as PropType<number>,
    required: true,
  },
  totalPages: {
    type: Number as PropType<number>,
    required: true,
  },
  onPageChange: {
    type: Function as PropType<(page: number) => void>,
    required: true,
  },
  perPage: {
    type: Number,
    required: true,
  },
  totalItems: {
    type: Number,
    required: true,
  },
});

function prevPage() {
  if (props.currentPage > 1) {
    props.onPageChange?.(props.currentPage - 1);
  }
}

function nextPage() {
  if (props.currentPage < props.totalPages) {
    props.onPageChange?.(props.currentPage + 1);
  }
}

const firstItemIndex = computed(() => {
  return (props.currentPage - 1) * props.perPage + 1;
});

const lastItemIndex = computed(() => {
  const lastIndex = props.currentPage * props.perPage;
  return lastIndex > props.totalItems ? props.totalItems : lastIndex;
});
</script>
