<template>

    <div class="row">
        <notifications group="foo" />
        <div class="col-9 mt-3 ml-0">
            <div class="card">
                <div class="card-header  justify-content-between align-items-center">                               
                    <div class="row">                    
                        <div class="col-sm-7">
                            <h4 style="display: inline-block;"> Categorias </h4>
                            <button type="button" class="btn btn-primary"  @click="editar=false;abrirModal();"><i class="bi bi-plus-circle"></i></button>
                        </div>
                        
                        <div class="col-sm-5">
                            <!-- <label for="username">Front Icon</label> -->
                            <div class="input-group  mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="bi bi-search"></i></span>
                                </div>
                                <input type="search" v-model="buscar" class="form-control" placeholder="Buscar" v-on:keyup="listarCategorias()">
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
                                    <th>Nombre</th>
                                    <th style="width:100px"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in categorias.data" :key="categoria.id" class="zoom" >
                                    <td class="text-info"> {{ categoria.id }} </td>
                                    <td class="text-info"> {{ categoria.categoria}} </td>
                                    <td class="text-info" style="text-align: center;"> 
                                        <button @click="editar=true;abrirModal(categoria);" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></button>
                                        <button @click="confirmEliminar(categoria)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item" v-show="categorias['first_page_url']">
                                <button class="page-link" @click.prevent="getPreviousPage"><i class="bi bi-chevron-double-left" aria-hidden="true"></i></button>
                            </li>
                            <li class="page-item" :class="{ 'active': (categorias['current_page']=== n) }" v-for="n in categorias['last_page']" :key="n">
                                <button class="page-link" @click.prevent="getPage(n)"> {{ n }} </button>
                            </li>
                            <li class="page-item" v-show="categorias['last_page_url']">
                                <button class="page-link" @click.prevent="getNextPage"><i class="bi bi-chevron-double-right" aria-hidden="true"></i></button>
                            </li>
                        </ul>
                    </nav>
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
                                <input v-model="categoria.id" id="Codigo" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Nombre">* Nombre</label>
                                <input v-model="categoria.nombre" id="Nombre" type="text" class="form-control form-control-sm" required>
                            </div>                            
                        </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-secondary btn-sm" v-on:click="modal.mostrar=0" ><i class="bi bi-arrow-return-left"></i></button>
                    <button type="button" class="btn btn-success btn-sm" v-on:click="guardarCategoria();" ><i class="bi bi-check-square"></i></button>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

export default {
    components: {
        
    },
    data(){
        return{
            categorias:{},
            buscar:'',
            editar:false,
            msgNombre:0,
            categoria:{
                id:'',
                nombre:''
            },
            modal : {
                titulo:"Categoria",
                mostrar:false

                },
            errors: {
                id:'',
                nombre:''
            },
        }  
    },
    methods: {
        async listarCategorias(){
            let find = {
                search: this.buscar,
            };
            await axios.get('/api/category/?search='+this.buscar).then((res) => {                    
                console.log(res.data);
                this.categorias=res.data;
            });

        },
        abrirModal(category={}){
            this.categoria.id = category.id;
            this.categoria.nombre = category.categoria;
            this.modal.mostrar=true;
        },
        guardarCategoria(){
            console.log('Inicio Funcion Guardar');
            let categoria = {
                categoria_id: this.categoria.id,
                categoria_nombre: this.categoria.nombre
            };

            if(this.editar==false){
                console.log('Funcion Crear');
                axios.post('api/category/savercat', categoria)
                    .then((res) => {                    
                        console.log(res.data);
                        this.$notify({
                                    group: 'foo',
                                    title: 'Crear categoria',
                                    type: 'success',
                                    text: 'La categoria fue creado con exito'
                                });
                        this.listarCategorias();
                        this.modal.mostrar=false;
                    })
                    .catch(error => {
                        this.msgNombre=1;
                    });
            }

            if(this.editar==true){
                console.log('Funcion ediat');
                axios.post('/api/category/updatecat', categoria)
                    .then((res) => {                    
                        console.log(res.data);
                        this.$notify({
                                    group: 'foo',
                                    title: 'Crear categoria',
                                    type: 'success',
                                    text: 'La categoria fue creado con exito'
                                });
                        this.listarCategorias();
                        this.modal.mostrar=false;
                    })
                    .catch(error => {
                        this.msgNombre=1;
                    });
            }

        },
        confirmEliminar(category={}){
            let x = confirm('Desea eliminar '+ category.categoria);
            if (x){
                let categoria = {
                    categoria_id: category.id,
                    categoria_nombre: category.categoria
                };
                axios.post('/api/category/deletecat', categoria)
                .then((resp)=>{
                    console.log(resp.data.success);
                    this.$notify({
                            group: 'foo',
                            title: 'Borrar categorÍa',
                            type: 'success',
                            text: 'La categoria fue borrada con exito'
                        });
                    this.listarCategorias();
                    
                })
                .catch(error => {
                    this.modalborrar.msg = 1;
                });
            }
        },

        /** */
        getPage(page){
            axios.get('/api/category/?page='+page).then((res)=>{                   
                console.log(res.data);
                this.categorias=res.data;
            });
        },
        getPreviousPage(){
            axios.get(this.categorias['first_page_url']).then((res)=>{                   
                console.log(res.data);
                this.categorias=res.data;
            });
        },
        getNextPage(){
            axios.get(this.categorias['last_page_url']).then((res) => {                    
                console.log(res.data);
                this.categorias=res.data;
            });
            
        },
        /** */ 
    },
    created(){
        //console.log('Component mounted.')
        this.listarCategorias();
    },

}
</script>

<style>

</style>