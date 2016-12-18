<style>
</style>
<template>
    <tr>
         <td>{{ index + from }}</td>
            <td>
                <span v-if="!editing"  @dblclick="editTodo">{{todo.name+todo.id}}</span>
                <span v-else @keyup.enter="editTodo">
                            <input v-model="todo.name" size='50' @keyup.esc="editTodo" @keyup.enter="saveTodo"></span>
                <i class="fa fa-edit" aria-hidden="true" v-show="!editing" @click="editTodo"/>
                <i class="fa fa-check" aria-hidden="true" v-show="editing" @click="saveTodo"/>
                <i class="fa fa-close" aria-hidden="true" v-show="editing" @click="unneditTodo"/>
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
            <span class="btn btn-md btn-danger">
                <i class='fa fa-fw fa-trash' @click="deleteTodo(index,todo.id)"/>
            </span>
            <span class="btn btn-md btn-info">
                <i class='fa fa-fw fa-edit' @click="editTodo"/>
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
            }
        },
        created() {
            //console.log('Component todo created.');
        },
        methods: {
            editTodo: function() {
                return this.editing = true;
            },
            unneditTodo: function() {
                return this.editing = false;
            },
            saveTodo: function() {
                return this.editing = false;
                //ficat put per guardar a la api.
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


