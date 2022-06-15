<template>
<div class="row">
    <notifications group="foo" />
    <div class="col-9 mt-3 ml-0">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                    <div class="row">                    
                        <div class="col-sm-4">
                            <h4 style="display: inline-block;">Productos</h4>
                            <button type="button" class="btn btn-primary btn-sm"  ><i class="bi bi-plus-circle"></i></button>
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="" class="form-control">
                                <option value="">Selecione Categoria</option>
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
                                <tr v-for="producto in productos.data" :key="producto.id" class="zoom" >
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
</div>
</template>

<script>
export default {
    data(){
        return{
            productos:{},
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
    },

    created(){
        this.listarProductos();
    },

}
</script>

<style>

</style>