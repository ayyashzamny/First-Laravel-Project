document.addEventListener('DOMContentLoaded', function () {
    // Get the edit form element
    const editForm = document.getElementById('editForm');

    // Add submit event listener to the edit form
    editForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Get values from form inputs
        const editId = document.getElementById('editId').value;
        const editTitle = document.getElementById('editTitle').value;
        const editContent = document.getElementById('editContent').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show confirmation dialog using Swal (SweetAlert)
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
                        // If update is successful, show success message
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#editModal').modal('hide'); // Close the modal
                            updateBlogTable(); // Refresh blog table
                        });
                    } else {
                        // If update fails, show error message
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    // Catch any network or server errors
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
        // Reload the page to reflect updated data
        location.reload();
    }

    // Add click event listeners to all elements with class '.edit-button'
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Get data attributes from clicked edit button
            const blogId = this.getAttribute('data-id');
            const blogTitle = this.getAttribute('data-title');
            const blogContent = this.getAttribute('data-content');

            // Set values in edit form fields
            document.getElementById('editId').value = blogId;
            document.getElementById('editTitle').value = blogTitle;
            document.getElementById('editContent').value = blogContent;
        });
    });
});
