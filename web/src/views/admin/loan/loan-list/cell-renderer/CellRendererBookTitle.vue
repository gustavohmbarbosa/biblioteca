<template>
  <div>
    <router-link :to="url()" @click.stop.prevent class="text-inherit hover:text-primary">
      {{ params.value }}
    </router-link>
  </div>
</template>

<script>
  export default {
    name: 'CellRendererBookTitle',
    methods: {
      url() {
        return {
          name: 'admin-book-view',
          params: { bookId: this.params.data.book_id }
        }
      }
    }
  }
</script>
