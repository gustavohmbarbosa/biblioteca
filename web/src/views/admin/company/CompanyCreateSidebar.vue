<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary"
    class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>CADASTRAR EDITORA</h4>
      <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <VuePerfectScrollbar class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

      <div class="p-6">
        <!-- NAME -->
        <label>Nome</label>
        <vs-input icon-pack="feather" icon="icon-user" icon-no-border v-model="company.name" class="w-full"
          placeholder="Nome da Editora" />
        <div class="text-danger text-sm" v-if="validations.name">
          <span class="text-danger text-sm" v-show="validations.name">{{ validations.name[0] }}</span>
        </div>
      </div>

    </VuePerfectScrollbar>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="storeCompany(company)">Cadastrar</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Cancelar</vs-button>
    </div>
  </vs-sidebar>
</template>

<script>
  import VuePerfectScrollbar from 'vue-perfect-scrollbar'

  import moduleCompanyManagement from '@/store/admin/company/moduleCompanyManagement.js'

  export default {
    props: {
      isSidebarActive: {
        type: Boolean,
        required: true
      },
      data: {
        type: Object,
        default: () => {},
      }
    },
    data() {
      return {
        company: {
          name: "",
        },
        settings: { // perfectscrollbar settings
          maxScrollbarLength: 60,
          wheelSpeed: .60,
        },
        validations: {}
      }
    },
    computed: {
      isSidebarActiveLocal: {
        get() {
          return this.isSidebarActive
        },
        set(val) {
          if (!val) {
            this.$emit('closeSidebar')
          }
        }
      },
    },
    methods: {
      storeCompany(company) {
        this.$store.dispatch('companyManagement/store', company)
          .then(response => {
            this.isSidebarActiveLocal = false
            this.$vs.notify({
              title: "Editora Cadastrada",
              text: response.data.message,
              color: "success",
              iconPack: 'feather',
              icon: 'icon-check',
            })
            this.resetData()
          })
          .catch(error => {
            this.$vs.notify({
              title: "Erro no Cadastro",
              text: "Preencha os campos corretamente",
              color: "danger",
              iconPack: 'feather',
              icon:'icon-alert-circle'
            })
            this.validations = error.response.data
          })
      },
      resetData() {
        Object.assign(this.$data, this.$options.data())
      },
    },
    components: {
      VuePerfectScrollbar,
    },
    created() {
      // Register Module CompanyManagement Module
      if (!moduleCompanyManagement.isRegistered) {
        this.$store.registerModule('companyManagement', moduleCompanyManagement)
        moduleCompanyManagement.isRegistered = true
      }
    }
  }

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