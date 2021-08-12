<template>
  <registration-form title="Formulário de Registro">
    <vs-tabs alignment="fixed" v-model="activeTab">
      <!-- Tab 1 -->
      <vs-tab label="Informações" icon-pack="feather" icon="icon-info" class="mt-4">
        <!-- Name -->
        <div class="w-full mb-6">
          <label>Nome</label>
          <vs-input
            class="w-full"
            icon-pack="feather"
            icon="icon-user"
            icon-no-border
            placeholder="Nome"
            v-model="reader.name"
          />

          <div class="text-danger text-sm" v-if="validations.name">
            <span v-show="validations.name">{{ validations.name[0] }}</span>
          </div>
        </div>

        <!-- Phone -->
        <div class="w-full mb-6">
          <label>Telefone</label>
          <vs-input
            class="w-full"
            icon-pack="feather"
            icon="icon-phone"
            icon-no-border
            placeholder="Telefone"
            v-mask="maskPhone"
            v-model="reader.phone"
          />

          <div class="text-danger text-sm" v-if="validations.phone">
            <span v-show="validations.phone">{{ validations.phone[0] }}</span>
          </div>
        </div>

        <!-- Gender -->
        <div class="w-full mb-6">
          <label>Sexo</label>
          <v-select
            class="w-full"
            placeholder="Selecione o sexo..."
            label="option"
            v-model="reader.gender"
            :reduce="option => option.value"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
            :options="genders"
          />

          <div class="text-danger text-sm" v-if="validations.gender">
            <span v-show="validations.gender">{{ validations.gender[0] }}</span>
          </div>
        </div>

        <!-- Registration -->
        <div class="w-full mb-6">
          <label>Matrícula</label>
          <vs-input
            class="w-full"
            placeholder="Matrícula"
            icon-pack="feather"
            icon="icon-code"
            icon-no-border
            v-mask="maskRegistration"
            v-model="reader.registration"
          />

          <div class="text-danger text-sm" v-if="validations.registration">
            <span v-show="validations.registration">{{ validations.registration[0] }}</span>
          </div>
        </div>

        <!-- Entry Year -->
        <div class="w-full mb-6">
          <label>Ano de Entrada</label>
          <vs-input
            class="w-full"
            placeholder="Ano de Entrada na Escola"
            icon-pack="feather"
            icon="icon-calendar"
            icon-no-border
            v-mask="maskEntryYear"
            v-model="reader.entry_year"
          />

          <div class="text-danger text-sm" v-if="validations.entry_year">
            <span v-show="validations.entry_year">{{ validations.entry_year[0] }}</span>
          </div>
        </div>

        <!-- Grade -->
        <div class="vx-row">
          <div class="vx-col w-full mb-6">
            <label>Série</label>

            <ul class="vx-row mt-3 radio-container">
              <li class="radio-items">
                <vs-radio
                  v-model="reader.grade"
                  vs-name="grade"
                  vs-value="1"
                >
                  1º Ano
                </vs-radio>
              </li>
              <li class="radio-items">
                <vs-radio
                  v-model="reader.grade"
                  vs-name="grade"
                  vs-value="2"
                >
                  2º Ano
                </vs-radio>
              </li>
              <li class="radio-items">
                <vs-radio
                  v-model="reader.grade"
                  vs-name="grade"
                  vs-value="3"
                >
                  3º Ano
                </vs-radio>
              </li>
            </ul>

            <div class="text-danger text-sm" v-if="validations.grade">
              <span v-show="validations.grade">{{ validations.grade[0] }}</span>
            </div>
          </div>
        </div>

        <!-- Class -->
        <div class="vx-row">
          <div class="vx-col w-full mb-6">
            <label>Turma</label>

            <ul class="vx-row mt-3 radio-container">
              <li class="radio-items">
                <vs-radio
                  color="warning"
                  v-model="reader.class"
                  vs-name="class"
                  vs-value="A"
                >
                  A
                </vs-radio>
              </li>
              <li class="radio-items">
                <vs-radio
                  color="warning"
                  v-model="reader.class"
                  vs-name="class"
                  vs-value="B"
                >
                  B
                </vs-radio>
              </li>
            </ul>

            <div class="text-danger text-sm" v-if="validations.class">
              <span v-show="validations.class">{{ validations.class[0] }}</span>
            </div>
          </div>

          <!-- Course -->
          <div class="vx-col w-full mb-6">
            <label>Curso</label>

            <ul class="vx-row mt-3 radio-container">
              <li class="radio-items">
                <vs-radio
                  color="success"
                  v-model="reader.course_id"
                  vs-name="course_id"
                  vs-value="1"
                >
                  Desenvolvimento de Sistemas
                </vs-radio>
              </li>
              <li class="radio-items">
                <vs-radio
                  color="success"
                  v-model="reader.course_id"
                  vs-name="course_id"
                  vs-value="2"
                >
                  Logística
                </vs-radio>
              </li>
            </ul>

            <div class="text-danger text-sm" v-if="validations.course_id">
              <span v-show="validations.course_id">{{ validations.course_id[0] }}</span>
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="vx-col w-full">
          <vs-button
            color="#999"
            type="flat"
            class="float-left"
            @click="$router.back()"
          >
            Cancelar
          </vs-button>
          <vs-button class="float-right" @click="activeTab = 1">Avançar</vs-button>
        </div>
      </vs-tab>

      <!-- Tab 2 -->
      <vs-tab label="Conta" icon-pack="feather" icon="icon-user">
        <!-- Email -->
        <div class="vx-col w-full mb-6">
          <label>Email</label>
          <vs-input
            class="w-full"
            icon-pack="feather"
            icon="icon-mail"
            icon-no-border
            placeholder="Email"
            v-model="reader.email"
          />

          <div class="text-danger text-sm" v-if="validations.email">
            <span v-show="validations.email">{{ validations.email[0] }}</span>
          </div>
        </div>

        <!-- Password -->
        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full mb-6">
            <label>Senha</label>
            <vs-input
              type="password"
              class="w-full"
              icon-pack="feather"
              icon="icon-lock"
              icon-no-border
              placeholder="Senha"
              v-model="reader.password"
            />

            <div class="text-danger text-sm" v-if="validations.password">
              <span v-show="validations.password">{{ validations.password[0] }}</span>
            </div>
          </div>

          <div class="vx-col sm:w-1/2 w-full mb-6">
            <label>Confirmar Senha</label>
            <vs-input
              type="password"
              class="w-full"
              icon-pack="feather"
              icon="icon-lock"
              icon-no-border
              placeholder="Confirme a senha"
              v-model="reader.password_confirmation"
            />

            <div class="text-danger text-sm" v-if="validations.password_confirmation">
              <span v-show="validations.password_confirmation">{{ validations.password_confirmation[0] }}</span>
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="vx-col w-full">
          <vs-button type="flat" color="#999" class="float-left" @click="activeTab = 0">Voltar</vs-button>
          <vs-button
            class="float-right"
            type="filled"
            @click.prevent="updateReader"
          >
            Cadastrar
          </vs-button>
        </div>
      </vs-tab>
    </vs-tabs>
  </registration-form>
</template>

<script>
import moduleReaderManagement from '@/store/admin/reader/moduleReaderManagement.js';
import RegistrationForm from '@/components/RegistrationForm';
import vSelect from 'vue-select';

export default {
  data() {
    return {
      reader: {
        name: '',
        email: '',
        password: 'bibli@avs',
        password_confirmation: 'bibli@avs',
        phone: '',
        gender: '',
        grade: null,
        class: '',
        course_id: null,
        registration: '',
        entry_year: '',
      },

      genders: [
        {
          value: 'Masculino',
          option: 'Masculino'
        },
        {
          value: 'Feminino',
          option: 'Feminino'
        },
        {
          value: 'Não-Binário',
          option: 'Não-Binário'
        },
        {
          value: 'Não Informado',
          option: 'Prefiro não informar'
        },
      ],

      activeTab: 0,

      validations: {},

      maskPhone: "(##) #####-####",
      maskRegistration: "#######",
      maskEntryYear: "####",
    }
  },
  components: {
    vSelect,
    RegistrationForm
  },
  mounted() {
    this.showReader();
  },
  methods: {
    async updateReader() {
      this.$vs.loading({
        container: '#form-container',
        scale: 0.6
      });

      try {
        const { readerId } = this.$route.params;
        delete this.reader.image;

        const readerStored = await this.$store.dispatch('readerManagement/update', {
          readerId,
          reader: this.reader,
        });

        this.$vs.loading.close("#form-container > .con-vs-loading");

        this.$vs.notify({
          title: "Leitor Cadastrado!",
          text: readerStored.data.message,
          color: "success",
          iconPack: 'feather',
          icon: 'icon-check',
        });

        this.$router.push({ name: 'admin-reader-list' });
      } catch (error) {
        this.$vs.loading.close("#form-container > .con-vs-loading");

        this.$vs.notify({
          title: "Erro no Cadastro",
          text: "Verifique os campos e os preencha corretamente",
          color: "danger",
          iconPack: 'feather',
          icon: 'icon-alert-circle'
        });

        console.log(error.response);
        this.validations = error.response.data.errors
      }
    },
    async showReader() {
      this.$vs.loading({
        container: '#form-container',
        scale: 0.6
      });

      try {
        const { readerId } = this.$route.params;

        const { data } = await this.$store.dispatch('readerManagement/show', readerId);
        this.reader = data;

        this.$vs.loading.close('#form-container > .con-vs-loading');
      } catch (error) {
        this.$vs.loading.close('#form-container > .con-vs-loading');

        this.$vs.notify({
          title: 'Erro!',
          text: 'Erro ao encontrar o leitor',
          color: 'success',
          iconPack: 'feather',
          icon: 'icon-check',
        });

        this.$router.push({ name: 'admin-reader-list' });
      }
    },
  },
  watch: {
    'activeTab': function () {
      scrollTo(0, 0);
    }
  },
  created() {
    if (!moduleReaderManagement.isRegistered) {
      this.$store.registerModule('readerManagement', moduleReaderManagement);
      moduleReaderManagement.isRegistered = true;
    }
  },
}
</script>

<style lang="scss" scoped>
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
