<template>
    <div class="vx-col w-full mb-base">
			<vx-card title="Cadastrar Leitor">

            <div class="vx-row">
              <div class="vx-col w-full mb-3">
                <label>Nome</label>
                <vs-input class="w-full" icon="person" placeholder="Nome" v-model="reader.name" />
              </div>
            </div>

            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full mb-2">
                <label>Email</label>
                <vs-input class="w-full" icon="email" placeholder="Email" v-model="reader.email" />
              </div>
              <div class="vx-col sm:w-1/2 w-full mb-2">
                <label>Senha</label>
                <vs-input type="password" class="w-full" icon="lock" placeholder="Senha" v-model="reader.password" />
              </div>
            </div>

            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <label>Telefone</label>
                <vs-input class="w-full" icon="phone" placeholder="Telefone" v-model="reader.phone" />
              </div>

              <div class="vx-col sm:w-1/2 w-full mb-2">
                <label>Sexo</label>
                <v-select class="w-full" :options="['Masculino', 'Feminino', 'Não-Binário','Desejo não informar']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.gender"/>
              </div>
            </div>´

            <div class="vx-row">
              <div class="vx-col sm:w-1/3 w-full mb-3">
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

              <div class="vx-col sm:w-1/3 w-full mb-3">
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

              <div class="vx-col sm:w-1/3 w-full mb-3">
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
            </div>

            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <label>Matrícula</label>
                <vs-input class="w-full" icon="content_paste" placeholder="Matrícula" v-model="reader.registration" />
              </div>

              <div class="vx-col sm:w-1/2 w-full mb-3">
                <label>Ano de Matrícula</label>
                <vs-input class="w-full" icon="date_range" placeholder="Ano de Matrícula" v-model="reader.entry_year" />
              </div>
            </div>

            <div class="vx-row">
              <div class="vx-col w-full mb-3">
                <label>Status</label>
                <v-select class="w-full" :options="['Ativado', 'Desativado', 'Bloqueado']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="reader.status"/>
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
						<vs-button color="danger" type="border" class="mb-2">Voltar</vs-button>
					</div>
				</div>
			</vx-card>
      </div>
</template>

<script>
import vSelect from 'vue-select'

export default {
  data() {
    return {
      reader: {
        name: '',
        email: '',
        password: '',
        phone: '',
        gender: { label: 'Sexo' },
        grade: '',
        class: '',
        courde_id: '',
        registration: '',
        entry_year: '',
        status: { label: 'Status' }
      }
    }
  },
  components: {
    'v-select': vSelect
  },
  methods: {
  },
}
</script>
