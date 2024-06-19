<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger</title>

    <!-- Linking CSS files for styling -->
    <link rel="stylesheet" href="/css/index.css">

    <!-- Bootstrap CSS for styling and responsiveness -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- SweetAlert2 for alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSRF Token for secure requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Bootstrap JS for functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

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
                        <a class="nav-link active" aria-current="page" href="{{ route('blog.index') }}">All Posts</a>
                    </li>
                    <!-- Link to Add New Post -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.post') }}">Add New</a>
                    </li>
                    <!-- Link to Table View -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog.show')}}">Table</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="container mt-5">
        <!-- Display Success Message if exists -->
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <!-- Blog Posts Section -->
        <section class="row">
            @foreach ($blogs as $blog)
                <article class="col-md-4 mb-4" id="blog-{{ $blog->id }}">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $blog->content }}</p>
                            <!-- Edit Button -->
                            <button class="btn btn-success btn-sm edit-button" data-id="{{ $blog->id }}"
                                data-title="{{ $blog->title }}" data-content="{{ $blog->content }}">Edit</button>
                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm delete-button" data-id="{{ $blog->id }}">Delete</button>
                        </div>
                        <div class="card-footer text-muted">Posted On: {{ $blog->updated_at }}</div>
                    </div>
                </article>
            @endforeach
        </section>
    </main>

    <!-- Edit Modal -->
    <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Blog Form -->
                    <form id="editBlogForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="blogId" name="id">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title:</label>
                            <input type="text" id="editTitle" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editContent" class="form-label">Content:</label>
                            <textarea id="editContent" name="content" rows="8" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript file for handling functionality -->
    <script src="/js/editBlog.js"></script>
    <script src="/js/deleteBlog.js"></script>
</body>

</html>