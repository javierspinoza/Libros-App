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
                    <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal ('guardar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>                
                </div>
                <div class="card-body">
                    <!-- <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> -->
                        <div class="form-group row">                                                            
                            <label class="col-md-1 form-control-label" for="text-input">Persona</label>
                            <div class="col-md-4">
                                <select class="form-control" v-model="id_persona" id="exampleFormControlSelect1">
                                    <option v-for="objeto in arrayPersona" :key="objeto.id" :value="objeto.id" v-text="objeto.nomCom"></option>
                                </select>
                            </div>                            
                            <label class="col-md-1 form-control-label" for="text-input">Entrega</label>
                            <div class="col-md-4">
                                <input type="date" v-model="fec_entrega" id="fec_entrega" name="fec_entrega" class="form-control" placeholder="Fecha de entrega">
                            </div>
                        </div>                     
                        <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Libro</label>
                            <div class="col-md-4 ">
                                <div class="input-group">                                
                                    <input type="text" id="texto1" name="texto" v-model="buscar1" class="form-control" placeholder="Nombre del libro a buscar">
                                    <button type="submit" class="btn btn-primary" @click="abrirModal"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    <!-- </form> -->
              
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Código</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="objeto in arrayDatos" :key="objeto.id"> 
                                <td v-text="objeto.nom"></td>
                                <td v-text="objeto.cod"></td>
                                <td v-text="objeto.autor"></td>
                                <td v-text="objeto.editorial"></td>
                                <td>                                    
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal">
                                        <i class="icon-trash"></i>
                                    </button>                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="float-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal">
                            <i class="icon-plus"></i>&nbsp;Guardar
                        </button>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina1(pagination.current_page - 1,buscar1,criterio)" >Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina1(page,buscar1,criterio)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link"  href="#" @click.prevent="cambiarPagina1(pagination.current_page + 1,buscar1,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>                                                 
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
                        <h4 class="modal-title" >Seleccione un libro</h4>
                        <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="card-body">                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">                                    
                                    <input type="text" id="texto" name="texto" v-model="buscar" class="form-control" placeholder="Libro a buscar" @keypress="listLibro(1,buscar)">  <!--KEYPRESS es para buscar cada vez que yo oprima una techa -->
                                    <button type="button" @click="listLibro(1,buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Autor</th>
                                    <th>Editorial</th>
                                    <th>Selecionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="objeto in arrayLibros" :key="objeto.id">
                                    <td v-text="objeto.nombre"></td>
                                    <td v-text="objeto.codigo"></td>
                                    <td v-text="objeto.nomAutor"></td>
                                    <td v-text="objeto.nomEditorial"></td>
                                    <td style="width=20px;">
                                        <button type="button" class="btn btn-success btn-sm" @click="agregarItem(objeto)"><i class="fa fa-mouse-pointer"></i>Ok</button> &nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)" >Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link"  href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" @click="cerrarModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <!-- <button v-show="accion == 0" type="button" @click="RegistrarSolicitud" class="btn btn-primary">Guardar </button>
                        <button v-show="accion" type="button" @click="ActualizarSolicitud" class="btn btn-primary">Actualizar</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>        
        <!--Fin del modal-->        
    </main>
</template>

<script>
    export default {
        data() {
            return {                
                arrayDatos: [],
                idPrestamo: 0,
                fec_entrega:"",

                modal: 0,
                accion: 0,
                titulo: "",
                buscar: "",
                buscar1: "",

                arrayPersona: [],
                id_persona: 0,

                arrayLibros: [],

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
                buscar1: '',
                criterio: 'nombre',
            }
        },
        methods: {
            cambiarPagina(page,buscar,criterio){
                let  me = this;
                //va a la pag actual
                me.pagination.current_page= page;
                //envia el metodo para traer los datos
                me.listLibro(page,buscar);
            },
            cambiarPagina1(page,buscar1,criterio){
                let  me = this;
                //va a la pag actual
                me.pagination.current_page= page;
                //envia el metodo para traer los datos
                me.listPres(page,buscar1);
            },
            listLibro:function(page,buscar){
                let me = this;
                var url = "/libro?page="+ page+  '&buscar='+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayLibros = respuesta.libros.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            // listPres:function(page,buscar1){
            //     let me = this;
            //     var url = "/solicitud?page="+ page+  '&buscar1='+buscar1;
            //     axios.get(url).then(function(response){
            //         var respuesta = response.data;
            //         me.arrayDatos = respuesta.solicitud.data;
            //         me.pagination = respuesta.pagination;
            //     })
            //     .catch(function(error){
            //         console.log(error);
            //     });
            // },

            getPersona(){
                let me = this;
                var url = "/selectPersona";
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayPersona = respuesta.personas;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            agregarItem:function(data=[]){
                this.arrayDatos.push({nom:data['nombre'],cod:data['codigo'],autor:data['nomAutor'],editorial:data['nomEditorial']})
                this.arrayLibros.splice(0,1);//para eliminar los datos una vez se vayan mandando a la tabla principal
            },

            abrirModal(accion, data = []) {
                switch (accion) {
                    case "guardar":
                        this.titulo='Registrar un libro'
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
            this.listLibro(1,  this.buscar);
            // this.listPres(1, this.buscar1)
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