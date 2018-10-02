<template>
    <div id="listaPessoas">
        <h1>Cadastros</h1>

        <a href="javascript:;" class="btPadraoExcluir">Excluir</a>

        <table id="tLista" class="striped" cellpadding="0" cellspacing="0" border="0">
            <thead>
            <tr>
                <th width="5%"><input type="checkbox" /></th>
                <th width="10%">ID</th>
                <th class="tL">Nome</th>
                <th width="20%">Data de Nascimento</th>
                <th width="10%">Dep</th>
                <th width="8%">Status</th>
            </tr>
            </thead>

            <tbody>
                <template v-for="item in listar">
                    <tr>
                        <td align="center" style="border-left:0;">
                            <input type="checkbox"/>
                        </td>
                        <td align="center">{{ item.id }}</td>
                        <td><router-link :to="{ name: 'editar', params: { id: item.id }}" class="linkUser">{{ item.nome }}</router-link></td>
                        <td align="center">{{ item.data_nascimento }}</td>
                        <td align="center"><router-link :to="{ name: 'dependente', params: { id: item.id }}" class="btAdicionar"></router-link></td>
                        <td align="center"><a href="javascript: void(0);" :class="[ item.is_active ? 'btVerde' : 'btCinza']"></a></td>
                    </tr>
                </template>
            </tbody>

        </table>
        <PaginationComponent v-if="pagination.last_page > 1" :pagination="pagination" :offset="10" @paginate="fetchLista()"></PaginationComponent>
    </div>


</template>

<script>
    import PaginationComponent from '../../components/PaginationComponent';
    export default {
        name: "Listar",
        components: {
            PaginationComponent,
        },
        data() {
            return {
                listar: [],
                pagination: {
                    'current_page': 1
                },
            }
        },
        methods: {
            fetchLista() {
                this.$http.get(`${this.$hostname}/api/pessoas?page=${this.pagination.current_page}`)
                    .then((response) => {
                        this.listar = response.body.data;
                        this.pagination = response.body.meta;
                    }).catch(err => {
                        console.log(err);
                    })
            }
        },
        mounted() {
            this.fetchLista();
        },
    }
</script>
