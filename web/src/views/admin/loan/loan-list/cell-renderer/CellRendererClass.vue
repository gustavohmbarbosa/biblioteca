<template>
    <span>{{ params.value + 'º ' + params.data.reader_class + ' ' + courseName() }}</span>
</template>

<script>
    export default {
        name: 'CellRendererClass',
        methods: {
          courseName() {
            if (this.params.data.course_id === "1")
              return "Desenvolvimento de Sistemas"
            else
              return "Logística"
          }
        }
    }
</script>

<style scoped>

div {
  display: block;
}

</style>
