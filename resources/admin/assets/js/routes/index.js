import Vue from 'vue'
import VueRouter from 'vue-router'

import ChangePassword from '../components/ChangePassword.vue'
import PermissionsIndex from '../components/cruds/Permissions/Index.vue'
import PermissionsCreate from '../components/cruds/Permissions/Create.vue'
import PermissionsShow from '../components/cruds/Permissions/Show.vue'
import PermissionsEdit from '../components/cruds/Permissions/Edit.vue'
import RolesIndex from '../components/cruds/Roles/Index.vue'
import RolesCreate from '../components/cruds/Roles/Create.vue'
import RolesShow from '../components/cruds/Roles/Show.vue'
import RolesEdit from '../components/cruds/Roles/Edit.vue'
import UsersIndex from '../components/cruds/Users/Index.vue'
import UsersCreate from '../components/cruds/Users/Create.vue'
import UsersShow from '../components/cruds/Users/Show.vue'
import UsersEdit from '../components/cruds/Users/Edit.vue'
import UserActionsIndex from '../components/cruds/UserActions/Index'
import PostsIndex from '../components/cruds/Posts/Index.vue'
import PostsCreate from '../components/cruds/Posts/Create.vue'
import PostsShow from '../components/cruds/Posts/Show.vue'
import PostsEdit from '../components/cruds/Posts/Edit.vue'
import CategoriesIndex from '../components/cruds/Categories/Index.vue'
import CategoriesCreate from '../components/cruds/Categories/Create.vue'
import CategoriesShow from '../components/cruds/Categories/Show.vue'
import CategoriesEdit from '../components/cruds/Categories/Edit.vue'
import TagsIndex from '../components/cruds/Tags/Index.vue'
import TagsCreate from '../components/cruds/Tags/Create.vue'
import TagsShow from '../components/cruds/Tags/Show.vue'
import TagsEdit from '../components/cruds/Tags/Edit.vue'
import ArticlesIndex from '../components/cruds/Articles/Index.vue'
import ArticlesCreate from '../components/cruds/Articles/Create.vue'
import ArticlesShow from '../components/cruds/Articles/Show.vue'
import ArticlesEdit from '../components/cruds/Articles/Edit.vue'
import PagesIndex from '../components/cruds/Pages/Index.vue'
import PagesCreate from '../components/cruds/Pages/Create.vue'
import PagesShow from '../components/cruds/Pages/Show.vue'
import PagesEdit from '../components/cruds/Pages/Edit.vue'

import ContactsUsIndex from '../components/cruds/ContactsUs/Index.vue'
import RegistersIndex from '../components/cruds/Registers/Index.vue'

// import Dashboard from '../components/Dashboard'

Vue.use(VueRouter)

const routes = [
    { path: '/change-password', component: ChangePassword, name: 'auth.change_password' },
    { path: '/permissions', component: PermissionsIndex, name: 'permissions.index' },
    { path: '/permissions/create', component: PermissionsCreate, name: 'permissions.create' },
    { path: '/permissions/:id', component: PermissionsShow, name: 'permissions.show' },
    { path: '/permissions/:id/edit', component: PermissionsEdit, name: 'permissions.edit' },
    { path: '/roles', component: RolesIndex, name: 'roles.index' },
    { path: '/roles/create', component: RolesCreate, name: 'roles.create' },
    { path: '/roles/:id', component: RolesShow, name: 'roles.show' },
    { path: '/roles/:id/edit', component: RolesEdit, name: 'roles.edit' },
    { path: '/users', component: UsersIndex, name: 'users.index' },
    { path: '/users/create', component: UsersCreate, name: 'users.create' },
    { path: '/users/:id', component: UsersShow, name: 'users.show' },
    { path: '/users/:id/edit', component: UsersEdit, name: 'users.edit' },
	{ path: '/user-actions', component: UserActionsIndex, name: 'user_actions.index' },
    { path: '/posts', component: PostsIndex, name: 'posts.index' },
    { path: '/posts/create', component: PostsCreate, name: 'posts.create' },
    { path: '/posts/:id', component: PostsShow, name: 'posts.show' },
    { path: '/posts/:id/edit', component: PostsEdit, name: 'posts.edit' },
    { path: '/categories', component: CategoriesIndex, name: 'categories.index' },
    { path: '/categories/create', component: CategoriesCreate, name: 'categories.create' },
    { path: '/categories/:id', component: CategoriesShow, name: 'categories.show' },
    { path: '/categories/:id/edit', component: CategoriesEdit, name: 'categories.edit' },
    { path: '/tags', component: TagsIndex, name: 'tags.index' },
    { path: '/tags/create', component: TagsCreate, name: 'tags.create' },
    { path: '/tags/:id', component: TagsShow, name: 'tags.show' },
    { path: '/tags/:id/edit', component: TagsEdit, name: 'tags.edit' },
    { path: '/articles', component: ArticlesIndex, name: 'articles.index' },
    { path: '/articles/create', component: ArticlesCreate, name: 'articles.create' },
    { path: '/articles/:id', component: ArticlesShow, name: 'articles.show' },
    { path: '/articles/:id/edit', component: ArticlesEdit, name: 'articles.edit' },
	{ path: '/pages', component: PagesIndex, name: 'pages.index' },
    { path: '/pages/create', component: PagesCreate, name: 'pages.create' },
    { path: '/pages/:id', component: PagesShow, name: 'pages.show' },
    { path: '/pages/:id/edit', component: PagesEdit, name: 'pages.edit' },


    { path: '/contactsus', component: ContactsUsIndex, name: 'contactsus.index' },
    { path: '/registers', component: RegistersIndex, name: 'registers.index' },
	// { path: '/home', component: Dashboard, name: 'dashboard' },
]

export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes
})
