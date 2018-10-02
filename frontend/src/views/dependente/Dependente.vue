<template>
    <div id="listaPessoas">
        <h1>Dependentes</h1>

        <div id="infoDep">

            <div id="fotoCadastro">
                <img :src="foto" width="77" height="77" />
            </div>

            <table id="tListaCad" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="tituloTab">Nome</td>
                    <td>{{ nome }}</td>
                </tr>
                <tr bgcolor="#cddeeb">
                    <td class="tituloTab">Data de Nascimento</td>
                    <td>{{ data_nascimento }}</td>
                </tr>
                <tr>
                    <td class="tituloTab">Email</td>
                    <td>{{ email }}</td>
                </tr>
            </table>

            <form id="frmAdicionaDep" @submit.prevent="formSubmit">

                <input type="hidden" name="pessoa_id" v-model="dep.pessoa_id">

                <div class="agrupa mB mR">
                    <label for="cNomeDep">Nome</label><br />
                    <input type="text"
                           name="nome"
                           v-model="dep.nome"
                           id="cNomeDep" />
                </div>
                <div class="agrupa">
                    <label for="cDataNasc">Data de Nascimento</label><br />
                    <input type="text"
                           name="data_nascimento"
                           v-model="dep.data_nascimento"
                           v-mask="'##/##/####'"
                           masked="true"
                           id="cDataNasc" />
                </div>

                <button type="submit"  class="btPadrao">Adicionar</button>

            </form>


            <table id="tLista" class="striped" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th width="60%" class="tL">Nome do Dependente</th>
                        <th width="33%">Data de Nascimento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dependentes">
                        <td>{{ item.nome }}</td>
                        <td align="center">{{ item.data_nascimento}}</td>
                        <td align="center">
                            <button type="button" @click="removerDependentes(item, index)" class="btRemover"></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Dependente",
        data() {
            return {
                nome: '',
                data_nascimento: '',
                email: '',
                foto: null,
                dependentes: {},

                dep: {
                    pessoa_id: null,
                    nome: null,
                    data_nascimento: null
                }
            }
        },
        created() {
            this.fetchPessoa();
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchPessoa() {
                // Find Cadastro de Pessoas
                this.$http.get(`${this.$hostname}/api/pessoas/${this.$route.params.id}`)
                    .then(response => {
                        this.getPessoa = response.body.data;
                        this.nome = this.getPessoa.nome;
                        this.data_nascimento = this.getPessoa.data_nascimento;
                        this.email = this.getPessoa.email;
                        this.foto  = (this.getPessoa.foto.indexOf("http://") == 0) || (this.getPessoa.foto.indexOf("https://") == 0)
                            ? this.getPessoa.foto
                            : `${this.$hostname}/storage/${this.getPessoa.foto}`;
                        this.dep.id = this.getPessoa.id;
                        // Loading Dependentes
                        this.$http.get(`${this.$hostname}/api/dependente/${this.$route.params.id}`)
                            .then(dep => {
                                this.dependentes = dep.body.data;
                            })
                            .catch(err => { console.log(err) });

                    })
            },
            removerDependentes: function (item, index) {
                console.log(index);
                this.$http.delete(`${this.$hostname}/api/dependente/${item.id}`)
                    .then(response => {
                        this.dependentes.splice(index, 1);
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            formSubmit: function(event) {

                this.$http.post(`${this.$hostname}/api/dependente`, this.dep)
                    .then(response => {
                        console.log(response.body.data);
                        this.dependentes.push(response.body.data)
                    })
                    .catch(err => { console.log(err) });
                event.target.reset();
            }
        }
    }
</script>

<style scoped>

</style>
