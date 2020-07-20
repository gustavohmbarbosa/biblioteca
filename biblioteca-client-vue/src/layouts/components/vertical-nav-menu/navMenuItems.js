/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default [
  {
    url: "/",
    name: "Dashboard",
    slug: "dashboard",
    icon: "HomeIcon",
  },
  {
    header: "Principal",
    icon: "PackageIcon",
    i18n: "Principal",
    items: [
      {
        url: null,
        name: "Leitores",
        icon: "UsersIcon",
        i18n: "Leitores",
        submenu: [
          {
            url: '/leitores/cadastro',
            name: "Cadastro",
            slug: "leitores-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/leitores',
            name: "Lista",
            slug: "leitores",
            i18n: "Lista",
          },
        ]
      },
      {
        url: null,
        name: "Livros",
        icon: "BookIcon",
        i18n: "Livros",
        submenu: [
          {
            url: '/livros/cadastro',
            name: "Cadastro",
            slug: "livros-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/livros',
            name: "Acervo",
            slug: "livros",
            i18n: "Acervo",
          },
        ]
      },
      {
        url : 'emprestimos',
        name: 'Emprestimos',
        slug: 'emprestimos',
        icon: 'RepeatIcon'
      },
      // {
      //   url: "/page2",
      //   name: "Page 2",
      //   slug: "page2",
      //   icon: "FileIcon",
      // },
    ]
  },
  {
    header: "Secundário",
    icon: "PackageIcon",
    i18n: "Secundário",
    items: [
      {
        url: null,
        name: "Autores",
        icon: "UsersIcon",
        i18n: "Autores",
        submenu: [
          {
            url: '/autores/cadastro',
            name: "Cadastro",
            slug: "autores-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/autores',
            name: "Lista",
            slug: "autores",
            i18n: "Lista",
          },
        ]
      },
      {
        url: null,
        name: "Editoras",
        icon: "GlobeIcon",
        i18n: "Editoras",
        submenu: [
          {
            url: '/editoras/cadastro',
            name: "Cadastro",
            slug: "editoras-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/editoras',
            name: "Lista",
            slug: "editoras",
            i18n: "Lista",
          },
        ]
      },
      {
        url: null,
        name: "Cursos",
        icon: "ListIcon",
        i18n: "Cursos",
        submenu: [
          {
            url: '/cursos/cadastro',
            name: "Cadastro",
            slug: "cursos-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/cursos',
            name: "Lista",
            slug: "cursos",
            i18n: "Lista",
          },
        ]
      },
    ]
  },
  {
    header: "Outros",
    icon: "PackageIcon",
    i18n: "Outros",
    items: [
      {
        url: null,
        name: "Bibliotecários",
        icon: "UsersIcon",
        i18n: "Bibliotecários",
        submenu: [
          {
            url: '/bibliotecarios/cadastro',
            name: "Cadastro",
            slug: "bibliotecarios-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/bibliotecarios',
            name: "Lista",
            slug: "bibliotecarios",
            i18n: "Lista",
          },
        ]
      },
      {
        url: "/configuracoes",
        name: "Configurações",
        slug: "configuracoes",
        icon: "SettingsIcon",
      }
    ]
  }
]
