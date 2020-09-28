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

          <!-- ISBN -->
          <div class="vx-col w-full  mb-6">
            <label>ISBN</label>
            <vx-input-group>
              <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="ISBN"
                v-model="book.isbn" v-mask="maskIsbn" />
              <template slot="append">
                <div class="append-text btn-addon">
                  <vx-tooltip delay=".5s" position="right" text="Busque as informações do livro pelo ISBN">
                    <vs-button color="primary" icon-pack="feather" icon="icon-search"
                      @click.prevent="searchBookByIsbn(book.isbn);resetData()">
                    </vs-button>
                  </vx-tooltip>
                </div>
              </template>
            </vx-input-group>
            <div class="text-danger text-sm" v-if="validations.isbn">
              <span v-show="validations.isbn">{{ validations.isbn[0] }}</span>
            </div>
          </div>

          <!-- Title -->
          <div class="vx-col w-full mb-6">
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
                <vx-tooltip delay=".5s" position="left" text="Cadastre um novo author">
                  <div class="prepend-text btn-addon">
                    <vs-button color="primary" icon-pack="feather" icon="icon-plus" @click="addNewAuthor"></vs-button>
                  </div>
                </vx-tooltip>
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
                <vx-tooltip delay=".5s" position="left" text="Cadastre uma nova editora">
                  <div class="prepend-text btn-addon">
                    <vs-button color="primary" icon-pack="feather" icon="icon-plus" @click="addNewCompany"></vs-button>
                  </div>
                </vx-tooltip>
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
              placeholder="Nº de Páginas" v-model="book.pages" v-mask="maskPages" />
            <div class="text-danger text-sm" v-if="validations.pages">
              <span v-show="validations.pages">{{ validations.pages[0] }}</span>
            </div>
          </div>

          <!-- Edition -->
          <div class="vx-col w-full  mb-6">
            <label>Edição</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-edit" icon-no-border placeholder="Edição"
              v-model="book.edition" v-mask="maskEdition" />
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

            <vx-tooltip
              title="Link para capa do livro"
              color=""
              text="Se você fez a busca do livro pelo ISBN talvez a imagem da capa esteja disponível para download aqui."
              position="right"
              class="float-right"
            >

              <a :href="book.linkCape" target="_blank" rel="Link da capa">
                <feather-icon icon="InfoIcon" svgClasses="h-5 w-5"/>
              </a>

            </vx-tooltip>

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

            <div class="text-danger text-sm" v-if="validations.cape">
              <span v-show="validations.cape">{{ validations.cape[0] }}</span>
            </div>
          </div>

          <!-- Publication Year -->
          <div class="w-full mb-6">
            <label>Publicação</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-calendar" icon-no-border
              placeholder="Ano de Publicação" v-model="book.publicationYear" v-mask="maskPublicationYear" />
            <div class="text-danger text-sm" v-if="validations.publicationYear">
              <span v-show="validations.publicationYear">{{ validations.publicationYear[0] }}</span>
            </div>
          </div>

          <!-- Synopsis -->
          <div class="w-full mb-6">
            <label>Sinopse</label>
            <vs-textarea rows="5" counter="5000" :counter-danger.sync="counterDanger[0]" v-model="book.synopsis" />
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
                v-model.lazy="book.price" :disabled="book.origin != 'Comprado'" v-money="money" maxlength="7" />
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
  import { VMoney } from 'v-money'

  import AuthorCreateSidebar from '@/views/admin/author/AuthorCreateSidebar.vue'
  import CompanyCreateSidebar from '@/views/admin/company/CompanyCreateSidebar.vue'

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
          price: null,
          isbn: '',
          synopsis: '',
          pages: '',
          language: 'pt',
          observations: '',
          edition: '',
          publicationYear: null,
          color: '',
          cdd: '',
          company_id: null,
          author_id: [],
          cape: null,
          showCape: null,
          linkCape: null
        },

        money: {
          decimal: ',',
          thousands: '.',
          prefix: '',
          suffix: '',
          precision: 2,
          masked: true
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
        textarea: ['', ''],
        counterDanger: [false, false],

        validations: {},

        maskIsbn: "#############",
        maskPages: "#####",
        maskEdition: "###",
        maskPublicationYear: "####",
      }
    },
    components: {
      vSelect,
      CompanyCreateSidebar,
      AuthorCreateSidebar,

    },
    directives: {
      money: VMoney
    },
    methods: {
      submitBook(book) {
        const bookFormatted = this.bookInFormData(book)

        this.notifyBookStored(bookFormatted)
      },
      bookInFormData(book) {
        let data = new FormData()

        data.append('cape', book.cape)
        data.append('title', book.title)
        data.append('subtitle', book.subtitle)
        data.append('origin', book.origin)
        data.append('price', this.formatPrice(book.price))
        data.append('isbn', book.isbn)
        data.append('synopsis', book.synopsis)
        data.append('pages', book.pages)
        data.append('language', book.language)
        data.append('observations', book.observations)
        data.append('edition', book.edition)
        data.append('publication_year', book.publicationYear)
        data.append('color', book.color)
        data.append('cdd', book.cdd)
        data.append('company_id', book.company_id)
        book.author_id.forEach((value, key) => {
          data.append('author_id[' + key + ']', value)
        })

        return data
      },
      async notifyBookStored(book) {
        this.$vs.loading({
          container: '#form-container',
          scale: 0.6
        })

        try {
          const bookStored = await this.storeBook(book)
          this.$vs.loading.close("#form-container > .con-vs-loading")
          this.$vs.notify({
            title: "Livro Cadastrado",
            text: bookStored.data.message,
            color: "success",
            iconPack: 'feather',
            icon: 'icon-check',
          })
          this.resetData()
        } catch (error) {
          this.$vs.loading.close("#form-container > .con-vs-loading")
          this.$vs.notify({
            title: "Erro no Cadastro",
            text: "Verifique os campos e os preencha corretamente",
            color: "danger",
            iconPack: 'feather',
            icon: 'icon-alert-circle'
          })
          this.validations = error.response.data.errors
        }
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
      formatPrice(price) {
        price = price.split(".").join("")
        price = price.split(",").join(".")

        return price
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
      resetData() {
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
      },
      async searchBookByIsbn(isbn) {
        this.$vs.loading({
          container: '#form-container',
          scale: 0.6
        })

        try {
          const response = await this.getBookByIsbn(isbn)
          const obtainedBook = await response.json()
          let bookData = await obtainedBook.items[0].volumeInfo

          bookData.isbn = isbn

          this.fillFormWithDataFromTheBookObtained(bookData)

          this.$vs.loading.close("#form-container > .con-vs-loading")
          this.$vs.notify({
            title: "Livro Encontrado",
            text: "Por favor verifique os campos.",
            color: "success",
            iconPack: 'feather',
            icon: 'icon-check',
          })
        } catch (error) {
          this.$vs.loading.close("#form-container > .con-vs-loading")
          this.$vs.notify({
            title: "Desculpe, algo deu errado",
            text: "Por favor verifique o ISBN ou preencha manualmente",
            color: "danger",
            iconPack: 'feather',
            icon: 'icon-check',
          })
        }
      },
      getBookByIsbn(isbn) {
        return fetch(`https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`)
      },
      fillFormWithDataFromTheBookObtained(data) {
        const book = this.book

        book.isbn            = data.isbn
        book.title           = data.title
        book.subtitle        = data.subtitle
        book.pages           = data.pageCount
        book.linkCape        = data.imageLinks.thumbnail
        book.publicationYear = data.publishedDate
        book.synopsis        = data.description
        book.language        = data.language

        this.sendAuthorsToCheck(data.authors)
        this.checkCompanyToSet(data.publisher)

      },
      sendAuthorsToCheck(authors) {
        authors.forEach((authorName) => {
          this.checkAuthorToSet(authorName)
        })
      },
      checkAuthorToSet(authorName) {
        try {
          const authors = this.authors

          const checkedAuthor = authors.filter((author) => {
            if (author.name == authorName)
              return author
          })[0]

          this.setAuthorInBook(checkedAuthor)
        } catch (error) {
          this.validations.author_id = ["Verifique se o autor deste livro ja foi cadastrado."]
        }
      },
      setAuthorInBook(author) {
        this.book.author_id.push(author.id)
      },
      checkCompanyToSet(companyName) {
        try {
          const companies = this.companies

          const checkedCompany = companies.filter((company) => {
            if (company.name == companyName)
              return company
          })[0]

          this.setCompanyInBook(checkedCompany)
        } catch (error) {
          this.validations.company_id = ["Verifique se a editora deste livro ja foi cadastrada."]
        }
      },
      setCompanyInBook(company) {
        this.book.company_id = company.id
      },
    },
    watch: {
      'authors': function (authors) {
        if (this.setAuthorLabel) {
          let lastAuthor = authors[authors.length - 1]
          this.setAuthorInBook(lastAuthor)
        }
      },
      'companies': function (companies) {
        if (this.setCompanyLabel) {
          let lastCompany = companies[companies.length - 1]
          this.setCompanyInBook(lastCompany)
        }
      },
      'activeTab': function () {
        scrollTo(0, 53)
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
