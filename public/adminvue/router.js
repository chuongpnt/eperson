import Vue from 'vue';
import Router from 'vue-router';
import store from './store';

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            redirect: '/dashboard',
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: require('./dashboard/Home'),
        },
        {
            path: '/users',
            component: require('./users/Users'),
            children: [
                {
                    path:'/',
                    name:'users.list',
                    component: require('./users/components/UserList')
                },
                {
                    path:'create',
                    name:'users.create',
                    component: require('./users/components/UserAdd')
                },
                {
                    path:'edit/:id',
                    name:'users.edit',
                    component: require('./users/components/UserEdit'),
                    props: (route) => ({propUserId: route.params.id}),
                },
                {
                    path:'groups',
                    name:'users.groups.list',
                    component: require('./users/components/GroupList')
                },
                {
                    path:'groups/create',
                    name:'users.groups.create',
                    component: require('./users/components/GroupAdd')
                },
                {
                    path:'groups/edit/:id',
                    name:'users.groups.edit',
                    component: require('./users/components/GroupEdit'),
                    props: (route) => ({propGroupId: route.params.id}),
                },
                {
                    path:'permissions',
                    name:'users.permissions.list',
                    component: require('./users/components/PermissionList')
                },
                {
                    path:'permissions/create',
                    name:'users.permissions.create',
                    component: require('./users/components/PermissionAdd')
                },
                {
                    path:'permissions/edit/:id',
                    name:'users.permissions.edit',
                    component: require('./users/components/PermissionEdit'),
                    props: (route) => ({propPermissionId: route.params.id}),
                },
            ]
        },
        {
            name: 'files',
            path: '/files',
            component: require('./files/Files'),
        },
        {
            path: '/posts',
            component: require('./posts/Posts'),
			children: [
                {
                    path:'/',
                    name:'posts.list',
                    component: require('./posts/components/PostList')
                },
                {
                    path:'create',
                    name:'posts.create',
                    component: require('./posts/components/PostAdd')
                },
                {
                    path:'edit/:id',
                    name:'posts.edit',
                    component: require('./posts/components/PostEdit'),
                    props: (route) => ({propPostId: route.params.id}),
                },
                {
                    path:'categories',
                    name:'posts.categories.list',
                    component: require('./posts/components/CategoryList')
                },
                {
                    path:'categories/create',
                    name:'posts.categories.create',
                    component: require('./posts/components/CategoryAdd')
                },
                {
                    path:'categories/edit/:id',
                    name:'posts.categories.edit',
                    component: require('./posts/components/CategoryEdit'),
                    props: (route) => ({propCategoryId: route.params.id}),
                },
            ]
        },
        {
            path: '/pages',
            component: require('./pages/Pages'),
            children: [
                {
                    path:'/',
                    name:'pages.list',
                    component: require('./pages/components/PageList')
                },
                {
                    path:'create',
                    name:'pages.create',
                    component: require('./pages/components/PageAdd')
                },
                {
                    path:'edit/:id',
                    name:'pages.edit',
                    component: require('./pages/components/PageEdit'),
                    props: (route) => ({propPageId: route.params.id}),
                },
            ]
        },

        {
            name: 'settings',
            path: '/settings',
            component: require('./settings/Settings'),
        }
    ],
});

router.beforeEach((to, from, next) => {
    store.commit('showLoader');
    next();
});

router.afterEach((to, from) => {
    setTimeout(()=>{
        store.commit('hideLoader');
    },1000);
});

export default router;