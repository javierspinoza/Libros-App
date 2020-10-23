<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fas fa-bookmark"></i> Libros                
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">                                                            
                            <label class="col-md-1 form-control-label" for="text-input">Persona</label>                                                            
                            <div class="col-md-5">
                                <select class="form-control" v-model="id_persona" id="exampleFormControlSelect1">
                                    <option v-for="objeto in arrayPersona" :key="objeto.id" :value="objeto.id" v-text="objeto.nombres"></option>
                                </select>
                            </div>                            
                            <label class="col-md-1 form-control-label" for="text-input">Entrega</label>
                            <div class="col-md-5">
                                <input type="date" v-model="fec_entrega" id="fec_entrega" name="fec_entrega" class="form-control" placeholder="Código">
                            </div>
                        </div>                     
                        <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Libro</label>                                                            
                            <div class="col-md-4">                            
                                <button type="button" class="btn btn-secondary btn-dark" data-toggle="modal" @click="abrirModal('guardar')">
                                <i class="fa fa-search"></i>&nbsp;Buscar
                            </button> 
                            </div>      
                        </div>
                    </form>
              
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Solicitud</th>
                                <th>Persona</th>
                                <th>Entrega</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="EliminarLibro(objeto)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>         
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
    <!-- </div> -->
        <!--Inicio del modal agregar/actualizar-->
         <div class="modal fade" id="modalNuevo" :class="{ mostrar: modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" >Listado de libros</h4>
                        <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- <div class="form-group row"> -->
                            <!-- <div class="input-group">
                                <div class="col-md-2">
                                    <label class="col-md-2 form-control-label" for="text-input">Persona</label>
                                </div>
                                <input  type="text" id="texto" name="texto" v-model="buscar" class="form-control" placeholder="Texto a buscar" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div> -->
                        <!-- </div> -->
                        <div class="form-group row">
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                        <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" v-model="buscar" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Libro</th>
                                    <th>Autor</th>
                                    <th>Editorial</th>
                                    <th>Selecionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)"><i class="fa fa-mouse-pointer"></i></button> &nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" @click="cerrarModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button v-show="accion == 0" type="button" @click="RegistrarSolicitud" class="btn btn-primary">Guardar </button>
                        <button v-show="accion" type="button" @click="ActualizarSolicitud" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
        <!--Fin del modal-->
        <!-- Inicio del modal Eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">            
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">                                   
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar Categoría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de eliminar la categoría?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click="EliminarLibro" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Fin del modal Eliminar -->
    </main>
</template>

<script>
    export default {
        data() {
            return {                
                arrayDatos: [],
                idSolicitud: 0,
                fec_entrega:"",

                modal: 0,
                accion: 0,
                titulo: "",
                buscar: "",
                arrayPersona: [],
                id_persona: 0,
                pagination: {
                    total: 0,
                    current_page: 0,
                    per_page: 0,
                    last_page: 0,
                    from: 0,
                    to: 0,
                 },
                offset: 3,
                buscar: '',
                criterio: 'nombre',
            }
        },
        methods: {

            abrirModal(accion, data = []) {
                switch (accion) {
                    case "guardar":

                        break;
                    case "editar":

                    default:
                        break;
                }
                this.modal = 1;
            },
            cerrarModal() {
                this.modal = 0;
            },
            limpiar() {
                this.fec_entrega = "";
            },

            mensaje(msj) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: msj,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        },
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if (!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                var to = from + this.offset * 2;
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        mounted() {
            console.log("Component mounted.");
            this.getPersona();
            this.ListarSolicitud(1, this.criterio, this.buscar);
        }
    };

</script> 

<style>
    .modal-content {
        width: 100% !important;
        position: absolute;
    }

    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #bbb4b47a;
    }

</style>