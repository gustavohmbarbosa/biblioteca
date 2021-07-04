<template>
  <div :style="{ direction: $vs.rtl ? 'rtl' : 'ltr' }">
    <company-edit-sidebar
      :isSidebarActive="editSidebarActive"
      @closeSidebar="toggleEditSidebar"
      :data="editSidebarData"
      :id="params.data.id"
    />

    <feather-icon
      icon="EyeIcon"
      svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
      @click="view"
    />

    <feather-icon
      icon="Edit3Icon"
      svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
      @click="edit"
    />

    <feather-icon
      icon="Trash2Icon"
      svgClasses="h-5 w-5 hover:text-danger cursor-pointer"
      @click="confirmDelete"
    />
  </div>
</template>

<script>
import CompanyEditSidebar from "@/views/admin/company/CompanySidebar.vue";

export default {
  name: "CellRendererActions",
  components: {
    CompanyEditSidebar
  },
  data() {
    return {
      // Edit Company sidebar
      editSidebarActive: false,
      editSidebarData: {}
    };
  },
  methods: {
    view() {
      this.$router
        .push("/admin/editoras/visualizacao/" + this.params.data.id)
        .catch(() => {});
    },
    edit() {
      this.editSidebarData = {};
      this.toggleEditSidebar(true);
    },
    toggleEditSidebar(state = false) {
      this.editSidebarActive = state;
    },
    confirmDelete() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirmar Exclusão`,
        text: `Você está prestes a excluir "${this.params.data.name}"`,
        accept: this.delete,
        acceptText: "Excluir",
        cancelText: "Cancelar"
      });
    },
    delete() {
      this.$store
        .dispatch("companyManagement/destroy", this.params.data.id)
        .then(response => {
          this.showDeleteSuccess(response.data.message);
        })
        .catch(error => {
          this.showDeleteFailed(error.data.message);
          console.error(error);
        });
    },
    showDeleteSuccess(message) {
      this.$vs.notify({
        color: "success",
        title: "Editora excluída!",
        text: message,
        iconPack: "feather",
        icon: "icon-check"
      });
    },
    showDeleteFailed(message) {
      this.$vs.notify({
        color: "danger",
        title: "Editora não excluída!",
        text: message,
        iconPack: "feather",
        icon: "icon-alert-circle"
      });
    }
  }
};
</script>
