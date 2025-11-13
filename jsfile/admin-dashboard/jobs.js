// jsfile/admin-dashboard/jobs.js

// Get the base URL dynamically
function getBaseUrl() {
    // Remove the filename and get the directory path
    const path = window.location.pathname;
    const directory = path.substring(0, path.lastIndexOf('/'));
    return window.location.origin + directory;
}

function getApiUrl(endpoint) {
    return `${getBaseUrl()}/php/admin/${endpoint}`;
}

// Global variable to track modal state
let currentModal = null;

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing job orders...');
    initializeJobOrders();
});

function initializeJobOrders() {
    loadJobOrders();
    
    // Add event listeners for filter buttons
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            // Add active class to clicked button
            this.classList.add('active');
            
            // Apply filter
            const filter = this.getAttribute('data-filter');
            filterJobOrders(filter);
        });
    });
    
    // Add event listener for search input
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchJobOrders(this.value);
        });
    }
    
    // Initialize modal with proper event listeners
    initializeModal();
}

function initializeModal() {
    const modalElement = document.getElementById('jobModal');
    if (!modalElement) return;
    
    // Remove any existing event listeners
    modalElement.removeEventListener('hidden.bs.modal', handleModalHide);
    modalElement.removeEventListener('show.bs.modal', handleModalShow);
    
    // Add new event listeners
    modalElement.addEventListener('hidden.bs.modal', handleModalHide);
    modalElement.addEventListener('show.bs.modal', handleModalShow);
}

function handleModalShow() {
    console.log('Modal shown');
    // Store reference to current modal
    currentModal = bootstrap.Modal.getInstance(document.getElementById('jobModal'));
}

function handleModalHide() {
    console.log('Modal hidden - cleaning up');
    cleanupModal();
}

function cleanupModal() {
    // Remove modal backdrop if it exists
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => {
        backdrop.remove();
    });
    
    // Remove modal-open class from body
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    
    // Reset current modal reference
    currentModal = null;
    
    console.log('Modal cleanup completed');
}

function loadJobOrders() {
    console.log('Loading job orders...');
    
    const fetchUrl = getApiUrl('joborder_fetch.php');
    console.log('Fetching from:', fetchUrl);
    
    fetch(fetchUrl)
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            
            if (data.error) {
                console.error('Server error:', data.error);
                showError('Error: ' + data.error);
                return;
            }
            
            if (data.message) {
                console.log('Message:', data.message);
                showMessage(data.message);
                return;
            }
            
            // Store the data for filtering
            window.jobOrdersData = data;
            populateTable(data);
        })
        .catch(error => {
            console.error('Error fetching job orders:', error);
            showError('Error loading job orders: ' + error.message);
        });
}

function populateTable(jobs) {
    const tbody = document.querySelector('#jobTable tbody');
    if (!tbody) {
        console.error('Table body not found');
        return;
    }
    
    tbody.innerHTML = '';

    if (jobs.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center text-muted">
                    No job orders found
                </td>
            </tr>
        `;
        return;
    }

    jobs.forEach(job => {
        const row = document.createElement('tr');
        
        // Format deadline date
        const deadline = new Date(job.application_deadline);
        const formattedDeadline = deadline.toLocaleDateString();
        
        // Determine status badge class
        let statusClass = 'badge bg-secondary';
        if (job.status === 'active') {
            statusClass = 'badge bg-success';
        } else if (job.status === 'pending approval') {
            statusClass = 'badge bg-warning';
        } else if (job.status === 'closed') {
            statusClass = 'badge bg-danger';
        }

        row.innerHTML = `
            <td>${job.JobOrder_id}</td>
            <td>${job.position_title}</td>
            <td>${job.employer_company}</td>
            <td>${job.country}</td>
            <td>${job.no_vacancies}</td>
            <td><span class="${statusClass}">${job.status}</span></td>
            <td>${formattedDeadline}</td>
            <td>
                <button class="btn btn-primary btn-sm view-btn" data-job-id="${job.JobOrder_id}">
                    View
                </button>
            </td>
        `;
        
        tbody.appendChild(row);
    });

    // Add event listeners to view buttons
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            const jobId = this.getAttribute('data-job-id');
            showJobDetails(jobId);
        });
    });
    
    console.log('Table populated with', jobs.length, 'jobs');
}

function filterJobOrders(filter) {
    if (!window.jobOrdersData) return;
    
    let filteredJobs = window.jobOrdersData;
    
    if (filter !== 'all') {
        filteredJobs = window.jobOrdersData.filter(job => 
            job.status.toLowerCase() === filter.toLowerCase()
        );
    }
    
    populateTable(filteredJobs);
}

function searchJobOrders(searchTerm) {
    if (!window.jobOrdersData) return;
    
    if (searchTerm.trim() === '') {
        populateTable(window.jobOrdersData);
        return;
    }
    
    const filteredJobs = window.jobOrdersData.filter(job => 
        job.position_title.toLowerCase().includes(searchTerm.toLowerCase()) ||
        job.employer_company.toLowerCase().includes(searchTerm.toLowerCase()) ||
        job.country.toLowerCase().includes(searchTerm.toLowerCase()) ||
        job.JobOrder_id.toString().includes(searchTerm)
    );
    
    populateTable(filteredJobs);
}

function showError(message) {
    const tbody = document.querySelector('#jobTable tbody');
    if (tbody) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center text-danger">
                    ${message}
                </td>
            </tr>
        `;
    }
}

function showMessage(message) {
    const tbody = document.querySelector('#jobTable tbody');
    if (tbody) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center text-muted">
                    ${message}
                </td>
            </tr>
        `;
    }
}

function showJobDetails(jobId) {
    console.log('Fetching details for job ID:', jobId);
    
    // Ensure any existing modal is properly closed first
    if (currentModal) {
        currentModal.hide();
        cleanupModal();
    }
    
    const fetchUrl = getApiUrl(`joborder_get_details.php?job_id=${jobId}`);
    console.log('Fetching details from:', fetchUrl);
    
    fetch(fetchUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(job => {
            console.log('Job details received:', job);
            
            if (job.error) {
                console.error('Error:', job.error);
                alert('Error loading job details: ' + job.error);
                return;
            }
            populateModal(job);
        })
        .catch(error => {
            console.error('Error fetching job details:', error);
            alert('Error loading job details');
        });
}

function populateModal(job) {
    // Format dates
    const deadline = new Date(job.application_deadline);
    const formattedDeadline = deadline.toLocaleDateString();
                                                                           
    // Format salary
    const formattedSalary = job.salary ? `$${job.salary.toLocaleString()}` : 'Not specified';
    
    // Determine status badge class
    let statusClass = 'badge bg-secondary';
    let statusText = job.status || 'Unknown';
    if (job.status === 'active') {
        statusClass = 'badge bg-success';
        statusText = 'Active';
    } else if (job.status === 'pending approval') {
        statusClass = 'badge bg-warning';
        statusText = 'Pending Approval';
    } else if (job.status === 'closed') {
        statusClass = 'badge bg-danger';
        statusText = 'Closed';
    }
    
    // Populate modal content
    document.getElementById('modalJobTitle').textContent = job.position_title || 'N/A';
    document.getElementById('modalEmployer').textContent = job.employer_company || 'N/A';
    document.getElementById('modalLocation').textContent = job.country || 'N/A';
    document.getElementById('modalSalary').textContent = formattedSalary;
    document.getElementById('modalVacancies').textContent = job.no_vacancies || 'N/A';
    document.getElementById('modalDeadline').textContent = formattedDeadline;
    document.getElementById('modalDescription').textContent = job.job_description || 'No description available';
    document.getElementById('modalContactPerson').textContent = job.contact_person || 'N/A';
    document.getElementById('modalContactEmail').textContent = job.contact_email || 'N/A';
    document.getElementById('modalContactPhone').textContent = job.contact_phone || 'N/A';
    
    // Update status in modal
    const statusElement = document.querySelector('#jobModal .job-detail-value .badge');
    if (statusElement) {
        statusElement.className = statusClass;
        statusElement.textContent = statusText;
    }
    
    // Show modal
    const modalElement = document.getElementById('jobModal');
    const jobModal = new bootstrap.Modal(modalElement);
    jobModal.show();
    
    console.log('Modal populated with job details');
}

// Add emergency cleanup function that can be called manually
window.cleanupAllModals = function() {
    console.log('Emergency modal cleanup');
    cleanupModal();
    
    // Force close any Bootstrap modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) {
            bsModal.hide();
        }
    });
    
    // Additional cleanup
    document.body.classList.remove('modal-open');
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => backdrop.remove());
};