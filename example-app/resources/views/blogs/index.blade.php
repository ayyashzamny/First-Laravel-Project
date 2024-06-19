<!-- resources/views/blog/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger</title>
    <link rel="stylesheet" href="styles/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blogger</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('blog.index')}}">All Posts</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog.post')}}">Add New</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="container mt-5">
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <section class="row">
            @foreach ($blogs as $blog)
                <article class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $blog->content }}</p>
                            <a href="{{ route('blog.edit', ['blog' => $blog]) }}" class="btn btn-success btn-sm">Edit</a>

                            <form action="{{ route('blog.destroy', ['blog' => $blog]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">Posted On: {{ $blog->updated_at }}</div>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
</body>

</html>