@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div id="app">
		<!-- Xoca ja que usa el mateix sistema que el laravel v- per vue ng- per angular-->
		<p v-show="seen">@{{message}}</p>
		<input type="text" v-model="message">
		<button v-on:click="reverseMessage">Reverse</button>
		<ol>
			<li v-for="todo in todos">@{{todo.name}} | @{{todo.done}} | @{{todo.priority}}</li>
		</ol>
	</div>
@endsection
