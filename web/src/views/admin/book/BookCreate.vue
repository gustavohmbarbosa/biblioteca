<template>
  <div class="vx-col w-full mb-base">
    <vx-card>
      <form>
        <div class="vx-row mb-3">
          <div class="vx-col sm:w-1/2 w-full">
            <label>Título</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-book" icon-no-border placeholder="Título"
              v-model="book.title" />
          </div>

          <div class="vx-col sm:w-1/2 w-full">
            <label>SubTítulo</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-bookmark" icon-no-border placeholder="SubTítulo"
              v-model="book.subtitle" />
          </div>
        </div>

        <div class="vx-row mb-3">
          <div class="vx-col sm:w-1/4 w-full">
            <label>Editora</label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text btn-addon">
                  <vs-button color="primary" icon-pack="feather" icon="icon-plus"></vs-button>
                </div>
              </template>

              <v-select class="w-full small" label="name" :options="companies" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                placeholder="Editora" v-model="book.company_id" />
            </vx-input-group>
          </div>

          <div class="vx-col sm:w-1/6 w-full">
            <label>Páginas</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-book-open" icon-no-border
              placeholder="Nº de Páginas" v-model="book.pages" />
          </div>


          <div class="vx-col sm:w-1/4 w-full">
            <label>ISBN</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="ISBN"
              v-model="book.isbn" />
          </div>

          <div class="vx-col sm:w-1/3 w-full">
            <label>CDD</label>
            <v-select class="w-full" label="name" :options="cdds" :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="CDD"
              v-model="book.cdd" />
          </div>
        </div>

        <div class="vx-row mb-3">
          <div class="vx-col sm:w-1/6 w-full">
            <label>Edição</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-edit" icon-no-border placeholder="Edição"
              v-model="book.edition" />
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Linguagem</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-globe" icon-no-border placeholder="Título"
              v-model="book.language" />
          </div>

          <div class="vx-col sm:w-1/3 w-full">
            <label>Autor</label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text btn-addon">
                  <vs-button color="primary" icon-pack="feather" icon="icon-plus"></vs-button>
                </div>
              </template>

              <v-select class="w-full vs-justify" label="name" :options="authors" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                placeholder="Autor" v-model="author" />
            </vx-input-group>
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Publicação</label>
            <datepicker class="w-full" placeholder="Dia Mês Ano" :language="language" format="d MMMM yyyy"
              v-model="book.publication_date"></datepicker>
          </div>
        </div>

        <div class="vx-row mb-3">

          <div class="vx-col sm:w-1/4 w-full">
            <label>Cor</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-droplet" icon-no-border placeholder="Título"
              v-model="book.color" />
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
          </div>

          <div class="vx-col sm:w-1/4 w-full">
            <label>Preço</label>
            <vs-input icon-pack="feather" icon="icon-dollar-sign" icon-no-border placeholder="Título"
              v-model="book.price" :disabled="book.origin != 'Comprado'" />
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

          </div>
        </div>

        <div class="vx-row mb-3">
          <div class="vx-col w-full sm:w-1/2">
            <label>Sinopse</label>
            <vs-textarea rows="5" counter="1000" :counter-danger.sync="counterDanger[0]" v-model="book.sinopsis" />
          </div>
          <div class="vx-col w-full sm:w-1/2">
            <label>Observações</label>
            <vs-textarea rows="5" counter="190" :counter-danger.sync="counterDanger[1]" v-model="book.observations" />
          </div>
        </div>

        <div class="vx-row">
          <div class="vx-col w-full">
            <vs-button class="ml-auto mt-2" type="filled" @click.prevent="add(book)">Cadastrar</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning" @click="resetData">Redefinir</vs-button>
          </div>
        </div>
      </form>
    </vx-card>
  </div>
</template>

<script>
  import vSelect from 'vue-select';
  import Datepicker from 'vuejs-datepicker';
  import * as lang from 'vuejs-datepicker/src/locale';

  import { mapActions } from 'vuex';
  import moduleBookManagement from '@/store/admin/book/moduleBookManagement.js';


  export default {
    data() {
      return {
        language: lang['ptBR'],
        author: '',
        book: {
          title: 'Português',
          subtitle: 'Português',
          origin: 'Doado',
          price: '23',
          isbn: '12443',
          sinopsis: 'Português',
          pages: '12',
          language: 'Português',
          observations: 'Português',
          edition: '12',
          publication_date: '10/12/2019',
          color: 'Português',
          cdd: '234',
          cape: null,
          company_id: '1',
        },
        companies: [{
            id: 1,
            name: 'Leandro Carvalho da Silva Junior',
          },
          {
            id: 2,
            name: 'teste2',
          },
          {
            id: 3,
            name: 'teste3',
          },
        ],
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
        authors: [{
            id: 1,
            name: 'teste',
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
        textarea: ['', ''],
        counterDanger: [false, false]
      }
    },
    components: {
      vSelect,
      Datepicker
    },
    methods: {
      updateCurrImg(input) {
        if (input.target.files && input.target.files[0]) {
          var reader = new FileReader()
          reader.onload = e => {
            this.book.cape = e.target.result
          }
          reader.readAsDataURL(input.target.files[0])
        }
      },
      resetData() {
        Object.assign(this.$data, this.$options.data())
      },
      ... mapActions(['moduleBookManagement/store']), 
      async add(book) {
        console.log(book);
        await this.store(book);
      },

    }
  }

</script>

<style scoped>

</style>
