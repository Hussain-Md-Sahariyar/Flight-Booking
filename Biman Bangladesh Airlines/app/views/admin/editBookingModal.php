<!-- Bootstrap Modal for Editing Booking -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content text-dark">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editBookingLabel">Edit Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="editBookingForm">
        <div class="modal-body">
          <input type="hidden" name="booking_id" id="booking_id">

          <div class="row">
            <div class="col-md-4">
              <label for="booking_date" class="form-label">Booking Date</label>
              <input type="date" class="form-control" name="booking_date" id="booking_date" required>
            </div>
            <div class="col-md-4">
              <label for="issue_before" class="form-label">Issue Before</label>
              <input type="date" class="form-control" name="issue_before" id="issue_before" required>
            </div>
            <div class="col-md-4">
              <label for="booking_reference" class="form-label">Booking Ref</label>
              <input type="text" class="form-control" name="booking_reference" id="booking_reference">
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-2">
              <label for="title" class="form-label">Title</label>
              <select class="form-select" name="title" id="title">
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
              </select>
            </div>
            <div class="col-md-5">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" class="form-control" name="first_name" id="first_name" required>
            </div>
            <div class="col-md-5">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="last_name" id="last_name" required>
            </div>
            <div class="col-md-4">
              <label for="date_of_birth" class="form-label">DOB</label>
              <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
            </div>
            <div class="col-md-4">
              <label for="passport_no" class="form-label">Passport No</label>
              <input type="text" class="form-control" name="passport_no" id="passport_no" required>
            </div>
            <div class="col-md-4">
              <label for="passport_expiry_date" class="form-label">Passport Expiry</label>
              <input type="date" class="form-control" name="passport_expiry_date" id="passport_expiry_date" required>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-4">
              <label for="flight_no" class="form-label">Flight No</label>
              <input type="text" class="form-control" name="flight_no" id="flight_no" required>
            </div>
            <div class="col-md-4">
              <label for="flying_from" class="form-label">Flying From</label>
              <input type="text" class="form-control" name="flying_from" id="flying_from" required>
            </div>
            <div class="col-md-4">
              <label for="flying_to" class="form-label">Flying To</label>
              <input type="text" class="form-control" name="flying_to" id="flying_to" required>
            </div>
            <div class="col-md-3">
              <label for="departure_city_code" class="form-label">Departure Code</label>
              <input type="text" class="form-control" name="departure_city_code" id="departure_city_code">
            </div>
            <div class="col-md-3">
              <label for="arrival_city_code" class="form-label">Arrival Code</label>
              <input type="text" class="form-control" name="arrival_city_code" id="arrival_city_code">
            </div>
            <div class="col-md-3">
              <label for="departure_terminal" class="form-label">Dep Terminal</label>
              <input type="text" class="form-control" name="departure_terminal" id="departure_terminal">
            </div>
            <div class="col-md-3">
              <label for="arrival_terminal" class="form-label">Arr Terminal</label>
              <input type="text" class="form-control" name="arrival_terminal" id="arrival_terminal">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4">
              <label for="departure_date" class="form-label">Departure Date</label>
              <input type="date" class="form-control" name="departure_date" id="departure_date">
            </div>
            <div class="col-md-4">
              <label for="arrival_date" class="form-label">Arrival Date</label>
              <input type="date" class="form-control" name="arrival_date" id="arrival_date">
            </div>
            <div class="col-md-2">
              <label for="departure_time" class="form-label">Dep Time</label>
              <input type="time" class="form-control" name="departure_time" id="departure_time">
            </div>
            <div class="col-md-2">
              <label for="arrival_time" class="form-label">Arr Time</label>
              <input type="time" class="form-control" name="arrival_time" id="arrival_time">
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-3">
              <label for="class" class="form-label">Class</label>
              <input type="text" class="form-control" name="class" id="class">
            </div>
            <div class="col-md-3">
              <label for="baggage_type" class="form-label">Baggage Type</label>
              <input type="text" class="form-control" name="baggage_type" id="baggage_type">
            </div>
            <div class="col-md-3">
              <label for="check_in_baggage" class="form-label">Check-In Baggage</label>
              <input type="text" class="form-control" name="check_in_baggage" id="check_in_baggage">
            </div>
            <div class="col-md-3">
              <label for="fare_basis" class="form-label">Fare Basis</label>
              <input type="text" class="form-control" name="fare_basis" id="fare_basis">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4">
              <label for="frequent_flyer_airline" class="form-label">FF Airline</label>
              <input type="text" class="form-control" name="frequent_flyer_airline" id="frequent_flyer_airline">
            </div>
            <div class="col-md-4">
              <label for="frequent_flyer_no" class="form-label">FF Number</label>
              <input type="text" class="form-control" name="frequent_flyer_no" id="frequent_flyer_no">
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-3">
              <label for="base_fare" class="form-label">Base Fare</label>
              <input type="number" class="form-control" name="base_fare" id="base_fare">
            </div>
            <div class="col-md-3">
              <label for="taxes" class="form-label">Taxes</label>
              <input type="number" class="form-control" name="taxes" id="taxes">
            </div>
            <div class="col-md-3">
              <label for="price" class="form-label">Total Price</label>
              <input type="number" class="form-control" name="price" id="price">
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-4">
              <label for="country" class="form-label">Country</label>
              <input type="text" class="form-control" name="country" id="country">
            </div>
            <div class="col-md-4">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-md-4">
              <label for="contact" class="form-label">Contact</label>
              <input type="text" class="form-control" name="contact" id="contact">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update Booking</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('editBookingForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch('../controllers/UpdateBookingController.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(response => {
    if (response.trim() === 'success') {
      alert("Booking updated successfully.");
      location.reload();
    } else {
      alert("Update failed: " + response);
    }
  });
});
</script>
