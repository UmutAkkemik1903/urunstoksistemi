import Vue from 'vue';
import VueRouter from 'vue-router';
import Ecxel from 'vue-excel-export';
import sort from 'vue-sorted-table';



Vue.use(VueRouter);
Vue.use(Ecxel);
Vue.use(sort);
import DashBoard from "../pages/DashBoard";
import Products from "../pages/products/ProductList";
import ProductDef from "../pages/definitions/product/ProductDef";
const routes=[
    {
        path: '/',
        component: DashBoard,
        name: 'dashboard'
    },
    {
        path: '/product',
        component: Products,
        name: 'product'
    },{
        path: '/productDefinition',
        component: ProductDef,
        name: 'productDef'
    }
]

export default new VueRouter({
    mode:'hash',
    routes
})

