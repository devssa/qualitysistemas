<template>
    <div id="listaPessoas">

        <h1>Editando o Cadastro</h1>

        <form id="formCadastrar"
              enctype="multipart/form-data"
              @submit.prevent="form">
            <label for="cNome">Nome</label><br />
            <input id="cNome" name="nome" v-model="nome" /><br />

            <label for="cDataNasc">Data de Nascimento</label><br />
            <input id="cDataNasc"
                   name="data_nascimento"
                   v-model="data_nascimento"
                   v-mask="'##/##/####'"
                   masked="true" /><br />

            <label for="cEmail">E-Mail</label><br />
            <input id="cEmail" name="email" v-model="email" /><br />

            <a :href="imagem" target="_blank">
                <img :src="imagem" alt="" height="75" width="75">
            </a>
            <br />

            <label for="cFoto">Foto</label><br />
            <input id="cFoto"
                   ref="foto"
                   name="foto"
                   type="file"
                   @change="onImageChange"/>
            <p class="message-error" v-if="message && message.errors.foto">{{ message.errors.foto[0] }}</p>
            <br />

            <button type="submit" class="btPadrao">Salvar</button>
        </form>



    </div>
</template>

<script>
    export default {
        name: 'Editar',
        data() {
            return {
                getPessoa: null,
                nome: '',
                data_nascimento: '',
                email: '',
                foto: null,

                message: null
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
                this.$http.get(`${this.$hostname}/api/pessoas/${this.$route.params.id}`)
                    .then(response => {
                        this.getPessoa = response.body.data;
                        this.nome = this.getPessoa.nome;
                        this.data_nascimento = this.getPessoa.data_nascimento;
                        this.email = this.getPessoa.email;
                        this.imagem  = (this.getPessoa.foto.indexOf("http://") == 0) || (this.getPessoa.foto.indexOf("https://") == 0)
                            ? this.getPessoa.foto
                            : `${this.$hostname}/storage/${this.getPessoa.foto}`;
                    })
            },
            onImageChange(event) {
                this.foto = event.target.files[0];
            },
            form: function(event) {
                // Editar
                this.$http.put(`${this.$hostname}/api/pessoas/${this.$route.params.id}`, {
                    nome: this.nome,
                    data_nascimento: this.data_nascimento,
                    email: this.email
                }).then(response => {
                    if (this.foto) {

                        let pessoa = response.body.data;

                        const fd = new FormData();
                        fd.append('foto', this.foto);

                        this.$http.post(`${this.$hostname}/api/pessoas/${pessoa.id}/foto`,
                            fd,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then(respFoto => { this.$router.push('/listar-cadastros'); })
                        .catch(errFoto => { this.message += errFoto.errors; });
                    } else {
                        this.$router.push('/listar-cadastros');
                    }
                }).catch(err => {
                    this.message += err.errors;
                });
            }
        },
    }
</script>
