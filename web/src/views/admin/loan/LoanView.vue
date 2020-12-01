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
          <div class="vx-col">
            <div>
              <vs-chip class="chip-status" :color="chipColor(loan.reader_status)">
                <span>{{ loan.reader_status }}</span>
              </vs-chip>
            </div>

            <div class="w-full reader-image">
              <img v-if="loan.reader_image" :src="loan.reader_image" />
              <img v-else src="../../../assets/images/user-image.png">
            </div>

            <div class="vx-row actions">
              <vx-tooltip  position="top" text="Ver dados do leitor">
                <feather-icon
                icon="EyeIcon"
                svgClasses="h-6 w-6 hover:text-dark cursor-pointer"
                @click="viewReader" />
              </vx-tooltip>
            </div>
          </div>

          <!-- Reader Datas -->
          <div class="vx-col flex-1" id="reader-info-col-1">
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

          <div class="vx-col flex-1" id="reader-info-col-2">
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
        </div>

      </vx-card>

      <div class="vx-row">
        <div class="vx-col lg:w-6/12 w-full">
          <vx-card :title="'Dados do Livro #' + loan.book_id " class="mb-base data-show-book">

            <div class="vx-row">

              <!-- Book image Col -->
              <div class="vx-col" id="image-col">
                <div class="img-container mb-4">
                  <img v-if="loan.book_cape" :src="loan.book_cape" class="rounded w-full" />
                  <img v-else src="../../../assets/images/image-not-founded.png" class="rounded w-full">
                </div>

                <div class="vx-row actions">
                  <vx-tooltip position="top" text="Ver dados do livro">
                    <feather-icon
                    icon="EyeIcon"
                    svgClasses="h-6 w-6 hover:text-dark cursor-pointer"
                    @click="viewBook" />
                  </vx-tooltip>
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
            </div>

          </vx-card>
        </div>

        <div class="vx-col lg:w-6/12 w-full">
          <vx-card :title="'Dados do Empréstimo #' + loan.id " class="mb-base data-show-loan">

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
            </div>


            <div class="vx-row actions">
              <vx-tooltip position="top" text="Editar dados do empréstimo">
                <feather-icon
                icon="Edit3Icon"
                svgClasses="h-6 w-6 mr-3 hover:text-dark cursor-pointer"
                @click="editLoan" />
              </vx-tooltip>

              <vx-tooltip position="top" text="Excluir empréstimo">
                <feather-icon
                icon="Trash2Icon"
                svgClasses="h-6 w-6 hover:text-dark cursor-pointer"
                @click="confirmDeleteRecord" />
              </vx-tooltip>
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
    chipColor(value) {
      let color

      switch (value) {
        case "Ativo":
          color = "success"
          break
        case "Inativo":
          color = "danger"
          break
        case "Bloqueado":
          color = "warning"
          break
        default:
          color = "primary"
          break
      }

      return color
    },
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
    viewReader() {
      this.$router.push({ name: "admin-reader-view", params: { readerId: this.loan.reader_id } }).catch(() => {})
    },
    viewBook() {
      this.$router.push({ name: "admin-book-view", params: { bookId: this.loan.book_id } }).catch(() => {})
    },
    editLoan() {
      this.$router.push({ name: "admin-loan-edit", params: { loanId: this.loan.id } }).catch(() => {})
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
.reader-image {
    img {
      width: 10rem;
      border-radius: 50%;
    }
  }

.actions {
  margin: 0rem;
  margin-top: 1rem;
  display: flex;
  justify-content: center;
}

.data-show-book, .data-show-loan {
  height: 18rem;
}

#image-col {
  width: 10rem;
}

#reader-info-col-2, #reader-info-col-1 {
  display: flex;
  align-items: center;
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

.chip-status {
    text-align: center;
    margin-left: 17%;
    margin-right: 83%;
    margin-bottom: 1rem;
    width: 8em;

    &.vs-chip-success {
      background: rgba(var(--vs-success), .15);
      color: rgba(var(--vs-success), 1) !important;
      font-weight: 500;
    }

    &.vs-chip-warning {
      background: rgba(var(--vs-warning), .15);
      color: rgba(var(--vs-warning), 1) !important;
      font-weight: 500;
    }

    &.vs-chip-danger {
      background: rgba(var(--vs-danger), .15);
      color: rgba(var(--vs-danger), 1) !important;
      font-weight: 500;
    }
  }

</style>
