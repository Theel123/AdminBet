<script setup>
import Table from '@/views/pages/tables/Table.vue';

</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Todas os Providers"> 
        <v-btn class="justify-content: left"> Criar Provider Novo</v-btn>
        <Table
            :dados="providers.data"
            :visualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaVisualizar'}"
            :atualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaAtualizar'}"
            :remover="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaRemover'}"
            :titulos="{
                id: {titulo: 'ID', tipo: 'texto'},
                name: {titulo: 'Nome', tipo: 'texto'},
                rtp: {titulo: 'RTP', tipo: 'texto'},
                show_home: {titulo: 'Exibir na Home', tipo: 'texto'},
                imagem: {titulo: 'Imagem', tipo: 'imagem'},
                created_at: {titulo: 'Criação', tipo: 'data'},
            }"
        ></Table> 
      </VCard>
    </VCol>
  </VRow>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            urlBase: 'http://localhost:8000/api/providers',
            name: "",
            rtp: "",
            show_home: "",
            image: "",
            created_at: "",
            transactionStatus: "",
            transactionMessage: [],
            providers: { data: [] },
            search: { id : '' }
        }
    },
    methods: {
        search() {

            axios.get('http://localhost:9011/api/v1/customer/'+this.search.id)
                .then(response => {
                    this.games = response.data.item
                    console.log(this.games)
                })
                .catch(errors => {
                    console.log(errors)
            })

            this.chargeList();
        },
        paginate(l) {
            this.urlBase = l.url
            this.chargeList()
        },
        chargeList() {
            axios.get(this.urlBase)
                .then(response => {
                    this.providers = response
                    console.log(this.providers)
                })
                .catch(errors => {
                    console.log(errors)
                })
        },

        save() {
            let formData = new FormData();

            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('gender', this.gender);
            formData.append('age', this.age);
            formData.append('password', this.password);

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }

            axios.post('http://localhost:9011/api/v1/customer', formData, config)
                .then(response => {
                    this.transactionStatus = "added";
                    this.transactionMessage = response.message;
                    console.log(response)
                    this.chargeList()
                }).catch(errors => {
                    this.transactionStatus = "failed"
                    this.transactionMessage = errors.response
                    console.log(errors.response.data.message)
                })
        },
        remove() {
            let confirmation = confirm("Deseja mesmo remover esse registro ?")
            let url = 'http://localhost:9011/api/v1/customer' + '/' + this.$store.state.item.id

            if(!confirmation) return false;

            axios.delete(url)
                .then(response => {
                    console.log(response)
                    this.$store.state.transaction.status= 'sucess'
                    this.$store.state.transaction.message= 'Cliente removido com sucesso'
                    this.chargeList()
                }).catch(errors => {
                    this.$store.state.transaction.status= 'failed'
            this.$store.state.transaction.message= 'Erro ao remover'
                    console.log(errors.response.data.message)
                })
        },
    },
    mounted() {
        this.chargeList()
    }
}
</script>

