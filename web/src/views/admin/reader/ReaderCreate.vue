<template>
  <div class="vx-row mb-base">
    <vx-card title="Cadastrar Leitor" class="form-container">

      <vs-tabs alignment="fixed" v-model="activeTab">
        <!-- Informations -->
        <vs-tab label="Informações" icon-pack="feather" icon="icon-info" class="mt-4">
          <div class=" w-full mb-6">
            <label>Nome</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Nome"
              v-model="reader.name" />
            <div class="text-danger text-sm" v-if="validations.name">
              <span v-show="validations.name">{{ validations.name[0] }}</span>
            </div>
          </div>

          <div class="w-full mb-6">
            <label>Telefone</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-phone" icon-no-border placeholder="Telefone"
              v-model="reader.phone" />
            <div class="text-danger text-sm" v-if="validations.phone">
              <span v-show="validations.phone">{{ validations.phone[0] }}</span>
            </div>
          </div>

          <div class="w-full mb-6">
            <label>Sexo</label>
            <v-select class="w-full" :options="['Masculino', 'Feminino', 'Não-Binário','Desejo não informar']"
              :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.gender" />
            <div class="text-danger text-sm" v-if="validations.gender">
              <span v-show="validations.gender">{{ validations.gender[0] }}</span>
            </div>
          </div>

          <div class="w-full mb-6">
            <label>Matrícula</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-code" icon-no-border placeholder="Matrícula"
              v-model="reader.registration" />
            <div class="text-danger text-sm" v-if="validations.registration">
              <span v-show="validations.registration">{{ validations.registration[0] }}</span>
            </div>
          </div>

          <div class="w-full mb-6">
            <label>Ano de Matrícula</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-calendar" icon-no-border
              placeholder="Ano de Matrícula" v-model="reader.entry_year" />
            <div class="text-danger text-sm" v-if="validations.entry_year">
              <span v-show="validations.entry_year">{{ validations.entry_year[0] }}</span>
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col w-full mb-6">
              <label>Série</label>
              <ul class="vx-row mt-3 radio-container">
                <li class="radio-items">
                  <vs-radio v-model="reader.grade" vs-name="grade" vs-value="1">1º Ano</vs-radio>
                </li>
                <li class="radio-items">
                  <vs-radio v-model="reader.grade" vs-name="grade" vs-value="2">2º Ano</vs-radio>
                </li>
                <li class="radio-items">
                  <vs-radio v-model="reader.grade" vs-name="grade" vs-value="3">3º Ano</vs-radio>
                </li>
              </ul>
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col w-full mb-6">
              <label>Turma</label>
              <ul class="vx-row mt-3 radio-container">
                <li class="radio-items">
                  <vs-radio color="warning" v-model="reader.class" vs-name="class" vs-value="A">A</vs-radio>
                </li>
                <li class="radio-items">
                  <vs-radio color="warning" v-model="reader.class" vs-name="class" vs-value="B">B</vs-radio>
                </li>
              </ul>
            </div>

            <div class="vx-col w-full mb-6">
              <label>Curso</label>
              <ul class="vx-row mt-3 radio-container">
                <li class="radio-items">
                  <vs-radio color="success" v-model="reader.course_id" vs-name="course_id" vs-value="1">
                    Desenvolvimento de Sistemas
                  </vs-radio>
                </li>
                <li class="radio-items">
                  <vs-radio color="success" v-model="reader.course_id" vs-name="course_id" vs-value="2">
                    Logística
                  </vs-radio>
                </li>
              </ul>
            </div>
          </div>

          <!-- Buttons -->
          <div class="vx-col w-full">
            <vs-button color="#999" type="flat" class="float-left" @click="$router.back()">Cancelar</vs-button>
            <vs-button class="float-right" @click="activeTab = 1">Avançar</vs-button>
          </div>

        </vs-tab>

        <!-- Account -->
        <vs-tab label="Conta" icon-pack="feather" icon="icon-user">

          <div class="vx-col w-full mb-6">
            <label>Email</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-mail" icon-no-border placeholder="Email"
              v-model="reader.email" />
            <div class="text-danger text-sm" v-if="validations.email">
              <span v-show="validations.email">{{ validations.email[0] }}</span>
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full mb-6">
              <label>Senha</label>
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
                placeholder="Senha" v-model="reader.password" />
              <div class="text-danger text-sm" v-if="validations.password">
                <span v-show="validations.password">{{ validations.password[0] }}</span>
              </div>
            </div>
            <div class="vx-col sm:w-1/2 w-full mb-6">
              <label>Confirmar Senha</label>
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
                placeholder="Confirme a senha" v-model="reader.password_confirmation" />
              <div class="text-danger text-sm" v-if="validations.password_confirmation">
                <span v-show="validations.password_confirmation">{{ validations.password_confirmation[0] }}</span>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="vx-col w-full">
            <vs-button type="flat" color="#999" class="float-left" @click="activeTab = 0">Voltar</vs-button>
            <vs-button class="float-right" type="filled" @click.prevent="submitReader(reader)">Cadastrar</vs-button>
          </div>
        </vs-tab>
      </vs-tabs>

    </vx-card>
  </div>
</template>

<script>
  import moduleReaderManagement from '@/store/admin/reader/moduleReaderManagement.js'

  import vSelect from 'vue-select'

  export default {
    data() {
      return {
        image: null,
        showImage: null,
        reader: {
          name: '',
          email: '',
          password: 'bibli@avs',
          password_confirmation: 'bibli@avs',
          phone: '',
          gender: 'Masculino',
          grade: 1,
          class: 'A',
          course_id: '1',
          registration: '',
          entry_year: '',
        },

        validations: {},

        activeTab: 0,
      }
    },
    components: {
      'v-select': vSelect
    },
    methods: {
      storeReader(reader) {
        // Loading
        this.$vs.loading({
          container: '.form-container',
          scale: 0.6
        })

        reader = this.treatReaderData(reader)

        // Header Settings
        const config = {
          headers: {
            'content-type': 'multipart/form-data',
            'Access-Control-Allow-Origin': '*'
          }
        }

        // Saving datas of reader
        this.$store.dispatch('readerManagement/store', reader, config)
          .then(res => {
            this.$vs.loading.close(".form-container > .con-vs-loading")
            this.$vs.notify({
              title: 'Leitor Criado com sucesso!',
              text: res.data.message,
              color: 'success',
              iconPack: 'feather',
              icon: 'icon-check',
            })
          })
          .catch(error => {
            this.$vs.loading.close(".form-container > .con-vs-loading")
            this.validations = error.response.data.errors
            this.$vs.notify({
              title: 'Erro ao criar leitor!',
              text: "Preencha os campos corretamente!",
              color: 'danger',
              iconPack: 'feather',
              icon: 'icon-alert-circle',
            })
          })
      },
      clearForm() {
        this.reader = {}
      },
      treatReaderData(reader) {

        if (this.image != null) {

          let data = new FormData()

          Object.entries(this.reader).forEach(([key, value]) => {
            if (key !== 'course') {
              data.append(key, value)
            }
          })
          data.append('image', this.image)

          return data
        }
        return reader
      },
      updateCurrImg(input) {
        if (input.target.files && input.target.files[0]) {
          var reader = new FileReader()
          reader.onload = e => {
            this.showImage = e.target.result
          }
          reader.readAsDataURL(input.target.files[0])
          this.image = input.target.files[0]
        }
      },
    },
    created() {
      if (!moduleReaderManagement.isRegistered) {
        this.$store.registerModule('readerManagement', moduleReaderManagement)
        moduleReaderManagement.isRegistered = true
      }
    }
  }

</script>

<style lang="scss" scoped>
  .form-container {
    margin-left: 1rem;
    margin-right: 1rem;
  }

  @media (min-width: 1024px) {
    .form-container {
      width: 50%;
      margin-left: 25%;
    }
  }

  .radio-container {
    display: inline;
  }

  @media (min-width: 340px) {
    .radio-container {
      display: flex;
    }

    .radio-items {
      margin-left: 1rem;
    }
  }

</style>
