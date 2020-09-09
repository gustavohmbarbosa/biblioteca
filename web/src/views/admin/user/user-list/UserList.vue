<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

  <div id="page-reader-list">

    <vx-card ref="filterCard" title="Filtros" class="reader-list-filters mb-8" actionButtons @refresh="resetColFilters" @remove="resetColFilters">
      <div class="vx-row">
        <div class="vx-col w-full">
          <label class="text-sm opacity-75">Função</label>
          <v-select :options="roleOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="roleFilter" class="mb-4 md:mb-0" />
        </div>
      </div>
    </vx-card>

    <div class="vx-card p-6">

      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ usersData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : usersData.length }} de {{ usersData.length }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>

              <vs-dropdown-item @click="gridApi.paginationSetPageSize(10)">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(25)">
                <span>25</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(30)">
                <span>30</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
          <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Buscar..." />
          <!-- <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()">Export as CSV</vs-button> -->

          <!-- EXPORT PROMPT-->
          <vs-prompt title="Exportar para Excel" class="export-options" @cancle="clearFields" @accept="exportToExcel" accept-text="Baixar" @close="clearFields" :active.sync="activePrompt">
            <vs-input v-model="fileName" placeholder="Digite o nome do arquivo.." class="w-full" />
            <v-select v-model="selectedFormat" :options="formats" class="my-4" />
            <div class="flex">
              <span class="mr-4">Células com Tamanho Responsivo:</span>
              <vs-switch v-model="cellAutoWidth">Tamanho Responsivo</vs-switch>
            </div>
          </vs-prompt>

          <vs-button @click="activePrompt=true">Exportar</vs-button>
      </div>


      <!-- AgGrid Table -->
      <ag-grid-vue
        id="datatable-list"
        ref="agGridTable"
        :components="components"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="usersData"
        rowSelection="multiple"
        colResizeDefault="shift"
        :animateRows="true"
        :floatingFilter="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :suppressPaginationPanel="true"
        :enableRtl="$vs.rtl">
      </ag-grid-vue>

      <vs-pagination
        :total="totalPages"
        :max="7"
        v-model="currentPage" />

    </div>
  </div>

</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@/assets/scss/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

// Store Module
import moduleUserManagement from '@/store/admin/user/moduleUserManagement.js'

// Cell Renderer
import CellRendererRole from "./cell-renderer/CellRendererRole.vue"
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"
import CellRendererAvatar from "./cell-renderer/CellRendererAvatar.vue"


export default {
  components: {
    AgGridVue,
    vSelect,

    // Cell Renderer
    CellRendererRole,
    CellRendererActions,
    CellRendererAvatar,
  },
  data() {
    return {

      // Filter Options
      roleFilter: { label: 'All', value: 'all' },
      roleOptions: [
        { label: 'All', value: 'all' },
        { label: 'Master', value: 'Master' },
        { label: 'Comum', value: 'Comum' },
        { label: 'Staff', value: 'Staff' },
      ],

      statusFilter: { label: 'Todos', value: 'all' },
      statusOptions: [
        { label: 'Todos', value: 'all' },
        { label: 'Ativado', value: 'Ativo' },
        { label: 'Desativado', value: 'Inativo' },
        { label: 'Bloqueado', value: 'Bloqueado' },
      ],

      searchQuery: "",

      // AgGrid
      gridApi: null,
      gridOptions: {},
      defaultColDef: {
        sortable: true,
        resizable: true,
        suppressMenu: true
      },
      columnDefs: [
        {
          headerName: 'ID',
          field: 'id',
          width: 125,
          checkboxSelection: true,
          headerCheckboxSelectionFilteredOnly: true,
          headerCheckboxSelection: true,
        },
        {
          headerName: 'Nome',
          field: 'name',
          filter: true,
          width: 310,
          cellRendererFramework: "CellRendererAvatar"
        },
        {
          headerName: 'Email',
          field: 'email',
          filter: true,
          width: 275,
        },
        {
          headerName: 'Função',
          field: 'role',
          filter: true,
          width: 150,
          cellRendererFramework: 'CellRendererRole'
        },
        {
          headerName: 'Ações',
          field: 'transactions',
          width: 125,
          cellRendererFramework: 'CellRendererActions',
        },
      ],

      // Cell Renderer Components
      components: {
        CellRendererRole,
        CellRendererActions,
        CellRendererAvatar,
      },

      // For Excel Export
      activePrompt: false,
      fileName: "",
      formats:["xlsx", "csv", "txt"] ,
      cellAutoWidth: true,
      selectedFormat: "xlsx",
      headerTitle: ["Id", "Nome", "Email", "Função", "Criado Em", "Atualizado Em"],
      headerVal: ["id", "name", "email", "role", "created_at", "updated_at"],
    }
  },
  watch: {
    roleFilter(obj) {
      this.setColumnFilter("role", obj.value)
    },
    isVerifiedFilter(obj) {
      let val = obj.value === "all" ? "all" : obj.value == "yes" ? "true" : "false"
      this.setColumnFilter("is_verified", val)
    },
    departmentFilter(obj) {
      this.setColumnFilter("department", obj.value)
    },
  },
  computed: {
    usersData() {
      return this.$store.state.userManagement.users
    },
    paginationPageSize() {
      if(this.gridApi) return this.gridApi.paginationGetPageSize()
      else return 10
    },
    totalPages() {
      if(this.gridApi) return this.gridApi.paginationGetTotalPages()
      else return 0
    },
    currentPage: {
      get() {
        if(this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
        else return 1
      },
      set(val) {
        this.gridApi.paginationGoToPage(val - 1)
      }
    }
  },
  methods: {
    setColumnFilter(column, val) {
      const filter = this.gridApi.getFilterInstance(column)
      let modelObj = null

      if(val !== "all") {
        modelObj = { type: "equals", filter: val }
      }

      filter.setModel(modelObj)
      this.gridApi.onFilterChanged()
    },
    resetColFilters() {
      // Reset Grid Filter
      this.gridApi.setFilterModel(null)
      this.gridApi.onFilterChanged()

      // Reset Filter Options
      this.roleFilter = this.isVerifiedFilter = this.departmentFilter = { label: 'Todos', value: 'all' }

      this.$refs.filterCard.removeRefreshAnimation()
    },
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val)
    },
    refreshCard(card) {
      card.removeRefreshAnimation(3000);
    },

    // For Excel Export
    exportToExcel() {
      import('@/vendor/Export2Excel').then(excel => {
        const list = this.$store.state.userManagement.users
        const data = this.formatJson(this.headerVal, list)
        excel.export_json_to_excel({
          header: this.headerTitle,
          data,
          filename: this.fileName,
          autoWidth: this.cellAutoWidth,
          bookType: this.selectedFormat
        })
        this.clearFields()
      })
    },
    formatJson(filterVal, jsonData) {
      return jsonData.map(v => filterVal.map(j => {
        return v[j]
      }))
    },
    clearFields() {
      this.filename = "",
      this.cellAutoWidth = true,
      this.selectedFormat = "xlsx"
    }
  },
  mounted() {
    this.gridApi = this.gridOptions.api

    /* =================================================================
      NOTE:
      Header is not aligned properly in RTL version of agGrid table.
      However, we given fix to this issue. If you want more robust solution please contact them at gitHub
    ================================================================= */
    if(this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
      header.style.left = "-" + String(Number(header.style.transform.slice(11,-3)) + 9) + "px"
    }

    // Loading for Users Request
    this.$vs.loading({
      container: '#datatable-list',
      scale: 0.6
    })
  },
  created() {
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }

    this.$store.dispatch("userManagement/index")
    .then(() => {
      this.$vs.loading.close("#datatable-list > .con-vs-loading")
    })
    .catch(err => {
      this.$vs.loading.close("#datatable-list > .con-vs-loading")

      this.$vs.notify({
        title: 'Erro!',
        text: 'Não foi possível carregar os dados!',
        color: 'danger',
        iconPack: 'feather',
        icon: 'icon-alert-circle',
      })
      console.error(err)
    })
  }
}
</script>

<style lang="scss">
#page-user-list {
  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }
}
</style>

<style lang="scss">
#page-user-list {
  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }
}
</style>
