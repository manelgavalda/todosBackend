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
                <label>
                    <input type="checkbox" name="quux[1]" disabled>
                    Foo
                </label>

                <label for="baz[1]">Bar</label>
                <input type="radio" name="quux[2]" id="baz[1]" checked>

                <label for="baz[2]">Bar</label>
                <input type="radio" name="quux[2]" id="baz[2]">
            </td>
            <td>
                <!--<span v-if="!editing"  @click="setDone">{{todo.done}}</span>-->
                <!--<span v-else @keyup.enter="setDone">-->
                            <!--<input v-model="todo.done" size="3"></span>-->

                <div class="form-group">
                    <label class="">
                        <div class="icheckbox_flat-green checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" checked="" style="position: absolute; opacity: 0;">
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                    </label>
                </div>

            </td>

            <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
            </td>
            <td><span class="badge bg-red">55%</span></td>
        <td>
            <span class="btn btn-md btn-danger"  @click="deleteTodo(index,todo.id)">
                <i class='fa fa-fw fa-trash'/>
            </span>
            <span class="btn btn-md btn-info" @click="editTodo(index,todo.id)">
                <i class='fa fa-fw fa-edit'/>
            </span>
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


