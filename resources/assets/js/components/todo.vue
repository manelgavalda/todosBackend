<style>

</style>
<template>
    <div>
     <td>{{ index + from }}</td>
        <td>
            <span v-if="editing==false"  @click="editTodo">{{todo.name}}</span>
            <span v-else @keyup.enter="editTodo" @keyup="resize">
                        <input v-model="todo.name" size='50'></span>
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
    </div>
</template>
<script>

export default {
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
            }
        }
    }
    //Afegir icones(edit,eliminar, cancelar(depenent de l'estat editing)).
    //TODO: Afegir un boto o algo agafar(ficar el seu src al js) o millor afegir al package.json per instal·lar el js(si te npm), si no te npm s'agafa el javascript i s'afegeix al general.
    //Fer el v-for només amb un todo (<todo>,</todo>
</script>


