<?php
  // Include the function checkAuthentication()
  include 'authenticate.php';

  $response = checkAuthentication();
  echo json_encode($response);
?>