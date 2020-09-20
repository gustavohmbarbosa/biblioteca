<template>
  <div id="page-reader-list">
    <div class="vx-card p-6">
      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ coursesData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : coursesData.length }} de {{ coursesData.length }}</span>
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

        <!-- SEARCH INPUT -->
        <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Buscar..." />

        <!-- EXPORT PROMPT -->
        <vs-prompt title="Exportar para Excel" class="export-options" @cancle="clearFields" @accept="exportToExcel" accept-text="Baixar" @close="clearFields" :active.sync="activePrompt">
          <vs-input v-model="fileName" placeholder="Digite o nome do arquivo.." class="w-full" />
          <v-select v-model="selectedFormat" :options="formats" class="my-4" />
          <div class="flex">
            <span class="mr-4">Células com Tamanho Responsivo:</span>
            <vs-switch v-model="cellAutoWidth">Tamanho Responsivo</vs-switch>
          </div>
        </vs-prompt>

        <vs-button @click="activePrompt=true" class="sm:mr-4">Exportar</vs-button>

        <!-- ACTIONS DROPDOWN -->
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
        :rowData="coursesData"
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
import moduleCourseManagement from '@/store/admin/course/moduleCourseManagement.js'

// Cell Renderer
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"


export default {
  components: {
    AgGridVue,
    vSelect,

    // Cell Renderer
    CellRendererActions
  },
  data() {
    return {

      // Filter Options
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
          width: 265
        },
        {
          headerName: 'Criado Em',
          field: 'created_at',
          filter: true,
          width: 230
        },
        {
          headerName: 'Atualizado Em',
          field: 'updated_at',
          filter: true,
          width: 230
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
        CellRendererActions
      },

      // Excel Exportation
      activePrompt: false,
      fileName: "",
      formats:["xlsx", "csv", "txt"] ,
      cellAutoWidth: true,
      selectedFormat: "xlsx",
      headerTitle: ["Id", "Nome", "Criado Em", "Atualizado Em"],
      headerVal: ["id", "name", "created_at", "updated_at"],
    }
  },
  computed: {
    coursesData() {
      return this.$store.state.courseManagement.courses
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
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val)
    },

    // Excel Exportation
    exportToExcel() {
      import('@/vendor/Export2Excel').then(excel => {
        const list = this.$store.state.courseManagement.courses
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

    if(this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
      header.style.left = "-" + String(Number(header.style.transform.slice(11,-3)) + 9) + "px"
    }

    // Loading for Courses Request
    this.$vs.loading({
      container: '#datatable-list',
      scale: 0.6
    })
  },
  created() {
    if(!moduleCourseManagement.isRegistered) {
      this.$store.registerModule('courseManagement', moduleCourseManagement)
      moduleCourseManagement.isRegistered = true
    }

    this.$store.dispatch("courseManagement/index")
    .then(() => {
      this.$vs.loading.close("#datatable-list > .con-vs-loading")
    })
    .catch(error => {
      this.$vs.loading.close("#datatable-list > .con-vs-loading")

      this.$vs.notify({
        title: 'Erro!',
        text: 'Não foi possível carregar os dados!',
        color: 'danger',
        iconPack: 'feather',
        icon: 'icon-alert-circle',
      })
      console.error(error)
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
