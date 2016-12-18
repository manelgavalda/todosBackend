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
                <span v-if="!editingName"  @dblclick="editName">{{todo.name}}</span>
                <span v-else @keyup.enter="editName">
                                <input v-model="todo.name" size="50"></span>

                <i class="fa fa-edit" aria-hidden="true" v-show="!editingName" @click="editName"/>
                <i class="fa fa-check" aria-hidden="true" v-show="editingName" @click="saveName"/>
                <i class="fa fa-close" aria-hidden="true" v-show="editingName" @click="unneditName"/>
            </td>
            <td>
                <span v-if="!editing"  @click="editTodo">{{todo.priority}}</span>
                <span v-else @keyup.enter="editTodo">
                            <input v-model="todo.priority" size="1"></span>
            </td>
            <td>
                <span v-if="!editing"  @click="editTodo">{{todo.done}}</span>
                <span v-else @keyup.enter="editTodo">
                            <input v-model="todo.done" size="3"></span>
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
            }
        },
        created() {
            //console.log('Component todo created.');
        },
        methods: {
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
            saveName: function(todo) {
                console.log(this.uri);
                //ficat put per guardar a la api.
                this.editTodoApi();
                return this.editingName = false;
            },
            //No el necessitem a todos.
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


