<template>
  <div class="vx-row mb-base">
    <vx-card :title="title" class="form-container">
      <slot></slot>
    </vx-card>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String
    }
  }
};
</script>

<style lang="scss">
.form-container {
  margin-left: 1rem;
  margin-right: 1rem;
}

@media (min-width: 1024px) {
  .form-container {
    width: 65%;
    margin: auto;
  }
}
</style>
