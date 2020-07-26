<template>
  <div class="vx-col w-full mb-base">

    <vs-alert color="danger" title="Leitor não encontrado" :active.sync="reader_not_found">
      <span>O leitor com o id {{ $route.params.readerId }} não foi encontrado. </span>
      <span>
        <span>Verificar </span><router-link :to="{name:'admin-reader-list'}" class="text-inherit underline">Todos os Leitores</router-link>
      </span>
    </vs-alert>

    <vx-card title="Editar Leitor" v-if="reader">

          <div class="vx-row">
            <div class="vx-col w-full mb-3">
              <label>Nome</label>
              <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Nome" v-model="reader.name" />
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full mb-2">
              <label>Email</label>
              <vs-input class="w-full" icon-pack="feather" icon="icon-mail" icon-no-border placeholder="Email" v-model="reader.email" />
            </div>
            <div class="vx-col sm:w-1/2 w-full mb-2">
              <label>Senha</label>
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border placeholder="Senha" v-model="reader.password" />
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full mb-3">
              <label>Telefone</label>
              <vs-input class="w-full" icon-pack="feather" icon="icon-phone" icon-no-border placeholder="Telefone" v-model="reader.phone" />
            </div>

            <div class="vx-col sm:w-1/2 w-full mb-2">
              <label>Sexo</label>
              <v-select class="w-full" :options="['Masculino', 'Feminino', 'Não-Binário','Desejo não informar']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.gender"/>
            </div>
          </div>´

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
                </div>

                <div class="vx-col sm:w-1/2 w-full mb-3">
                  <label>Ano de Matrícula</label>
                  <vs-input class="w-full" icon-pack="feather" icon="icon-calendar" icon-no-border placeholder="Ano de Matrícula" v-model="reader.entry_year" />
                </div>
              </div>

              <div class="vx-row">
                <div class="vx-col w-full mb-3">
                  <label>Status</label>
                  <v-select class="w-full" :options="['Ativado', 'Desativado', 'Bloqueado']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.status"/>
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
          <vs-button class="mr-3 mb-2">Criar</vs-button>
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
      reader: { name: 'Caio Guilherme' },
      reader_not_found: false,
    }
  },
  components: {
    'v-select': vSelect
  },
  methods: {
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
