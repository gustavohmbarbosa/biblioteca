<template>
  <div class="h-screen flex w-full bg-img">
    <div
      class="vx-col flex items-center justify-center flex-col sm:w-1/2 md:w-3/5 lg:w-3/4 xl:w-1/2 mx-auto text-center"
    >
      <img
        src="@/assets/images/pages/404.png"
        alt="graphic-404"
        class="mx-auto mb-4 max-w-full"
      />
      <h1 class="sm:mx-0 mb-5 text-5xl d-theme-heading-color">
        Página Não Encontrada!
      </h1>
      <p class="sm:mx-0 mb-10 text-primary">
        Não foi possível encontrar esta página ou ela não existe.
      </p>
      <vs-button size="large" @click="$router.go(-1)">Voltar</vs-button>
    </div>
  </div>
</template>
