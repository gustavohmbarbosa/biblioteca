<template>
  <div class="flex items-center">
    <vs-avatar :src="params.data.image" class="flex-shrink-0 mr-2" size="30px"/>
    <span class="text-inherit">{{ params.value }}</span>
  </div>
</template>

<script>
  export default {
    name: 'CellRendererAvatar'
  }
</script>
