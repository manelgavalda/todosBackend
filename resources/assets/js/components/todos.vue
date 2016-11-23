<template>
    <div>
        <p v-show="seen">{{message}}</p>
        <input type="text" v-model="message">
        <button v-on:click="reverseMessage">Reverse</button>

        <!--<ol>-->
            <!--<li v-for="todo in todos">{{todo.name}} | {{todo.priority}} | {{todo.done}}</li>-->
        <!--</ol>-->



        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">#</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Done</th>
                <th>Progress</th>
                <th style="width: 40px">Label</th>
            </tr>
            <tr v-for="todo in todos">
                <td>#</td>
                <td>{{todo.name}}</td>
                <td>{{todo.priotity}}</td>
                <td>{{todo.done}}</td>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                <td><span class="badge bg-red">55%</span></td>
            </tr>
        </table>
    </div>


</template>
<style>
</style>
<script>
    export default {
        data() {
            return {
                message: 'Hola que tal',
                seen: false,
                todos: [
                ],
            }
        },
        created() {
            console.log('Component todolist created.');
            this.fetchData();
        },
        methods: {
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


