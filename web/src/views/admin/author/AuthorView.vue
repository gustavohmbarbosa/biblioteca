<template>
  <div class="mb-base" id="page-author-view">

    <vs-alert color="danger" title="Autor Não Encontrado" :active.sync="author_not_found">
      <span>O autor com id {{ $route.params.authorId }} não foi encontrado. </span>
      <span>Verificar </span>
      <router-link :to="{name:'admin-author-list'}" class="text-inherit underline">Todos Os Autores</router-link>
    </vs-alert>

    <div>
      <vx-card :title="'Registro #' + author.id " class="view-container" id="author-data">

        <!-- image -->
        <div class="vx-row">

          <!-- image Col -->
          <div class="vx-col">
            <div class="w-full author-image">
              <img v-if="author.image" :src="author.image" />
              <img v-else src="../../../assets/images/user-image.png">
            </div>

            <div class="vx-row actions">

              <vx-tooltip class="vx-col"  position="top" text="Voltar">
                <feather-icon
                icon="ArrowLeftIcon"
                svgClasses="h-6 w-6 hover:text-dark cursor-pointer"
                @click="$router.back()" />
              </vx-tooltip>

              <vx-tooltip class="vx-col"  position="top" :text="'Editar dados de ' + author.name">
                <feather-icon
                icon="Edit3Icon"
                svgClasses="h-6 w-6 hover:text-primary cursor-pointer"
                @click="editRecord" />
              </vx-tooltip>

              <vx-tooltip class="vx-col"  position="top" :text="'Excluir ' + author.name + ' do sistema'">
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
                <td>{{ author.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Biografia</td>
                <td>{{ author.biography }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Criado Em</td>
                <td>{{ author.created_at }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Atualizado Em</td>
                <td>{{ author.updated_at }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->
        </div>

      </vx-card>
    </div>
  </div>
</template>

<script>
  import moduleAuthorManagement from '@/store/admin/author/moduleAuthorManagement.js'

  export default {
    data() {
      return {
        author: {},
        author_not_found: false,
      }
    },
    methods: {
      editRecord() {
        this.$router.push("/autores/edicao/" + this.author.id).catch(() => {})
      },
      confirmDeleteRecord() {
        this.$vs.dialog({
          type: 'confirm',
          color: 'danger',
          title: `Confirmar Exclusão`,
          text: `Você está prestes a excluir "${this.author.name}"`,
          accept: this.deleteRecord,
          acceptText: "Excluir",
          cancelText: "Cancelar",
        })
      },
      deleteRecord() {
        this.$store.dispatch("authorManagement/destroy", this.author.id)
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
          title: 'Autor excluído',
          text: message,
          iconPack: 'feather',
          icon: 'icon-check',
        })
      },
      showDeleteFailed(message) {
        this.$vs.notify({
          color: 'danger',
          title: 'Autor não excluído',
          text: message,
          iconPack: 'feather',
          icon: 'icon-alert-circle',
        })
      }
    },
    created() {
      if (!moduleAuthorManagement.isRegistered) {
        this.$store.registerModule('authorManagement', moduleAuthorManagement)
        moduleAuthorManagement.isRegistered = true
      }

      const authorId = this.$route.params.authorId

      this.$vs.loading("#author-data")

      this.$store.dispatch("authorManagement/show", authorId)
        .then(res => {
          this.$vs.loading.close(".con-vs-loading")
          this.author = res.data
          console.log(this.author.image)
        })
        .catch(err => {
          this.$vs.loading.close(".con-vs-loading")

          if (err.response.status === 404) {
            this.author_not_found = true
            return
          }
          console.error(err)
          this.showDeleteFailed(err.data.message)
        })
    }
  }

</script>

<style lang="scss" scoped>
  .author-image {
    img {
      width: 10rem;
      border-radius: 50%;
    }
  }

  .actions {
    margin: 0rem;
    margin-top: 1rem;
  }

  #page-author-view {
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
