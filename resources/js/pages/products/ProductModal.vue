<template>

    <div>

        <div>

            <div class="modal fade" tabindex="-1" role="dialog" id="productModal">
                <div class="modal-dialog"  role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" v-text="item.id>0?'Ürün Düzenle':'Yeni Ürün'"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form  @submit.prevent="true">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Mal Numarası</label>
                                    <div class="col-sm-9">
                                        <select class="form-control"  v-model="item.product_id">
                                            <option v-for="productValue in productJoinList" :value='productValue.id'>{{ productValue.product_num }}</option>
                                        </select>
                                    </div>
                                </div>  <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Barkod</label>
                                    <div class="col-sm-9">
                                        <select class="form-control"  v-model="item.product_id">
                                            <option v-for="productValue in productJoinList" :value='productValue.id'>{{ productValue.product_bar }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Ürün Adı</label>
                                    <div class="col-sm-9">
                                        <select class="form-control"  v-model="item.product_id">
                                            <option v-for="productValue in productJoinList" :value='productValue.id'>{{ productValue.product_name }}</option>
                                        </select>
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Mal numarası</label>
                                    <div class="col-sm-9">
                                        <input type="date" v-model="item.product_skt" class="form-control">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" v-text="item.id>0?'Güncelle':'Kaydet'" @click="saveItem"></button>
                            <button class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    name: "ProductModal",
    props: ['item'],



    data() {
        return {
            productJoinList: null,
            mode: "no-cors"
        }
    },
    async created() {
        await this.definitionGetModal();
    },
    methods: {
        definitionGetModal() {
            axios.get('productDefinition').then(response => {
                this.productJoinList = response.data.data;
            })
        },
        saveItem() {
            if (this.item.id > 0) {
                axios.put('/product/' + this.item.id, this.item)
                    .then(response => {
                        if (response.data.success) {
                            this.$emit('onSaved', this.item);
                            $('#productModal').modal('hide');
                            toastr.success('Kayıt Güncellendi')
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.errorMessage = error.response.data.message;
                    })

            } else {


                axios.post('/product', this.item)
                    .then(response => {
                        if (response.data.success) {

                            this.$emit('onSaved', this.item);
                            $('#productModal').modal('hide');
                            toastr.success('Kayıt eklendi')
                        }
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message;

                    });
            }
        }


    }

}

</script>

<style scoped>

</style>
