document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editForm');

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const editId = document.getElementById('editId').value;
        const editTitle = document.getElementById('editTitle').value;
        const editContent = document.getElementById('editContent').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show confirmation dialog before submitting the form
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to update this blog post?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the update request
                fetch(`/blog/update/${editId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        title: editTitle,
                        content: editContent
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#editModal').modal('hide'); // Close the modal
                            updateBlogTable(); // re direct to the table page 
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    });

    // Function to update the blog table after successful update
    function updateBlogTable() {
        // Perform any necessary DOM manipulation or reloading of data
        // Example: Reload the page after closing the modal
        location.reload();
    }

    // Populate modal fields when Edit button is clicked
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const blogId = this.getAttribute('data-id');
            const blogTitle = this.getAttribute('data-title');
            const blogContent = this.getAttribute('data-content');

            document.getElementById('editId').value = blogId;
            document.getElementById('editTitle').value = blogTitle;
            document.getElementById('editContent').value = blogContent;
        });
    });
});
