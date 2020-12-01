<template>
  <div class="mb-base" id="page-user-view">

    <vs-alert color="danger" title="Leitor Não Encontrado" :active.sync="reader_not_found">
      <span>O leitor com id {{ $route.params.readerId }} não foi encontrado. </span>
      <span>Verificar </span>
      <router-link :to="{name:'admin-reader-list'}" class="text-inherit underline">Todos Os Leitores</router-link>
    </vs-alert>

    <div>
      <vx-card :title="'Registro #' + reader.id " class="view-container" id="reader-data">

        <div class="vx-row">

          <!-- image Col -->
          <div class="vx-col">
            <div>
              <vs-chip class="chip-status" :color="chipColor(reader.status)">
                <span>{{ reader.status }}</span>
              </vs-chip>
            </div>

            <div class="w-full reader-image">
              <img v-if="reader.image" :src="reader.image" />
              <img v-else src="../../../assets/images/user-image.png">
            </div>

            <div class="vx-row actions">

              <vx-tooltip class="vx-col"  position="top" text="Voltar">
                <feather-icon
                icon="ArrowLeftIcon"
                svgClasses="h-6 w-6 hover:text-dark cursor-pointer"
                @click="$router.back()" />
              </vx-tooltip>

              <vx-tooltip class="vx-col"  position="top" :text="'Editar dados de ' + reader.name">
                <feather-icon
                icon="Edit3Icon"
                svgClasses="h-6 w-6 hover:text-primary cursor-pointer"
                @click="editRecord" />
              </vx-tooltip>

              <vx-tooltip class="vx-col"  position="top" :text="'Excluir ' + reader.name + ' do sistema'">
                <feather-icon
                icon="Trash2Icon"
                svgClasses="h-6 w-6 hover:text-danger cursor-pointer"
                @click="confirmDeleteRecord" />
              </vx-tooltip>

            </div>
          </div>

          <!-- Information - Col 1 -->
          <div class="vx-col flex-1" id="account-info-col-1">
            <table>
              <tr>
                <td class="font-semibold">Nome</td>
                <td>{{ reader.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Email</td>
                <td>{{ reader.email }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Telefone</td>
                <td>{{ reader.phone }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Gênero</td>
                <td>{{ reader.gender }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Matrícula</td>
                <td>{{ reader.registration }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Ano de Matrícula</td>
                <td>{{ reader.entry_year }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <!-- Information - Col 2 -->
          <div class="vx-col flex-1" id="account-info-col-2">
            <table>
              <tr>
                <td class="font-semibold">Série</td>
                <td>{{ reader.grade + 'º Ano' }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Turma</td>
                <td>{{ reader.class }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Curso</td>
                <td>{{ reader.course.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Criado Em</td>
                <td>{{ reader.created_at }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Atualizado Em</td>
                <td>{{ reader.updated_at }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 2 -->

        </div>

      </vx-card>
    </div>
  </div>
</template>

<script>
  import moduleReaderManagement from '@/store/admin/reader/moduleReaderManagement.js'

  export default {
    data() {
      return {
        reader: {},
        reader_not_found: false,
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
      editRecord() {
        this.$router.push({ name: "admin-reader-edit", params: { readerId: this.reader.id } }).catch(() => {})
      },
      confirmDeleteRecord() {
        this.$vs.dialog({
          type: 'confirm',
          color: 'danger',
          title: `Confirmar Exclusão`,
          text: `Você está prestes a excluir "${this.reader.name}"`,
          accept: this.deleteRecord,
          acceptText: "Excluir",
          cancelText: "Cancelar",
        })
      },
      deleteRecord() {
        this.$store.dispatch("readerManagement/destroy", this.reader.id)
          .then(response => {
            this.showDeleteSuccess(response.data.message)
          })
          .catch(error => {
            this.showDeleteFailed(error.data.message)
            console.error(error)
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
    },
    created() {
      if (!moduleReaderManagement.isRegistered) {
        this.$store.registerModule('readerManagement', moduleReaderManagement)
        moduleReaderManagement.isRegistered = true
      }

      const readerId = this.$route.params.readerId

      this.$vs.loading("#reader-data")

      this.$store.dispatch("readerManagement/show", readerId)
        .then(res => {
          this.$vs.loading.close(".con-vs-loading")
          this.reader = res.data
        })
        .catch(err => {
          this.$vs.loading.close(".con-vs-loading")

          if (err.response.status === 404) {
            this.reader_not_found = true
            return
          }
          console.error(err)
          this.showDeleteFailed(err.data.message)
        })
    }
  }

</script>

<style lang="scss" scoped>
  .reader-image {
    img {
      width: 10rem;
      border-radius: 50%;
    }
  }

  .actions {
    margin: 0rem;
    margin-top: 1rem;
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
