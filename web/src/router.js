import Vue from 'vue'
import Router from 'vue-router'
import store from '@/store/store'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
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
          component: () => import('./views/Home.vue')
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
                { title: 'Usuários' },
                { title: 'Lista', active: true },
            ],
            pageTitle: 'Lista de Usuários',
            rule: 'editor'
          },
        },
        {
          path: 'admin/usuarios/visualizacao/:userId',
          name: 'admin-user-view',
          component: () => import('@/views/admin/user/UserView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Usuários ' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Usuário',
            rule: 'editor'
          },
        },
        {
          path: 'admin/usuarios/cadastro',
          name: 'admin-user-create',
          component: () => import('@/views/admin/user/UserCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Usuários' },
              { title: 'Cadastro', active: true },
            ],
            pageTitle: 'Cadastro de Usuário',
            rule: 'editor'
        },
        },
        {
          path: 'admin/usuarios/edicao/:userId',
          name: 'admin-user-edit',
          component: () => import('@/views/admin/user/user-edit/UserEdit.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Usuários' },
              { title: 'Edição', active: true },
            ],
            pageTitle: 'Edição de Usuário',
            rule: 'editor'
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
              { title: 'Leitores' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Leitores',
            rule: 'editor'
          },
        },
        {
          path: 'admin/leitores/cadastro',
          name: 'admin-reader-create',
          component: () => import('@/views/admin/reader/ReaderCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores' },
              { title: 'Cadastro', active: true },
            ],
            pageTitle: 'Cadastro de Leitor',
            rule: 'editor'
          },
        },
        {
          path: 'admin/leitores/visualizacao/:readerId',
          name: 'admin-reader-view',
          component: () => import('@/views/admin/reader/ReaderView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores' },
              { title: 'View', active: true },
            ],
            pageTitle: 'Visualizar Leitor',
            rule: 'editor'
          },
        },
        {
          path: 'admin/leitores/edicao/:readerId',
          name: 'admin-reader-edit',
          component: () => import('@/views/admin/reader/ReaderEdit.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Leitores' },
              { title: 'Edição', active: true },
            ],
            pageTitle: 'Editar Leitor',
            rule: 'editor'
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
              { title: 'Livros' },
              { title: 'Lista', active: true },
            ],
            pageTitle: 'Lista de Livros',
            rule: 'editor'
          },
        },

        {
          path: 'admin/livros/cadastro',
          name: 'admin-book-create',
          component: () => import('@/views/admin/book/BookCreate.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros' },
              { title: 'Cadastro', active: true },
            ],
            pageTitle: 'Cadastro de Livro',
            rule: 'editor'
          },
        },
        {
          path: 'admin/livros/visualizacao/:bookId',
          name: 'admin-book-view',
          component: () => import('@/views/admin/book/BookView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros ' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Livro',
            rule: 'editor'
          },
        },
        {
          path: 'admin/livros/edicao/:bookId',
          name: 'admin-book-edit',
          component: () => import('@/views/admin/book/BookEdit.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Livros' },
              { title: 'Edição', active: true },
            ],
            pageTitle: 'Edição de Livro',
            rule: 'editor'
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
              { title: 'Empréstimos' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Empréstimos',
            rule: 'editor'
          },
        },
        {
          path: 'admin/emprestimos/visualizacao/:loanId',
          name: 'admin-loan-view',
          component: () => import('@/views/admin/loan/LoanView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Empréstimos' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Empréstimo',
            rule: 'editor'
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
              { title: 'Autores' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Autores',
            rule: 'editor'
          },
        },
        {
          path: 'admin/autores/visualizacao/:authorId',
          name: 'admin-author-view',
          component: () => import('@/views/admin/author/AuthorView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Autores ' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Autor',
            rule: 'editor'
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
              { title: 'Editoras' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Editoras',
            rule: 'editor'
          },
        },
        {
          path: 'admin/editoras/visualizacao/:companyId',
          name: 'admin-company-view',
          component: () => import('@/views/admin/company/CompanyView.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Editoras ' },
              { title: 'Visualização', active: true },
            ],
            pageTitle: 'Visualização de Editora',
            rule: 'editor'
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
              { title: 'Cursos' },
              { title: 'Listar', active: true },
            ],
            pageTitle: 'Lista de Cursos',
            rule: 'editor'
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
          path: '/pages/login',
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
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
      appLoading.style.display = "none";
    }
})

router.beforeEach(async (to, from, next) => {

  if((to.name !== 'page-login' && to.name !== 'page-error-404' && to.name !== 'page-register' ) && !store.getters['auth/hasToken']) {
    try {
      await store.dispatch('auth/checkToken')
      next({ name: to.name })
    } catch (err) {
      // Saving the route
      // await store.dispatch('saveRouteThatWillBeAccessed', to.name)
      console.log(err)
      next({ name: 'page-login' })
    }
  } else {
    if(to.name === 'page-login' && store.getters['auth/hasToken']) {
      next({ name: 'home' })
    } else {
      next()
    }
  }
})

export default router
