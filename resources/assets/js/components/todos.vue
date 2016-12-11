<style>
</style>
<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add task</h3>
            </div>
        <form role="form" action="#">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter task name"
                        v-model="newTodo"
                        @keyup.enter="addTodo">
                </div>
            </div>
        </form>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tasques</h3>
            <div class="btn-group">
                <button type="button" class="btn btn-default">{{visibility}}</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" @click="setVisibility('all')">All</a></li>
                    <li><a href="#" @click="setVisibility('active')">Active</a></li>
                    <li><a href="#" @click="setVisibility('completed')">Completed</a></li>
                </ul>
            </div>
        </div>
        <div class="box-body">
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
                <td>{{ index + from }}</td>
                <td>
                    <input class="toggle" type="checkbox" v-model="todo.completed">
                    <label @dblclick="editTodo(todo)">{{todo.name}}</label>
                </td>
                <td>{{ todo.priority }}</td>
                <td>{{ todo.done }}</td>
                <td>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                    <input class="edit" type="text" v-model="todo.name" v-todo-focus="todo == editedTodo" @blur="doneEdit(todo)" @keyup.enter="doneEdit(todo)">
                </td>
                <td><span class="badge bg-red">55%</span></td>
            </tr>
            </tbody>

        </table>
    </div>
    <div class="box-footer clearfix">
        <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries </span>

        <pagination
                :current-page="page"
                :items-per-page="perPage"
                :total-items="total"
                @page-changed="pageChanged"></pagination><!--TODO api value-->


    </div>
    </div>
        </div>
</template>
<script>
import Pagination from './pagination.vue'

export default {
        el: '.todoapp',
        components : {Pagination},
        data() {
            return {
                //message: 'Hola que tal',
                //seen: false,
                uri: '/api/v1/task',
                editedTodo : null,
                todos: [
                ],
                visibility: 'all',// 'active' 'completed'
                newTodo: '',
                perPage: 5,
                from: 0,
                to: 0,
                total: 0,
                page: 1,
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
            pageChanged: function(pageNum) {
             this.page=pageNum;
             this.fetchPage(pageNum);
            },
            addTodo: function() {
                var value = this.newTodo && this.newTodo.trim();
                if (!value) {
                    return;
                }
                var todo = {
                    name: value,
                    //Valors per defecte.
                    priority: 1,
                    done: false,
                    user_id: 1 //necessaria.
                };
                this.filteredTodos.push(todo);
                this.newTodo = '';
                this.addTodoToApi(todo);
                //Refrescar pàgina al afegir todo.
                this.fetchPage(this.page);
            },
            setVisibility: function(visibility) {
                this.visibility=visibility;
            },
            reverseMessage: function() {
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function() {
                return this.fetchPage(1);
            },
            addTodoToApi: function(todo) {
                this.$http.post(this.uri, {
                    name: todo.name,
                    priority: todo.priority,
                    done: todo.done
                }).then((response) => {
                console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                //this.fetchPage(this.page);
            },
            fetchPage: function(page) {
                this.$http.get(this.uri+'?page=' + page).then((response) => {
                    console.log(response);
                    this.todos = response.data.data;
                    this.perPage = response.data.per_page;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            //editTodo.
            editTodo: function (todo) {
                this.beforeEditCache = todo.name;
				this.editedTodo = todo;
            },
            doneEdit: function (todo) {
				if (!this.editedTodo) {
					return;
				}
				this.editedTodo = null;
				todo.title = todo.title.trim();
				if (!todo.title) {
					this.removeTodo(todo);
				}
			},
        },
        directives: {
			'todo-focus': function (value) {
				if (!value) {
					return;
				}
				var el = this.el;
				Vue.nextTick(function () {
					el.focus();
				});
            }
        }
    }
    //TODO: encomptes de ensenyar la llista: fer una taula. El laravel ja te una taula d'exemples afegir simple table(copiar i pegar taulad e dins de pages/table/simple.html(el tenim a node modules, adminlt,pages) i copiar la taula dins la primera table=class i dins el foreach(fiquem els trs de cada tasca(capçalera no). Ficarem name,done,priority.
</script>


