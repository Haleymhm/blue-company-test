<template>
<div class="row">
    <notifications group="foo" />
    <div class="col-9 mt-3 ml-0">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                    <div class="row">                    
                        <div class="col-sm-4">
                            <h4 style="display: inline-block;">Productos</h4>
                            <button type="button" class="btn btn-primary btn-sm"  >Nueva</button>
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="" class="form-control">
                                <option value="">Categorias</option>
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

}
</script>

<style>

</style>