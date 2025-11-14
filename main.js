
document.querySelectorAll('.form-box').forEach(form => {
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch(this.dataset.backend, {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      alert(data.message);
      if(this.dataset.clear !== "false") this.reset(); 
      if(data.reload) location.reload(); 
    })
    .catch(err => console.error(err));
  });
});

function searchTable(table, query, callback){
  const formData = new FormData();
  formData.append("table", table);
  formData.append("query", query);

  fetch("backend_get.php", { method:"POST", body: formData })
  .then(res => res.json())
  .then(data => callback(data))
  .catch(err => console.error(err));
}



function deleteRecord(table, id, callback) {
  if(!confirm("Are you sure you want to delete this record?")) return;
  fetch('backend_delete.php', {
    method: 'POST',
    body: new URLSearchParams({ table, id })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    callback(data);
  })
  .catch(err => console.error(err));
}


function editRecord(formElement, record) {
  Object.keys(record).forEach(key => {
    const input = formElement.querySelector(`[name="${key}"]`);
    if(input) input.value = record[key];
  });
  formElement.dataset.backend = formElement.dataset.backend; 
  formElement.dataset.clear = "false"; 
}


function loadBookings(query='') {
  searchTable('bookings', query, data => {
    const container = document.getElementById('bookingResults');
    container.innerHTML = '';
    data.data.forEach(row => {
      container.innerHTML += `<div>
        ${row.name} - ${row.destination} - ${row.date} - ${row.guests}
        <button onclick="deleteRecord('bookings', ${row.id}, d=>{ loadBookings(query); })">Delete</button>
      </div>`;
    });
  });
}

function loadReviews(query='') {
  searchTable('reviews', query, data => {
    const container = document.getElementById('reviewResults');
    container.innerHTML = '';
    data.data.forEach(row => {
      container.innerHTML += `<div>
        ${row.name}: ${row.review}
        <button onclick="deleteRecord('reviews', ${row.id}, d=>{ loadReviews(query); })">Delete</button>
      </div>`;
    });
  });
}


function loadComplaints(query='') {
  searchTable('complaints', query, data => {
    const container = document.getElementById('complaintResults');
    container.innerHTML = '';
    data.data.forEach(row => {
      container.innerHTML += `<div>
        ${row.name} (${row.email}): ${row.complaint}
        <button onclick="deleteRecord('complaints', ${row.id}, d=>{ loadComplaints(query); })">Delete</button>
      </div>`;
    });
  });
}


