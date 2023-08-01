<template>
    <div class="container-fluid">
        <div>
            <div class="col-xl-12 col-lg-12" v-if="defList">
                <div class=" float-right">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="active-cyan-3 active-cyan-4">
                                <input id="searchInput" type="text" class="form-control" v-model="search_input" v-on:input="productDefSearch()" placeholder="Ürün Ara" aria-label="Ürün Ara" aria-describedby="button-addon1">
                            </div>
                        </div>

                    </form>
                    <hr>
                </div>
            </div>

       <div><product-def-modal :item="item" v-on:onSaved="refreshData" ></product-def-modal></div>

        <table class="table table-striped table-bordered" >
            <thead class="thead-success">
            <tr>

                <th>Mal No</th>
                <th>Barkot</th>
                <th>Ürün Adı</th>

                <th>
                    <button @click="createDefData" class="btn btn-success" id="buttonCreate"><i class="fa fa-plus"></i></button>
                </th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="item in defList">

                <td>{{item.product_num}}</td>
                <td>{{item.product_bar}}</td>
                <td>{{item.product_name}}</td>

                <td>
                    <button @click="editDefData(item.id)" class="btn btn-primary" id="buttonEdit"><i class="fa fa-pencil"></i></button>
                    <button @click="deleteDefData(item.id)" class="btn btn-danger" id="buttonDelete"><i class="fa fa-trash "></i></button>

                </td>
            </tr>
            </tbody>
        </table>
        <!--<pagination :meta="meta" v-on:pageChange="fetchData"/> -->
        <div class="row">
            <nav aria-label="Page navigation example">
                <paginate
                    v-if="lastPage"
                    :page-count="lastPage"
                    :click-handler="pageChange"
                    :prev-text="'GERİ'"
                    :next-text="'İLERİ'"
                    :prev-class="'btn btn-ligt'"
                    :next-class="'btn btn-ligt'"
                    :last-button-text="'text-black'"
                    :page-link-class="'text-black'"
                    :container-class="'pagination'"
                    :page-class="'btn btn-light'">
                </paginate>
            </nav>
        </div>
    </div>
        </div>
</template>

<script>
import productDefModal from "./productDefModal";
import paginate from "vuejs-paginate";
import 'vue-search-select/dist/VueSearchSelect.css';
export default {
    components:{paginate,productDefModal},
data(){
    return{
        item:{},
        defList:{},
        meta:{},
        lastPage:"",
        search_input:"",
        mode: "no-cors"



    }
},
  created(){
    this.definitionList()
  },
    methods:{
        pageChange(page){
          this.definitionList(page)
        },
        fetchData(page = 1) {
            axios.get('productDefinition', {params: {page}})
                .then(response => {
                    this.defList = response.data.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;
                    this.total = this.meta.total;
                });
        },
        definitionList(page = 1) {
            this.errorMessage = null;
            this.defList = null;
            axios.get("productDefinition", {params: {page}})
                .then(response => {
                    this.defList = response.data.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        },
        refreshData(){
        this.definitionList();
        },
        createDefData(){
            this.item = {}
            $('#productDefModal').modal('show');
        },
        editDefData(id) {
            axios.get("/productDefinition/" + id)
                .then(response => {
                    this.item = response.data;
                    $('#productDefModal').modal('show')
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        },
        deleteDefData(id) {
            swal.fire({
                text: 'Silmek istediğinizden emin misiniz?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.value) {
                    axios.delete("/productDefinition/" + id)
                        .then(response => {
                            this.definitionList();
                            toastr.warning('Kayıt Silindi', 'Ürün')
                        })
                        .catch(error => {
                            if (error.response != null)
                                this.errorMessage = error.response.data.message;
                            else
                                this.errorMessage = error.message;
                        });
                }
            })
        },
        productDefSearch(){
            if(this.search_input.length > 1){
                this.procList = {};
                axios.get('/defSearch/' + this.search_input).then(response => {
                    this.defList = response.data.data;
                    this.meta = response.data
                    this.lastPage = this.meta.last_page;

                })
            }
            if (!this.search_input.length){
                this.fetchData(1);
            }
        }
    }
}
</script>

<style scoped>
#buttonEdit{
    border-radius: 20px;
}
#buttonDelete{
    border-radius: 20px;
}
#buttonCreate{
    border-radius: 20px;
}
#searchInput{
    border-radius: 20px;
}
</style>
