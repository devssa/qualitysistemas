import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/home/Home'
import Listar from './views/listar/Listar'
import Novo from './views/novo/Novo'
import Editar from './views/editar/Editar'
import Dependente from './views/dependente/Dependente'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            meta: {
                title: 'Cadastro de Pessoas'
            },
            component: Home
        },
        {
            path: '/listar-cadastros',
            name: 'listar',
            component: Listar
        },
        {
            path: '/incluir-novo',
            name: 'novo',
            component: Novo
        },
        {
            path: '/editar/:id',
            name: 'editar',
            component: Editar
        },
        {
            path: '/dependente/:id',
            name: 'dependente',
            component: Dependente
        }
    ]
});
