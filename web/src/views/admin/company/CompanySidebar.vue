<template>
  <vs-sidebar
    click-not-close
    position-right
    parent="body"
    default-index="1"
    color="primary"
    class="add-new-data-sidebar items-no-padding"
    spacer
    v-model="isSidebarActiveLocal"
  >
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>
        {{ !id ? "CADASTRAR EDITORA" : `EDITAR EDITORA #${id}` }}
      </h4>
      <feather-icon
        icon="XIcon"
        @click.stop="isSidebarActiveLocal = false"
        class="cursor-pointer"
      ></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <VuePerfectScrollbar
      class="scroll-area--data-list-add-new"
      :settings="settings"
      :key="$vs.rtl"
    >
      <div class="p-6">
        <!-- Name -->
        <div class="w-full mb-6">
          <label>Nome</label>
          <vs-input
            icon-pack="feather"
            icon="icon-globe"
            icon-no-border
            v-model="company.name"
            class="w-full"
            placeholder="Nome da Editora"
          />
          <span class="text-danger text-sm" v-if="validations.name">
            {{ validations.name[0] }}
          </span>
        </div>

        <!-- About -->
        <div class="w-full mb-6">
          <label>Sobre a editora</label>
          <vs-textarea
            rows="5"
            counter="5000"
            :counter-danger.sync="counterDanger"
            v-model="company.about"
            class="mb-0"
          />
          <span class="text-danger text-sm" v-if="validations.about">
            {{ validations.about[0] }}
          </span>
        </div>
      </div>
    </VuePerfectScrollbar>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button v-if="!id" class="mr-6" @click="storeCompany">
        Cadastrar
      </vs-button>

      <vs-button v-else class="mr-6" @click="updateCompany">
        Salvar Alterações
      </vs-button>

      <vs-button type="flat" color="#999" @click="isSidebarActiveLocal = false">
        Cancelar
      </vs-button>
    </div>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";

import moduleCompanyManagement from "@/store/admin/company/moduleCompanyManagement.js";

export default {
  props: {
    id: Number,
    isSidebarActive: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      default: () => {}
    }
  },
  data() {
    return {
      company: {
        name: "",
        about: ""
      },

      settings: {
        maxScrollbarLength: 60,
        wheelSpeed: 0.6
      },

      validations: {},

      counterDanger: false
    };
  },
  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive;
      },
      set(val) {
        if (!val) {
          this.$emit("closeSidebar");
        }
      }
    }
  },
  methods: {
    storeCompany() {
      this.$store
        .dispatch("companyManagement/store", this.company)
        .then(response => {
          this.isSidebarActiveLocal = false;
          this.$vs.notify({
            title: "Editora Cadastrada",
            text: response.data.message,
            color: "success",
            iconPack: "feather",
            icon: "icon-check"
          });
          this.resetData();
        })
        .catch(error => {
          this.$vs.notify({
            title: "Erro no Cadastro",
            text: "Verifique os campos e os preencha corretamente",
            color: "danger",
            iconPack: "feather",
            icon: "icon-alert-circle"
          });
          this.validations = error.response.data.errors;
        });
    },
    getCompanyById(id) {
      const company = this.$store.getters["companyManagement/getCompanyById"](
        id
      );

      this.company = company;
    },
    updateCompany() {
      this.isSidebarActiveLocal = false;
      this.$store
        .dispatch("companyManagement/update", this.company)
        .then(response => {
          this.$vs.notify({
            title: "Editora",
            text: response.data.message,
            color: "success",
            iconPack: "feather",
            icon: "icon-check"
          });
        })
        .catch(error => {
          this.$vs.notify({
            title: `Editora #${this.company.id}`,
            text: "Houve um Erro na Edição, Tente Novamente",
            color: "danger",
            iconPack: "feather",
            icon: "icon-alert-circle"
          });
          this.validations = error.response.data.errors;
        });
    },
    resetData() {
      Object.assign(this.$data, this.$options.data());
    }
  },
  components: {
    VuePerfectScrollbar
  },
  created() {
    // Register Module CompanyManagement Module
    if (!moduleCompanyManagement.isRegistered) {
      this.$store.registerModule("companyManagement", moduleCompanyManagement);
      moduleCompanyManagement.isRegistered = true;
    }

    if (this.id) this.getCompanyById(this.id);
  }
};
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 400px;
    max-width: 90vw;
  }
}

.scroll-area--data-list-add-new {
  // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);
}
</style>
