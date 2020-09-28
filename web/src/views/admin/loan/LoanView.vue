<template>
  <div id="page-user-view">

    <vs-alert color="danger" title="Empréstimo Não Encontrado" :active.sync="loan_not_found">
      <span>O empréstimo com id {{ $route.params.loanId }} não foi encontrado. </span>
      <span>
        <span>Verificar </span><router-link :to="{name:'admin-loan-list'}" class="text-inherit underline">Todos Os Leitores</router-link>
      </span>
    </vs-alert>

    <div id="user-data" v-if="loan">

      <vx-card :title="'Dados do Leitor #' + loan.reader_id" class="mb-base data-show">

        <div class="vx-row">

          <!-- Reader image Col -->
          <div class="vx-col" id="image-col">
            <div class="img-container mb-4">
              <img v-if="loan.reader_image" :src="loan.reader_image" class="rounded w-full" />
              <img v-else src="../../../assets/images/user-image.png" class="rounded w-full">
            </div>
          </div>

          <!-- Reader Datas -->
          <div class="vx-col flex-1" id="account-info-col-1">
            <table>
              <tr>
                <td class="font-semibold">Nome</td>
                <td>{{ loan.reader_name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Email</td>
                <td>{{ loan.reader_email }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Telefone</td>
                <td>{{ loan.reader_phone }}</td>
              </tr>
            </table>
          </div>

          <div class="vx-col flex-1" id="account-info-col-1">
            <table>
              <tr>
                <td class="font-semibold">Sala</td>
                <td>{{ loan.reader_grade + 'º Ano "' + loan.reader_class + '"'}}</td>
              </tr>
              <tr>
                <td class="font-semibold">Curso</td>
                <td>{{ loan.course_name }}</td>
              </tr>
            </table>
          </div>

          <div class="vx-col w-full flex" id="account-manage-buttons">
            <vs-button icon-pack="feather" icon="icon-eye" type="border" class="mr-4" :to="{name: 'admin-reader-view', params: { readerId: loan.reader_id }}">Visualizar</vs-button>
          </div>

        </div>

      </vx-card>

      <div class="vx-row">
        <div class="vx-col lg:w-6/12 w-full">
          <vx-card :title="'Dados do Livro #' + loan.book_id " class="mb-base data-show">

            <div class="vx-row">

              <!-- Book image Col -->
              <div class="vx-col" id="image-col">
                <div class="img-container mb-4">
                  <img v-if="loan.book_cape" :src="loan.book_cape" class="rounded w-full" />
                  <img v-else src="../../../assets/images/image-not-founded.png" class="rounded w-full">
                </div>
              </div>

              <!-- Book Datas -->
              <div class="vx-col flex-1" id="account-info-col-1">
                <table>
                  <tr>
                    <td class="font-semibold">Título</td>
                    <td>{{ loan.book_title }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold">Subtítulo</td>
                    <td>{{ loan.book_subtitle }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold">Cor</td>
                    <td>{{ loan.book_color }}</td>
                  </tr>
                </table>
              </div>

              <div class="vx-col w-full flex" id="account-manage-buttons">
                <vs-button icon-pack="feather" icon="icon-eye" type="border" class="mr-4" :to="{name: 'app-book-view', params: { loanId: loan.book_id }}">Visualizar</vs-button>
              </div>
            </div>

          </vx-card>
        </div>

        <div class="vx-col lg:w-6/12 w-full">
          <vx-card :title="'Dados do Empréstimo #' + loan.id " class="mb-base data-show">

            <div class="vx-row">

              <!-- Loan Datas -->
              <div class="vx-col flex-1" id="account-info-col-1">
                <table>
                  <tr>
                    <td class="font-semibold">Data Estimada</td>
                    <td>{{ loan.estimated_date }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold">Data de Entrega</td>
                    <td v-if="return_date != undefined">{{ loan.return_date }}</td>
                    <td v-else>Não Devolvido</td>
                  </tr>
                  <tr>
                    <td class="font-semibold">Status</td>
                    <td>
                      <span :class="'status-color-' + statusColor(loan.status)">{{ loan.status }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="font-semibold">Criado Em</td>
                    <td>{{ loan.created_at }}</td>
                  </tr>
                </table>
              </div>

              <div class="vx-col w-full flex" id="account-manage-buttons">
                <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'app-loan-edit', params: { loanId: $route.params.loanId }}">Editar</vs-button>
                <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Deletar</vs-button>
              </div>

            </div>

          </vx-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moduleLoanManagement from '@/store/admin/loan/moduleLoanManagement.js'

export default {
  data() {
    return {
      loan: {},
      loan_not_found: false,
    }
  },
  methods: {
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Confirmar Exclusão`,
        text: `Você está prestes a excluir o empréstimo #"${this.loan.id}"`,
        accept: this.deleteRecord,
        acceptText: "Excluir",
        cancelText: "Cancelar",
      })
    },
    deleteRecord() {
      /* Below two lines are just for demo purpose */
      this.$store.dispatch('loanManagement/destroy', this.loan.id)
        .then(res => {
          this.$router.push({name:'admin-loan-list'})
          this.$vs.notify({
            title: 'Empréstimo Excluído',
            text: res.data.message,
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
          })
        })
        .catch(err => {
          this.$vs.notify({
            title: 'Empréstimo Não Excluído',
            text: err.message,
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
          })
        })
    },
  },
  mounted() {
    // Loading for Loans Request
    this.$vs.loading({
      container: '.data-show',
      scale: 0.6
    })
  },
  created() {
    // Register Module LoanManagement Module
    if(!moduleLoanManagement.isRegistered) {
      this.$store.registerModule('loanManagement', moduleLoanManagement)
      moduleLoanManagement.isRegistered = true
    }

    const loanId = this.$route.params.loanId

    this.$store.dispatch("loanManagement/show", loanId)
      .then(res => {
        this.loan = res.data
        this.$vs.loading.close(".data-show > .con-vs-loading")
      })
      .catch(err => {
        this.showDeleteFailed(err.data.message)
        this.$vs.loading.close(".data-show > .con-vs-loading")
      })
  },
  computed: {
    statusColor() {
      return (value) => {
          if(value === "Ativo") return "success"
          else if(value === "Pendente") return "danger"
          else if(value === "Inativo") return "warning"
          else "primary"
        }
    }
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

// For Status Color

.status-color-success {
  color: rgba(var(--vs-success),1) !important;
}
.status-color-warning {
  color: rgba(var(--vs-warning),1) !important;
}
.status-color-danger {
  color: rgba(var(--vs-danger),1) !important;
}

</style>
