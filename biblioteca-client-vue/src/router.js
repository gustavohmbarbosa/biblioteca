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
        // Theme Routes
        // =============================================================================
              {
                path: '/',
                name: 'home',
                component: () => import('./views/Home.vue')
              },
              {
                path: '/page2',
                name: 'page-2',
                component: () => import('./views/Page2.vue')
              },


              /* Administrative */

              // Users
              {
                path: '/usuarios',
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
                path: '/usuarios/edicao/:userId',
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

              // Readers
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
                path: '/apps/reader/reader-view/:readerId',
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
                path: '/leitores/cadastro',
                name: 'admin-reader-create',
                component: () => import('@/views/admin/reader/ReaderCreate.vue')
              },
              {
                path: '/apps/reader/reader-edit/:readerId',
                name: 'admin-reader-edit',
                component: () => import('@/views/admin/reader/reader-edit/ReaderEdit.vue'),
                meta: {
                    breadcrumb: [
                        { title: 'Home', url: '/' },
                        { title: 'Leitores' },
                        { title: 'Edit', active: true },
                    ],
                    pageTitle: 'Editar Leitor',
                    rule: 'editor'
                },
              },
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

export default router
