<template>
  <div id="app">
      <div id="conteudoGeral">
          <div id="topoGeral">
              <div id="logoTopo" onclick="location.href='index.php'" style="cursor:pointer;"></div>
              <div id="dirTopo"></div>
          </div>
          <div id="baixoGeral">
              <div id="menuEsq">
                  <div id="titMenu">Menu de Opções</div>
                  <router-link to="/">Início</router-link>
                  <router-link to="/listar-cadastros">Listar Cadastros</router-link>
                  <router-link to="/incluir-novo">Incluir Novo</router-link>
              </div>

              <div id="conteudoDir">
                  <router-view/>
              </div> <!-- FIM CONTEUDO DIR -->

          </div>

      </div>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'app',
  components: {
    HelloWorld
  }
}
</script>

<style src="./assets/css/principal.css"></style>
<style>
</style>
