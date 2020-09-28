<template>
  <div id="page-user-view">

    <vs-alert color="danger" title="Compania Não Encontrada" :active.sync="company_not_found">
      <span>A compania com id {{ $route.params.companyId }} não foi encontrada. </span>
      <span>
        <span>Verificar </span><router-link :to="{name:'admin-company-list'}" class="text-inherit underline">Todos Os Autores</router-link>
      </span>
    </vs-alert>

    <div id="user-data" v-if="company">

      <vx-card title="Registro" class="mb-base" id="data-show">

        <div class="vx-row">

          <!-- Information - Col 1 -->
          <div class="vx-col" id="account-info-col-1">
            <table>
              <tr>
                <td class="font-semibold">Nome</td>
                <td>{{ company.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Criado Em</td>
                <td>{{ company.created_at }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Atualizado Em</td>
                <td>{{ company.updated_at }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <div class="vx-col w-full flex" id="account-manage-buttons">
            <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'admin-company-edit', params: { companyId: $route.params.companyId }}">Editar</vs-button>
            <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Excluir</vs-button>
          </div>

        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
import moduleCompanyManagement from '@/store/admin/company/moduleCompanyManagement.js'

export default {
  data() {
    return {
      company: {},
      company_not_found: false,
    }
  },
  methods: {
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Confirmar Exclusão`,
        text: `Você está prestes a excluir "${this.company.name}"`,
        accept: this.deleteRecord,
        acceptText: "Excluir",
        cancelText: "Cancelar",
      })
    },
    deleteRecord() {
      /* Below two lines are just for demo purpose */
      this.$store.dispatch('companyManagement/destroy', this.company.id)
        .then(res => {
          this.$router.push({name:'admin-company-list'})
          this.$vs.notify({
            title: 'Autor Excluído',
            text: res.data.message,
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
          })
        })
        .catch(err => {
          this.$vs.notify({
            title: 'Autor Não Excluído',
            text: err.message,
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
          })
        })
    },
  },
  mounted() {
    // Loading for Companys Request
    this.$vs.loading({
      container: '#data-show',
      scale: 0.6
    })
  },
  created() {
    // Register Module CompanyManagement Module
    if(!moduleCompanyManagement.isRegistered) {
      this.$store.registerModule('companyManagement', moduleCompanyManagement)
      moduleCompanyManagement.isRegistered = true
    }

    const companyId = this.$route.params.companyId

    this.$store.dispatch("companyManagement/show", companyId)
      .then(res => {
        this.company = res.data
        this.$vs.loading.close("#data-show > .con-vs-loading")
      })
      .catch(err => {
        this.showDeleteFailed(err.data.message)
        this.$vs.loading.close("#data-show > .con-vs-loading")
      })
  }
}

</script>

<style lang="scss">

#image-col {
  width: 10rem;
}

#page-user-view {
  table {
    td {
      vertical-align: top;
      min-width: 140px;
      padding-bottom: .8rem;
      word-break: break-all;
    }

    &:not(.permissions-table) {
      td {
        @media screen and (max-width:370px) {
          display: block;
        }
      }
    }
  }
}

@media screen and (min-width:1201px) and (max-width:1211px),
only screen and (min-width:636px) and (max-width:991px) {
  #account-info-col-1 {
    width: calc(100% - 12rem) !important;
  }
}

</style>
