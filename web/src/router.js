import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '',
      component: () => import('./layouts/main/Main.vue'),
      meta: { requiresAuth: true },
      children: [

        /* Administrative */

        // Home
        {
          path: '/admin',
          name: 'admin-home',
          component: () => import('./views/Home.vue'),
        },
        // Home/>

        // Users
        {
          path: 'admin/usuarios',
          name: 'admin-user-list',
          component: () => import('@/views/admin/user/user-list/UserList.vue'),
          meta: {
            breadcrumb: [
                { title: 'Home', url: '/' },
                { title: 'Usuários', url: '/admin/usuarios' },
                { title: 'Lista', active: true },
            ],
            pageTitle: 'Lista de Usuários',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/usuarios/visualizacao/:userId',
          name: 'admin-user-view',
          component: () => import('@/views/admin/user/UserView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Usuários', url: '/admin/usuarios' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Usuário',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/usuarios/cadastro',
          name: 'admin-user-create',
          component: () => import('@/views/admin/user/UserCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Usuários', url: '/admin/usuarios' },
              { title: 'Cadastro', active: true },
            ],
            pageTitle: 'Cadastro de Usuário',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/usuarios/edicao/:userId',
          name: 'admin-user-edit',
          component: () => import('@/views/admin/user/user-edit/UserEdit.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Usuários', url: '/admin/usuarios' },
              { title: 'Edição', active: true },
            ],
            pageTitle: 'Edição de Usuário',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Users/>

        // Readers
        {
          path: 'admin/leitores',
          name: 'admin-reader-list',
          component: () => import('@/views/admin/reader/reader-list/ReaderList.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores', url: '/admin/leitores' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Leitores',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/leitores/cadastro',
          name: 'admin-reader-create',
          component: () => import('@/views/admin/reader/ReaderCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores', url: '/admin/leitores' },
              { title: 'Cadastro', active: true },
            ],
            pageTitle: 'Cadastro de Leitor',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/leitores/visualizacao/:readerId',
          name: 'admin-reader-view',
          component: () => import('@/views/admin/reader/ReaderView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores', url: '/admin/leitores' },
              { title: 'View', active: true },
            ],
            pageTitle: 'Visualizar Leitor',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/leitores/edicao/:readerId',
          name: 'admin-reader-edit',
          component: () => import('@/views/admin/reader/ReaderEdit.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores', url: '/admin/leitores' },
              { title: 'Edição', active: true },
            ],
            pageTitle: 'Editar Leitor',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Readers/>

        // Books
        {
          path: 'admin/livros',
          name: 'admin-book-list',
          component: () => import('@/views/admin/book/book-list/BookList.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros', url: '/admin/livros' },
              { title: 'Lista', active: true },
            ],
            pageTitle: 'Lista de Livros',
            rule: 'editor',
            requiresAuth: true,
          },
        },

        {
          path: 'admin/livros/cadastro',
          name: 'admin-book-create',
          component: () => import('@/views/admin/book/BookCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros', url: '/admin/livros' },
              { title: 'Cadastro', active: true },
            ],
            pageTitle: 'Cadastro de Livro',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/livros/visualizacao/:bookId',
          name: 'admin-book-view',
          component: () => import('@/views/admin/book/BookView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros', url: '/admin/livros' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Livro',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/livros/edicao/:bookId',
          name: 'admin-book-edit',
          component: () => import('@/views/admin/book/BookEdit.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros', url: '/admin/livros' },
              { title: 'Edição', active: true },
            ],
            pageTitle: 'Edição de Livro',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Books/>

        // Loans
        {
          path: 'admin/emprestimos',
          name: 'admin-loan-list',
          component: () => import('@/views/admin/loan/loan-list/LoanList.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Empréstimos', url: '/admin/emprestimos' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Empréstimos',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/emprestimos/visualizacao/:loanId',
          name: 'admin-loan-view',
          component: () => import('@/views/admin/loan/LoanView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Empréstimos', url: '/admin/emprestimos' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Empréstimo',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/emprestimos/cadastro',
          name: 'admin-loan-create',
          component: () => import('@/views/admin/loan/LoanCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Empréstimos', url: '/admin/emprestimos' },
              { title: 'Cadastrar', active: true },
            ],
            pageTitle: 'Cadastro de Empréstimo',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Loans />

        // Authors
        {
          path: 'admin/autores',
          name: 'admin-author-list',
          component: () => import('@/views/admin/author/author-list/AuthorList.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Autores', url: '/admin/autores' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Autores',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/autores/visualizacao/:authorId',
          name: 'admin-author-view',
          component: () => import('@/views/admin/author/AuthorView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Autores', url: '/admin/autores' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Autor',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Authors/>

        // Companies
        {
          path: 'admin/editoras',
          name: 'admin-company-list',
          component: () => import('@/views/admin/company/company-list/CompanyList.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Editoras', url: '/admin/editoras' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Editoras',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        {
          path: 'admin/editoras/visualizacao/:companyId',
          name: 'admin-company-view',
          component: () => import('@/views/admin/company/CompanyView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Editoras', url: '/admin/editoras' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Editora',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Companies/>

        // Courses
        {
          path: 'admin/cursos',
          name: 'admin-courses-list',
          component: () => import('@/views/admin/course/course-list/CourseList.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Cursos', url: '/admin/cursos' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Cursos',
            rule: 'editor',
            requiresAuth: true,
          },
        },
        // Courses/>
      ],
    },
    /* Authentication and Miscellaneous */
    {
      path: '',
      component: () => import('@/layouts/full-page/FullPage.vue'),
      children: [
        {
          path: '/admin/login',
          name: 'page-login',
          component: () => import('@/views/pages/Login.vue')
        },
        {
          path: '/pages/register',
          name: 'page-register',
          component: () => import('@/views/pages/Register.vue')
        },
        {
          path: '/pages/error-404',
          name: 'page-error-404',
          component: () => import('@/views/pages/Error404.vue')
        },
      ]
    },
    // Redirect to 404 page, if no match found
    {
      path: '*',
      redirect: '/pages/error-404'
    }
  ],
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
      appLoading.style.display = "none";
    }
})

router.beforeEach((to, from, next) => {
  if (!to.meta.requiresAuth) {
    // console.log(`Passou para ${to.path}`);
    next();
    return;
  }

  if (localStorage.getItem('token')) {
    // console.log(`Passou para ${to.path}`);
    next();
    return;
  }

  // console.log(`Não passou para ${to.path}`);
  next({ name: 'page-login' });
});

export default router
