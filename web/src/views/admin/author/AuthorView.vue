<template>
  <div id="page-user-view">

    <vs-alert color="danger" title="Autor Não Encontrado" :active.sync="author_not_found">
      <span>O autor com id {{ $route.params.authorId }} não foi encontrado. </span>
      <span>
        <span>Verificar </span><router-link :to="{name:'admin-author-list'}" class="text-inherit underline">Todos Os Autores</router-link>
      </span>
    </vs-alert>

    <div id="user-data" v-if="author">

      <vx-card title="Registro" class="mb-base" id="data-show">

        <!-- image -->
        <div class="vx-row">

          <!-- image Col -->
          <div class="vx-col" id="image-col">
            <div class="img-container mb-4">
              <img v-if="author.image" :src="author.image" class="rounded w-full" />
              <img v-else src="../../../assets/images/user-image.png" class="rounded w-full">
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

          <div class="vx-col w-full flex" id="account-manage-buttons">
            <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'admin-author-edit', params: { authorId: $route.params.authorId }}">Editar</vs-button>
            <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Excluir</vs-button>
          </div>

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
      /* Below two lines are just for demo purpose */
      this.$store.dispatch('authorManagement/destroy', this.author.id)
        .then(res => {
          this.$router.push({name:'admin-author-list'})
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
    // Loading for Authors Request
    this.$vs.loading({
      container: '#data-show',
      scale: 0.6
    })
  },
  created() {
    // Register Module AuthorManagement Module
    if(!moduleAuthorManagement.isRegistered) {
      this.$store.registerModule('authorManagement', moduleAuthorManagement)
      moduleAuthorManagement.isRegistered = true
    }

    const authorId = this.$route.params.authorId

    this.$store.dispatch("authorManagement/show", authorId)
      .then(res => {
        this.author = res.data
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
