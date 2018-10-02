<template>
    <div id="listaPessoas">

        <h1>Incluindo um Novo Cadastro</h1>
        <form id="formCadastrar"
              @submit.prevent="form">
            <label for="cNome">Nome</label><br />
            <input id="cNome"
                   v-model="nome"
                   name="nome" />
            <p class="message-error" v-if="message && message.nome"> {{ message.nome }}</p>
            <br />

            <label for="cDataNasc">Data de Nascimento</label><br />
            <input id="cDataNasc"
                   v-model="data_nascimento"
                   v-mask="'##/##/####'"
                   masked="true"
                   name="data_nascimento" />
            <p class="message-error" v-if="message && message.data_nascimento">Data de NAscimento</p>
            <br />

            <label for="cEmail">E-Mail</label><br />
            <input type="email"
                   id="cEmail"
                   v-model="email"
                   name="email" />
            <p class="message-error" v-if="message && message.email">EMAIL</p>
            <br />

            <label for="cFoto">Foto</label><br />
            <input id="cFoto"
                   ref="foto"
                   name="foto"
                   type="file"
                   @change="onImageChange"/>
            <p class="message-error" v-if="message && message.foto">{{message.foto}}</p>
            <br />
            <button type="submit" class="btPadrao">Salvar</button>
        </form>



    </div>
</template>

<script>
    export default {
        name: "Novo",
        data: {
            nome: '',
            data_nascimento: '',
            email: '',
            foto: null,

            message: null,
        },
        methods: {
            onImageChange(event) {
                this.foto = event.target.files[0];
            },
            form: function(event) {
                this.$http.post(`${this.$hostname}/api/pessoas`, {
                    nome: this.nome,
                    email: this.email,
                    data_nascimento: this.data_nascimento,
                }).then(response => {
                    let pessoa = response.data.data;
                    const fd = new FormData();
                    fd.append('foto', this.foto, this.foto.name);
                    this.$http.post(`${this.$hostname}/api/pessoas/${pessoa.id}/foto`, fd)
                    .then(respFoto => { console.log(respFoto) })
                    .catch(errFoto => { console.log(errFoto) })
                }).catch(error => {
                    console.log(error);
                });
                event.target.reset();
            }
        }
    }
</script>

<style scoped>

</style>
