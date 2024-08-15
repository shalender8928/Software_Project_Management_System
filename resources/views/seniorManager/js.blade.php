<script src="{{asset('../assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->

	<!-- the sweet alert cdn link -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
	integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
	 crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Plugin js for this page -->
  <script src="{{asset('../assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{asset('../assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{asset('../assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('../assets/js/template.js')}}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  <script src="../assets/js/dashboard-dark.js"></script>
	<!-- End custom js for this page -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
	integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
	crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
// Inactivity timer
// Inactivity timer
let timeout;

function resetTimer() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        // Send POST request to logout route
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            credentials: 'same-origin', // Include cookies for authentication
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/'; // Redirect to the homepage or login page after logout
            }
        })
        .catch(error => {
            console.error('Logout error:', error);
        });
    }, 1 * 60 * 1000); // 15 minutes for actual use
}

// Attach event listeners to reset the timer
window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;

// Handle browser/tab close
window.addEventListener('beforeunload', function (e) {
    // Optional: display confirmation dialog
    e.preventDefault();
    e.returnValue = ''; // Standard for most browsers
});

</script>