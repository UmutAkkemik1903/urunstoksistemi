<template>
    <div class="container-fluid">
        <h2>Tarihi Geçen Ürünler</h2>
        <hr>
        <div>


        <table class="table table-striped table-bordered" >
            <thead class="thead-success">
            <tr>
                <th>Mal No</th>
                <th>Barkot</th>
                <th>Ürün Adı</th>
                <th>SKT</th>


            </tr>
            </thead>
            <tbody>
            <tr v-for="item in sktList">

                <td>{{ item.product_num }}</td>
                <td>{{ item.product_bar }}</td>
                <td>{{ item.product_name }}</td>
                <td>{{ item.product_skt }}</td>

            </tr>
            </tbody>
        </table>

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
import Paginate from 'vuejs-paginate';
export default {
    components:{Paginate},
    name: "DashBoard",

    data(){

        return{
            item:{},
            errorMessage:null,
            sktList: null,
            meta:{},
            lastPage:"",
            mode: "no-cors"

        }
    },

    created(){
        this.fetchData();
    },
    methods:{
        pageChange(page){
            this.fetchData(page);
        },
        fetchData(page = 1) {
            this.errorMessage = null;
            this.sktList = null;
            axios.get("/", {params: {page}})
                .then(response => {
                    this.sktList = response.data.data;
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
    }
}
</script>

<style scoped>

</style>
