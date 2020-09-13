<template>
  <div class="vx-col w-full mb-base">

    <vx-card>
      <form>
        <div class="vx-row mb-3">
          <div class="vx-col sm:w-1/2 w-full">
            <label>Título</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-book" icon-no-border placeholder="Título"
              v-model="book.title" />
            <div class="text-danger text-sm" v-if="validations.title">
              <span class="text-danger text-sm" v-show="validations.title">{{ validations.title[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/2 w-full">
            <label>SubTítulo</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-bookmark" icon-no-border placeholder="SubTítulo"
              v-model="book.subtitle" />
            <div class="text-danger text-sm" v-if="validations.subtitle">
              <span v-show="validations.subtitle">{{ validations.subtitle[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row mb-3">
          <div class="vx-col sm:w-1/4 w-full">
            <label>Editora</label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text btn-addon">
                  <vs-button color="primary" icon-pack="feather" icon="icon-plus" @click="addNewCompany"></vs-button>
                </div>
              </template>

              <v-select class="w-full small" label="name" :options="companies" :reduce="name => name.id"
                :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="Editora" v-model="book.company_id" />
            </vx-input-group>
            <div class="text-danger text-sm" v-if="validations.company_id">
              <span v-show="validations.company_id">{{ validations.company_id[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/6 w-full">
            <label>Páginas</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-book-open" icon-no-border
              placeholder="Nº de Páginas" v-model="book.pages" />
            <div class="text-danger text-sm" v-if="validations.pages">
              <span v-show="validations.pages">{{ validations.pages[0] }}</span>
            </div>
          </div>


          <div class="vx-col sm:w-1/4 w-full">
            <label>ISBN</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="ISBN"
              v-model="book.isbn" />
            <div class="text-danger text-sm" v-if="validations.isbn">
              <span v-show="validations.isbn">{{ validations.isbn[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/3 w-full">
            <label>CDD</label>
            <v-select class="w-full" label="name" :options="cdds" :reduce="name => name.id"
              :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="CDD" v-model="book.cdd" />
            <div class="text-danger text-sm" v-if="validations.cdd">
              <span v-show="validations.cdd">{{ validations.cdd[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row mb-3">
          <div class="vx-col sm:w-1/6 w-full">
            <label>Edição</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-edit" icon-no-border placeholder="Edição"
              v-model="book.edition" />
            <div class="text-danger text-sm" v-if="validations.edition">
              <span v-show="validations.edition">{{ validations.edition[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Linguagem</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-globe" icon-no-border placeholder="Título"
              v-model="book.language" />
            <div class="text-danger text-sm" v-if="validations.language">
              <span v-show="validations.language">{{ validations.language[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/3 w-full">
            <label>Autor</label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text btn-addon">
                  <vs-button color="primary" icon-pack="feather" icon="icon-plus" @click="addNewAuthor"></vs-button>
                </div>
              </template>

              <v-select class="w-full vs-justify" label="name" :options="authors" :reduce="name => name.id"
                :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="Autor" v-model="book.author_id" />
            </vx-input-group>
            <div class="text-danger text-sm" v-if="validations.author_id">
              <span v-show="validations.author_id">{{ validations.author_id[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Publicação</label>
            <datepicker class="w-full" placeholder="Dia Mês Ano" :language="language" format="d MMMM yyyy"
              v-model="book.publication_year"></datepicker>
            <div class="text-danger text-sm" v-if="validations.publication_year">
              <span v-show="validations.publication_year">{{ validations.publication_year[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row mb-3">

          <div class="vx-col sm:w-1/4 w-full">
            <label>Cor</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-droplet" icon-no-border placeholder="Título"
              v-model="book.color" />
            <div class="text-danger text-sm" v-if="validations.color">
              <span v-show="validations.color">{{ validations.color[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Origem</label>
            <ul class="vx-row mt-3 ml-1">
              <li>
                <vs-radio v-model="book.origin" vs-name="grade" vs-value="Doado">Doado</vs-radio>
              </li>
              <li>
                <vs-radio class="ml-12" v-model="book.origin" vs-name="grade" vs-value="Comprado">Comprado</vs-radio>
              </li>
            </ul>
            <div class="text-danger text-sm" v-if="validations.origin">
              <span v-show="validations.origin">{{ validations.origin[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Preço</label>
            <vs-input icon-pack="feather" icon="icon-dollar-sign" icon-no-border placeholder="Título"
              v-model="book.price" :disabled="book.origin != 'Comprado'" />
            <div class="text-danger text-sm" v-if="validations.price">
              <span v-show="validations.price">{{ validations.price[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/4 w-full upload-img">
            <label>Capa</label>

            <template v-if="!book.cape">
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
              <vs-button color="success" class="w-full " @click="$refs.uploadImgInput.click()">Selecionar Capa
              </vs-button>
            </template>

            <template v-if="book.cape">
              <!-- Image upload Buttons -->
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
              <div class="btn-group">
                <vs-button color="success" type="border" size="small" class="sm:w-1/2"
                  @click="$refs.uploadImgInput.click()">Atualizar</vs-button>
                <vs-button color="danger" type="border" size="small" class="sm:w-1/2" @click="book.cape=null">Remover
                </vs-button>
              </div>
            </template>
            <div class="text-danger text-sm" v-if="validations.cape">
              <span v-show="validations.cape">{{ validations.cape[0] }}</span>
            </div>

          </div>
        </div>

        <div class="vx-row mb-3">
          <div class="vx-col w-full sm:w-1/2">
            <label>Sinopse</label>
            <vs-textarea rows="5" counter="1000" :counter-danger.sync="counterDanger[0]" v-model="book.synopsis" />
            <div class="text-danger text-sm" v-if="validations.synopsis">
              <span v-show="validations.synopsis">{{ validations.synopsis[0] }}</span>
            </div>
          </div>
          <div class="vx-col w-full sm:w-1/2">
            <label>Observações</label>
            <vs-textarea rows="5" counter="190" :counter-danger.sync="counterDanger[1]" v-model="book.observations" />
            <div class="text-danger text-sm" v-if="validations.observations">
              <span v-show="validations.observations">{{ validations.observations[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row">
          <div class="vx-col w-full">
            <vs-button class="ml-auto mt-2" type="filled" @click.prevent="storeBook(book)">Cadastrar</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning" @click="resetData">Redefinir</vs-button>
          </div>
        </div>
      </form>
    </vx-card>
  </div>
</template>

<script>
import moduleBookManagement from '@/store/admin/book/moduleBookManagement.js'
import moduleCompanyManagement from '@/store/admin/company/moduleCompanyManagement.js'
import moduleAuthorManagement from '@/store/admin/author/moduleAuthorManagement.js'

import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker'

export default {
  data() {
    return {
      book: {
        title: '',
        subtitle: '',
        origin: '',
        price: '',
        isbn: '',
        synopsis: '',
        pages: '',
        language: '',
        observations: '',
        edition: '',
        publication_year: null,
        color: '',
        cdd: '',
        cape: null,
        company_id: null,
        author_id: null,
      },
      companies: [],
      authors: [],
      validations: {}
    }
  },
  components: {
    vSelect,
    Datepicker
  },
  methods: {
    updateBook() {
      // Loading in form
      this.$vs.loading({
        container: '#update-form',
        scale: 0.6
      })
      this.$store.dispatch('bookManagement/update', this.book)
        .then(res => {
          this.$vs.loading.close("#update-form > .con-vs-loading")
          this.$vs.notify({
            title: "Livro atualizado!",
            text: res.data.message,
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
          })
        })
        .catch(err => {
          this.validations = err.response.data
          console.log(this.validations)
          this.$vs.loading.close("#update-form > .con-vs-loading")
          this.$vs.notify({
            title: "Livro não atualizado!",
            text: "Verifique os campos e os preencha corretamente!",
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-circle-alert',
          })
        })
    },
  },
  mounted() {
    // Loading for Readers Request
    this.$vs.loading({
      container: '#update-form',
      scale: 0.6
    })
  },
  created() {
    // Register Module BookManagement Module
    if(!moduleBookManagement.isRegistered) {
      this.$store.registerModule('bookManagement', moduleBookManagement)
      moduleBookManagement.isRegistered = true
    }

    // Register Module CompanyManagement Module
    if (!moduleCompanyManagement.isRegistered) {
      this.$store.registerModule('companyManagement', moduleCompanyManagement)
      moduleCompanyManagement.isRegistered = true
    }

    // Register Module AuthorManagement Module
    if (!moduleAuthorManagement.isRegistered) {
      this.$store.registerModule('authorManagement', moduleAuthorManagement)
      moduleAuthorManagement.isRegistered = true
    }

    // Getting Companies
    this.$store.dispatch('companyManagement/index')
      .then(response => {
        this.companies = response.data
      })
      .catch(error => {
        console.log(error)
      })

    // Getting Authors
    this.$store.dispatch('authorManagement/index')
      .then(response => {
        this.authors = response.data
      })
      .catch(error => {
        console.log(error)
      })

    const bookId = this.$route.params.bookId
    this.$store.dispatch("bookManagement/show", bookId)
      .then(res => {
        this.book = res.data
        this.$vs.loading.close("#update-form > .con-vs-loading")
      })
      .catch(err => {
        this.$vs.notify({
          title: "Erro",
          text: err.data.message,
          color: 'success',
          iconPack: 'feather',
          icon: 'icon-check',
          time: 4000
        })

        this.$vs.loading.close("#update-form > .con-vs-loading")
        this.$router.push('/livros')
      })
  }
}
</script>
