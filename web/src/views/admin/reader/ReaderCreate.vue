<template>
    <div class="vx-col w-full mb-base">
			<vx-card title="Cadastrar Leitor">
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

                <!-- <div class="vx-row">
                  <div class="vx-col w-full mb-3">
                    <label>Status</label>
                    <v-select class="w-full" :options="['Ativo', 'Inativo', 'Bloqueado']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.status"/>
                  </div>
                </div> -->
              </div>
            </div>

          <div class="vx-col m-auto">
            <div class="centerx">
              <vs-upload action="https://jsonplaceholder.typicode.com/posts/" text="Salvar Foto"/>
            </div>
          </div>

				<div class="vx-row">
					<div class="vx-col w-full">
						<vs-button class="mr-3 mb-2" @click="storeReader(reader)">Criar</vs-button>
						<vs-button color="danger" class="mr-3 mb-2" :to="{name:'admin-reader-list'}">Voltar</vs-button>
            <vs-button color="warning" class="mb-2" @click="clearForm">Limpar formulário</vs-button>
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
        name: 'teste',
        email: 'teste@teste.com',
        password: '12345678',
        password_confirmation: '12345678',
        phone: '00 00000-0000',
        gender: 'Masculino',
        grade: 2,
        class: 'B',
        course_id: "1",
        registration: '12345678',
        entry_year: '2019',
      },
      validations: {}
    }
  },
  components: {
    'v-select': vSelect
  },
  methods: {
    storeReader(reader) {
      // Saving datas of reader
      this.$store.dispatch('readerManagement/store', reader)
        .then(response => {
          this.showCreatedSuccess(response.data.message)
        })
        .catch(error => {
          console.log(error)
          // this.validations = JSON.stringify(error.response.data.errors)
          // console.log(this.validations)
          // this.showCreatedFailed("Preencha os campos corretamente!")
        })
    },
    clearForm() {
      this.reader = {}
    },
    showCreatedSuccess(message) {
      this.$vs.notify({
        color: 'success',
        title: 'Leitor Criado com sucesso!',
        text: message
      })
    },
    showCreatedFailed(message) {
      this.$vs.notify({
        color: 'danger',
        title: 'Erro ao criar leitor!',
        text: message
      })
    },
  },
  created() {
    // Register Module ReaderManagement Module
    if(!moduleReaderManagement.isRegistered) {
      this.$store.registerModule('readerManagement', moduleReaderManagement)
      moduleReaderManagement.isRegistered = true
    }
  }
}
</script>
