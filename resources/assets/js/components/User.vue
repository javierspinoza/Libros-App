<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escriterio</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Usuarios
                    <button type="button" @click="abrirModal ('persona', 'registrar')" class="btn btn-primary"> <!-- son los parametros que se enviaron en el metodo abrir modal --> 
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-7">
                            <div class="input-group">
                                <select class="form-control col-md-4" v-model="criterio">
                                    <option value="nombres">Nombre</option>
                                    <option value="apellidos">Apellidos</option>
                                    <option value="email">Email</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Dirección</th>
                                <th>Télefono</th>
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="objeto in arrayPersona" :key="objeto.id">
                                <td>
                                    <button type="button" @click="abrirModal ('persona', 'actualizar', objeto)" class="btn btn-warning btn-sm" >
                                        <i class="icon-pencil"></i> <!-- aqui se envio los parametros del metodo(el modelo osea CATEGORIA la accion) y el objeto -->
                                    </button>&nbsp;  
                                    <!-- inicio boton activar desactivar-->
                                    <template v-if="objeto.condicion">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(objeto.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(objeto.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                    <!-- fin boton activar desactivar-->                                                                      
                                </td>
                                <td v-text="objeto.nombres"></td>
                                <td v-text="objeto.apellidos"></td>
                                <td v-text="objeto.dir"></td>
                                <td v-text="objeto.tel"></td>
                                <td v-text="objeto.email"></td>
                                <td v-text="objeto.usuario"></td>
                                <td v-text="objeto.rol"></td><!--es el alias del controlador aqui-->
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
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <!-- el mostrar el de la etiqueta de STYLE y MOdal cuando sea 1 se muestra-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' :modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document"> 
                <div class="modal-content"> <!-- modal-content hace referencia a donde lo cree en los STYLE-->
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="nombres" class="form-control" placeholder="Ingrese el nombre">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="apellidos" class="form-control" placeholder="Ingrese apellidos">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Teléfono</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="tel" class="form-control" placeholder="Ingrese teléfono">
                                </div>
                                <label class="col-md-2 form-control-label" for="email-input">Email</label>
                                <div class="col-md-4">
                                    <input type="email" v-model="email" class="form-control" placeholder="Ingrese email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Rol (*)</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="id_rol">
                                        <option value="0">Seleccione un rol</option>
                                        <option v-for="objeto in arrayRol" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre">Seleccione un rol</option>
                                    </select>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Usuario</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="usuario" class="form-control" placeholder="Ingrese nombre de usuario">
                                </div>                                                                
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Password</label>
                                <div class="col-md-4">
                                    <input type="password" v-model="password" class="form-control" placeholder="Ingrese password de acceso">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Dirección</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="dir" class="form-control" placeholder="Dirección">
                                </div>                                
                            </div>
                            <!-- validar que que usuario ingrese datos -->
                            <div v-show="errorPersona" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <!--FIN VALIDACION-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
                arrayPersona:[],
                persona_id: 0, //es el id de la tabla categoria
                nombres: '',
                apellidos: '',
                dir: '',
                tel: '',
                email: '',
                usuario: '',
                password: '',
                id_rol: 0,
                //ARRAY ROL
                arrayRol:[],
                //MODAL
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,                
                //VALIDACION
                errorPersona: 0,
                errorMostrarMsjPersona : [],
                //Paginacion
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0,
                },
                offset:3,
                //BUSCAR
                criterio: 'nombre',
                buscar: '',
            }            
        },

        methods: {
            
            //PARA MOSTRAR LOS DATOS O LISTARLOS
            listarPersona (page,buscar,criterio){ //page de la paguinacion y las dos variables otras son las de buscar
                let me = this;
                var url= '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;//concatenamos y enviamos los parametros en la ruta de buscar y paguinacion
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayPersona = respuesta.personas.data;//categorias es del index del controller que es el objeto
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            //select rol
            selectRol(){
                let me = this;
                var url= '/rol/selectRol';//concatenamos y enviamos los parametros en la ruta de buscar y paguinacion
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles;//categorias es del index del controller que es el objeto
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            //METODO DE LA PAGUINACION
            cambiarPagina(page,buscar,criterio){
                let  me = this;
                //va a la pag actual
                me.pagination.current_page= page;
                //envia el metodo para traer los datos
                me.listarPersona(page,buscar,criterio);
            },
            //REGISTRAR Persona
            registrarPersona(){
                if (this.validarPersona()) { //se llama el metodo de validar
                    return;
                }

                let me = this;
                axios.post('/user/registrar',{
                    'nombres': this.nombres,
                    'apellidos': this.apellidos,
                    'dir': this.dir,
                    'tel': this.tel,
                    'email': this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'id_rol': this.id_rol
                })
                .then(function (response){
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');//el 1 al page, en el parametro buscar no envio nada y el criterio es el nombre
                }).catch(function (error){
                    console.log(error);
                });
            },
            actualizarPersona(){
                if (this.validarPersona()) { //se llama el metodo de validar
                    return;
                }

                let me = this;
                axios.put('/user/actualizar',{
                    'id': this. persona_id, //segundo del data y el primero de bd o controlador
                    'nombres': this.nombres,
                    'apellidos': this.apellidos,
                    'dir': this.dir,
                    'tel': this.tel,
                    'email': this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'id_rol': this.id_rol
                })
                .then(function (response){
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error){
                    console.log(error);
                });
            },            
            //MODAL PARA ACTUALIZAR Y GUARDAR UN NUEVO REGISTRO
            abrirModal(modelo, accion, data = []){ // el data es el mismo objeto que llamamos arriba en el boton
                this.selectRol();
                switch (modelo) { //valida que MODELO sea igual a persona
                    case "persona":
                    {
                        switch (accion) {
                            case 'registrar':{
                                this.modal = 1;
                                this.tituloModal = 'Registar usuario';
                                this.nombres = '';
                                this.apellidos = '';
                                this.dir = '';
                                this.tel = '';
                                this.email = '';
                                this.usuario = '',
                                this.password = '',
                                this.id_rol = 0,
                                this.tipoAccion =1;
                                break;
                            }
                            case 'actualizar':{                                
                                this.modal = 1;
                                this.tituloModal = 'Editar usuario';
                                this.tipoAccion = 2;
                                this.persona_id = data['id'];//primer campo nombre en el data y el segundo del controlador o la bd
                                this.nombres = data['nombres'];
                                this.apellidos = data['apellidos'];
                                this.dir = data['dir'];
                                this.tel = data['tel'];
                                this.email = data['email'];
                                this.usuario = data['usuario'];
                                this.password = data['password'];
                                this.id_rol = data['id_rol'];
                                break;
                            }                                
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '',
                this.nombres = '',
                this.apellidos = '',
                this.dir = '',
                this.tel = '',
                this.email = '',
                this.usuario = '',
                this.password = '',
                this.id_rol = 0,
                this.errorPersona = 0
            }, 
            //DESACTIVAR EL BONTON PARA QUE SE DESACTIVE EL USUARIO
            desactivarUsuario(id){
                Swal.fire({
                    title: 'Estas seguro de desactivar este usuario?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        let me = this;
                        axios.put('/user/desactivar',{
                            'id': id, //segundo del parametro desactivar y el primero de bd o controlador                            
                        })
                        .then(function (response){
                            me.listarPersona(1,'','nombre');
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Se ha desactivado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }).catch(function (error){
                            console.log(error);
                        });
                    }
                })
            },
            //ACTIVAR EL BONTON PARA QUE SE ACTIVE EL USUARIO
            activarUsuario(id){
                Swal.fire({
                    title: 'Estas seguro de activar este usuario?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        let me = this;
                        axios.put('/user/activar',{
                            'id': id, //segundo del parametro desactivar y el primero de bd o controlador                            
                        })
                        .then(function (response){
                            me.listarPersona(1,'','nombre');
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Se ha activado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }).catch(function (error){
                            console.log(error);
                        });
                    }
                })
            },           
            //VALIDAR QUE EL USUARIO NO INGRESE VALORES NULOS
            validarPersona (){
                this.errorPersona = 0;
                this.errorMostrarMsjPersona = [];

                if (!this.nombres) this.errorMostrarMsjPersona.push("El nombre de la Persona no puede estar vacio y es unico");
                if (!this.usuario) this.errorMostrarMsjPersona.push("El nombre de usuario no puede estar vacio y es unico");
                if (!this.password) this.errorMostrarMsjPersona.push("El password no puede estar vacio");
                if (this.id_rol==0) this.errorMostrarMsjPersona.push("debes seleccionar un rol");

                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1 ; //error Persona cambiara a 1 si hay algun error

                return this.errorPersona;
            },                        
        },
        //METODO COMPUTADO DE LA PAGUINACION
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
            this.listarPersona(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold
    }
</style>