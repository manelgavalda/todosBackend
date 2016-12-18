@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Tasks
@endsection


@section('main-content')
	<div id="app">
		<!-- iCheck 1.0.1 -->
		<script src="../../plugins/iCheck/icheck.min.js"></script>
		<todos></todos>
	</div>
@endsection
