import Vue from 'vue'
import Vuex from 'vuex'
import Alert from './modules/alert'
import ChangePassword from './modules/change_password'
import Rules from './modules/rules'
import PermissionsIndex from './modules/Permissions'
import PermissionsSingle from './modules/Permissions/single'
import RolesIndex from './modules/Roles'
import RolesSingle from './modules/Roles/single'
import UsersIndex from './modules/Users'
import UsersSingle from './modules/Users/single'
import UserActionsIndex from './modules/UserActions'
import PostsIndex from './modules/Posts'
import PostsSingle from './modules/Posts/single'
import CategoriesIndex from './modules/Categories'
import CategoriesSingle from './modules/Categories/single'
import TagsIndex from './modules/Tags'
import TagsSingle from './modules/Tags/single'
import ArticlesIndex from './modules/Articles'
import ArticlesSingle from './modules/Articles/single'
import PagesIndex from './modules/Pages'
import PagesSingle from './modules/Pages/single'


import ContactsUsIndex from './modules/ContactsUs'
import RegistersIndex from './modules/Registers'



Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        ChangePassword,
        Rules,
        PermissionsIndex,
        PermissionsSingle,
        RolesIndex,
        RolesSingle,
        UsersIndex,
        UsersSingle,
		UserActionsIndex,
        PostsIndex,
        PostsSingle,
        CategoriesIndex,
        CategoriesSingle,
        TagsIndex,
        TagsSingle,
        ArticlesIndex,
        ArticlesSingle,
        PagesIndex,
        PagesSingle,
        ContactsUsIndex,

        RegistersIndex,



    },
    strict: debug,
})
