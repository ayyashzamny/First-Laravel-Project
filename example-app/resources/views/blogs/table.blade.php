<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger</title>
    <link rel="stylesheet" href="/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Navbar -->
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
                    <!-- Navigation Links -->
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('blog.index') }}">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.post') }}">Add New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blog.show') }}">Table</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-5">
        <!-- Display Session Message -->
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <!-- Blog Posts Table -->
        <section>
            <h1 class="mb-4">Blog Posts Table</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Posted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr id="blog-{{ $blog->id }}">
                            <!-- Display Blog Post Data -->
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->content }}</td>
                            <td>{{ $blog->updated_at }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#" class="btn btn-success btn-sm edit-button" data-id="{{ $blog->id }}"
                                    data-title="{{ $blog->title }}" data-content="{{ $blog->content }}">Edit</a>
                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm delete-button"
                                    data-id="{{ $blog->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Edit Form -->
                <form id="editForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Blog Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden Field for Blog ID -->
                        <input type="hidden" id="editId" name="editId">
                        <div class="mb-3">
                            <!-- Edit Title Input -->
                            <label for="editTitle" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="editTitle" name="editTitle">
                        </div>
                        <div class="mb-3">
                            <!-- Edit Content Textarea -->
                            <label for="editContent" class="col-form-label">Content:</label>
                            <textarea class="form-control" id="editContent" name="editContent" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Close Modal Button -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Update Button -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="/js/editBlogTable.js"></script>
    <script src="/js/deleteBlog.js"></script>
</body>

</html>