<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <feather-icon icon="EyeIcon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="viewRecord" />
      <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord" />
      <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
    export default {
        name: 'CellRendererActions',
        methods: {
          viewRecord() {
            this.$router.push('/leitores/visualizacao/' + this.params.data.id).catch(() => {})
          },
          editRecord() {
            this.$router.push("/leitores/edicao/" + this.params.data.id).catch(() => {})
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
            this.$store.dispatch("readerManagement/destroy", this.params.data.id)
              .then(res => {
                this.showDeleteSuccess(res.data.message)
              })
              .catch(err => {
                this.showDeleteFailed(err.data.message)
                console.error(err)
              })
          },
          showDeleteSuccess(message) {
            this.$vs.notify({
              color: 'success',
              title: 'Leitor excluído',
              text: message,
              iconPack: 'feather',
              icon: 'icon-check',
            })
          },
          showDeleteFailed(message) {
            this.$vs.notify({
              color: 'danger',
              title: 'Leitor não excluído',
              text: message,
              iconPack: 'feather',
              icon: 'icon-alert-circle',
            })
          }
        }
    }
</script>
