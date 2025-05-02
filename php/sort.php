<?php
// Step 1: Create an array of student names
$students = array("John", "Alice", "Bob", "David", "Sophia");

// Step 2: Display the original array
echo "<h3>Original Array:</h3>";
echo "<pre>";
print_r($students);
echo "</pre>";

// Step 3: Sort in ascending order using asort()
asort($students);
echo "<h3>Sorted in Ascending Order (asort):</h3>";
echo "<pre>";
print_r($students);
echo "</pre>";

// Step 4: Sort in descending order using arsort()
arsort($students);
echo "<h3>Sorted in Descending Order (arsort):</h3>";
echo "<pre>";
print_r($students);
echo "</pre>";
?>