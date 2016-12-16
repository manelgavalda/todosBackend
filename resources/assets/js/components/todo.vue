<style>
.button {
    color: green;
}
</style>
<template>
    <tr>
         <td>{{ index + from }}</td>
            <td>
                <span v-if="editing==false"  @click="editTodo">{{todo.name}}</span>
                <span v-else @keyup.enter="editTodo">
                            <input v-model="todo.name" size='50' @keyup.esc="editTodo"></span>
                <i class="fa fa-check" aria-hidden="true" v-show="editing" @click="editTodo"/>
                <i class="fa fa-edit" aria-hidden="true" v-show="!editing" @click="editTodo"/>
                <i class="fa fa-close" aria-hidden="true" v-show="editing" @click="editTodo"/>
            </td>
            <td>
                <span v-if="editing==false"  @click="editTodo">{{todo.priority}}</span>
                <span v-else @keyup.enter="editTodo">
                            <input v-model="todo.priority" size="1"></span>
            </td>
            <td>
                <span v-if="editing==false"  @click="editTodo">{{todo.done}}</span>
                <span v-else @keyup.enter="editTodo">
                            <input v-model="todo.done" size="3"></span>
            </td>
            <td>
                <button class='fa fa-trash'@click="deleteTodo(index,todo.id)"/>
            </td>
            <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
            </td>
            <td><span class="badge bg-red">55%</span></td>
    </tr>
</template>
<script>

export default {
        props: ['todo','index','from'],

        data() {
            return {
                editing :false,
            }
        },
        created() {
            console.log('Component todo created.');
        },
        methods: {
            hola: function(pageNum) {
             console.log('Hello');
            },
            //editTodo.
            editTodo: function() {
                if (this.editing) {
                    return this.editing = false;
                }
                return this.editing = true;
            },
            deleteTodoApi: function(id) {
                this.$http.delete(this.uri + '/' + id).then((response) => {
                    console.log(response);
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            deleteTodo: function(id,idTask) {
            //Per cridar desde fora funció
            var out = this;
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this task!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                  },
                  function(){
                    swal("Deleted!", "Your task has been deleted.", "success");
                    out.todos.splice(this.id, 1);
                    out.deleteTodoApi(this.idTask);
                    out.fetchPage(out.page);
                  });
            },
        }
    }
    //Afegir icones(edit,eliminar, cancelar(depenent de l'estat editing)).
    //TODO: Afegir un boto o algo agafar(ficar el seu src al js) o millor afegir al package.json per instal·lar el js(si te npm), si no te npm s'agafa el javascript i s'afegeix al general.
    //Fer el v-for només amb un todo (<todo>,</todo>
</script>


