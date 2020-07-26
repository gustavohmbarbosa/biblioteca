<template>
  <div id="page-user-view">

    <vs-alert color="danger" title="Leitor Não Encontrado" :active.sync="reader_not_found">
      <span>O leitor com id {{ $route.params.readerId }} não foi encontrado. </span>
      <span>
        <span>Verificar </span><router-link :to="{name:'admin-reader-list'}" class="text-inherit underline">Todos Os Usuários</router-link>
      </span>
    </vs-alert>

    <div id="user-data" v-if="reader">

      <vx-card title="Registro" class="mb-base">

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
                <td class="font-semibold">Senha</td>
                <td>{{ reader.password }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Telefone</td>
                <td>{{ reader.phone }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Status</td>
                <td>{{ reader.status }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <!-- Information - Col 2 -->
          <div class="vx-col flex-1" id="account-info-col-2">
            <table>
              <tr>
                <td class="font-semibold">Gênero</td>
                <td>{{ reader.gender }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Curso</td>
                <td>{{ reader.course_name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Sala</td>
                <td>{{ reader.grade + ' ' + reader.class }}</td>
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
      reader: {
          "id": 1,
          "image": require("@/assets/images/portrait/small/avatar-s-3.jpg"),
          "name": "Angelo Sashington",
          "email": "angelo@sashington.com",
          "status": "Ativo",
          "grade": "1º",
          "class": "B",
          "course_name": 'Des. de Sistemas',
          "gender": "Masculino",
          "password": "12345678",
          "phone": "(00) 00000-0000",
          "registration": "1234657",
          "entry_year": "2019"
      },
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
      this.$router.push({name:'admin-reader-list'});
      this.showDeleteSuccess()

      /* UnComment below lines for enabling true flow if deleting reader */
      // this.$store.dispatch("readerManagement/removeRecord", this.reader.id)
      //   .then(()   => { this.$router.push({name:'app-reader-list'}); this.showDeleteSuccess() })
      //   .catch(err => { console.error(err)       })
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: 'success',
        title: 'Leitor Excluído',
        text: 'O leitor selecionado foi excluído com sucesso!'
      })
    }
  },
  created() {
    // Register Module ReaderManagement Module
    if(!moduleReaderManagement.isRegistered) {
      this.$store.registerModule('readerManagement', moduleReaderManagement)
      moduleReaderManagement.isRegistered = true
    }

    const readerId = this.$route.params.readerId
    this.$store.dispatch("readerManagement/fetchReader", readerId)
      .then(res => { this.reader = res.data })
      .catch(err => {
        if(err.response.status === 404) {
          this.reader_not_found = true
          return
        }
        console.error(err) })
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
