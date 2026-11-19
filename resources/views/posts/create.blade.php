<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a post</title>
    <style>
        body { max-width: 760px; margin: 2rem auto; padding: 0 1rem; font-family: Arial, sans-serif; color: #1f2937; }
        label { display: block; margin: 1rem 0 .4rem; font-weight: bold; }
        input, textarea { box-sizing: border-box; width: 100%; padding: .7rem; border: 1px solid #9ca3af; border-radius: 5px; font: inherit; }
        textarea { min-height: 220px; resize: vertical; }
        .button { display: inline-block; margin-top: 1rem; padding: .65rem 1rem; border: 0; border-radius: 5px; background: #1d4ed8; color: white; text-decoration: none; cursor: pointer; font: inherit; }
        .error { color: #b91c1c; }
    </style>
</head>
<body>
    <h1>Create a post</h1>
    @if ($errors->any())
        <div class="error" role="alert">
            <p>Please correct the following:</p>
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input id="title" name="title" type="text" value="{{ old('title') }}" maxlength="255" required>
        <label for="body">Body</label>
        <textarea id="body" name="body" required>{{ old('body') }}</textarea>
        <button class="button" type="submit">Save post</button>
        <a class="button" href="{{ route('posts.index') }}">Cancel</a>
    </form>
</body>
</html>
