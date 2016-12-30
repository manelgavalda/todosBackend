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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <todo v-for="(todo, index) in filteredTodos"
                      v-bind:todo="todo"
                      v-bind:index="index"
                      v-bind:from="from"
                      @todo-deleted="deleteTodo">
                </todo>
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries </span>

        <pagination
                :current-page="page"
                :total-items="total"
                @page-changed="pageChanged">
        </pagination>


    </div>
    </div>
        </div>
</template>
<script>
import Pagination from './pagination.vue'

import Todo from './todo.vue'

export default {
        components : {Pagination,Todo},
        data() {
            return {
                uri: '/api/v1/task',
                editing :false,
                todos: [
                ],
                visibility: 'all',// 'active' 'completed'
                newTodo: '',
                perPage: 5,
                from: 0,
                to: 0,
                total: 0,
                page: 1
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
            return filters[this.visibility](this.todos);

            }
        },
        created() {
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
                    priority: 1,
                    done: false,
                    user_id: 1
                };
                this.filteredTodos.push(todo);
                this.newTodo = '';
                this.addTodoApi(todo);
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
            addTodoApi: function(todo) {
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
            },
            fetchPage: function(page) {
                this.$http.get(this.uri+'?page=' + page).then((response) => {
                    this.todos = response.data.data;
                    this.perPage = response.data.per_page;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            deleteTodo: function(index,id) {
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
                    out.deleteTodoApi(id);
                    out.fetchPage(out.page);
                  });
            },
            deleteTodoApi: function(id) {
                this.$http.delete(this.uri + '/' + id).then((response) => {
                    console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
        }
    }
    //TODO: Afegir un boto o algo agafar(ficar el seu src al js) o millor afegir al package.json per instal·lar el js(si te npm), si no te npm s'agafa el javascript i s'afegeix al general.
    //TODO: Al editar que estigue seleccionat i amb el focus.
</script>


