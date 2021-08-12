<template>
  <div class="vx-col w-full mb-base">
    <vx-card id="update-book-form">
      <vs-tabs alignment="left" ref="bookForm" v-model="activeTab">
        <!-- To Book -->
        <vs-tab label="Livro" icon-pack="feather" icon="icon-book" class="mt-4 p-0">
          <div class="grid grid-cols-10 mb-3">
            <div class="col-span-10 lg:col-span-2 mb-3">
              <!-- Cape -->
              <img v-if="book.showCape" :src="book.showCape" class="responsive rounded" alt="Capa do Livro"/>
              
              <img v-else src="@/assets/images/book-image.png" class="responsive rounded" alt="Capa do Livro"/>

              <!-- Image upload Buttons -->
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateImg" accept="image/*" />
              <div class="text-center" style="margin-top:-2.75rem;">
                <vs-button color="success" type="flat" class="w-full" @click="$refs.uploadImgInput.click()">
                  Trocar imagem
                </vs-button>
              </div>
            </div>
            <div class="col-span-10 lg:col-span-8 lg:pl-5 my-auto py-auto">
              <!-- ISBN -->
              <div class="vx-col mb-3">
                <label>ISBN</label>
                <vs-input class="lg:w-1/4 w-full" icon-pack="feather" icon="icon-code" icon-no-border
                  v-model="book.isbn" v-mask="maskIsbn" />
                <div class="text-danger text-sm" v-if="validations.isbn">
                  <span class="text-danger text-sm">{{ validations.isbn[0] }}</span>
                </div>
              </div>

              <div class="vx-row mb-3">
                <!-- Title -->
                <div class="vx-col lg:w-3/5 w-full mb-3 lg:mb-0">
                  <label>Título</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-book" icon-no-border placeholder="Título"
                    v-model="book.title" />
                  <div class="text-danger text-sm" v-if="validations.title">
                    <span class="text-danger text-sm">{{ validations.title[0] }}</span>
                  </div>
                </div>

                <!-- Subtitle -->
                <div class="vx-col lg:w-2/5 w-full">
                  <label>SubTítulo</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-bookmark" icon-no-border
                    placeholder="SubTítulo" v-model="book.subtitle" />
                  <div class="text-danger text-sm" v-if="validations.subtitle">
                    <span>{{ validations.subtitle[0] }}</span>
                  </div>
                </div>
              </div>

              <div class="vx-row mb-3">
                <div class="vx-col lg:w-3/5 w-full mb-3 lg:mb-0">
                  <label>Autor(es)</label>
                  <v-select multiple class="w-full vs-justify" label="name" :options="authors" :reduce="name => name.id"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'" placeholder="Selecione o(s) autor(es)" v-model="book.authors_id" />
                
                  <div class="text-danger text-sm" v-if="validations.authors_id">
                    <span>{{ validations.authors_id[0] }} </span>
                  </div>
                </div>

                <div class="vx-col lg:w-2/5 w-full">
                  <label>Editora</label>
                  <v-select label="name" :options="companies" :reduce="name => name.id" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                    placeholder="Selecione a editora" v-model="book.company_id" />

                  <div class="text-danger text-sm" v-if="validations.company_id">
                    <span>{{ validations.company_id[0] }}</span>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-12 lg:gap-8 mb-3">
                <!-- Pages -->
                <div class="col-span-12 lg:col-span-2 mb-3">
                  <label>Páginas</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-book-open" icon-no-border
                    placeholder="Nº de Páginas" v-model="book.pages" v-mask="maskPages" />
                  <div class="text-danger text-sm" v-if="validations.pages">
                    <span>{{ validations.pages[0] }}</span>
                  </div>
                </div>

                <!-- Edition -->
                <div class="col-span-12 lg:col-span-2 mb-3">
                  <label>Edição</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-edit" icon-no-border placeholder="Edição"
                    v-model="book.edition" v-mask="maskEdition" />
                  <div class="text-danger text-sm" v-if="validations.edition">
                    <span>{{ validations.edition[0] }}</span>
                  </div>
                </div>

                <!-- Language -->
                <div class="col-span-12 lg:col-span-2 mb-3">
                  <label>Linguagem</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-globe" icon-no-border placeholder="Título"
                    v-model="book.language" />
                  <div class="text-danger text-sm" v-if="validations.language">
                    <span>{{ validations.language[0] }}</span>
                  </div>
                </div>

                <!-- Publication Year -->
                <div class="col-span-12 lg:col-span-2 w-full mb-6">
                  <label>Publicação</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-calendar" icon-no-border
                    placeholder="Ano" v-model="book.publicationYear" v-mask="maskPublicationYear" />
                  <div class="text-danger text-sm" v-if="validations.publicationYear">
                    <span>{{ validations.publicationYear[0] }}</span>
                  </div>
                </div>

                <!-- CDD -->
                <div class="col-span-12 lg:col-span-4 mb-3">
                  <label>Código Decimal de Dewey</label>
                  <v-select label="name" :options="cdds" :reduce="name => name.id" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                    placeholder="CDD" v-model="book.cdd" />
                  <div class="text-danger text-sm" v-if="validations.cdd">
                    <span>{{ validations.cdd[0] }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Synopsis -->
          <div class="w-full">
            <vs-textarea
              rows="5"
              counter="5000"
              placeholder="Sinopse"
              :counter-danger.sync="counterDanger[0]"
              v-model="book.synopsis"
            />
            <div class="text-danger text-sm" v-if="validations.synopsis">
              <span v-show="validations.synopsis">{{ validations.synopsis[0] }}</span>
            </div>
          </div>

          <!-- Buttons -->
          <div class="vx-col w-full mt-6">
            <vs-button
              color="#999"
              type="flat"
              class="float-left"
              @click="$router.back()"
            >
              Cancelar
            </vs-button>
            <vs-button class="float-right" type="filled" @click.prevent="submitBook(book)">Salvar Alterações</vs-button>
          </div>
        </vs-tab>

        <!-- To Library -->
        <vs-tab label="Biblioteca" icon-pack="feather" icon="icon-archive">
          <!-- Color -->
          <div class="vx-row">
            <div class="vx-col lg:w-1/3 w-full mb-6">
              <label>Cor</label>
              <vs-input class="w-full" icon-pack="feather" icon="icon-droplet" icon-no-border placeholder="Cor"
                v-model="book.color" />
              <div class="text-danger text-sm" v-if="validations.color">
                <span>{{ validations.color[0] }}</span>
              </div>
            </div>

            <!-- Origin -->
            <div class="vx-col lg:w-1/3 w-full mb-6">
              <label>Origem</label>
              <ul class="vx-row mt-3 ml-1 flex justify-items-between">
                <li>
                  <vs-radio class="sm:w-1/2 w-full" v-model="book.origin" vs-name="grade" vs-value="Doado">Doado
                  </vs-radio>
                </li>
                <li>
                  <vs-radio class="sm:w-1/2 w-full sm:ml-12 ml-6" v-model="book.origin" vs-name="grade" vs-value="Comprado">
                    Comprado</vs-radio>
                </li>
              </ul>
              <div class="text-danger text-sm" v-if="validations.origin">
                <span>{{ validations.origin[0] }}</span>
              </div>
            </div>

            <!-- Price -->
            <div class="vx-col lg:w-1/3 w-full mb-6">
              <label>Preço</label>
              <vs-input class="w-full" icon-pack="feather" icon="icon-dollar-sign" icon-no-border placeholder="Preço"
                v-model.lazy="book.price" :disabled="book.origin != 'Comprado'" v-money="money" maxlength="7" />
              <div class="text-danger text-sm" v-if="validations.price">
                <span>{{ validations.price[0] }}</span>
              </div>
            </div>
          </div>

          <!-- Observations -->
          <div class="w-full mb-6">
            <label>Observações</label>
            <vs-textarea rows="5" counter="190" :counter-danger.sync="counterDanger[1]" v-model="book.observations" />
            <div class="text-danger text-sm" v-if="validations.observations">
              <span>{{ validations.observations[0] }}</span>
            </div>
          </div>

          <!-- Buttons -->
          <div class="vx-col w-full">
            <vs-button type="flat" color="#999" class="float-left" @click="activeTab = 0">Voltar</vs-button>
            <vs-button class="float-right" type="filled" @click.prevent="submitBook(book)">Salvar Alterações</vs-button>
          </div>
        </vs-tab>
      </vs-tabs>
    </vx-card>
  </div>
</template>

<script>
import moduleBookManagement from "@/store/admin/book/moduleBookManagement.js";
import moduleCompanyManagement from "@/store/admin/company/moduleCompanyManagement.js";
import moduleAuthorManagement from "@/store/admin/author/moduleAuthorManagement.js";

import vSelect from "vue-select";
import Datepicker from "vuejs-datepicker";
import { VMoney } from "v-money";

export default {
  data() {
    return {
      book: {
        title: "",
        subtitle: "",
        origin: "",
        price: "",
        isbn: "",
        synopsis: "",
        pages: "",
        language: "",
        observations: "",
        edition: "",
        publication_year: null,
        color: "",
        cdd: "",
        cape: null,
        company_id: null,
        authors_id: [],
      },
      companies: [],
      authors: [],
      cdds: [],
      validations: {},

      activeTab: 0,

      money: {
        decimal: ",",
        thousands: ".",
        prefix: "",
        suffix: "",
        precision: 2,
        masked: true
      },

      maskIsbn: "#############",
      maskPages: "#####",
      maskEdition: "###",
      maskPublicationYear: "####",
      counterDanger: [false, false],

    };
  },
  watch: {
    activeTab: function() {
      scrollTo(0, 53);
    }
  },
  components: {
    vSelect,
    Datepicker
  },
  directives: {
    money: VMoney
  },
  methods: {
    submitBook(book) {
      const bookFormatted = this.bookInFormData(book);

      this.updateBook(bookFormatted);
    },
    bookInFormData(book) {
      let data = new FormData();

      data.append("cape", book.cape);
      data.append("title", book.title);
      data.append("subtitle", book.subtitle);
      data.append("origin", book.origin);
      data.append("price", this.formatPrice(book.price));
      data.append("isbn", book.isbn);
      data.append("synopsis", book.synopsis);
      data.append("pages", book.pages);
      data.append("language", book.language);
      data.append("observations", book.observations);
      data.append("edition", book.edition);
      data.append("publication_year", book.publicationYear);
      data.append("color", book.color);
      data.append("cdd", book.cdd);
      data.append("company_id", book.company_id);
      book.authors_id.forEach((value, key) => {
        data.append("author_id[" + key + "]", value);
      });

      return data;
    },
    async updateBook(book) {
      this.$vs.loading({
        container: ".form-container",
        scale: 0.6
      });

      try {
        const { data } = await this.$store.dispatch(
          "bookManagement/update",
          book,
          {
            headers: {
              "content-type": "multipart/form-data",
              "Access-Control-Allow-Origin": "*"
            }
          }
        );

        this.$vs.loading.close(".form-container > .con-vs-loading");
        this.$vs.notify({
          title: "Livro Atualizado",
          text: data.message,
          color: "success",
          iconPack: "feather",
          icon: "icon-check"
        });

        this.resetData();
      } catch (error) {
        this.$vs.loading.close(".form-container > .con-vs-loading");
        this.$vs.notify({
          title: "Erro na Edição",
          text: "Verifique os campos e os preencha corretamente",
          color: "danger",
          iconPack: "feather",
          icon: "icon-alert-circle"
        });
        console.log(error.response);
        this.validations = error.response.data.errors;
      }
    },
    updateImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader();
        reader.onload = e => {
          this.book.showCape = e.target.result;
        };
        reader.readAsDataURL(input.target.files[0]);
        this.book.cape = input.target.files[0];
      }
    },
  },
  mounted() {
    this.$vs.loading({
      container: "#update-book-form",
      scale: 0.6
    });
  },
  created() {
    // Register Module BookManagement Module
    if (!moduleBookManagement.isRegistered) {
      this.$store.registerModule("bookManagement", moduleBookManagement);
      moduleBookManagement.isRegistered = true;
    }

    const bookId = this.$route.params.bookId;
    this.$store
      .dispatch("bookManagement/show", bookId)
      .then(res => {
        this.book = res.data;
        this.book.showCape = null;
        this.book.authors_id = this.book.authors.map(author => author.id);
        this.$vs.loading.close("#update-book-form > .con-vs-loading");
      })
      .catch(err => {
        this.$vs.notify({
          title: "Erro",
          text: err.response.data.message,
          color: "danger",
          iconPack: "feather",
          icon: "icon-check",
          time: 4000
        });
      });

    // Register Module CompanyManagement Module
    if (!moduleCompanyManagement.isRegistered) {
      this.$store.registerModule("companyManagement", moduleCompanyManagement);
      moduleCompanyManagement.isRegistered = true;
    }

    // Getting Companies
    this.$store
      .dispatch("companyManagement/index")
      .then(response => {
        this.companies = response.data;
      })
      .catch(error => {
        this.$vs.notify({
          title: "Erro",
          text: error.response.data.message,
          color: "danger",
          iconPack: "feather",
          icon: "icon-check",
          time: 4000
        });
      });

    // Register Module AuthorManagement Module
    if (!moduleAuthorManagement.isRegistered) {
      this.$store.registerModule("authorManagement", moduleAuthorManagement);
      moduleAuthorManagement.isRegistered = true;
    }

    // Getting Authors
    this.$store
      .dispatch("authorManagement/index")
      .then(response => {
        this.authors = response.data;
      })
      .catch(error => {
        this.$vs.notify({
          title: "Erro",
          text: error.response.data.message,
          color: "danger",
          iconPack: "feather",
          icon: "icon-check",
          time: 4000
        });
      });
  }
};
</script>
