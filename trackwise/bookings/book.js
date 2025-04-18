document.getElementById("bookingForm").addEventListener("submit", async (e) => {
    e.preventDefault();
  
    const bookingData = {
      user_id: 1, // Replace with actual user ID from session
      train_number: document.getElementById("trainNumber").value,
      from_station: document.getElementById("fromStation").value,
      to_station: document.getElementById("toStation").value,
      journey_date: document.getElementById("journeyDate").value,
      coach_type: document.getElementById("coachType").value
    };
  
    try {
      const response = await fetch("../api/book_ticket.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(bookingData)
      });
  
      const result = await response.json();
  
      if (result.success) {
        document.getElementById("pnrNumber").textContent = result.pnr_number;
        document.getElementById("bookingResult").style.display = "block";
        document.getElementById("bookingForm").reset();
      } else {
        alert(`Error: ${result.error || "Booking failed"}`);
      }
    } catch (error) {
      console.error("Fetch error:", error);
      alert("Network error. Please try again.");
    }
  });