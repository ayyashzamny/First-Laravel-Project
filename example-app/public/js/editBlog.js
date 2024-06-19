document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to edit buttons
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function () {
            // Fill the form in the modal with the blog data
            document.getElementById('blogId').value = this.dataset.id;
            document.getElementById('editTitle').value = this.dataset.title;
            document.getElementById('editContent').value = this.dataset.content;
            // Show the modal
            new bootstrap.Modal(document.getElementById('editBlogModal')).show();
        });
    });

    // Add event listener to the edit form submission
    document.getElementById('editBlogForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form data
        let formData = new FormData(this);
        // Get the blog ID from the hidden input field
        let blogId = document.getElementById('blogId').value;

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
                fetch(`/blog/update/${blogId}`, {
                    method: 'POST', // Use POST method for the update request
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Add CSRF token for security
                        'Accept': 'application/json', // Expect a JSON response
                    },
                    body: formData // Send the form data in the request body
                })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    if (data.success) {
                        // If the update is successful, show a success message using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload(); // Reload the page after success
                        });
                    } else {
                        // If the update fails, show an error message using SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    // Catch any network or server errors and display an error message using SweetAlert
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
});
