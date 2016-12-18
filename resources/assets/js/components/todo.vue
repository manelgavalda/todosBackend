<style>
</style>
<template>
    <tr>
         <td>{{ index + from }}</td>
            <!--<td>-->
                <!--<span v-if="!editing"  @dblclick="editTodo">{{todo.name}}</span>-->
                <!--<span v-else @keyup.enter="editTodo">-->
                            <!--<input v-model="todo.name" size='50' @keyup.esc="editTodo" @keyup.enter="saveTodo"></span>-->
            <!--</td>-->
            <td>
                <span v-if="!editingName"  @dblclick="editName" >{{todo.name}}</span>
                <span v-else @keyup.enter="editName">
                                <input v-model="todo.name" size="50" @keyup.enter="saveName" @keyup.esc="unneditName"></span>

                <i class="fa fa-edit" aria-hidden="true" v-show="!editingName" @click="editName"/>
                <i class="fa fa-check" aria-hidden="true" v-show="editingName" @click="saveName"/>
                <i class="fa fa-close" aria-hidden="true" v-show="editingName" @click="unneditName"/>
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info">{{todo.priority}}</button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu btn-info" role="menu">
                        <li v-for="n in 10"><a href="#" @click="setPriority(n)">{{n}}</a></li>
                    </ul>
                </div>
            </td>
            <td>
                <!--<span v-if="!editing"  @click="setDone">{{todo.done}}</span>-->
                <!--<span v-else @keyup.enter="setDone">-->
                            <!--<input v-model="todo.done" size="3"></span>-->

                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="flat-red" checked>
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red">
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red" disabled>
                        Flat green skin checkbox
                    </label>
                </div>
            </td>

            <td>
                <!-- iCheck -->
                <!--<div class="box box-success">-->
                    <!--<div class="box-header">-->
                        <!--<h3 class="box-title">iCheck - Checkbox &amp; Radio Inputs</h3>-->
                    <!--</div>-->
                    <!--<div class="box-body">-->
                        <!--&lt;!&ndash; Minimal style &ndash;&gt;-->

                        <!--&lt;!&ndash; checkbox &ndash;&gt;-->
                        <!--<div class="form-group">-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="minimal" checked>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="minimal">-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="minimal" disabled>-->
                                <!--Minimal skin checkbox-->
                            <!--</label>-->
                        <!--</div>-->

                        <!--&lt;!&ndash; radio &ndash;&gt;-->
                        <!--<div class="form-group">-->
                            <!--<label>-->
                                <!--<input type="radio" name="r1" class="minimal" checked>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="radio" name="r1" class="minimal">-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="radio" name="r1" class="minimal" disabled>-->
                                <!--Minimal skin radio-->
                            <!--</label>-->
                        <!--</div>-->

                        <!--&lt;!&ndash; Minimal red style &ndash;&gt;-->

                        <!--&lt;!&ndash; checkbox &ndash;&gt;-->
                        <!--<div class="form-group">-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="minimal-red" checked>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="minimal-red">-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="minimal-red" disabled>-->
                                <!--Minimal red skin checkbox-->
                            <!--</label>-->
                        <!--</div>-->

                        <!--&lt;!&ndash; radio &ndash;&gt;-->
                        <!--<div class="form-group">-->
                            <!--<label>-->
                                <!--<input type="radio" name="r2" class="minimal-red" checked>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="radio" name="r2" class="minimal-red">-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="radio" name="r2" class="minimal-red" disabled>-->
                                <!--Minimal red skin radio-->
                            <!--</label>-->
                        <!--</div>-->

                        <!--&lt;!&ndash; Minimal red style &ndash;&gt;-->

                        <!--&lt;!&ndash; checkbox &ndash;&gt;-->
                        <!--<div class="form-group">-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="flat-red" checked>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="flat-red">-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="checkbox" class="flat-red" disabled>-->
                                <!--Flat green skin checkbox-->
                            <!--</label>-->
                        <!--</div>-->

                        <!--&lt;!&ndash; radio &ndash;&gt;-->
                        <!--<div class="form-group">-->
                            <!--<label>-->
                                <!--<input type="radio" name="r3" class="flat-red" checked>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="radio" name="r3" class="flat-red">-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input type="radio" name="r3" class="flat-red" disabled>-->
                                <!--Flat green skin radio-->
                            <!--</label>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /.box-body &ndash;&gt;-->
                    <!--<div class="box-footer">-->
                        <!--Many more skins available. <a href="http://fronteed.com/iCheck/">Documentation</a>-->
                    <!--</div>-->
                <!--</div>-->
        </td>
    </tr>
</template>
<script>

export default {
        props: ['todo','index','from'],

        data() {
            return {
                editing: false,
                editingName: false,
                uri: 'api/v1/task',
                n: this.todo.priority,
            }
        },
        created() {
            //console.log('Component todo created.');
        },
        methods: {
            //Name methods:
            editName: function() {
                //console.log(this.index);
                return this.editingName = true;
            },
            editTodo: function() {
                //console.log(this.index);
                return this.editing = true;
            },
            unneditName: function() {
                return this.editingName = false;
            },
            saveName: function() {
                console.log(this.uri);
                this.editTodoApi();
                return this.editingName = false;
            },
            //Priority methods:
            setPriority: function(priority) {
                this.todo.priority=priority;
                this.editTodoApi();
            },
            //Done methods:
            setDone: function() {
                console.log("Canviant estat");
            },
            //Editar todo desde api.
            editTodoApi: function() {
                console.log(this.todo.name);
                this.$http.put(this.uri +'/'+this.todo.id,{
                    name: this.todo.name,
                    priority: this.todo.priority,
                    done: this.todo.done
                }).then((response) => {
                console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            //No puc usar nom delete peruè és un keyword de javascript.
            deleteTodo: function(index,id) {
                console.log("Deleting todo");
                //per a que el pare ho pille.
                this.$emit('todo-deleted',index,id);
            }
        }
    }
    //Afegir icones(edit,eliminar, cancelar(depenent de l'estat editing)).
    //TODO: Afegir un boto o algo agafar(ficar el seu src al js) o millor afegir al package.json per instal·lar el js(si te npm), si no te npm s'agafa el javascript i s'afegeix al general.
    //Fer el v-for només amb un todo (<todo>,</todo>
    //Fer més accions com el de borrar.
</script>


