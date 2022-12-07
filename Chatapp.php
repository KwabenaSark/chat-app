<?php
// Connect to the database
$db = mysqli_connect('localhost', 'user', 'password', 'database_name') or die('Error connecting to MySQL server.');

// Check if the user has submitted their message
if (isset($_POST['submit'])) {
  // Get the submitted message and username
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $message = mysqli_real_escape_string($db, $_POST['message']);

  // Insert the message into the database
  $sql = "INSERT INTO chat (username, message) VALUES ('$username', '$message')";
  mysqli_query($db, $sql);
}
?>
<!-- Chat app interface -->
<h1>Chat App</h1>
<form action="chat.php" method="post">
  <input type="text" name="username" placeholder="Username" required>
  <br>
  <textarea name="message" placeholder="Message" required></textarea>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>
<!-- Display messages from the database -->
<h2>Chat History</h2>
<?php
// Retrieve messages from the database
$sql = "SELECT * FROM chat ORDER BY id ASC";
$result = mysqli_query($db, $sql);
// Loop through the messages and display them
while ($row = mysqli_fetch_array($result)) {
echo "<p><strong>" . $row['username'] . "</strong>: " . $row['message'] . "</p>";
}
?>
