<template>
    <vs-chip class="ag-grid-cell-chip" :color="chipColor(params.value)">
      <span>{{ params.value }}</span>
    </vs-chip>
</template>

<script>
    export default {
        name: 'CellRendererRole',
        computed: {
          chipColor() {
            return (value) => {
              if(value === "Master") return "success"
              else if(value === "Comum") return "primary"
              else if(value === "Staff") return "warning"
              else "danger"
            }
          }
        }
    }
</script>

<style lang="scss" scoped>
.ag-grid-cell-chip {
  &.vs-chip-success {
    background: rgba(var(--vs-success),.15);
    color: rgba(var(--vs-success),1) !important;
    font-weight: 500;
  }
  &.vs-chip-warning {
    background: rgba(var(--vs-warning),.15);
    color: rgba(var(--vs-warning),1) !important;
    font-weight: 500;
  }
  &.vs-chip-primary {
    background: rgba(var(--vs-primary),.15);
    color: rgba(var(--vs-primary),1) !important;
    font-weight: 500;
  }
}
</style>
