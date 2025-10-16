// Mock job orders data
let jobOrders = [
  {
    id: "JO-2023-001",
    employer: "Al Faisal Hospital",
    country: "Saudi Arabia",
    position: "Registered Nurse",
    vacancies: 25,
    salary: "$1,200 - $1,500",
    status: "Active",
    applicants: 18,
    deadline: "2024-01-30",
    datePosted: "2023-12-01",
    requirements: [
      "Bachelor of Science in Nursing",
      "At least 2 years of hospital experience",
      "PROMETRIC or HAAD exam passer",
      "Valid nursing license",
    ],
    benefits: [
      "Free accommodation",
      "Transportation allowance",
      "Medical insurance",
      "Annual vacation with airfare",
      "30 days paid leave annually",
    ],
    description:
      "Al Faisal Hospital is seeking qualified Registered Nurses to join their expanding healthcare facility in Riyadh, Saudi Arabia. The candidate will be responsible for providing quality nursing care to patients, administering medications, and assisting doctors during procedures.",
    contactPerson: "Mohammed Al-Harbi",
    contactEmail: "recruitment@alfaisalhospital.sa",
    contactPhone: "+966-11-234-5678",
  },
  {
    id: "JO-2023-002",
    employer: "Marina Bay Hotels & Resorts",
    country: "Singapore",
    position: "Hotel Housekeeping Staff",
    vacancies: 15,
    salary: "SGD 1,400 - SGD 1,600",
    status: "Active",
    applicants: 32,
    deadline: "2024-01-15",
    datePosted: "2023-11-25",
    requirements: [
      "High school graduate",
      "At least 1 year experience in hotel housekeeping",
      "Good command of English",
      "Customer service oriented",
    ],
    benefits: [
      "Free meals during duty",
      "Accommodation assistance",
      "Medical benefits",
      "Annual performance bonus",
      "Training opportunities",
    ],
    description:
      "Marina Bay Hotels & Resorts is looking for dedicated Housekeeping Staff to maintain the cleanliness and presentation of our 5-star hotel rooms and facilities. The ideal candidate has attention to detail and excellent customer service skills.",
    contactPerson: "Grace Lim",
    contactEmail: "careers@marinabayhotels.sg",
    contactPhone: "+65-6789-1234",
  },
];

let filteredJobs = [...jobOrders];
let currentFilter = "all";
let searchTerm = "";
let editingJobId = null;

const jobTableBody = document.querySelector("#jobTable tbody");
const filterButtons = document.querySelectorAll(".filter-btn");
const jobSearchInput = document.getElementById("searchInput");
const modalOverlay = document.getElementById("modalOverlay");
const modalContent = document.getElementById("modalContent");
const modalClose = document.getElementById("modalClose");
const btnAddJob = document.getElementById("btnAddJob");
const modalAddEditOverlay = document.getElementById("modalAddEditOverlay");
const modalAddEditClose = document.getElementById("modalAddEditClose");
const jobForm = document.getElementById("jobForm");
const cancelAddEdit = document.getElementById("cancelAddEdit");
const modalAddEditTitle = document.getElementById("modalAddEditTitle");
const submitJobBtn = document.getElementById("submitJobBtn");

// create status
function createStatusBadge(status) {
  const span = document.createElement("span");
  span.classList.add("badge");
  if (status.toLowerCase() === "active") {
    span.classList.add("badge-active");
    span.textContent = "Active";
  } else if (status.toLowerCase() === "pending approval") {
    span.classList.add("badge-pending");
    span.textContent = "Pending Approval";
  } else {
    span.classList.add("badge-closed");
    span.textContent = "Closed";
  }
  return span;
}

// Render job orders table rows
function renderJobTable() {
  jobTableBody.innerHTML = "";
  filteredJobs.forEach((job) => {
    const tr = document.createElement("tr");
    tr.classList.add("cursor-pointer");
    tr.addEventListener("click", () => openJobDetails(job.id));

    tr.innerHTML = `
                <td>${job.id}</td>
                <td>${job.position}</td>
                <td>${job.employer}</td>
                <td>${job.country}</td>
                <td>${job.vacancies}</td>
                <td></td>
                <td>${job.deadline}</td>
                <td><button class="btn btn-secondary btn-view" data-id="${job.id}">View</button></td>
              `;

    // Insert status badge
    const statusTd = tr.children[5];
    statusTd.appendChild(createStatusBadge(job.status));

    // Prevent row click when clicking the button
    tr.querySelector(".btn-view").addEventListener("click", (e) => {
      e.stopPropagation();
      openJobDetails(job.id);
    });

    jobTableBody.appendChild(tr);
  });
}

// Filter and search jobs
function filterAndSearchJobs() {
  filteredJobs = jobOrders.filter((job) => {
    if (currentFilter !== "all" && job.status.toLowerCase() !== currentFilter) {
      return false;
    }
    if (searchTerm) {
      const term = searchTerm.toLowerCase();
      return (
        job.position.toLowerCase().includes(term) ||
        job.employer.toLowerCase().includes(term) ||
        job.country.toLowerCase().includes(term)
      );
    }
    return true;
  });
  renderJobTable();
}

// Open job details modal
function openJobDetails(jobId) {
  const job = jobOrders.find((j) => j.id === jobId);
  if (!job) return;
  modalContent.innerHTML = `
              <h3>${job.position} - ${job.employer}</h3>
              <p><strong>Location:</strong> ${job.country}</p>
              <p><strong>Vacancies:</strong> ${job.vacancies}</p>
              <p><strong>Salary:</strong> ${job.salary}</p>
              <p><strong>Status:</strong> ${job.status}</p>
              <p><strong>Deadline:</strong> ${job.deadline}</p>
              <h4>Description</h4>
              <p>${job.description}</p>
              <h4>Requirements</h4>
              <ul>${job.requirements.map((r) => `<li>${r}</li>`).join("")}</ul>
              <h4>Benefits</h4>
              <ul>${job.benefits.map((b) => `<li>${b}</li>`).join("")}</ul>
              <h4>Contact Information</h4>
              <p><strong>Person:</strong> ${job.contactPerson}</p>
              <p><strong>Email:</strong> ${job.contactEmail}</p>
              <p><strong>Phone:</strong> ${job.contactPhone}</p>
            `;
  modalOverlay.classList.add("active");
}

// Close modals
function closeModal() {
  modalOverlay.classList.remove("active");
  modalAddEditOverlay.classList.remove("active");
  editingJobId = null;
  jobForm.reset();
  modalAddEditTitle.textContent = "Add New Job Order";
  submitJobBtn.textContent = "Create Job Order";
}

// Open add/edit modal
function openAddEditModal(editJob = null) {
  if (editJob) {
    editingJobId = editJob.id;
    modalAddEditTitle.textContent = "Edit Job Order";
    submitJobBtn.textContent = "Update Job Order";
    jobForm.position.value = editJob.position;
    jobForm.employer.value = editJob.employer;
    jobForm.country.value = editJob.country;
    jobForm.salary.value = editJob.salary;
    jobForm.vacancies.value = editJob.vacancies;
    jobForm.deadline.value = editJob.deadline;
    jobForm.status.value = editJob.status;
    jobForm.description.value = editJob.description;
    jobForm.contactPerson.value = editJob.contactPerson;
    jobForm.contactEmail.value = editJob.contactEmail;
    jobForm.contactPhone.value = editJob.contactPhone;
  } else {
    editingJobId = null;
    jobForm.reset();
    modalAddEditTitle.textContent = "Add New Job Order";
    submitJobBtn.textContent = "Create Job Order";
  }
  modalAddEditOverlay.classList.add("active");
}

// Event listeners
filterButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    filterButtons.forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
    currentFilter = btn.dataset.filter.toLowerCase();
    filterAndSearchJobs();
  });
});

jobSearchInput.addEventListener("input", (e) => {
  searchTerm = e.target.value;
  filterAndSearchJobs();
});

modalClose.addEventListener("click", closeModal);
modalOverlay.addEventListener("click", (e) => {
  if (e.target === modalOverlay) closeModal();
});

btnAddJob.addEventListener("click", () => openAddEditModal());
modalAddEditClose.addEventListener("click", closeModal);
cancelAddEdit.addEventListener("click", closeModal);
modalAddEditOverlay.addEventListener("click", (e) => {
  if (e.target === modalAddEditOverlay) closeModal();
});

jobForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const newJob = {
    id: editingJobId ? editingJobId : `JO-${Date.now()}`,
    position: jobForm.position.value,
    employer: jobForm.employer.value,
    country: jobForm.country.value,
    salary: jobForm.salary.value,
    vacancies: parseInt(jobForm.vacancies.value, 10),
    status: jobForm.status.value,
    deadline: jobForm.deadline.value,
    description: jobForm.description.value,
    contactPerson: jobForm.contactPerson.value,
    contactEmail: jobForm.contactEmail.value,
    contactPhone: jobForm.contactPhone.value,
    requirements: [],
    benefits: [],
    applicants: 0,
    datePosted: new Date().toISOString().split("T")[0],
  };
  if (editingJobId) {
    const idx = jobOrders.findIndex((j) => j.id === editingJobId);
    if (idx !== -1) jobOrders[idx] = newJob;
  } else {
    jobOrders.push(newJob);
  }
  filterAndSearchJobs();
  closeModal();
});

// Initial render
filterAndSearchJobs();
