<template>
  <div class="flex items-center">
    <vs-avatar
     :src="params.data.reader_image"
     class="flex-shrink-0 mr-2"
     size="30px"
     @click="$router.push(url())" />

    <router-link :to="url()" @click.stop.prevent class="text-inherit hover:text-primary">
      {{ params.value }}
    </router-link>
  </div>
</template>

<script>
  export default {
    name: 'CellRendereReaderName',
    methods: {
      url() {
        return {
          name: 'admin-reader-view',
          params: { readerId: this.params.data.reader_id }
        }
      }
    }
  }
</script>
