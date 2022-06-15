<template>
<div class="row">
    <notifications group="foo" />
    <div class="col-12 mt-3 ml-0">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                    <div class="row">                    
                        <div class="col-sm-4">
                            <h4 style="display: inline-block;">Productos</h4>
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="" class="form-control" v-model="buscarCat"  @change="getForCategory()">
                                <option value="">Seleccione Categoria</option>
                                <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.categoria }}</option>
                            </select>
                        </div>
                        
                        <div class="col-sm-4">
                            <!-- <label for="username">Front Icon</label> -->
                            <div class="input-group  mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="bi bi-search"></i></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar" v-on:keyup="getForText()">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width:5%">Id</th>
                                    <th>Categoria</th>
                                    <th>Nombre</th>
                                    <th>Valor</th>
                                    <th>Fecha Exp.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in productos.data" :key="producto.id" >
                                    <td class="text-info"> {{ producto.id }} </td>
                                    <td class="text-info"> {{ producto.categoria }} </td>
                                    <td class="text-info"> {{ producto.nombre_prod}} </td>
                                    <td class="text-info"> {{ producto.valor}} </td>
                                    <td class="text-info"> {{ producto.fecha_expiracion}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item" v-show="productos['first_page_url']">
                                <button class="page-link" @click.prevent="getPreviousPage"><i class="bi bi-chevron-double-left" aria-hidden="true"></i></button>
                            </li>
                            <li class="page-item" :class="{ 'active': (productos['current_page']=== n) }" v-for="n in productos['last_page']" :key="n">
                                <button class="page-link" @click.prevent="getPage(n)"> {{ n }} </button>
                            </li>
                            <li class="page-item" v-show="productos['last_page_url']">
                                <button class="page-link" @click.prevent="getNextPage"><i class="bi bi-chevron-double-right" aria-hidden="true"></i></button>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    data(){
        return{
            productos:{},
            categorias:{},
            buscar:'',
            buscarCat:'',
        }  
    },

    methods:{
        async listarProductos(){
            await axios.get('/api/getProducts').then((res) => {                    
                console.log(res.data);
                this.productos=res.data;
            });
        },
        async listarCategorias(){
            await axios.get('/api/getCategories').then((res) => {                    
                console.log(res.data);
                this.categorias=res.data;
            });

        },

        async getForText(){
            await axios.get('/api/getForText?search='+this.buscar).then((res) => {                    
                console.log(res.data);
                this.productos=res.data;
            });

        },
        async getForCategory(){
            await axios.get('/api/getForCategory?category_id='+this.buscarCat).then((res) => {                    
                console.log(res.data);
                this.productos=res.data;
            });
        },

        /** */
        getPage(page){
            axios.get('/api/category/?page='+page).then((res)=>{                   
                console.log(res.data);
                this.productos=res.data;
            });
        },
        getPreviousPage(){
            axios.get(this.productos['first_page_url']).then((res)=>{                   
                console.log(res.data);
                this.productos=res.data;
            });
        },
        getNextPage(){
            axios.get(this.productos['last_page_url']).then((res) => {                    
                console.log(res.data);
                this.productos=res.data;
            });
            
        },
        /** */

    },

    created(){
        this.listarCategorias();
        this.listarProductos();
    },
}
</script>

<style>

</style>