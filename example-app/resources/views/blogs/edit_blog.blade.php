<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post Form</title>
    
    <!-- Linking CSS files for styling -->
    <link rel="stylesheet" href="/css/newPost.css">
    <link rel="stylesheet" href="/css/header.css">
    
    <!-- Bootstrap CSS for styling and responsiveness -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- SweetAlert2 for alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Bootstrap JS for functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="#">Blogger</a>
            <!-- Responsive Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <!-- Link to All Posts -->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('blog.index') }}">All Posts</a>
                    </li>
                    <!-- Link to Add New Post -->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blog.post') }}">Add New</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="blog-post-form">
                    <h1>Edit Blog Post</h1>
                    <!-- Display Validation Errors -->
                    <div>
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Edit Blog Form -->
                    <form id="editBlogForm">
                        @csrf
                        @method('PUT')
                        <!-- Hidden Input for Blog ID -->
                        <input type="hidden" id="blogId" value="{{ $blog->id }}">
                        
                        <!-- Title Input -->
                        <label for="postTitle">Title:</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ $blog->title }}" required>

                        <!-- Content Textarea -->
                        <label for="postContent">Content:</label>
                        <textarea id="content" name="content" rows="8" class="form-control"
                            required>{{ $blog->content }}</textarea>

                        <!-- Update Button -->
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                        <!-- Clear Button -->
                        <button type="reset" class="btn btn-secondary mt-3 ms-2">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Linking JavaScript file for handling form submission -->
    <script src="/js/editBlog.js"></script>
    
</body>

</html>
