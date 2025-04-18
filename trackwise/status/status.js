document.getElementById("checkStatusBtn").addEventListener("click", async () => {
    const trainNumber = document.getElementById("trainNumberInput").value.trim();
    if (!trainNumber) return alert("Please enter a train number");
  
    try {
      const response = await fetch(`../api/get_train_status.php?train=${trainNumber}`);
      const data = await response.json();
  
      if (data.error) {
        alert(data.error);
        return;
      }
  
      // Update UI
      document.getElementById("trainName").textContent = 
        `${data.train_name} (${data.train_number})`;
      document.getElementById("currentStation").textContent = data.station_name;
      
      const statusBadge = document.getElementById("statusBadge");
      statusBadge.textContent = data.status;
      statusBadge.className = data.status.toLowerCase().replace(" ", "-");
  
      document.getElementById("lastUpdate").textContent = data.last_update;
      document.getElementById("trainStatusResult").style.display = "block";
    } catch (error) {
      console.error("Fetch error:", error);
      alert("Failed to fetch status. Please try again.");
    }
  });