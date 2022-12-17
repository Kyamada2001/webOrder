<template>
  <ul class="justify-center flex flex-row align-center border-collapse">
    <li v-if="currentPage > 1" class="pagination-item" @click="changePage(currentPage - 1)">
      <a href="#">Prev</a>
    </li>
    <li v-for="page in pages" :key="page" class="pagination-item" :class="{ 'bg-orange-100': currentPage === page }" @click="changePage(page)">
      <a href="#">{{ page }}</a>
    </li>
    <li v-if="currentPage < totalPages" class="pagination-item" @click="changePage(currentPage + 1)">
      <a href="#">Next</a>
    </li>
  </ul>
</template>
<script>

export default {
  props: {
    items: Array,
    currentPage: Number,
    perPage: Number,
    total: Number,
  },
  computed: {
    totalPages() {
      return Math.ceil(this.total / this.perPage);
    },
    pages() {
      const pages = [];
      for (let i = 1; i <= this.totalPages; i++) {
        pages.push(i);
      }
      return pages;
    }
  },
  data() {
    return {
    }
  },
  methods: {
    changePage(page) {
      if (this.currentPage === page) {
        return;
      }
      this.$emit('change', page);
    },
  }
}
</script>


