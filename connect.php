<?php
include "credentials.inc";

// Create connection
$conn = new mysqli($host, $user, $pass, $base);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
