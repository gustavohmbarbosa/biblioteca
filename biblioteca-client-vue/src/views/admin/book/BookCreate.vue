<template>
  <div class="vx-col w-full mb-base">
    <vx-card>

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

            <v-select class="w-full" label="name" :options="companies" :dir="$vs.rtl ? 'rtl' : 'ltr'"
              placeholder="Editora" v-model="book.company" />
          </vx-input-group>
        </div>

        <div class="vx-col sm:w-1/6 w-full">
          <label>Páginas</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-book-open" icon-no-border placeholder="Nº de Páginas"
            v-model="book.pages" />
        </div>


        <div class="vx-col sm:w-1/4 w-full">
          <label>ISBN</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="ISBN"
            v-model="book.title" />
        </div>

        <div class="vx-col sm:w-1/3 w-full">
          <label>CDD</label>
          <v-select class="w-full" label="name" :options="cdds" :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="CDD"
            v-model="book.cdd" />
        </div>
      </div>

      <div class="vx-row mb-3">
        <div class="vx-col sm:w-1/5 w-full">
          <label>Edição</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-edit" icon-no-border placeholder="Edição"
            v-model="book.title" />
        </div>

        <div class="vx-col sm:w-1/5 w-full">
          <label>Linguagem</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="Título"
            v-model="book.title" />
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
            v-model="book.date"></datepicker>
        </div>
      </div>

      <div class="vx-row mb-3">

        <div class="vx-col sm:w-1/5 w-full">
          <label>Cor</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-droplet" icon-no-border placeholder="Título"
            v-model="book.title" />
        </div>
        <div class="vx-col sm:w-1/5 w-full">
          <label>Origem</label>
          <ul class="vx-row mt-3 ml-1">
            <li>
              <vs-radio v-model="book.origin" vs-name="grade" vs-value="Doado">Doado</vs-radio>
            </li>
            <li>
              <vs-radio class="ml-3" v-model="book.origin" vs-name="grade" vs-value="Comprado">Comprado</vs-radio>
            </li>
          </ul>
        </div>

        <div class="vx-col sm:w-1/6 w-full">
          <label>Preço</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-dollar-sign" icon-no-border placeholder="Título"
            v-model="book.title" />
        </div>
      </div>

      <div class="vx-row">
        <div class="vx-col w-full">
          <vs-button class="ml-auto mt-2">Cadastrar</vs-button>
          <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Redefinir</vs-button>
        </div>
      </div>
    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';
import * as lang from 'vuejs-datepicker/src/locale';

export default {
  data() {
    return {
      language: lang['ptBR'],
      author: '',
      book: {
        title: '',
        subtitle: '',
        company: '',
        pages: '',
        isbn: '',
        cdd: '',
        origin: 'Doado',
        price: '',
        date: null,
      },
      companies: [
        {
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
      cdds: [
        {
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
      authors: [
        {
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
          this.data.image = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    reset_data() {
       Object.assign(this.$data, this.$options.data())
    }
  }
}
</script>

<style scoped>

</style>