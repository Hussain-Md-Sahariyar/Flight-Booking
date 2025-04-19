<?php
// From controller: $user contains user profile data
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body { background-color: #121212; color: #e0e0e0; font-family: 'Poppins', sans-serif; }
    .header, .sidebar, .profile-card, .modal-content { background-color: #1f1f1f; }
    .header { padding: 20px 30px; display: flex; justify-content: space-between; }
    .header .btn { background-color: #00bcd4; color: white; }
    .sidebar { position: fixed; top: 80px; left: 0; width: 250px; height: calc(100vh - 80px); padding: 35px; }
    .content { margin-left: 260px; padding: 30px; }
    .profile-card { border-radius: 10px; padding: 30px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .profile-card h5 { color: #00bcd4; }
    .profile-card i { cursor: pointer; }
    .form-control { background-color: #121212; color: #e0e0e0; border: 1px solid #00bcd4; }
  </style>
</head>
<body>

<div class="header">
  <a href="index.php"><img src="images/Biman_Bangladesh_Airlines_Logo.png" width="250"></a>
  <button class="btn" onclick="window.location.href='login.php'">Sign Out</button>
</div>

<div class="sidebar">
  <a href="user.php">My Profile</a>
  <a href="user_booking.php">Bookings</a>
</div>

<div class="content">
  <div class="profile-card">
    <h5>User Information <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#editModal"></i></h5>
    <p><strong>Name:</strong> <?= htmlspecialchars($user['first_name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Contact:</strong> <?= htmlspecialchars($user['phone_number']) ?></p>
    <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editProfileForm">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" value="updateProfile">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($user['first_name']) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" class="form-control" name="contact" value="<?= htmlspecialchars($user['phone_number']) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($user['address']) ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('editProfileForm').addEventListener('submit', function(e) {
  e.preventDefault();
  fetch('controllers/UserController.php', {
    method: 'POST',
    body: new FormData(this)
  })
  .then(res => res.text())
  .then(data => {
    if (data === 'success') {
      alert("Profile updated successfully.");
      location.reload();
    } else {
      alert("Update failed.");
    }
  });
});
</script>

</body>
</html>
