<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
<div class="container">
    <div class="columns">
        <div class="column is-4-desktop is-offset-4-desktop">
            <form>
                <input type="text" class="input" value=""/>
                <input type="submit" class="button is-success is-fullwidth" value="Add Todo"/>
            </form>

            <div class="todo-list">
                <div class="card">
                    <h4>@{{ todo.todo }}</h4>
                    <p>@{{ todo.created_at }}</p>
                    <button class="button is-small is-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>