export default {
  pages: {
    key: "title",
    data: [
      //DASHBOARD
      {title: 'Dashboard',                  url: '/',                           icon: 'HomeIcon',           is_bookmarked: false},
      //{title: 'Page 2', url: '/page2',    icon: 'FileIcon', is_bookmarked: false},

      //PRINCIPAL
      {title: 'Cadastro de Leitor',         url: '/leitores/cadastro',          icon: 'UserPlusIcon',       is_bookmarked: true},
      {title: 'Lista de Leitores',          url: '/leitores',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastro de Livro',          url: '/livros/cadastro',            icon: 'PlusSquareIcon',     is_bookmarked: true},
      {title: 'Acervo',                     url: '/leitores',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Novo Empréstimo',            url: '/emprestimos/novo',           icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Lista de Empréstimos',       url: '/emprestimos',                icon: 'ListIcon',           is_bookmarked: false},

      //SECUNDÁRIO
      {title: 'Cadastro de Autor',          url: '/autores/cadastro',           icon: 'UserPlusIcon',       is_bookmarked: false},
      {title: 'Lista de Autores',           url: '/autores',                    icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastro de Editora',        url: '/editoras/cadastro',          icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Lista de Editoras',          url: '/editoras',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastro de Curso',          url: '/cursos/cadastro',            icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Lista de Cursos',            url: '/cursos',                     icon: 'ListIcon',           is_bookmarked: false},
      
      //OUTROS
      {title: 'Cadastro de Usuário',        url: '/usuarios/cadastro',          icon: 'UserPlusIcon',       is_bookmarked: false},
      {title: 'Lista de Usuários',          url: '/usuarios',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Configurações',              url: '/configuracoes',              icon: 'SettingsIcon',       is_bookmarked: false},
    ]
  }
}
