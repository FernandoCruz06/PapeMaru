document.addEventListener("DOMContentLoaded", function () {
    const userList = document.getElementById("userList");
    const addUserBtn = document.getElementById("addUserBtn");
    const modal = document.getElementById("modal");
    const modalTitle = document.getElementById("modalTitle");
    const modalForm = document.getElementById("modalForm");
    const modalSubmitBtn = document.getElementById("modalSubmitBtn");
  
    let editingUserId = null;
  
    // Función para cargar los usuarios desde la API
    function loadUsers() {
      fetch("http://localhost/servicioREST_Papeleria/Servicios_Rello/obtener_usuarios.php")
        .then(response => response.json())
        .then(data => {
          userList.innerHTML = "";
          data.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
              <td>${user.id}</td>
              <td>${user.email}</td> <!-- Cambio de "nombre" a "email" -->
              <td>${user.password}</td>
              <td>${user.rol}</td>
              <td>
                <button class="editBtn" data-id="${user.id}">Editar</button>
                <button class="deleteBtn" data-id="${user.id}">Eliminar</button>
              </td>
            `;
            userList.appendChild(row);
          });
        });
    }
  
    // Cargar los usuarios al cargar la página
    loadUsers();
  
    // Agregar evento al botón de agregar usuario
    addUserBtn.addEventListener("click", () => {
      modalTitle.textContent = "Agregar Usuario";
      modalSubmitBtn.textContent = "Agregar";
      modalForm.reset();
      editingUserId = null;
      modal.style.display = "block";
    });
  
    // Delegación de eventos para botones de editar y eliminar
    userList.addEventListener("click", e => {
      if (e.target.classList.contains("editBtn")) {
        const userId = e.target.getAttribute("data-id");
        editingUserId = userId;
        modalTitle.textContent = "Editar Usuario";
        modalSubmitBtn.textContent = "Guardar Cambios";
  
        // Cargar los datos del usuario a editar y mostrar el modal de edición
        fetch(`http://localhost/servicioREST_Papeleria/Servicios_Rello/obtener_usuario.php?id=${userId}`)
          .then(response => response.json())
          .then(user => {
            modalForm.querySelector("#email").value = user.email;
            modalForm.querySelector("#rol").value = user.rol;
            modalForm.querySelector("#password").value = user.password;
            modal.style.display = "block";
          });
      } else if (e.target.classList.contains("deleteBtn")) {
        const userId = e.target.getAttribute("data-id");
        if (confirm("¿Estás seguro de eliminar este usuario?")) {
          // Llamar a la función para eliminar el usuario
          deleteUser(userId);
        }
      }
    });
  
    // Función para eliminar un usuario
    function deleteUser(userId) {
      fetch("http://localhost/servicioREST_Papeleria/Servicios_Rello/eliminar_usuario.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${userId}`
      })
      .then(response => response.text())
      .then(message => {
        alert(message);
      });
    }
  
   // Mostrar el modal de agregar/editar
   modalSubmitBtn.addEventListener("click", () => {
    const formData = new FormData(modalForm);
    const formObject = {};
    formData.forEach((value, key) => {
      formObject[key] = value;
    });
  
    console.log(formObject); // Agrega esta línea para verificar los datos
  
    if (editingUserId) {
      formObject.id = editingUserId;
      // Llamar a la función para editar el usuario
      editUser(formObject);
    } else {
      // Llamar a la función para agregar el usuario
      addUser(formObject);
    }
  
    modal.style.display = "none";
  });
  
  
    // Cerrar el modal al hacer clic fuera de él
    window.addEventListener("click", event => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
  
  // Cerrar el modal al hacer clic en la X
modalCloseBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });



  // Función para agregar un usuario
  function addUser(userData) {
    const params = new URLSearchParams(userData);
  
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Rello/insertar_usuario.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: params
    })
    .then(response => response.text())
    .then(message => {
      alert(message);
      loadUsers();
    });
  }
  

  
  // Función para editar un usuario
 // Función para editar un usuario
function editUser(userData) {
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Rello/modificar_usuario.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: new URLSearchParams(userData)
    })
    .then(response => response.text())
    .then(message => {
      alert(message);
      loadUsers(); 
    });
  }