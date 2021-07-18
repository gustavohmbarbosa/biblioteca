<template>
  <div class="vx-row mb-base" id="form-container">
    <vx-card title="Formulário de Cadastro" class="card-form">

      <vs-tabs alignment="fixed" ref="bookForm" v-model="activeTab">
        <!-- To Books -->
        <vs-tab label="Livro" icon-pack="feather" icon="icon-book" class="mt-4">
          <company-create-sidebar :isSidebarActive="addNewSidebarToCompanyCreate"
            @closeSidebar="toggleCompanyCreateSidebar" :data="companyCreateSidebar" />

          <author-create-sidebar :isSidebarActive="addNewSidebarToAuthorCreate"
            @closeSidebar="toggleAuthorCreateSidebar" :data="authorCreateSidebar" />

          <!-- Title -->
          <div class="vx-col  w-full mb-6">
            <label>Título</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-book" icon-no-border placeholder="Título"
              v-model="book.title" />
            <div class="text-danger text-sm" v-if="validations.title">
              <span class="text-danger text-sm" v-show="validations.title">{{ validations.title[0] }}</span>
            </div>
          </div>

          <!-- Subtitle -->
          <div class="vx-col  w-full mb-6">
            <label>SubTítulo</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-bookmark" icon-no-border placeholder="SubTítulo"
              v-model="book.subtitle" />
            <div class="text-danger text-sm" v-if="validations.subtitle">
              <span v-show="validations.subtitle">{{ validations.subtitle[0] }}</span>
            </div>
          </div>

          <!-- Author -->
          <div class="w-full mb-6">
            <label>Autor</label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text btn-addon">
                  <vs-button color="primary" icon-pack="feather" icon="icon-plus" @click="addNewAuthor"></vs-button>
                </div>
              </template>

              <v-select multiple class="w-full vs-justify" label="name" :options="authors" :reduce="name => name.id"
                :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="Autor" v-model="book.author_id" />
            </vx-input-group>
            <div class="text-danger text-sm" v-if="validations.author_id">
              <span v-show="validations.author_id">{{ validations.author_id[0]}}</span>
            </div>
          </div>

          <!-- Company -->
          <div class="vx-col w-full  mb-6">
            <label>Editora</label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text btn-addon">
                  <vs-button color="primary" icon-pack="feather" icon="icon-plus" @click="addNewCompany"></vs-button>
                </div>
              </template>

              <v-select label="name" :options="companies" :reduce="name => name.id" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                placeholder="Editora" v-model="book.company_id" />
            </vx-input-group>
            <div class="text-danger text-sm" v-if="validations.company_id">
              <span v-show="validations.company_id">{{ validations.company_id[0] }}</span>
            </div>
          </div>

          <!-- Pages -->
          <div class="vx-col w-full  mb-6">
            <label>Páginas</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-book-open" icon-no-border
              placeholder="Nº de Páginas" v-model="book.pages" />
            <div class="text-danger text-sm" v-if="validations.pages">
              <span v-show="validations.pages">{{ validations.pages[0] }}</span>
            </div>
          </div>

          <!-- ISBN -->
          <div class="vx-col w-full  mb-6">
            <label>ISBN</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="ISBN"
              v-model="book.isbn" />
            <div class="text-danger text-sm" v-if="validations.isbn">
              <span v-show="validations.isbn">{{ validations.isbn[0] }}</span>
            </div>
          </div>

          <!-- Edition -->
          <div class="vx-col w-full  mb-6">
            <label>Edição</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-edit" icon-no-border placeholder="Edição"
              v-model="book.edition" />
            <div class="text-danger text-sm" v-if="validations.edition">
              <span v-show="validations.edition">{{ validations.edition[0] }}</span>
            </div>
          </div>


          <!-- CDD -->
          <div class="w-full mb-6">
            <label>Código Decimal de Dewey</label>
            <v-select label="name" :options="cdds" :reduce="name => name.id" :dir="$vs.rtl ? 'rtl' : 'ltr'"
              placeholder="CDD" v-model="book.cdd" />
            <div class="text-danger text-sm" v-if="validations.cdd">
              <span v-show="validations.cdd">{{ validations.cdd[0] }}</span>
            </div>
          </div>

          <!-- Language -->
          <div class="vx-col w-full  mb-6">
            <label>Linguagem</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-globe" icon-no-border placeholder="Título"
              v-model="book.language" />
            <div class="text-danger text-sm" v-if="validations.language">
              <span v-show="validations.language">{{ validations.language[0] }}</span>
            </div>
          </div>

          <!-- Cape -->
          <div class="vx-col w-full mb-6 cape-container">
            <label>Capa</label>
            <template v-if="!book.cape">
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateImg" accept="image/*">
              <vs-button color="success" class="w-full" @click="$refs.uploadImgInput.click()">Selecionar Capa
              </vs-button>
            </template>

            <!-- Show -->
            <template v-if="book.cape">
              <template>
                <div class="img-container w-64 mx-auto flex items-center justify-center">
                  <img :src="book.showCape" alt="img" class="responsive rounded">
                </div>
              </template>

              <!-- Image upload Buttons -->
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateImg" accept="image/*">
              <div class="mt-6 text-center">
                <vs-button color="success" type="flat" class="sm:w-1/2" @click="$refs.uploadImgInput.click()">
                  Atualizar
                </vs-button>
                <vs-button color="#999" type="flat" class="sm:w-1/2" @click="book.cape=null;book.showCape=null">
                  Remover
                </vs-button>
              </div>
            </template>
          </div>

          <!-- Publication Date -->
          <div class="w-full mb-6">
            <label>Publicação</label>
            <datepicker class="w-full" placeholder="Dia Mês Ano" :language="language" format="d MMMM yyyy"
              v-model="book.publication_date"></datepicker>
            <div class="text-danger text-sm" v-if="validations.publication_date">
              <span v-show="validations.publication_date">{{ validations.publication_date[0] }}</span>
            </div>
          </div>

          <!-- Synopsis -->
          <div class="w-full mb-6">
            <label>Sinopse</label>
            <vs-textarea rows="5" counter="1000" :counter-danger.sync="counterDanger[0]" v-model="book.synopsis" />
            <div class="text-danger text-sm" v-if="validations.synopsis">
              <span v-show="validations.synopsis">{{ validations.synopsis[0] }}</span>
            </div>
          </div>

          <!-- Buttons -->
          <div class="vx-col w-full">
            <vs-button color="#999" type="flat" class="float-left" @click="$router.back()">Cancelar</vs-button>
            <vs-button class="float-right" @click="activeTab = 1">Avançar</vs-button>
          </div>

        </vs-tab>

        <!-- To Library -->
        <vs-tab label="Biblioteca" icon-pack="feather" icon="icon-archive">

          <!-- Color -->
          <div class="w-full mb-6">
            <label>Cor</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-droplet" icon-no-border placeholder="Cor"
              v-model="book.color" />
            <div class="text-danger text-sm" v-if="validations.color">
              <span v-show="validations.color">{{ validations.color[0] }}</span>
            </div>
          </div>

          <div class="vx-row">
            <!-- Origin -->
            <div class="vx-col w-full mb-6 sm:w-1/2">
              <label>Origem</label>
              <ul class="vx-row mt-3 ml-1">
                <li>
                  <vs-radio class="w-full sm:w-1/2" v-model="book.origin" vs-name="grade" vs-value="Doado">Doado
                  </vs-radio>
                </li>
                <li>
                  <vs-radio class="w-full sm:w-1/2 ml-6" v-model="book.origin" vs-name="grade" vs-value="Comprado">
                    Comprado</vs-radio>
                </li>
              </ul>
              <div class="text-danger text-sm" v-if="validations.origin">
                <span v-show="validations.origin">{{ validations.origin[0] }}</span>
              </div>
            </div>

            <!-- Price -->
            <div class="vx-col w-full mb-6 sm:w-1/2">
              <label>Preço</label>
              <vs-input class="w-full" icon-pack="feather" icon="icon-dollar-sign" icon-no-border placeholder="Preço"
                v-model="book.price" :disabled="book.origin != 'Comprado'" />
              <div class="text-danger text-sm" v-if="validations.price">
                <span v-show="validations.price">{{ validations.price[0] }}</span>
              </div>
            </div>
          </div>

          <!-- Observations -->
          <div class="w-full mb-6">
            <label>Observações</label>
            <vs-textarea rows="5" counter="190" :counter-danger.sync="counterDanger[1]" v-model="book.observations" />
            <div class="text-danger text-sm" v-if="validations.observations">
              <span v-show="validations.observations">{{ validations.observations[0] }}</span>
            </div>
          </div>

          <!-- Buttons -->
          <div class="vx-col w-full">
            <vs-button type="flat" color="#999" class="float-left" @click="activeTab = 0">Voltar</vs-button>
            <vs-button class="float-right" type="filled" @click.prevent="submitBook(book)">Cadastrar</vs-button>
          </div>

        </vs-tab>
      </vs-tabs>
      
    </vx-card>
  </div>
</template>


<script>
  import vSelect from 'vue-select'
  import Datepicker from 'vuejs-datepicker'
  import * as lang from 'vuejs-datepicker/src/locale'

  import AuthorCreateSidebar from '@/views/admin/author/AuthorSidebar.vue'
  import CompanyCreateSidebar from '@/views/admin/company/CompanyCreateSidebar.vue'

  import ConvertDateToStandard from '@/utils/ConvertDateToStandard.js'

  import moduleBookManagement from '@/store/admin/book/moduleBookManagement.js'
  import moduleCompanyManagement from '@/store/admin/company/moduleCompanyManagement.js'
  import moduleAuthorManagement from '@/store/admin/author/moduleAuthorManagement.js'


  export default {
    data() {
      return {
        book: {
          title: '',
          subtitle: '',
          origin: 'Doado',
          price: '',
          isbn: '',
          synopsis: '',
          pages: '',
          language: 'Português',
          observations: '',
          edition: '',
          publication_date: null,
          color: '',
          cdd: '',
          company_id: null,
          author_id: [],
          cape: null,
          showCape: null,
        },

        companies: [],
        addNewSidebarToCompanyCreate: false,
        companyCreateSidebar: {},
        setCompanyLabel: false,

        authors: [],
        addNewSidebarToAuthorCreate: false,
        authorCreateSidebar: {},
        setAuthorLabel: false,

        cdds: [{
            id: 1,
            name: 'Ciência da informação e bibliotecas e Biblioteconomia',
          },
          {
            id: 2,
            name: 'Leandro Carvalho da Silva Juniore',
          },
          {
            id: 3,
            name: 'teste3',
          },
        ],

        activeTab: 0,
        language: lang['ptBR'],
        textarea: ['', ''],
        counterDanger: [false, false],

        validations: {}
      }
    },
    components: {
      vSelect,
      Datepicker,
      CompanyCreateSidebar,
      AuthorCreateSidebar,

    },
    methods: {
      submitBook(book) {
        const bookTreated = this.treatBook(book)

        this.notifyBookStored(bookTreated)
      },
      treatBook(book) {
        book['publication_date'] = ConvertDateToStandard(book['publication_date'])
        book = this.bookInFormData(book)

        return book
      },
      bookInFormData(book) {
        let data = new FormData()
        Object.entries(book).forEach(([key, value]) => {
          if (key == 'author_id')
            value.forEach((value, key) => {
              data.append('author_id[' + key + ']', value)
            })
          else
            data.append(key, value)
        })

        return data
      },
      storeBook(book) {
        const config = {
          headers: {
            'content-type': 'multipart/form-data',
            'Access-Control-Allow-Origin': '*'
          }
        }

        return this.$store.dispatch('bookManagement/store', book, config)
      },
      async notifyBookStored(book) {
        this.$vs.loading({
          container: '.form-container',
          scale: 0.6
        })

        try {
          const bookStored = await this.storeBook(book)
          this.$vs.loading.close(".form-container > .con-vs-loading")
          this.$vs.notify({
            title: "Livro Cadastrado",
            text: bookStored.data.message,
            color: "success",
            iconPack: 'feather',
            icon: 'icon-check',
          })
          this.resetData()
        } catch (error) {
          this.$vs.loading.close(".form-container > .con-vs-loading")
          this.$vs.notify({
            title: "Erro no Cadastro",
            text: "Preencha os campos corretamente",
            color: "danger",
            iconPack: 'feather',
            icon: 'icon-alert-circle'
          })
          this.validations = error.response.data.errors
        }
      },
      updateImg(input) {
        if (input.target.files && input.target.files[0]) {
          var reader = new FileReader()
          reader.onload = e => {
            this.book.showCape = e.target.result
          }
          reader.readAsDataURL(input.target.files[0])
          this.book.cape = input.target.files[0]
        }
      },
      libraryTab(){
          console.log(this.$refs.bookForm)
        this.$refs.bookForm.childActive()
          console.log(this.$refs.bookForm)

      },
      resetData() {
          console.log(this.$refs.bookForm)

        let startData = this.$options.data()

        delete startData['authors']
        delete startData['companies']

        Object.assign(this.$data, startData)
      },
      addNewCompany() {
        this.companyCreateSidebar = {}
        this.toggleCompanyCreateSidebar(true)
      },
      toggleCompanyCreateSidebar(val = false) {
        this.addNewSidebarToCompanyCreate = val
        this.setCompanyLabel = true
      },
      addNewAuthor() {
        this.authorCreateSidebar = {}
        this.toggleAuthorCreateSidebar(true)
      },
      toggleAuthorCreateSidebar(val = false) {
        this.addNewSidebarToAuthorCreate = val
        this.setAuthorLabel = true
      }
    },
    watch: {
      'book.origin': function (origin) {
        if (origin != 'Comprado') {
          this.book.price = null
        }
      },
      'authors': function (authors) {
        if (this.setAuthorLabel) {
          this.book.author_id.push(authors[authors.length - 1].id)
        }
      },
      'companies': function (companies) {
        if (this.setCompanyLabel) {
          this.book.company_id = companies[companies.length - 1].id
        }
      }
    },
    created() {
      if (!moduleBookManagement.isRegistered) {
        this.$store.registerModule('bookManagement', moduleBookManagement)
        moduleBookManagement.isRegistered = true
      }

      if (!moduleCompanyManagement.isRegistered) {
        this.$store.registerModule('companyManagement', moduleCompanyManagement)
        moduleCompanyManagement.isRegistered = true
      }

      if (!moduleAuthorManagement.isRegistered) {
        this.$store.registerModule('authorManagement', moduleAuthorManagement)
        moduleAuthorManagement.isRegistered = true
      }

      this.$store.dispatch('companyManagement/index')
        .then(response => {
          this.companies = response.data
        })
        .catch(error => {
          console.log(error)
        })

      this.$store.dispatch('authorManagement/index')
        .then(response => {
          this.authors = response.data
        })
        .catch(error => {
          console.log(error)
        })
    },
  }

</script>

<style lang="scss" scoped>
  .vue-form-wizard {
    padding-bottom: 0;

    ::v-deep .wizard-header {
      padding: 0;
    }

    ::v-deep .wizard-tab-content {
      padding-right: 0;
      padding-left: 0;
      padding-bottom: 0;

      .wizard-tab-container {
        margin-bottom: 0 !important;
      }
    }
  }

  .cape-container {
    max-height: 35.1rem;

    .img-container {
      box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.3)
    }
  }

  .card-form {
    margin-left: 1rem;
    margin-right: 1rem;
  }

  @media (min-width: 1024px) {
    .card-form {
      width: 50%;
      margin-left: 25%;
    }
  }

</style>
