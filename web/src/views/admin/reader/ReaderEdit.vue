<template>
  <div class="vx-col w-full mb-base">

    <vx-card title="Editar Leitor" v-if="reader" id="update-form">

        <div class="vx-row">
          <div class="vx-col w-full mb-3">
            <label>Nome</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Nome" v-model="reader.name" />
            <div class="text-danger text-sm" v-if="validations.name">
              <span v-show="validations.name">{{ validations.name[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full mb-2">
            <label>Email</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-mail" icon-no-border placeholder="Email" v-model="reader.email" />
            <div class="text-danger text-sm" v-if="validations.email">
              <span v-show="validations.email">{{ validations.email[0] }}</span>
            </div>
          </div>
          <div class="vx-col sm:w-1/4 w-full mb-2">
            <label>Senha</label>
            <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border placeholder="Senha" v-model="reader.password" />
            <div class="text-danger text-sm" v-if="validations.password">
              <span v-show="validations.password">{{ validations.password[0] }}</span>
            </div>
          </div>
          <div class="vx-col sm:w-1/4 w-full mb-2">
            <label>Confirmar Senha</label>
            <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border placeholder="Confirmar Senha" v-model="reader.password_confirmation" />
            <div class="text-danger text-sm" v-if="validations.password_confirmation">
              <span v-show="validations.password_confirmation">{{ validations.password_confirmation[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full mb-3">
            <label>Telefone</label>
            <vs-input class="w-full" icon-pack="feather" icon="icon-phone" icon-no-border placeholder="Telefone" v-model="reader.phone" />
            <div class="text-danger text-sm" v-if="validations.phone">
              <span v-show="validations.phone">{{ validations.phone[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/2 w-full mb-2">
            <label>Sexo</label>
            <v-select class="w-full" :options="['Masculino', 'Feminino', 'Não-Binário','Desejo não informar']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.gender"/>
            <div class="text-danger text-sm" v-if="validations.gender">
              <span v-show="validations.gender">{{ validations.gender[0] }}</span>
            </div>
          </div>
        </div>

        <div class="vx-row">
          <div class="vx-col sm:w-1/6 w-full mb-3">
            <label>Ano</label>
            <ul class="mt-3">
              <li>
                <vs-radio v-model="reader.grade" vs-name="grade" vs-value="1">1º Ano</vs-radio>
              </li>
              <li>
                <vs-radio v-model="reader.grade" vs-name="grade" vs-value="2">2º Ano</vs-radio>
              </li>
              <li>
                <vs-radio v-model="reader.grade" vs-name="grade" vs-value="3">3º Ano</vs-radio>
              </li>
            </ul>
          </div>

          <div class="vx-col sm:w-1/6 w-full mb-3">
            <label>Classe</label>
            <ul class="mt-3">
              <li>
                <vs-radio color="warning" v-model="reader.class" vs-name="class" vs-value="A">A</vs-radio>
              </li>
              <li>
                <vs-radio color="warning" v-model="reader.class" vs-name="class" vs-value="B">B</vs-radio>
              </li>
            </ul>
          </div>

          <div class="vx-col sm:w-1/6 w-full mb-3">
            <label>Curso</label>
            <ul class="mt-3">
              <li>
                <vs-radio color="success" v-model="reader.course_id" vs-name="course_id" vs-value="1">Logística</vs-radio>
              </li>
              <li>
                <vs-radio color="success" v-model="reader.course_id" vs-name="course_id" vs-value="2">Des. de Sistemas</vs-radio>
              </li>
            </ul>
          </div>

          <div class="vx-col sm:w-1/2 w-full mb-3">
            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <label>Matrícula</label>
                <vs-input class="w-full" icon-pack="feather" icon="icon-archive" icon-no-border placeholder="Matrícula" v-model="reader.registration" />
                <div class="text-danger text-sm" v-if="validations.registration">
                  <span v-show="validations.registration">{{ validations.registration[0] }}</span>
                </div>
              </div>

              <div class="vx-col sm:w-1/2 w-full mb-3">
                <label>Ano de Matrícula</label>
                <vs-input class="w-full" icon-pack="feather" icon="icon-calendar" icon-no-border placeholder="Ano de Matrícula" v-model="reader.entry_year" />
                <div class="text-danger text-sm" v-if="validations.entry_year">
                  <span v-show="validations.entry_year">{{ validations.entry_year[0] }}</span>
                </div>
              </div>
            </div>

            <div class="vx-row">
              <div class="vx-col w-full mb-3">
                <label>Status</label>
                <v-select class="w-full" :options="['Ativado', 'Desativado', 'Bloqueado']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.status"/>
                <div class="text-danger text-sm" v-if="validations.status">
                  <span v-show="validations.status">{{ validations.status[0] }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      <div class="vx-col m-auto">
        <div class="centerx">
          <vs-upload action="https://jsonplaceholder.typicode.com/posts/" text="Salvar Foto"/>
        </div>
      </div>

      <div class="vx-row">
        <div class="vx-col w-full">
          <vs-button class="mr-3 mb-2" @click="updateReader">Criar</vs-button>
          <vs-button color="danger" type="border" class="mb-2" :to="{name:'admin-reader-list'}">Voltar</vs-button>
        </div>
      </div>
    </vx-card>
  </div>
</template>

<script>
import moduleReaderManagement from '@/store/admin/reader/moduleReaderManagement.js'
import vSelect from 'vue-select'

export default {
  data() {
    return {
      reader: {
        id: '',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        phone: '',
        gender: '',
        grade: '',
        class: '',
        course_id: '',
        registration: '',
        entry_year: '',
      },
      validations: {}
    }
  },
  components: {
    'v-select': vSelect
  },
  methods: {
    updateReader() {
      // Loading in form
      this.$vs.loading({
        container: '#update-form',
        scale: 0.6
      })
      this.$store.dispatch('readerManagement/update', this.reader)
        .then(res => {
          this.$vs.loading.close("#update-form > .con-vs-loading")
          this.$vs.notify({
            color: 'success',
            title: "Leitor atualizado!",
            text: res.data.message,
            iconPack: 'feather',
            icon: 'icon-check',
          })
        })
        .catch(err => {
          this.validations = err.response.data
          console.log(this.validations)
          this.$vs.loading.close("#update-form > .con-vs-loading")
          this.$vs.notify({
            color: 'danger',
            title: "Leitor não atualizado!",
            text: "Preencha os campos corretamente!",
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
    // Register Module ReaderManagement Module
    if(!moduleReaderManagement.isRegistered) {
      this.$store.registerModule('readerManagement', moduleReaderManagement)
      moduleReaderManagement.isRegistered = true
    }

    const readerId = this.$route.params.readerId
    this.$store.dispatch("readerManagement/show", readerId)
      .then(res => {
        this.reader = res.data
        this.$vs.loading.close("#update-form > .con-vs-loading")
      })
      .catch(err => {
        this.$vs.notify({
          color: 'success',
          title: "Erro",
          text: err.data.message,
          iconPack: 'feather',
          icon: 'icon-check',
          time: 4000
        })

        this.$vs.loading.close("#update-form > .con-vs-loading")
        this.$router.push('/leitores')
      })
  }
}
</script>
