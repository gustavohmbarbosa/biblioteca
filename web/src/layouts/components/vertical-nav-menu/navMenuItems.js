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
        url: '/admin/leitores',
        name: "Leitores",
        slug: 'leitores',
        icon: "UsersIcon",
      },
      {
        url: '/admin/livros',
        name: "Livros",
        slug: "livros",
        icon: "BookIcon",
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
        url: '/admin/autores',
        name: "Autores",
        slug: "autores",
        icon: "UsersIcon",
      },
      {
        url: '/admin/editoras',
        name: "Editoras",
        slug: "editoras",
        icon: "GlobeIcon",
      },
      {
        url: '/admin/cursos',
        name: "Cursos",
        slug: "cursos",
        icon: "ListIcon",
      },
    ]
  },
  {
    header: "Outros",
    icon: "PackageIcon",
    i18n: "Outros",
    items: [
      {
        url: '/admin/usuarios',
        name: "Usuários",
        slug: "usuarios",
        icon: "UsersIcon",
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
