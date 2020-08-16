<template>
  <div id="page-user-view">

    <vs-alert color="danger" title="Leitor Não Encontrado" :active.sync="reader_not_found">
      <span>O leitor com id {{ $route.params.readerId }} não foi encontrado. </span>
      <span>
        <span>Verificar </span><router-link :to="{name:'admin-reader-list'}" class="text-inherit underline">Todos Os Usuários</router-link>
      </span>
    </vs-alert>

    <div id="user-data" v-if="reader">

      <vx-card title="Registro" class="mb-base" id="data-show">

        <!-- image -->
        <div class="vx-row">

          <!-- image Col -->
          <div class="vx-col" id="image-col">
            <div class="img-container mb-4">
              <img :src="reader.image" class="rounded w-full" />
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
                <td class="font-semibold">Status</td>
                <td>{{ reader.status }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Gênero</td>
                <td>{{ reader.gender }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <!-- Information - Col 2 -->
          <div class="vx-col flex-1" id="account-info-col-2">
            <table>
              <tr>
                <td class="font-semibold">Curso</td>
                <td>{{ reader.course.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Sala</td>
                <td>{{ reader.grade + 'º Ano ' + reader.class }}</td>
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
          <!-- /Information - Col 2 -->
          <div class="vx-col w-full flex" id="account-manage-buttons">
            <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'admin-reader-edit', params: { readerId: $route.params.readerId }}">Editar</vs-button>
            <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Excluir</vs-button>
          </div>

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
      /* Below two lines are just for demo purpose */
      this.$store.dispatch('readerManagement/destroy', this.reader.id)
        .then(res => {
          this.$router.push({name:'admin-reader-list'})
          this.$vs.notify({
            title: 'Leitor Excluído',
            text: res.data.message,
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
          })
        })
        .catch(err => {
          this.$vs.notify({
            title: 'Leitor Não Excluído',
            text: err.message,
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
          })
        })
    },
  },
  mounted() {
    // Loading for Readers Request
    this.$vs.loading({
      container: '#data-show',
      scale: 0.6
    })
  },
  created() {
    // Register Module ReaderManagement Module
    if(!moduleReaderManagement.isRegistered) {
      this.$store.registerModule('readerManagement', moduleReaderManagement)
      moduleReaderManagement.isRegistered = true
    }

    const readerId = this.$route.params.readerId
    this.$store.dispatch("readerManagement/show", readerId)
      .then(res => {
        this.reader = res.data
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

// #account-info-col-1 {
//   // flex-grow: 1;
//   width: 30rem !important;
//   @media screen and (min-width:1200px) {
//     & {
//       flex-grow: unset !important;
//     }
//   }
// }


@media screen and (min-width:1201px) and (max-width:1211px),
only screen and (min-width:636px) and (max-width:991px) {
  #account-info-col-1 {
    width: calc(100% - 12rem) !important;
  }

  // #account-manage-buttons {
  //   width: 12rem !important;
  //   flex-direction: column;

  //   > button {
  //     margin-right: 0 !important;
  //     margin-bottom: 1rem;
  //   }
  // }

}

</style>
