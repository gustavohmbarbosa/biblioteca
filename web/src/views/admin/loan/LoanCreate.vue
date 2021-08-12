<template>
  <div class="vx-row mb-base" id="form-container">
    <vx-card title="Formulário de Cadastro" class="card-form">

      Olá

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker'
import * as lang from 'vuejs-datepicker/src/locale'

import moduleLoanManagement from '@/store/admin/loan/moduleLoanManagement.js'

export default {
  data() {
    return {
      loan: {},
      validations: {},

      activeTab: 0,
      language: lang['ptBR'],
      textarea: ['', ''],
      counterDanger: [false, false],

    }
  },
  components: {
    vSelect,
    Datepicker,
  },
  methods: {
    async storeLoan() {
      try {
        this.$vs.loading({
          container: '#form-container',
          scale: 0.6
        });

        const loan = this.$store.dispatch('bookManagement/store', this.loan);

        this.$vs.loading.close("#form-container > .con-vs-loading");

        this.$vs.notify({
          title: "Empréstimo Cadastrado",
          text: loan.data.message,
          color: "success",
          iconPack: 'feather',
          icon: 'icon-check',
        });
      } catch (error) {
        this.$vs.loading.close("#form-container > .con-vs-loading");

        this.$vs.notify({
          title: "Erro no Cadastro",
          text: "Preencha os campos corretamente",
          color: "danger",
          iconPack: 'feather',
          icon: 'icon-alert-circle'
        });

        this.validations = error.response.data.errors
      }
    },
  },
  created() {
    if (!moduleLoanManagement.isRegistered) {
      this.$store.registerModule('loanManagement', moduleLoanManagement)
      moduleLoanManagement.isRegistered = true
    }
  },
}
</script>

<style lang="scss" scoped>
.vue-form-wizard {
  padding-bottom: 0;

  ::v-deep .wizard-header {
    padding: 0;
  }

  ::v-deep .wizard-tab-content {
    padding-right: 0;
    padding-left: 0;
    padding-bottom: 0;

    .wizard-tab-container {
      margin-bottom: 0 !important;
    }
  }
}

.cape-container {
  max-height: 35.1rem;

  .img-container {
    box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.3)
  }
}

.card-form {
  margin-left: 1rem;
  margin-right: 1rem;
}

@media (min-width: 1024px) {
  .card-form {
    width: 50%;
    margin-left: 25%;
  }
}
</style>
