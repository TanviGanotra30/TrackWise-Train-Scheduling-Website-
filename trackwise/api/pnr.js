document.getElementById("checkPnrBtn").addEventListener("click", async () => {
    const pnr = document.getElementById("pnrInput").value.trim();
    if (!pnr) return alert("Please enter a PNR number");
  
    try {
      const response = await fetch(`../api/get_pnr_status.php?pnr=${pnr}`);
      const data = await response.json();
  
      if (data.error) {
        alert(data.error);
        return;
      }
  
      // Update UI
      document.getElementById("pnrNumber").textContent = data.pnr_number;
      document.getElementById("trainInfo").textContent = 
        `${data.train_name} (${data.train_number})`;
      document.getElementById("routeInfo").textContent = 
        `${data.from_station} → ${data.to_station}`;
      document.getElementById("journeyDate").textContent = data.journey_date;
      document.getElementById("coachSeat").textContent = 
        `${data.coach_type} | ${data.seat_number || 'Not allocated'}`;
      
      const statusElement = document.getElementById("bookingStatus");
      statusElement.textContent = data.booking_status;
      statusElement.className = data.booking_status.toLowerCase();
  
      document.getElementById("pnrResult").style.display = "block";
    } catch (error) {
      console.error("Fetch error:", error);
      alert("Failed to fetch PNR status. Please try again.");
    }
  });