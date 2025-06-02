<?php
// Start session
session_start();

// Destroy all session data
session_destroy();

// Redirect to login page
header("Location: Admin_login.html");
// Optionally, you can also clear the session cookie
// Ensure no further code is executed after the redirect
exit();
?>
