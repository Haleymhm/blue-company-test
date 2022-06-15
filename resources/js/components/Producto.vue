<template>
<div class="row">
    <notifications group="foo" />
    <div class="col-9 mt-3 ml-0">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                    <div class="row">                    
                        <div class="col-sm-4">
                            <h4 style="display: inline-block;">Productos</h4>
                            <button type="button" class="btn btn-primary btn-sm"  @click="editar=false;abrirModal();"><i class="bi bi-plus-circle"></i></button>
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="" class="form-control" v-model="buscarCat"  >
                                <option value="">Seleccione Categoria</option>
                                <option v-for="categoria in categorias.data" :key="categoria.id" :value="categoria.id">{{ categoria.categoria }}</option>
                            </select>
                        </div>
                        
                        <div class="col-sm-4">
                            <!-- <label for="username">Front Icon</label> -->
                            <div class="input-group  mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="bi bi-search"></i></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Buscar">
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
                                    <th style="width:100px"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in productos.data" :key="producto.id" >
                                    <td class="text-info"> {{ producto.id }} </td>
                                    <td class="text-info"> {{ producto.categoria }} </td>
                                    <td class="text-info"> {{ producto.nombre_prod}} </td>
                                    <td class="text-info"> {{ producto.valor}} </td>
                                    <td class="text-info"> {{ producto.fecha_expiracion}} </td>
                                    <td class="text-info" style="text-align: center;"> 
                                        <button @click="editar=true;abrirModal(producto);" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></button>
                                        <button @click="confirmEliminar(producto)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    <div class="col-3 mt-3">
        <div class="card text-center"  v-if="modal.mostrar">
            <div class="card-header">
                {{modal.titulo}} <button type="button"  class="btn btn-outline-danger" v-on:click="modal.mostrar=false">
                        <span aria-hidden="true">X</span>
                    </button>
            </div>
            <div class="card-body">

                        <div class="form-group" v-if="editar">
                            <label for="Codigo">* Codigo</label>
                            <input v-model="producto.id" id="Codigo" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Nombre">* Nombre</label>
                            <input v-model="producto.nombre" id="Nombre" type="text" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="Nombre">Categoria</label>
                            <select name="" id="" class="form-control" v-model="producto.category_id"  >
                                <option value="">Seleccione Categoria</option>
                                <option v-for="categoria in categorias.data" :key="categoria.id" :value="categoria.id">{{ categoria.categoria }}</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="Nombre">* Valor</label>
                            <input v-model="producto.valor" id="Nombre" type="number" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="Nombre">Fecha Expiracion</label>
                            <input v-model="producto.fechae" id="Nombre" type="date" class="form-control form-control-sm" required>
                        </div>  
                    </div>

            <div class="card-footer">
                <button type="button" class="btn btn-secondary btn-sm" v-on:click="modal.mostrar=0" ><i class="bi bi-arrow-return-left"></i></button>
                <button type="button" class="btn btn-success btn-sm" v-on:click="guardarProducto();" ><i class="bi bi-check-square"></i></button>
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
            editar:false,
            msgNombre:0,
            producto:{
                id:'',
                category_id:'',
                nombre:'',
                valor:'',
                fechae:''
            },
            modal : {
                titulo:"Producto",
                mostrar:false

                },
            errors: {
                id:'',
                nombre:''
            },
        }  
    },

    methods:{
        async listarProductos(){
            await axios.get('/api/products/?search='+this.buscar).then((res) => {                    
                console.log(res.data);
                this.productos=res.data;
            });
        },
        async listarCategorias(){
            await axios.get('/api/category/?search=').then((res) => {                    
                console.log(res.data);
                this.categorias=res.data;
            });

        },

        abrirModal(product={}){
            this.producto.id = product.id;
            this.producto.category_id = product.category_id;
            this.producto.nombre = product.nombre_prod;
            this.producto.valor = product.valor;
            this.producto.fechae = product.fecha_expiracion;
            this.modal.mostrar=true;
        },

        guardarProducto(){
            console.log('Inicio Funcion Guardar');
            let producto = {
                producto_id: this.producto.id,
                producto_nombre: this.producto.nombre,
                categoria_id: this.producto.category_id,
                producto_valor: this.producto.valor,
                producto_fechae: this.producto.fechae
            };

            if(this.editar==false){
                console.log('Funcion Crear');
                axios.post('api/product/saveprod', producto)
                    .then((res) => {                    
                        console.log(res.data);
                        this.$notify({
                                    group: 'foo',
                                    title: 'Crear Producto',
                                    type: 'success',
                                    text: 'El producto fue <strong> creado </strong>con exito'
                                });
                        this.listarProductos();
                        this.modal.mostrar=false;
                    })
                    .catch(error => {
                        this.msgNombre=1;
                    });
            }

            if(this.editar==true){
                console.log('Funcion ediat');
                axios.post('api/product/updateprod', producto)
                    .then((res) => {                    
                        console.log(res.data);
                        this.$notify({
                                    group: 'foo',
                                    title: 'Editar Producto',
                                    type: 'success',
                                    text: 'EL producto fue <strong>actualizado</strong> con exito'
                                });
                        this.listarCategorias();
                        this.modal.mostrar=false;
                    })
                    .catch(error => {
                        this.msgNombre=1;
                    });
            }
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