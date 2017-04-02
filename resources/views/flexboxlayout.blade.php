<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>

    header {
        position: fixed;
        background-color: indianred;
        padding:10px;
        margin:10px;
        flex:5;
    }


    .article {
        background-color: lightblue;
        padding:10px;
        margin:10px;
        flex:200px;
    }

    .container {
        display: flex;
        flex-direction: row;
    }

    footer {
        border: solid black 1px;
        position: fixed;
        bottom:0px;
        height: 50px;
        width: 100%;
        background-color: #00a7d0;
    }

    nav {
        position: absolute;
        left:0px;
        width: 200px;
        border: solid black 1px;
        background-color: #00e765;
        display: none;
    }

</style>
<body>

<header>Header</header>

<nav>
    <ul>
        <li>Link1</li>
        <li>Link2</li>
        <li>Link3</li>
        <li>Contact</li>
        <li>About</li>
    </ul>
</nav>

<section class="flex-column">

<div class="container">

    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>
    <div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, cum debitis dolorem est facilis fugit impedit magnam nulla officia quia quis sequi ullam vel. At id necessitatibus quam vel voluptate.</div>

</div>

<footer>
        @copyright Manel Gavaldà Andreu
</footer>

</body>
</html>