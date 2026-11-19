<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sok Yi's Post Manager</title>
    <style>
        :root { color-scheme: light; font-family: Arial, sans-serif; color: #1f2937; background: #f3f4f6; }
        body { margin: 0; }
        header { display: flex; align-items: center; gap: 1rem; padding: 1.5rem max(1.5rem, calc((100% - 900px) / 2)); background: #1d4ed8; color: white; }
        header img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; }
        main { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .toolbar, .post, .notice { background: white; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1rem; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; }
        .post h2 { margin-top: 0; }
        .actions { display: flex; gap: .75rem; align-items: center; }
        .button { display: inline-block; border: 0; border-radius: 5px; padding: .6rem .9rem; background: #1d4ed8; color: white; text-decoration: none; cursor: pointer; font: inherit; }
        .button.secondary { background: #4b5563; }
        .button.danger { background: #b91c1c; }
        .pagination { display: flex; gap: .75rem; justify-content: center; margin: 1.5rem 0; }
        .empty { color: #6b7280; }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('images/profile.jpg') }}" alt="Sok Yi's profile picture">
        <h1>Welcome to Sok Yi's Post Manager</h1>
    </header>
    <main>
        @if (session('success'))
            <div class="notice" role="status">{{ session('success') }}</div>
        @endif
        <section class="toolbar">
            <h2>Posts</h2>
            <a class="button" href="{{ route('posts.create') }}">Create post</a>
        </section>

        @forelse ($posts as $post)
            <article class="post">
                <h2>{{ $post->title }}</h2>
                <p>{!! nl2br(e($post->body)) !!}</p>
                <div class="actions">
                    <a class="button secondary" href="{{ route('posts.edit', $post) }}">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button class="button danger" type="submit">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="post empty">No posts yet. Create your first post.</p>
        @endforelse

        <nav class="pagination" aria-label="Pagination">
            {{ $posts->links() }}
        </nav>
    </main>
</body>
</html>
