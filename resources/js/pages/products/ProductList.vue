<template>

    <div class="container-fluid">
        <div>
            <div class="col-xl-12 col-lg-12" v-if="ProductList">
                <div class=" float-right">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="active-cyan-3 active-cyan-4">
                                <input id="search" type="text" class="form-control" v-model="search_input" v-on:input="productSearch()" placeholder="Ürün Ara" aria-label="Ürün Ara" aria-describedby="button-addon1">
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
            <div>
                <product-modal :item="item" v-on:onSaved="refreshData"></product-modal>
            </div>

            <table class="table table-striped table-bordered">
                <thead class="thead-success">
                <tr>
                    <th>Mal Numarası</th>
                    <th>Barkot</th>
                    <th @click="orderBy('product_name')">Ürün Adı</th>
                    <th>SKT</th>
                    <th>
                        <button id="createButton" @click="createData" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        <export-excel
                            class   = "btn btn-default"
                            :data   = "json_data"
                            worksheet = "Ürün Stok"
                            name    = "stok.xls">

                            <button id="excel" class="btn btn-info"><i class="fa fa-file-excel-o"></i></button>

                        </export-excel>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in ProductList">

                    <td>{{ item.product_num }}</td>
                    <td>{{ item.product_bar }}</td>
                    <td>{{ item.product_name }}</td>
                    <td>{{ item.product_skt }}</td>
                    <td>
                        <button @click="editData(item.id)" id="editButton" class="btn btn-primary "><i class="fa fa-pencil"></i>
                        </button>
                        <button @click="deleteData(item.id)" id="deleteButton" class="btn btn-danger "><i class="fa fa-trash "></i>
                        </button>
                    </td>
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

import ProductModal from './ProductModal';
import Paginate from 'vuejs-paginate';

export default {

    components: {ProductModal, Paginate},

    data() {

        return {
            item: {},
            errorMessage: null,
            ProductList: {},
            meta: {},
            lastPage: "",
            search_input: "",
            json_data:[{}],
            json_meta:{
                'key': 'charset',
                'value': 'utf-8'
            },
            sortKey: '',
            mode: "no-cors"


        }
    },

    created() {
        this.fetchData();
    },
    methods: {
        pageChange(page) {
            this.fetchData(page);
        },
        fetchData(page = 1) {
            this.errorMessage = null;
            this.ProductList = null;
            axios.get("product", {params: {page}})
                .then(response => {
                    this.ProductList = response.data.data;
                    this.json_data = response.data.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;

                })
        },

        createData() {
            this.item = {};
            $('#productModal').modal('show');
        },
        refreshData(item) {
            this.fetchData();
        },
        editData(id) {
            axios.get("/product/" + id)
                .then(response => {
                    this.item = response.data.[0];
                    $('#productModal').modal('show')
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        },
        deleteData(id) {
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
                    axios.delete("/product/" + id)
                        .then(response => {
                            this.fetchData();
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
        productSearch() {
            if(this.search_input.length > 1) {
                this.ProductList = {};
                axios.get('/productSearch/' + this.search_input).then(response => {
                    this.ProductList = response.data.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;
                })
            }
            if (!this.search_input.length) {
                this.fetchData(1);
            }
        },

        orderBy: function(sorKey) {
            this.sortKey = sorKey
            this.json_data[sorKey] = !this.json_data[sorKey]
            this.desc = this.json_data[sorKey]

        }

    },

}

</script>

<style scoped>
span {font-weight: bold;}
.is-active {background: turquoise;}
#excel{
    border-radius: 20px;
}
#deleteButton{
    border-radius: 20px;
}
#editButton{
    border-radius: 20px;
}
#search{
    border-radius: 20px;
}
#createButton{
    border-radius: 20px;
}
</style>
