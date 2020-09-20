<template>
  <span>{{ treatAuthors(params.value) }}</span>
</template>

<script>
  export default {
    name: 'CellRendererAuthors',
    methods: {
      treatAuthors(authors) {
        if (typeof authors !== 'undefined' && authors.length > 0)
          return authors[0].name
        else
          return "Autor não informado"
      }
    }
  }
</script>
