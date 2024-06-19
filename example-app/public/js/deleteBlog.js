// Select all elements with the class 'delete-button' and add an event listener to each
document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function () {
        // Get the blog ID from the data-id attribute of the clicked button
        const blogId = this.getAttribute('data-id');
        
        // Display a confirmation dialog using SweetAlert
        Swal.fire({
            title: 'Are you sure?', // Title of the confirmation dialog
            text: "You won't be able to revert this!", // Text inside the confirmation dialog
            icon: 'warning', // Icon indicating a warning
            showCancelButton: true, // Display the cancel button
            confirmButtonColor: '#3085d6', // Color of the confirm button
            cancelButtonColor: '#d33', // Color of the cancel button
            confirmButtonText: 'Yes, delete it!' // Text inside the confirm button
        }).then((result) => {
            // If the user confirms the deletion
            if (result.isConfirmed) {
                // Send a DELETE request to the server to delete the blog post
                fetch(`/blogDelete/${blogId}`, {
                    method: 'DELETE', // Use DELETE method
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token for security
                        'Content-Type': 'application/json', // Content type
                        'Accept': 'application/json' // Expect a JSON response
                    },
                })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    // If the deletion is successful
                    if (data.success) {
                        // Display a success message using SweetAlert
                        Swal.fire({
                            title: 'Deleted!', // Title of the success dialog
                            text: data.message, // Message inside the success dialog
                            icon: 'success', // Icon indicating success
                            confirmButtonText: 'OK' // Text inside the confirm button
                        }).then(() => {
                            // Remove the corresponding row from the table
                            document.getElementById(`blog-${blogId}`).remove();
                        });
                    } else {
                        // If the deletion fails, display an error message
                        Swal.fire({
                            title: 'Error!', // Title of the error dialog
                            text: data.message, // Message inside the error dialog
                            icon: 'error', // Icon indicating an error
                            confirmButtonText: 'OK' // Text inside the confirm button
                        });
                    }
                })
                .catch(error => {
                    // Catch any network or server errors and display an error message
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!', // Title of the error dialog
                        text: 'Something went wrong!', // Message inside the error dialog
                        icon: 'error', // Icon indicating an error
                        confirmButtonText: 'OK' // Text inside the confirm button
                    });
                });
            }
        });
    });
});
