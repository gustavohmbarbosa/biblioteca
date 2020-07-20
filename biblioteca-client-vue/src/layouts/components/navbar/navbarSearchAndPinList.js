export default {
  pages: {
    key: "title",
    data: [
      //DASHBOARD
      {title: 'Dashboard',                url: '/',                           icon: 'HomeIcon',           is_bookmarked: false},
      //{title: 'Page 2', url: '/page2',    icon: 'FileIcon', is_bookmarked: false},

      //PRINCIPAL
      {title: 'Cadastrar Leitor',         url: '/leitores/cadastro',          icon: 'UserPlusIcon',       is_bookmarked: true},
      {title: 'Listar Leitores',          url: '/leitores',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastrar Livro',          url: '/livros/cadastro',            icon: 'PlusSquareIcon',     is_bookmarked: true},
      {title: 'Acervo',                   url: '/leitores',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Novo Empréstimo',          url: '/emprestimos/novo',           icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Listar Empréstimos',       url: '/emprestimos',                icon: 'ListIcon',           is_bookmarked: false},

      //SECUNDÁRIO
      {title: 'Cadastrar Autor',          url: '/autores/cadastro',           icon: 'UserPlusIcon',       is_bookmarked: false},
      {title: 'Listar Autores',           url: '/autores',                    icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastrar Editora',        url: '/editoras/cadastro',          icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Listar Editoras',          url: '/editoras',                   icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Cadastrar Curso',          url: '/cursos/cadastro',            icon: 'PlusSquareIcon',     is_bookmarked: false},
      {title: 'Listar Cursos',            url: '/cursos',                     icon: 'ListIcon',           is_bookmarked: false},
      
      //OUTROS
      {title: 'Cadastrar Bibliotecário',  url: '/bibliotecarios/cadastro',    icon: 'UserPlusIcon',       is_bookmarked: false},
      {title: 'Listar Bibliotecários',    url: '/bibliotecarios',             icon: 'ListIcon',           is_bookmarked: false},
      {title: 'Configurações',            url: '/configuracoes',              icon: 'SettingsIcon',       is_bookmarked: false},
    ]
  }
}
