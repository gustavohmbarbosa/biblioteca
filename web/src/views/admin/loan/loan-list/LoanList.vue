<template>
  <div id="page-reader-list">
    <vx-card ref="filterCard" title="Filtros" class="reader-list-filters mb-8" actionButtons @refresh="resetColFilters" @remove="resetColFilters">
      <div class="vx-row">
        <div class="vx-col w-full">
          <label class="text-sm opacity-75">Status</label>
          <v-select :options="statusOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="statusFilter" class="mb-4 md:mb-0" />
        </div>
      </div>
    </vx-card>

    <div class="vx-card p-6">
      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ loansData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : loansData.length }} de {{ loansData.length }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>

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

        <!-- CREATE A NEW LOAN -->
        <vs-button @click="$router.push({ name: 'admin-loan-create' })" class="sm:mr-4" type="border">
          <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
          Novo Empréstimo
        </vs-button>

        <!-- SEARCH INPUT -->
        <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Buscar..." />

        <!-- EXPORT PROMPT-->
        <vs-prompt title="Exportar para Excel" class="export-options" @cancle="clearFields" @accept="exportToExcel" accept-text="Baixar" @close="clearFields" :active.sync="activePrompt">
          <vs-input v-model="fileName" placeholder="Digite o nome do arquivo.." class="w-full" />
          <v-select v-model="selectedFormat" :options="formats" class="my-4" />
          <div class="flex">
            <span class="mr-4">Células com Tamanho Responsivo:</span>
            <vs-switch v-model="cellAutoWidth">Tamanho Responsivo</vs-switch>
          </div>
        </vs-prompt>

        <vs-button @click="activePrompt=true" class="sm:mr-4">Exportar</vs-button>

        <vs-dropdown vs-trigger-click class="cursor-pointer">
          <div class="p-3 shadow-drop rounded-lg d-theme-dark-light-bg cursor-pointer flex items-end justify-center text-lg font-small w-32">
            <span class="mr-2 leading-none">Ações</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>

          <vs-dropdown-menu>
            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                <span>Deletar</span>
              </span>
            </vs-dropdown-item>

            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                <span>Arquivar</span>
              </span>
            </vs-dropdown-item>

            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                <span>Imprimir</span>
              </span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
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
        :rowData="loansData"
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
import moduleLoanManagement from '@/store/admin/loan/moduleLoanManagement.js'

// Cell Renderer
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"
import CellRendererReaderName from "./cell-renderer/CellRendererReaderName.vue"
import CellRendererBookTitle from "./cell-renderer/CellRendererBookTitle.vue"
import CellRendererClass from "./cell-renderer/CellRendererClass.vue"
import CellRendererStatus from "./cell-renderer/CellRendererStatus.vue"
import CellRendererReturnDate from './cell-renderer/CellRendererReturnDate.vue'

export default {
  components: {
    AgGridVue,
    vSelect,

    // Cell Renderer
    CellRendererActions,
    CellRendererReaderName,
    CellRendererBookTitle,
    CellRendererClass,
    CellRendererStatus,
    CellRendererReturnDate
  },
  data() {
    return {

      // Filter Options
      statusFilter: { label: 'Todos', value: 'all' },
      statusOptions: [
        { label: 'Todos', value: 'all' },
        { label: 'Ativado', value: 'Ativo' },
        { label: 'Desativado', value: 'Inativo' },
        { label: 'Pendente', value: 'Pendente' },
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
          headerName: 'Leitor',
          field: 'reader_name',
          filter: true,
          width: 250,
          cellRendererFramework: 'CellRendererReaderName'
        },
        {
          headerName: 'Livro',
          field: 'book_title',
          filter: true,
          width: 225,
          cellRendererFramework: 'CellRendererBookTitle',
        },
        {
          headerName: 'Status',
          field: 'status',
          width: 125,
          cellRendererFramework: 'CellRendererStatus',
        },
        {
          headerName: 'Entrega',
          field: 'return_date',
          width: 150,
          cellRendererFramework: 'CellRendererReturnDate'
        },
        {
          headerName: 'Ações',
          field: 'transactions',
          width: 110,
          cellRendererFramework: 'CellRendererActions',
        },
      ],

      // Cell Renderer Components
      components: {
        CellRendererActions,
        CellRendererReaderName,
        CellRendererBookTitle,
        CellRendererClass,
        CellRendererReturnDate
      },

      // For Excel Export
      activePrompt: false,
      fileName: "",
      formats:["xlsx", "csv", "txt"] ,
      cellAutoWidth: true,
      selectedFormat: "xlsx",
      headerTitle: ["Id", "Nome do Leitor", "Título do Livro", "Status", "Data de Entrega Estimada", "Data de Devolução"],
      headerVal: ["id", "reader_name", "book_title", "status", "estimated_date", "return_date"],
    }
  },
  watch: {
    statusFilter(obj) {
      this.setColumnFilter("status", obj.value)
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
    loansData() {
      return this.$store.state.loanManagement.loans
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
      this.roleFilter = this.statusFilter = this.isVerifiedFilter = this.departmentFilter = { label: 'Todos', value: 'all' }

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
        const list = this.$store.state.loanManagement.loans
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
    // this.gridOptions.getRowStyle = (params) => {
    //   if (params.data.status === 'Pendente'){
    //     return { background: 'rgba(234, 84, 85, .15)' };
    //   }
    // }

    /* =================================================================
      NOTE:
      Header is not aligned properly in RTL version of agGrid table.
      However, we given fix to this issue. If you want more robust solution please contact them at gitHub
    ================================================================= */
    if(this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
      header.style.left = "-" + String(Number(header.style.transform.slice(11,-3)) + 9) + "px"
    }

    // Loading for Loans Request
    this.$vs.loading({
      container: '#datatable-list',
      scale: 0.6
    })
  },
  created() {
    if(!moduleLoanManagement.isRegistered) {
      this.$store.registerModule('loanManagement', moduleLoanManagement)
      moduleLoanManagement.isRegistered = true
    }

    this.$store.dispatch("loanManagement/index")
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
  .danger-row {
    background: rgba(var(--vs-danger),.15);
    color: rgba(var(--vs-danger),1) !important;
    font-weight: 500;
  }
}
</style>
