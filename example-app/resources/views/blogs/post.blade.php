<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post Form</title>
    <link rel="stylesheet" href="Styles/newPost.css">
    <link rel="stylesheet" href="Styles/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <a class="nav-link " aria-current="page" href="{{ route('blog.index') }}">All Posts</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blog.post') }}">Add New</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog.show')}}">Table</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="blog-post-form">
                    <h1>Create a New Blog Post</h1>
                    <div>
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <form id="blogForm">
                        @csrf
                        <label for="postTitle">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>

                        <label for="postContent">Content:</label>
                        <textarea id="content" name="content" rows="8" class="form-control" placeholder="Content"
                            required></textarea>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-3 ms-2">Clear</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="/js/blogForm.js"></script>
</body>

</html>