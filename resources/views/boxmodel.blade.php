<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<style>

    *
    {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    #bloc1
    {
        position: static;
        max-width: 600px;
        margin: 20px auto;
        border: solid darkred 10px;
        box-sizing: border-box;
    }

    #bloc2
    {
        position: relative;
        top: -50px;
        max-width: 600px;
        margin: 20px auto;
        padding: 50px;
        border: solid blue 10px;
        box-sizing: border-box;
    }

</style>

<div id="bloc1">
	<span>Això és una prova inline</span>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto assumenda eaque fugit itaque maxime nostrum numquam officia, sint voluptatem voluptates. Beatae doloremque eius iste officia praesentium qui quibusdam quisquam. Incidunt.
</div>
<div id="bloc2">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad commodi dolorem facilis illum mollitia quae quisquam quo repudiandae sed vero? Assumenda aut dolore doloremque harum in magni minima neque rem.
</div>

</body>
</html>