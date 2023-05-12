function SearchUser() {
  const formDefault = document.querySelector('#formDefault');
  formDefault.addEventListener('submit', onSubmit);
  function onSubmit(event) {
    formDefault.removeEventListener('submit', onSubmit);
    event.preventDefault();
    if (document.querySelector('#formDefault').checkValidity()) {
      const formData = new FormData(event.target);
      const email = formData.get('email');
      const password = formData.get('password');

      fetch('/api/user/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          if (data.ok) {
            sessionStorage.setItem('token', data.token);
            window.location.href = 'stocks.php';
          }
          if (data.error) {
            swal(
              'Houston, we have a problem',
              'This user does not exist or the password is invalid',
              'error',
            );
          }
          if (data.error_code) {
            swal(
              'Houston, we have a problem',
              data.message + ' ' + data.error_code,
              'error',
            );
          }
        })
        .catch((error) => console.log(error));
    }
  }
}

function DoLogout() {
  sessionStorage.clear();
  window.location.href = 'logout.php';
}

function CreateUser() {
  const formDefault = document.querySelector('#formDefault');
  formDefault.addEventListener('submit', onSubmit);
  function onSubmit(event) {
    formDefault.removeEventListener('submit', onSubmit);
    event.preventDefault();
    if (document.querySelector('#formDefault').checkValidity()) {
      const formData = new FormData(event.target);
      const name = formData.get('name');
      const email = formData.get('email');
      const password = formData.get('password');

      fetch('/api/user/create', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, email, password }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          if (data.ok) {
            sessionStorage.setItem('token', data.token);
            window.location.href = 'stocks.php';
          }
          if (data.error) {
            swal(
              'Houston, we have a problem',
              'This user already exists',
              'error',
            );
          }
          if (data.error_code) {
            swal(
              'Houston, we have a problem',
              data.message + ' ' + data.error_code,
              'error',
            );
          }
        })
        .catch((error) => console.log(error));
    }
  }
}

function SearchHistory() {
  const formDefault = document.querySelector('#formDefault');
  formDefault.addEventListener('submit', onSubmit);
  function onSubmit(event) {
    formDefault.removeEventListener('submit', onSubmit);
    event.preventDefault();
    if (document.querySelector('#formDefault').checkValidity()) {
      const formData = new FormData(event.target);
      const searchId = formData.get('searchId');

      fetch('/api/history/', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ searchId }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          if (!data.error) {
            const tabla = document.querySelector('#stockTable');
            const tbody = tabla.querySelector('tbody');
            tbody.innerHTML = '';
            const tablaBody = document.querySelector('#table-body');
            data.forEach((row) => {
              const tablaRow = document.createElement('tr');
              const tablaCell1 = document.createElement('td');
              tablaCell1.textContent = row.name;
              const tablaCell2 = document.createElement('td');
              tablaCell2.textContent = row.symbol;
              const tablaCell3 = document.createElement('td');
              tablaCell3.textContent = row.date;
              const tablaCell4 = document.createElement('td');
              tablaCell4.textContent = row.time;
              const tablaCell5 = document.createElement('td');
              tablaCell5.textContent = row.open;
              const tablaCell6 = document.createElement('td');
              tablaCell6.textContent = row.high;
              const tablaCell7 = document.createElement('td');
              tablaCell7.textContent = row.low;
              const tablaCell8 = document.createElement('td');
              tablaCell8.textContent = row.close;
              const tablaCell9 = document.createElement('td');
              tablaCell9.textContent = row.volume;
              const tablaCell10 = document.createElement('td');
              tablaCell10.textContent = row.user_name;
              tablaRow.appendChild(tablaCell1);
              tablaRow.appendChild(tablaCell2);
              tablaRow.appendChild(tablaCell3);
              tablaRow.appendChild(tablaCell4);
              tablaRow.appendChild(tablaCell5);
              tablaRow.appendChild(tablaCell6);
              tablaRow.appendChild(tablaCell7);
              tablaRow.appendChild(tablaCell8);
              tablaRow.appendChild(tablaCell9);
              tablaRow.appendChild(tablaCell10);
              tablaBody.appendChild(tablaRow);
            });
          }
          if (data.error) {
            swal(
              'Houston, we have a problem',
              data.message + ' ' + data.error_code,
              'error',
            );
          }
        })
        .catch((error) => console.log(error));
    }
  }
}

function VerificarToken() {
  const token = sessionStorage.getItem('token');
  if (!token) {
    window.location.href = 'login.php';
  }

  fetch('/api/user/verify', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + token,
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      swal('Welcome', data.name, 'success');
    })
    .catch((error) => {
      console.log(error);
      swal('Houston, we have a problem', 'You must log in to enter', 'error');
      setTimeout(function () {
        window.location.href = 'login.php';
      }, 4000);
    });
}

function SearchStock() {
  const formDefault = document.querySelector('#formDefault');
  formDefault.addEventListener('submit', onSubmit);
  function onSubmit(event) {
    formDefault.removeEventListener('submit', onSubmit);
    event.preventDefault();
    if (document.querySelector('#formDefault').checkValidity()) {
      const formData = new FormData(event.target);
      const searchStock = formData.get('searchStock');
      fetch('/api/stocks/', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ searchStock }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          if (!data.error) {
            const successMessage =
              document.getElementById('successful_message');
            successMessage.style.display = 'block';
            setTimeout(function () {
              successMessage.style.display = 'none';
            }, 2000);
            const tabla = document.querySelector('#stockTable');
            const tbody = tabla.querySelector('tbody');
            tbody.innerHTML = '';
            const tablaBody = document.querySelector('#table-body');
            data.stock.forEach((row) => {
              const tablaRow = document.createElement('tr');
              const tablaCell1 = document.createElement('td');
              tablaCell1.textContent = row.name;
              const tablaCell2 = document.createElement('td');
              tablaCell2.textContent = row.symbol;
              const tablaCell3 = document.createElement('td');
              tablaCell3.textContent = row.date;
              const tablaCell4 = document.createElement('td');
              tablaCell4.textContent = row.time;
              const tablaCell5 = document.createElement('td');
              tablaCell5.textContent = row.open;
              const tablaCell6 = document.createElement('td');
              tablaCell6.textContent = row.high;
              const tablaCell7 = document.createElement('td');
              tablaCell7.textContent = row.low;
              const tablaCell8 = document.createElement('td');
              tablaCell8.textContent = row.close;
              const tablaCell9 = document.createElement('td');
              tablaCell9.textContent = row.volume;
              tablaRow.appendChild(tablaCell1);
              tablaRow.appendChild(tablaCell2);
              tablaRow.appendChild(tablaCell3);
              tablaRow.appendChild(tablaCell4);
              tablaRow.appendChild(tablaCell5);
              tablaRow.appendChild(tablaCell6);
              tablaRow.appendChild(tablaCell7);
              tablaRow.appendChild(tablaCell8);
              tablaRow.appendChild(tablaCell9);
              tablaBody.appendChild(tablaRow);
            });
          }
          if (data.error) {
            swal(
              'Houston, we have a problem',
              data.message + ' ' + data.error_code,
              'error',
            );
          }
        })
        .catch((error) => console.log(error));
    }
  }
}

// This file is a JavaScript file named "script.js". It contains four functions:
// "SearchUser()", "DoLogout()", "CreateUser()", and "SearchHistory()". The functions are
// responsible for handling different events on a web page such as form submissions and
// making HTTP requests using the Fetch API.

// The "SearchUser()" function sends a POST request to the "/api/user/login"
// endpoint with the email and password fields from the form. If the response indicates
// that the user exists and the password is correct, the function sets a token in the
// session storage and redirects to the "stocks.php" page. If the response indicates an
// error, a message is displayed using the SweetAlert library.

// The "DoLogout()" function clears the session storage and redirects to the "logout.php"
// page.

// The "CreateUser()" function sends a POST request to the "/api/user/create"
// endpoint with the name, email, and password fields from the form. If the response
// indicates that the user was created successfully, the function sets a token in the
// session storage and redirects to the "stocks.php" page. If the response indicates
// an error, a message is displayed using the SweetAlert library.

// The "SearchHistory()" function sends a POST request to the "/api/history/searchId"
// endpoint with the searchId field from the form. If the response indicates that the
// search was successful, the function populates a table with the results. If the response
// indicates an error, a message is displayed using the SweetAlert library.
