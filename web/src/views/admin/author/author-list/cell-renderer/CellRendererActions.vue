<template>
  <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
    <feather-icon
     icon="EyeIcon"
     svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
     @click="viewRecord" />

    <feather-icon
     icon="Edit3Icon"
     svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
     @click="editRecord" />

    <feather-icon
     icon="Trash2Icon"
     svgClasses="h-5 w-5 hover:text-danger cursor-pointer"
     @click="confirmDeleteRecord" />
  </div>
</template>

<script>
  export default {
    name: 'CellRendererActions',
    methods: {
      viewRecord() {
        this.$router.push('/admin/autores/visualizacao/' + this.params.data.id).catch(() => {})
      },
      editRecord() {
        this.$router.push("/admin/autores/edicao/" + this.params.data.id).catch(() => {})
      },
      confirmDeleteRecord() {
        this.$vs.dialog({
          type: 'confirm',
          color: 'danger',
          title: `Confirmar Exclusão`,
          text: `Você está prestes a excluir "${this.params.data.name}"`,
          accept: this.deleteRecord,
          acceptText: "Excluir",
          cancelText: "Cancelar",
        })
      },
      deleteRecord() {
        this.$store.dispatch("authorManagement/destroy", this.params.data.id)
          .then(response => {
            this.showDeleteSuccess(response.data.message)
          })
          .catch(error => {
            this.showDeleteFailed(error.data.message)
            console.error(error)
          })
      },
      showDeleteSuccess(message) {
        this.$vs.notify({
          color: 'success',
          title: 'Autor excluído',
          text: message,
          iconPack: 'feather',
          icon: 'icon-check',
        })
      },
      showDeleteFailed(message) {
        this.$vs.notify({
          color: 'danger',
          title: 'Autor não excluído',
          text: message,
          iconPack: 'feather',
          icon: 'icon-alert-circle',
        })
      }
    }
  }
</script>
