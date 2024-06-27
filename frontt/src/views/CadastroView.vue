<template>
  <div class="container">
    <h3 class="text-end"><b> {{ currentDateTime }} </b></h3>

    <FormularioComponent msg="Cadastrar Currículo"></FormularioComponent>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
import FormularioComponent from '@/components/FormularioComponent.vue'

export default {
  name: 'CadastroView',
  components: {
    FormularioComponent,
  }, 
  data() {
    return {
      currentDateTime: '',
     
    };
  },
  created() {
    this.updateDateTime();
    setInterval(this.updateDateTime, 1000);
  },
  methods: {
    updateDateTime() {
      const now = new Date();
      this.currentDateTime = now.toLocaleString();

    }
  }
}
</script>