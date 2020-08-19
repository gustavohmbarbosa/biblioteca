<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary"
    class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>CADASTRAR AUTOR</h4>
      <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <VuePerfectScrollbar class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

      <div class="p-6">

        <!-- NAME -->
        <div class="w-full mb-6">
          <label>Nome</label>
          <vs-input icon-pack="feather" icon="icon-user" icon-no-border v-model="author.name" class="w-full"
            placeholder="Nome do Autor" />
          <div class="text-danger text-sm" v-if="validations.name">
            <span class="text-danger text-sm" v-show="validations.name">{{ validations.name[0] }}</span>
          </div>
        </div>

        <!-- BIOGRAPHY -->
        <div class="w-full mb-6">
          <label class="">Biografia</label>
          <vs-textarea v-model="author.biography" class="w-full" rows="5" />
          <div class="text-danger text-sm" v-if="validations.biography">
            <span class="text-danger text-sm" v-show="validations.biography">{{ validations.biography[0] }}</span>
          </div>
        </div>

        <!-- Upload -->
        <div class="upload-img" v-if="!author.image">
          <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
          <vs-button @click="$refs.uploadImgInput.click()" color="success" class="w-full">Foto do Author</vs-button>
          <div class="text-danger text-sm" v-if="validations.image">
            <span class="text-danger text-sm" v-show="validations.image">{{ validations.image[0] }}</span>
          </div>
        </div>

        <!-- Author Image -->
        <template v-if="author.image">

          <!-- Image Container -->
          <div class="img-container w-64 mx-auto flex items-center justify-center">
            <img :src="author.image" alt="img" class="responsive rounded">
          </div>

          <!-- Image upload Buttons -->
          <div class="modify-img flex justify-between mt-5">
            <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
            <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Atualizar Imagem</vs-button>
            <vs-button type="flat" color="#999" @click="author.image = null">Remover Imagem</vs-button>
          </div>
        </template>
      </div>
    </VuePerfectScrollbar>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="storeAuthor(author)">Cadastrar</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Cancelar</vs-button>
    </div>
  </vs-sidebar>
</template>

<script>
  import VuePerfectScrollbar from 'vue-perfect-scrollbar'

  import moduleAuthorManagement from '@/store/admin/author/moduleAuthorManagement.js'

  export default {
    props: {
      isSidebarActive: {
        type: Boolean,
        required: true
      },
      data: {
        type: Object,
        default: () => {},
      }
    },
    data() {
      return {
        author: {
          name: "",
          biography: "",
          image: null
        },
        settings: { // perfectscrollbar settings
          maxScrollbarLength: 60,
          wheelSpeed: .60,
        },
        validations: {}
      }
    },
    computed: {
      isSidebarActiveLocal: {
        get() {
          return this.isSidebarActive
        },
        set(val) {
          if (!val) {
            this.$emit('closeSidebar')
          }
        }
      },
    },
    methods: {
      storeAuthor(author) {
        this.$store.dispatch('authorManagement/store', author)
          .then(response => {
            this.isSidebarActiveLocal = false
            this.$vs.notify({
              title: "Author Cadastrado",
              text: response.data.message,
              color: "success",
              iconPack: 'feather',
              icon: 'icon-check',
            })
            this.resetData()
          })
          .catch(error => {
            this.$vs.notify({
              title: "Erro no Cadastro",
              text: "Preencha os campos corretamente",
              color: "danger",
              iconPack: 'feather',
              icon: 'icon-alert-circle'
            })
            this.validations = error.response.data
          })
      },
      updateCurrImg(input) {
        if (input.target.files && input.target.files[0]) {
          var reader = new FileReader()
          reader.onload = e => {
            this.author.image = e.target.result
          }
          reader.readAsDataURL(input.target.files[0])
        }
      },
      resetData() {
        Object.assign(this.$data, this.$options.data())
      },
    },
    components: {
      VuePerfectScrollbar,
    },
    created() {
      // Register Module AuthorManagement Module
      if (!moduleAuthorManagement.isRegistered) {
        this.$store.registerModule('authorManagement', moduleAuthorManagement)
        moduleAuthorManagement.isRegistered = true
      }
    }
  }

</script>

<style lang="scss" scoped>
  .add-new-data-sidebar {
    ::v-deep .vs-sidebar--background {
      z-index: 52010;
    }

    ::v-deep .vs-sidebar {
      z-index: 52010;
      width: 400px;
      max-width: 90vw;

      .img-container {
        box-shadow: 0px 1px 8px 1px rgba(0,0,0,0.3)
      }
    }
  }

  .scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);
  }

</style>
