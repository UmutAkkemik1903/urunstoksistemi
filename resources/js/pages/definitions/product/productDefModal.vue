<template>
    <div>
        <div>

            <div class="modal fade" tabindex="-1" role="dialog" id="productDefModal">
                <div class="modal-dialog"  role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" v-text="item.id>0?'Ürün Düzenle':'Yeni Ürün'"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div v-if="errorMessage" class="alert alert-danger" v-html="errorMessage"></div>
                            <form  @submit.prevent="true">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Mal numarası</label>
                                    <div class="col-sm-9">
                                        <input v-model="item.product_num" class="form-control" placeholder="Mal numarasını giriniz...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Barkot</label>
                                    <div class="col-sm-9">
                                        <input v-model="item.product_bar" class="form-control" placeholder="Barkod giriniz...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-from-label" >Ürün adı</label>
                                    <div class="col-sm-9">
                                        <input v-model="item.product_name" class="form-control" placeholder="Ürün adını giriniz...">
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
    name: "productDefModal",
    props:['item'],
    mode: "no-cors",
    data(){
        return{
            errorMessage: ''
        }
    },
    methods: {
        saveItem() {
            if (this.item.id > 0) {
                axios.put('/productDefinition/' + this.item.id, this.item)
                    .then(response => {
                        if (response.data.success) {
                            this.$emit('onSaved', this.item);
                            $('#productDefModal').modal('hide');
                            toastr.success('Kayıt Güncellendi')
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.errorMessage = error.response.data.message;
                    })

            } else {


                axios.post('/productDefinition', this.item)
                    .then(response => {
                        if (response.data.success) {

                            this.$emit('onSaved', this.item);
                            $('#productDefModal').modal('hide');
                            toastr.success('Kayıt tanımlı ürünlere eklendi')
                        }
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message;
                        if (error.response.data.errors) {
                            this.errorMessage += "<ul>";
                            Object.keys(error.response.data.errors).forEach((key) => {
                                this.errorMessage += "<li>" + error.response.data.errors[key][0] + "</li>";
                            });
                            this.errorMessage += "</ul>";
                        }
                    });
            }
        }


    }
}
</script>

<style scoped>

</style>
