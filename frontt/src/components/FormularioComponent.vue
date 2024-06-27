<template>
  <div class="form">
    <h1>{{ msg }}</h1>
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <div class="row text-start">
        <div class="col-md-3">
          <label for="inputNome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="inputNome" required v-model="dados.nome">
        </div>
        <div class="col-md-3">
          <label for="inputEmail" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail" required placeholder="nome@dominio.com" v-model="dados.email">
        </div>
        <div class="col-md-3">
          <label for="inputTelefone" class="form-label">Telefone</label>
          <input type="text" class="form-control" id="inputTelefone" placeholder="(00) 00000-0000" v-mask="['(##) ####-####', '(##) #####-####']" required v-model="dados.telefone">
        </div>
        <div class="col-md-3">
          <label for="inputCargoDesejado" class="form-label">Cargo Desejado</label>
          <input type="text" class="form-control" id="inputCargoDesejado" required v-model="dados.cargoDesejado">
        </div>
        <div class="col-md-3">
          <label for="selectEscolaridade" class="form-label">Escolaridade</label>
          <select class="form-select" aria-label="Default select example" required id="selectEscolaridade" v-model="dados.escolaridade">
            <option value="Fundamental">Ensino Fundamental</option>
            <option value="Médio">Ensino Médio</option>
            <option value="Superior">Ensino Superior</option>
            <option value="Pós Graduação">Pós Graduação</option>
            <option value="Mestrado">Mestrado</option>
            <option value="Doutorado">Doutorado</option>
          </select>        
        </div>
        <div class="col-md-3">
          <label for="inputDate" class="form-label">Data</label>
          <input type="date" class="form-control" id="inputDate" required v-model="dados.dataEnvio">
        </div>
        <div class="col-md-3">
          <label for="inputDate" class="form-label">Hora</label>
          <input type="time" class="form-control" id="inputDate" required v-model="dados.horaEnvio">
        </div>
        <div class="col-md-3">
          <label for="inputFileCurriculo" class="form-label">Enviar Currículo</label>
          <input type="file" class="form-control" id="inputFileCurriculo" required @change="uploadArquivo">
          <p v-if="notifications.fileError" style="color: red;">{{ notifications.fileError }}</p>

        </div>
        <div class="col-md-12">
          <label for="inputObservacoes" class="form-label">Observações</label>
          <textarea class="form-control" id="inputObservacoes" rows="3" v-model="dados.observacoes"></textarea>
        </div>
        <div class="col-md-12 mt-2">
          <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import http from '@/services/axios.js';
import {mask} from 'vue-the-mask';
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
  name: 'FormularioComponent',
  props: {
    msg: String
  },
  directives: {
    mask
  },
  data(){
    return {
      dados: {
          'nome' : '',
          'email' : '',
          'telefone' : '',
          'cargoDesejado' : '',
          'escolaridade' : '',
          'dataEnvio' : '',
          'horaEnvio' : '',
          'fileCurriculo' : '',
          'observacoes' : ''
        },
        notifications:{
          fileError: ''
        },
        ipCliente: null,

      }
  },
  methods: {
    notify(msg, type) {
      toast(msg, {
        "type": type,
        autoClose: 1000,
      }); 
    },
    uploadArquivo(event){
      const arquivoSelecionado = event.target.files[0];
      const extensoesPermitidas = ['.doc', '.docx', '.pdf'];
      const tamanhoMaximo = 1 * 1024 * 1024; // 1MB
      const inputFileCurriculo = document.getElementById('inputFileCurriculo');

      if (!arquivoSelecionado) {
        this.notifications.fileError = 'Por favor, selecione um arquivo.';
        return;
      }

      const tamanhoArquivo = arquivoSelecionado.size;
   
      const extensaoArquivo = arquivoSelecionado.name.split('.').pop();
      if (!extensoesPermitidas.includes(`.${extensaoArquivo}`)) { // Verifica se a extensao do arquivo esta na lista de extensoes permitidas
        this.arquivoSelecionado = null;
        this.notifications.fileError = 'O arquivo deve ser do tipo .doc, .docx ou .pdf.';

        if (inputFileCurriculo) {
          inputFileCurriculo.value = '';
        }
        return;
      }

      if (tamanhoArquivo > tamanhoMaximo) {
        this.notifications.fileError = 'O tamanho máximo do arquivo é de 1MB.';
        if (inputFileCurriculo) {
          inputFileCurriculo.value = '';
        }
        return;
      }

      this.dados.fileCurriculo = arquivoSelecionado;
      this.notifications.fileError = '';
    },

    async submitForm() {
      console.log(this.dados.fileCurriculo)
      try{
        const formData = new FormData();

        formData.append('nome', this.dados.nome);
        formData.append('email', this.dados.email);
        formData.append('telefone', this.dados.telefone);
        formData.append('cargoDesejado', this.dados.cargoDesejado);
        formData.append('escolaridade', this.dados.escolaridade);
        formData.append('dataEnvio', this.dados.dataEnvio);
        formData.append('horaEnvio', this.dados.horaEnvio);
        formData.append('observacoes', this.dados.observacoes);
        formData.append('fileCurriculo', this.dados.fileCurriculo);
        formData.append('ipCliente', this.ipCliente);

        const dadosRetornados = await http.post('/cadastrar_curriculo', formData,{
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }); 
        console.log(dadosRetornados)
        this.notify('Currículo enviado com sucesso!', 'sucess');
      } catch(error){
        this.notify('Currículo enviado com sucesso!', 'error');
        console.log(error?.response?.data);
      }
    }
  },
  mounted() {

    axios.get('https://api.ipify.org?format=json')
      .then(response => {
        this.ipCliente = response.data.ip;
      })
      .catch(error => {
        console.error('Erro ao obter o endereço IP do cliente:', error);
      });
  }
}
</script>

<style scoped>
</style>
