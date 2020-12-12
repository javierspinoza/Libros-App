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
                    <button type="button" class="btn btn-primary" data-toggle="modal" @click="mostrar()">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>                
                </div>
                <div class="card-body">
                    <!-- <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> -->

                        <template v-if="view">
                            <div class="form-group row">                                                            
                                <label class="col-md-1 form-control-label" for="text-input">Persona</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="id_persona" id="exampleFormControlSelect1">
                                        <option v-for="objeto in arrayPersona" :key="objeto.id" :value="objeto.id" v-text="objeto.nomComp"></option>
                                    </select>
                                </div>                            
                                <label class="col-md-1 form-control-label" for="text-input">Entrega</label>
                                <div class="col-md-4">
                                    <input type="date" v-model="fec_entrega" id="fec_entrega" name="fec_entrega" class="form-control" placeholder="Fecha de entrega">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Código</label>
                                <div class="col-md-4 ">
                                    <div class="input-group">                                
                                        <input type="text" id="texto1" name="texto" v-model="buscar" class="form-control" placeholder="Codigo del libro a buscar" @keyup.enter="getLibro(buscar)">
                                        <button type="submit" class="btn btn-primary" @click="abrirModal"><i class="fa fa-search"></i></button>
                                    </div>                                
                                </div>
                                <h3 class="text-muted mx-sm-2" v-text="nombreLibro"></h3>                            
                            </div>
                            <div class="form-group row">                            
                                <label class="col-md-1 form-control-label" for="text-input">Cantidad</label>                                                        
                                <div class="col-md-4">
                                    <div class="input-group">                                    
                                        <input type="text" v-model="cant" id="cant" name="cant" class="form-control" placeholder="Ingrese la cantidad">
                                        <button type="button" class="btn btn-success" @click="agregarItem2">
                                            <i class="icon-check"></i>
                                        </button>
                                    </div>
                                </div>                            
                            </div>

                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Cantidad</th>
                                        <th>Autor</th>
                                        <th>Editorial</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="objeto in arrayDatos" :key="objeto.id"> 
                                        <td v-text="objeto.nomLibro"></td>
                                        <td v-text="objeto.cod"></td>
                                        <td v-text="objeto.cant"></td>
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
                            <div class="float-right mx-sm-2">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" @click="regSolicitud()">
                                    <i class="icon-plus"></i>&nbsp;Guardar
                                </button>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" @click="ocultarDetalle()">
                                    <i class="icon-close"></i>&nbsp;Cerrar
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

                        </template>
                        <template v-else>
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Nº Prestamo</th>
                                        <th>Persona</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Fecha Entrega</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="objeto in arrayMaster" :key="objeto.id"> 
                                        <td v-text="objeto.id"></td>
                                        <td v-text="objeto.nomComp"></td>
                                        <td v-text="objeto.fec_sol"></td>
                                        <td v-text="objeto.fec_entrega"></td>
                                        <td>                                    
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="mostrar(objeto)">
                                                <i class="icon-eye"></i>
                                            </button>                                  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
                    <!-- </form> -->
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
                            <label class="col-md-1 form-control-label" for="text-input">Cantidad</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="number" v-model="cant" id="cant" name="cant" class="form-control" placeholder="Ingrese la cantidad">
                                </div>
                            </div>
                        </div>                        
                        <!-- esta tabla llama todo del controlador libros en la parte del index -->
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Autor</th>
                                    <th>Editorial</th>
                                    <th>Disponible</th>
                                    <th>Selecionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="objeto in arrayLibros" :key="objeto.id">
                                    <td v-text="objeto.nombre"></td>
                                    <td v-text="objeto.codigo"></td>
                                    <td v-text="objeto.nomAutor"></td>
                                    <td v-text="objeto.nomEditorial"></td>
                                    <td v-text="objeto.cant"></td>
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
    import Toasted from 'vue-toasted';
    Vue.use(Toasted);
    export default {
        data() {
            return {                
                arrayDatos: [],
                idLibro: 0,
                fec_entrega:"",
                nombreLibro:"",
                codigoLibro:"",
                nombreAutor:"",
                nombreEditorial:"",
                cant:1,
                idSolicitud:0,

                modal: 0,
                view: 0,
                accion: 0,
                titulo: "",
                buscar: "",
                buscar1: "",

                arrayPersona: [],
                id_persona: 0,

                arrayLibros: [],
                arrayMaster: [],
                arrayGetLibros: [],

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
            listDatos:function(page,buscar){
                let me = this;
                var url = "/solicitud?page="+ page+  '&buscar='+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayMaster = respuesta.solicitud.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listDetalle:function(page){
                let me = this;
                var url = "/detsolicitud?page="+ page+  '&buscar='+ this.idSolicitud;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.solicitud.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            //es para listar un libro en especifico cuando lo estemos buscando
            //en el buscar libro principal de PRESTAMOS DE LIBROS
            getLibro:function(buscar){                             
                let me = this; 
                var url = "/getlibro?buscar="+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayGetLibros = respuesta.libros;

                    if (me.arrayGetLibros.length >0) {
                        me.idLibro=me.arrayGetLibros[0]['id'];
                        me.codigoLibro=me.arrayGetLibros[0]['codigo'];//este CODIGO es el que yo estableci en el controllador
                        me.nombreLibro=me.arrayGetLibros[0]['nombre'];
                        me.nombreAutor=me.arrayGetLibros[0]['nomAutor'];
                        me.nombreEditorial=me.arrayGetLibros[0]['nomEditorial'];
                    }else{
                        me.nombreLibro="Verifique el nombre o código"
                    }
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
            //toma los datos que yo selecciono de la ventana modal cuando le doy en el boton que dice ok y los agrega a la tabla arrayDATOS
            agregarItem:function(data=[]){
                this.arrayDatos.push({id:data['id'],nom:data['nombre'],cod:data['codigo'],cant:this.cant,autor:data['nomAutor'],editorial:data['nomEditorial']})
                //el primer campo es como viene los libros y el segundo del controlador y la tatbla
                this.arrayLibros.splice(0,1);//para eliminar los datos una vez se vayan mandando a la tabla principal
                this.mensajeToast();
            },
            //agrega los datos que estan desde el formulario principal
            agregarItem2:function(){
                this.arrayDatos.push({id:this.idLibro,nomLibro:this.nombreLibro,cod:this.codigoLibro,cant:this.cant,autor:this.nombreAutor,editorial:this.nombreEditorial})
                //el primer campo es como esta en la tabla y de como viene en el controlador, el segundo el como esta en el data
                this.arrayLibros.splice(0,1);
            },
            regSolicitud(){
                let me = this;
                var url="/solicitud/registrar";
                axios.post(url,{
                    fec_entrega: this.fec_entrega,
                    id_persona: this.id_persona,
                    datosDetalle:me.arrayDatos //datos detalle es como lo llame en el controlador
                })
                .then(function(response){
                    // me.listCat();
                    me.limpiar();
                    me.mensaje('Se guardo correctamente');
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            // eliminarSolicitud(data=[]){
            //     let me = this;

            //     Swal.fire({
            //         title: 'Estas seguro?',
            //         text: "Se eliminaran los datos",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         cancelButtonText: 'Cancelar!',
            //         confirmButtonText: 'Confirmar!'
            //         }).then((result) => {                        
            //         if (result.isConfirmed) {

            //             var url="/solicitud/eliminar";
            //                 axios.post(url,{
            //                 id:data['id']
            //             })
            //             .then(function(response){
            //                 // me.listCat();
            //             })
            //                 .catch(function(error){
            //                 console.log(error);
            //             });                        
            //         }
            //     })                 
            // },    

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
                this.id_persona = "";
                this.cant = 1;
                this.nombreLibro = "";
                this.buscar = "";
            },

            mensaje(msj) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: msj,
                    showConfirmButton: false,
                    timer: 2000
                });
            },
            mensajeToast(){
                let toast= this.$toasted.show(
                    'Libro agregado',{
                        theme:"bubble"
                    
                });
            },
            mostrar(data=[]){
                this.view = 1;
                this.id_persona=data['idPerso'];//primero del data y de como la llame en el formulario y el segundo es el alias
                this.fec_entrega=data['fec_entrega'];
                this.idSolicitud=data['id'];
                this.listDetalle(1, "");
            },
            ocultarDetalle(){
                this.view = 0;
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
            this.listDatos();
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