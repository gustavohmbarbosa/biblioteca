/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior () {
        return { x: 0, y: 0 }
    },
    routes: [

        {
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
        // =============================================================================
        // DASHBOARD
        // =============================================================================
              {
                path: '/',
                name: 'home',
                component: () => import('./views/Home.vue')
              },
        // =============================================================================
        // MAIN
        // =============================================================================
              // READERS
              {
                path: '/leitores/cadastro',
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
                path: '/leitores',
                name: 'admin-reader-list',
                component: () => import('@/views/admin/reader/reader-list/ReaderList.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
                        { title: 'Leitores' },
                        { title: 'Lista', active: true },
                    ],
                    pageTitle: 'Leitores',
                    rule: 'editor'
                },
              },
              {    
                path: '/leitores/visualizacao/:readerId',
                name: 'admin-reader-view',
                component: () => import('@/views/admin/reader/ReaderView.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
                        { title: 'Leitores ' },
                        { title: 'Visualização', active: true },
                    ],
                    pageTitle: 'Visualização de Leitor',
                    rule: 'editor'
                },
              },
              {
                path: '/leitores/edicao/:readerId',
                name: 'admin-reader-edit',
                component: () => import('@/views/admin/reader/reader-edit/ReaderEdit.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
                        { title: 'Leitores' },
                        { title: 'Edição', active: true },
                    ],
                    pageTitle: 'Edição de Leitor',
                    rule: 'editor'
                },
              },
              
              // BOOKS
              {
                path: '/livros/cadastro',
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
                path: '/livros',
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
                path: '/livros/visualizacao/:bookId',
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
                path: '/livros/edicao/:bookId',
                name: 'admin-book-edit',
                component: () => import('@/views/admin/book/book-edit/BookEdit.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
<<<<<<< HEAD
                        { title: 'Leitores' },
                        { title: 'Listar', active: true },
=======
                        { title: 'Livros' },
                        { title: 'Edição', active: true },
>>>>>>> 71ff38dc31231c399c234d9356b43658829f2677
                    ],
                    pageTitle: 'Edição de Livro',
                    rule: 'editor'
                },
              },
        // =============================================================================
        // OTHERS
        // =============================================================================
              // USERS
              {
<<<<<<< HEAD
                path: '/leitores/visualizacao/:readerId',
                name: 'admin-reader-view',
                component: () => import('@/views/admin/reader/ReaderView.vue'),
=======
                path: '/usuarios/cadastro',
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
                path: '/usuarios',
                name: 'admin-user-list',
                component: () => import('@/views/admin/user/user-list/UserList.vue'),
>>>>>>> 71ff38dc31231c399c234d9356b43658829f2677
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
                path: '/usuarios/visualizacao/:userId',
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
<<<<<<< HEAD
                path: '/leitores/edicao/:readerId',
                name: 'admin-reader-edit',
                component: () => import('@/views/admin/reader/ReaderEdit.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
                        { title: 'Leitores' },
=======
                path: '/usuarios/edicao/:userId',
                name: 'admin-user-edit',
                component: () => import('@/views/admin/user/user-edit/UserEdit.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
                        { title: 'Usuários' },
>>>>>>> 71ff38dc31231c399c234d9356b43658829f2677
                        { title: 'Edição', active: true },
                    ],
                    pageTitle: 'Edição de Usuário',
                    rule: 'editor'
                },
              },
            ],
        },
    // =============================================================================
    // FULL PAGE
    // =============================================================================
        /* Authentication and Miscellaneous */
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
              {
                path: '/pages/login',
                name: 'admin-login',
                component: () => import('@/views/pages/Login.vue')
              },
              {
                path: '/pages/register',
                name: 'admin-register',
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

export default router
