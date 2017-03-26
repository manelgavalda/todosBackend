<style>
</style>
<template>
    <tr>
         <td>{{ index + from }}</td>
            <td>
                <span v-if="!editingName"  @dblclick="editName" >{{todo.name}}</span>
                <span v-else @keyup.enter="editName">
                                <input class="form-control" v-focus v-model="todo.name" size="50" @keyup.enter="saveName" @keyup.esc="unneditName"></span>
                <i class="fa fa-edit" style="font-size:20px;color:blue;" aria-hidden="true" v-show="!editingName" @click="editName"/>
                <i class="fa fa-check" style="font-size:20px;color:green;" aria-hidden="true" v-show="editingName" @click="saveName"/>
                <i class="fa fa-close" style="font-size:20px;color:red;" aria-hidden="true" v-show="editingName" @click="unneditName"/>
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
                <span v-if="todo.done">
                    <input type="checkbox" checked="true" class="flat-red" @click="setDone(false)">
                </span>
                <span v-else>
                    <input type="checkbox" class="flat-red"  @click="setDone(true)">
                </span>
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
                return this.editingName = true;
            },
            editTodo: function() {
                return this.editingName = true;
            },
            unneditName: function() {
                return this.editingName = false;
            },
            saveName: function() {
                this.editTodoApi();
                return this.editingName = false;
            },
            //Priority methods:
            setPriority: function(priority) {
                this.todo.priority=priority;
                this.editTodoApi();
            },
            //Done methods:
            setDone: function(done) {
            this.todo.done=done;
            this.editTodoApi();
            },
            //Fer peticions al editar.
            editTodoApi: function() {
                axios.put(this.uri +'/'+this.todo.id,{
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
            //No puc usar nom delete perquè és un keyword de javascript.
            deleteTodo: function(index,id) {
                console.log("Deleting todo");
                //Per enviarli al pare.
                this.$emit('todo-deleted',index,id);
            }
        },
        directives: {
          focus: {
            // directive definition
              inserted: function (el) {
                // Focus the element
                el.focus()
              }
          }
        }
    }
</script>


