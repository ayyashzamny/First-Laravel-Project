// Add an event listener to the form with the ID 'blogForm'
document.getElementById('blogForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object from the form
    let formData = new FormData(this);

    // Send a POST request to the server to store the blog post
    fetch(`/blogStore`, {
        method: 'POST', // Use POST method
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value, // CSRF token for security
            'Accept': 'application/json', // Expect a JSON response
        },
        body: formData // Send the form data
    })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        // If the blog post is successfully stored
        if (data.success) {
            // Display a success message using SweetAlert
            Swal.fire({
                title: 'Success!', // Title of the success dialog
                text: data.message, // Message inside the success dialog
                icon: 'success', // Icon indicating success
                confirmButtonText: 'OK' // Text inside the confirm button
            }).then(() => {
                // Reset the form after the user clicks OK
                document.getElementById('blogForm').reset();
            });
        } else {
            // If storing the blog post fails, display an error message
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
});
