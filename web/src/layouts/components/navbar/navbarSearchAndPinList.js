export default {
  pages: {
    key: "title",
    data: [
      //DASHBOARD
      {title: 'Dashboard',                  url: '/admin/',                           icon: 'HomeIcon',           is_bookmarked: false},
      //{title: 'Page 2', url: '/admin/page2',    icon: 'FileIcon', is_bookmarked: false},

      //PRINCIPAL
      {title: 'Cadastro de Leitor',         url: '/admin/leitores/cadastro',          icon: 'UserPlusIcon',       is_bookmarked: true},
      {title: 'Lista de Leitores',          url: '/admin/leitores',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastro de Livro',          url: '/admin/livros/cadastro',            icon: 'PlusSquareIcon',     is_bookmarked: true},
      {title: 'Acervo',                     url: '/admin/leitores',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Novo Empréstimo',            url: '/admin/emprestimos/novo',           icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Lista de Empréstimos',       url: '/admin/emprestimos',                icon: 'ListIcon',           is_bookmarked: false},

      //SECUNDÁRIO
      {title: 'Cadastro de Autor',          url: '/admin/autores/cadastro',           icon: 'UserPlusIcon',       is_bookmarked: false},
      {title: 'Lista de Autores',           url: '/admin/autores',                    icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastro de Editora',        url: '/admin/editoras/cadastro',          icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Lista de Editoras',          url: '/admin/editoras',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastro de Curso',          url: '/admin/cursos/cadastro',            icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Lista de Cursos',            url: '/admin/cursos',                     icon: 'ListIcon',           is_bookmarked: false},

      //OUTROS
      {title: 'Cadastro de Usuário',        url: '/admin/usuarios/cadastro',          icon: 'UserPlusIcon',       is_bookmarked: false},
      {title: 'Lista de Usuários',          url: '/admin/usuarios',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Configurações',              url: '/admin/configuracoes',              icon: 'SettingsIcon',       is_bookmarked: false},
    ]
  }
}
