/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  ----------------------------------------------------------------------------------------

==========================================================================================*/


export default [
  {
    url: "/admin",
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
            url: '/admin/leitores/cadastro',
            name: "Cadastro",
            slug: "leitores-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/admin/leitores',
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
            url: '/admin/livros/cadastro',
            name: "Cadastro",
            slug: "livros-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/admin/livros',
            name: "Acervo",
            slug: "livros",
            i18n: "Acervo",
          },
        ]
      },
      {
        url : '/admin/emprestimos',
        name: 'Emprestimos',
        slug: 'emprestimos',
        icon: 'RepeatIcon'
      },
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
            url: '/admin/autores/cadastro',
            name: "Cadastro",
            slug: "autores-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/admin/autores',
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
            url: '/admin/editoras/cadastro',
            name: "Cadastro",
            slug: "editoras-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/admin/editoras',
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
            url: '/admin/cursos/cadastro',
            name: "Cadastro",
            slug: "cursos-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/admin/cursos',
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
        name: "Usuários",
        icon: "UsersIcon",
        i18n: "Usuários",
        submenu: [
          {
            url: '/admin/usuarios/cadastro',
            name: "Cadastro",
            slug: "usuarios-cadastro",
            i18n: "Cadastro",
          },
          {
            url: '/admin/usuarios',
            name: "Lista",
            slug: "usuarios",
            i18n: "Lista",
          },
        ]
      },
      {
        url: "/admin/configuracoes",
        name: "Sistema",
        slug: "configuracoes",
        icon: "SettingsIcon",
      }
    ]
  }
]
