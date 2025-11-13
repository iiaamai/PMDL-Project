document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("viewModal");
  const editModal = document.getElementById("editProfileModal");
  const closeBtn = modal.querySelector(".modal-close");
  const closeFooterBtn = modal.querySelector(".btn-close-footer");
  
  // Edit modal elements
  const editCloseBtn = editModal.querySelector(".modal-close");
  const editCloseFooterBtn = editModal.querySelector(".btn-close-footer");
  const editProfileBtn = document.getElementById("editProfileBtn");
  const saveProfileBtn = document.getElementById("saveProfileBtn");
  const editProfileForm = document.getElementById("editProfileForm");

  // Elements inside view modal
  const modalName = document.getElementById("modalName");
  const modalDestination = document.getElementById("modalDestination");
  const modalPosition = document.getElementById("modalPosition");
  const modalStatus = document.getElementById("modalStatus");

  // Tabs
  const tabButtons = modal.querySelectorAll(".tab-button");
  const tabPanes = modal.querySelectorAll(".tab-pane");

  // Current OFW ID
  let currentOfwId = null;

  // ========================
  // TAB SWITCHING FUNCTION
  // ========================
  function setupTabSwitching() {
    tabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        // Remove active state from all buttons and panes
        tabButtons.forEach((b) => b.classList.remove("active"));
        tabPanes.forEach((p) => p.classList.remove("active"));

        // Activate selected tab and pane
        btn.classList.add("active");
        const target = btn.getAttribute("data-tab");
        document.getElementById(target).classList.add("active");
      });
    });
  }

  // Function to reset tabs to default (Documents tab)
  function resetTabsToDefault() {
    tabButtons.forEach((b) => b.classList.remove("active"));
    tabPanes.forEach((p) => p.classList.remove("active"));
    
    // Activate Documents tab
    const documentsTab = modal.querySelector('.tab-button[data-tab="documents"]');
    const documentsPane = document.getElementById("documents");
    
    if (documentsTab && documentsPane) {
      documentsTab.classList.add("active");
      documentsPane.classList.add("active");
    }
  }

  // Initialize tab switching
  setupTabSwitching();

  // ========================
  // VIEW BUTTON CLICK EVENT
  // ========================
  document.querySelectorAll(".viewBtn").forEach((button) => {
    button.addEventListener("click", async () => {
      currentOfwId = button.getAttribute("data-id");

      // Show modal (loading state)
      openModal();
      modalName.textContent = "Loading...";
      modalDestination.textContent = "—";
      modalPosition.textContent = "—";
      modalStatus.textContent = "—";

      // Reset tabs to Documents tab when opening modal
      resetTabsToDefault();

      try {
        // Fetch OFW details from backend
        const response = await fetch("php/admin/ofw_view_details.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: new URLSearchParams({ id: currentOfwId }),
        });

        const data = await response.json();

        if (data.error) {
          modalName.textContent = "Error loading data";
          console.error(data.error);
          return;
        }

        // Populate modal with fetched data
        modalName.textContent = data.Name || "No Name";
        modalDestination.textContent = data.Destination || "—";
        modalPosition.textContent = data.Position || "—";
        modalStatus.textContent = data.Status || "—";

        // Update tab content with the fetched data
        document.getElementById("documentsContent").innerHTML = `<p>Documents for ${data.Name}</p>`;
        document.getElementById("personalContent").innerHTML = `<p>Personal details for ${data.Name}</p>`;
        document.getElementById("employmentContent").innerHTML = `<p>Employment info for ${data.Name}</p>`;

      } catch (err) {
        console.error("Error fetching OFW details:", err);
        modalName.textContent = "Failed to load details";
      }
    });
  });

  // ========================
  // EDIT PROFILE BUTTON CLICK
  // ========================
  editProfileBtn.addEventListener("click", async () => {
    if (!currentOfwId) {
      alert("No OFW ID found. Please view a profile first.");
      return;
    }
    
    console.log("Edit profile clicked for ID:", currentOfwId);
    
    try {
      // Show loading state
      editProfileBtn.textContent = "Loading...";
      editProfileBtn.disabled = true;

      const formData = new URLSearchParams();
      formData.append('id', currentOfwId);

      const response = await fetch("php/admin/ofw_get_full_details.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData
      });

      console.log("Response status:", response.status);
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const text = await response.text();
      console.log("Raw response:", text);
      
      let data;
      try {
        data = JSON.parse(text);
      } catch (e) {
        console.error("JSON parse error:", e);
        throw new Error("Invalid JSON response from server");
      }

      if (data.error) {
        console.error("Server error:", data.error);
        alert("Error loading profile data: " + data.error);
        return;
      }

      // Populate edit form with data
      populateEditForm(data);
      
      // Close view modal and open edit modal
      closeModal();
      openEditModal();
      
    } catch (err) {
      console.error("Error fetching OFW details for editing:", err);
      alert("Failed to load profile data for editing. Check console for details.");
    } finally {
      // Reset button state
      editProfileBtn.textContent = "Edit Profile";
      editProfileBtn.disabled = false;
    }
  });

  // ========================
  // POPULATE EDIT FORM (SIMPLIFIED)
  // ========================
  function populateEditForm(data) {
    console.log("Populating form with data:", data);
    
    // Set the OFW ID
    document.getElementById("editOfwId").value = currentOfwId;
    
    // Worker Type (Editable)
    if (data.worker_type) {
      const radio = document.querySelector(`input[name="worker_type"][value="${data.worker_type}"]`);
      if (radio) radio.checked = true;
    }
    
    // Personal Information (Read-only)
    document.getElementById("editLastName").value = data.Last_Name || data.last_name || "";
    document.getElementById("editFirstName").value = data.First_Name || data.first_name || "";
    document.getElementById("editMiddleName").value = data.Middle_Name || data.middle_name || "";
    document.getElementById("editExtensionName").value = data.Extension_Name || data.extension_name || "";
    document.getElementById("editSex").value = data.Sex || data.sex || "";
    document.getElementById("editCivilStatus").value = data.Civil_Status || data.civil_status || "";
    document.getElementById("editDateOfBirth").value = data.Date_of_Birth || data.date_of_birth || "";
    document.getElementById("editNationality").value = data.Nationality || data.nationality || "";
    
    // Employment Information
    document.getElementById("editDestination").value = data.Destination || data.destination || "";
    document.getElementById("editJob").value = data.Job || data.job || data.Position || data.position || "";
    document.getElementById("editStatus").value = data.Status || data.status || "";
  }

  // ========================
  // SAVE PROFILE CHANGES (SIMPLIFIED)
  // ========================
  saveProfileBtn.addEventListener("click", async () => {
    // Only validate the editable fields
    const workerType = document.querySelector('input[name="worker_type"]:checked');
    const status = document.getElementById("editStatus").value;

    if (!workerType) {
      alert("Please select a worker type.");
      return;
    }

    if (!status) {
      alert("Please select a status.");
      return;
    }

    try {
      const formData = new FormData();
      formData.append('ofw_id', document.getElementById("editOfwId").value);
      formData.append('worker_type', workerType.value);
      formData.append('status', status);
      
      const response = await fetch("php/admin/ofw_update_profile.php", {
        method: "POST",
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        alert("Profile updated successfully!");
        closeEditModal();
        // Refresh the view modal with updated data
        await refreshViewModal();
      } else {
        alert("Error updating profile: " + result.error);
      }
    } catch (err) {
      console.error("Error updating profile:", err);
      alert("Failed to update profile");
    }
  });

  // ========================
  // FORM VALIDATION (SIMPLIFIED)
  // ========================
  function validateForm() {
    const workerType = document.querySelector('input[name="worker_type"]:checked');
    const status = document.getElementById("editStatus").value;
    
    let isValid = true;
    
    if (!workerType) {
      isValid = false;
      // Highlight worker type section
      document.querySelector('.worker-type-container').style.border = '2px solid #f13535';
      document.querySelector('.worker-type-container').style.padding = '10px';
      document.querySelector('.worker-type-container').style.borderRadius = '6px';
    } else {
      document.querySelector('.worker-type-container').style.border = 'none';
      document.querySelector('.worker-type-container').style.padding = '0';
    }
    
    if (!status) {
      isValid = false;
      document.getElementById("editStatus").style.borderColor = '#f13535';
    } else {
      document.getElementById("editStatus").style.borderColor = '#ddd';
    }
    
    return isValid;
  }

  // ========================
  // REFRESH VIEW MODAL
  // ========================
  async function refreshViewModal() {
    if (!currentOfwId) return;
    
    try {
      const response = await fetch("php/admin/ofw_view_details.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ id: currentOfwId }),
      });

      const data = await response.json();

      if (!data.error) {
        // Update view modal with new data
        modalName.textContent = data.Name || "No Name";
        modalDestination.textContent = data.Destination || "—";
        modalPosition.textContent = data.Position || "—";
        modalStatus.textContent = data.Status || "—";
        
        // Reopen the view modal
        openModal();
      }
    } catch (err) {
      console.error("Error refreshing view modal:", err);
    }
  }

  // ========================
  // MODAL CONTROL FUNCTIONS
  // ========================
  function openModal() {
    modal.classList.add("active");
  }

  function closeModal() {
    modal.classList.remove("active");
  }
  
  function openEditModal() {
    editModal.classList.add("active");
  }
  
  function closeEditModal() {
    editModal.classList.remove("active");
  }

  // Close buttons
  closeBtn.addEventListener("click", closeModal);
  closeFooterBtn.addEventListener("click", closeModal);
  editCloseBtn.addEventListener("click", closeEditModal);
  editCloseFooterBtn.addEventListener("click", closeEditModal);

  // Close when clicking outside modal content
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });
  
  editModal.addEventListener("click", (e) => {
    if (e.target === editModal) {
      closeEditModal();
    }
  });

  // Debug function to test the endpoint
  async function testEndpoint() {
    const testId = 1; // Change this to an ID that exists in your database
    console.log("Testing endpoint with ID:", testId);
    
    try {
      const formData = new URLSearchParams();
      formData.append('id', testId);

      const response = await fetch("php/admin/ofw_get_full_details.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData
      });
      
      const text = await response.text();
      console.log("Test response:", text);
    } catch (err) {
      console.error("Test failed:", err);
    }
  }

  // Optional: Call this in your console to test
  // testEndpoint();
});