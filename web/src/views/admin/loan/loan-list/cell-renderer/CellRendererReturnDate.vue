<template>
  <span>{{ cellValue() }}</span>
</template>

<script>
  export default {
    name: 'CellRendererReturnDate',
    methods: {
      cellValue() {
        if (this.params.data.return_date == null || this.params.data.return_date == 'null')
          return "Não devolvido"
        else
          return this.params.data.return_date
      }
    }
  }
</script>
