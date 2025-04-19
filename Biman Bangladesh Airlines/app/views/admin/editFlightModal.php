<form id="editFlightForm" action="../controllers/UpdateFlightController.php" method="POST">
    <input type="hidden" name="flight_no" id="edit_flight_no">
    <input type="hidden" name="departure_date" id="edit_departure_date">

    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Flying From</label>
            <input type="text" class="form-control" name="flying_from" id="edit_flying_from" required>
        </div>
        <div class="form-group col-md-4">
            <label>Flying To</label>
            <input type="text" class="form-control" name="flying_to" id="edit_flying_to" required>
        </div>
        <div class="form-group col-md-4">
            <label>Departure Time</label>
            <input type="time" class="form-control" name="departure_time" id="edit_departure_time" required>
        </div>
    </div>

    <!-- Additional fields: airport, terminal, aircraft, price, etc. -->

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Flight</button>
    </div>
</form>
