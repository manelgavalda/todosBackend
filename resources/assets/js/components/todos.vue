<template>
    <div>
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Add task</h3>
            </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="#">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter task Name"
                        v-model="newTodo"
                        @keyup.enter="addNewTodo"
                           >
                </div>
            </div>
            <!-- /.box-body -->

            <!--<div class="box-footer">-->
                <!--<button type="submit" class="btn btn-primary">Submit</button>-->
            <!--</div>-->
        </form>
    </div>
            <div class="box-body">
                <div class="btn-group">
                    <button type="button" class="btn btn-default">{{visibility}}</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" v-on:click="setVisibility('all')">All</a></li>
                        <li><a href="#" @click="setVisibility('active')">Active</a></li>
                        <li><a href="#" @click="setVisibility('completed')">Completed</a></li>
                    </ul>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Priority</th>
                        <th>Done</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <td>{{index}}</td>
                        <td>{{todo.name}}</td>
                        <td>{{todo.priority}}</td>
                        <td>{{todo.done}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-red">55%</span></td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
</template>
<style>
</style>
<script>
    export default {
        data() {
            return {
                //message: 'Hola que tal',
                //seen: false,
                todos: [
                ],
                visibility: 'all',// 'active' 'completed'
                newTodo: ''
            }
        },
        computed: {
            filteredTodos: function() {
            var filters = {
                all:function(todos){
                    return todos;
                },
                active:function(todos){
                    return todos.filter(function(todo){
                        return !todo.done;
                    });
                },
                completed:function(todos){
                    return todos.filter(function(todo){
                        return todo.done;
                    });
                }
            }
            //Filters
            //return this.todos;
            //Active
            return filters[this.visibility](this.todos);

            }
        },
        created() {
            console.log('Component todolist created.');
            this.fetchData();
        },
        methods: {
            addNewTodo: function(newTodo) {
                console.log(this.newTodo);
                var value = this.newTodo && this.newTodo.trmim()
                if(!value){
                    return
                }
                this.todos.push({
                name: value,
                priority: 1,
                done:false
                }
                );
            },
            setVisibility: function(visibility) {
                console.log("Han fet click");
                this.visibility=visibility;
            },
            reverseMessage: function() {
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function() {
                // GET /someUrl
                this.$http.get('/api/v1/task').then((response) => {
                    console.log(response);
                    this.todos = response.data.data;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            }
        }
    }
    //TODO: encomptes de ensenyar la llista: fer una taula. El laravel ja te una taula d'exemples afegir simple table(copiar i pegar taulad e dins de pages/table/simple.html(el tenim a node modules, adminlt,pages) i copiar la taula dins la primera table=class i dins el foreach(fiquem els trs de cada tasca(capçalera no). Ficarem name,done,priority.
</script>


