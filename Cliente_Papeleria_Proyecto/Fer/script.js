document.addEventListener("DOMContentLoaded", function () {
    const tablaContactos = document.getElementById("tablaContactos");
    const formularioProveedor = document.getElementById("formularioProveedor");
    const modal = document.getElementById("modal");
    const modalTitle = document.getElementById("modalTitle");
    const modalForm = document.getElementById("modalForm");
    const modalSubmitBtn = document.getElementById("modalSubmitBtn");
  
    let editingProveedorId = null;
  

    function listarProveedores() {
        fetch("http://localhost/servicioREST_Papeleria/Servicios_Proveedores/listar_proveedores.php")
            .then(response => response.json())
            .then(data => {
                // Eliminar todas las filas excepto la primera (encabezado)
                while (tablaContactos.rows.length > 1) {
                    tablaContactos.deleteRow(1);
                }
                
                data.forEach(proveedor => {
                    const row = tablaContactos.insertRow();
                    row.innerHTML = `
                        <td>${proveedor.id}</td>
                        <td>${proveedor.nombre}</td>
                        <td>${proveedor.telefono}</td>
                        <td>${proveedor.email}</td>
                        <td>
                            <button class="editBtn" data-id="${proveedor.id}">Editar</button>
                            <button class="deleteBtn" data-id="${proveedor.id}">Eliminar</button>
                        </td>
                    `;
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    
  
    function editarProveedor(id) {
        const nuevoNombre = document.getElementById('nombre').value;
        const nuevoTelefono = document.getElementById('telefono').value;
        const nuevoEmail = document.getElementById('email').value;
  
      if (nuevoNombre && nuevoTelefono && nuevoEmail) {
        const proveedor = {
          id: id,
          nombre: nuevoNombre,
          telefono: nuevoTelefono,
          email: nuevoEmail
        };
  
        fetch('http://localhost/servicioREST_Papeleria/Servicios_Proveedores/editar_proveedores.php', {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(proveedor)
        })
        .then(response => {
          if (response.ok) {
            console.log('Proveedor editado con éxito');
            listarProveedores();
          } else {
            console.error('Error al editar el proveedor');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      }
    }
  
    function eliminarProveedor(id) {
      if (confirm('¿Estás seguro de que quieres eliminar este proveedor?')) {
        fetch(`http://localhost/servicioREST_Papeleria/Servicios_Proveedores/eliminar_proveedores.php?id=${id}`, {
          method: 'DELETE'
        })
        .then(response => {
          if (response.ok) {
            console.log('Proveedor eliminado con éxito');
            listarProveedores();
          } else {
            console.error('Error al eliminar el proveedor');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      }
    }
  
    function agregarProveedor() {
        const nuevoNombre = document.getElementById('nombre').value;
        const nuevoTelefono = document.getElementById('telefono').value;
        const nuevoEmail = document.getElementById('email').value;
  
      if (nuevoNombre && nuevoTelefono && nuevoEmail) {
        const proveedor = {
          nombre: nuevoNombre,
          telefono: nuevoTelefono,
          email: nuevoEmail
        };
  
        fetch("http://localhost/servicioREST_Papeleria/Servicios_Proveedores/insertar_proveedores.php", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(proveedor)
        })
        .then(response => {
          if (response.ok) {
            console.log('Proveedor agregado con éxito');
            listarProveedores();
          } else {
            console.error('Error al agregar el proveedor');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      }
    }
  
    // Cargar los proveedores al cargar la página
    listarProveedores();
  
    // Agregar evento al botón de agregar proveedor
    formularioProveedor.addEventListener("submit", event => {
      event.preventDefault();
      agregarProveedor();
    });
  
    // Delegación de eventos para botones de editar y eliminar
    tablaContactos.addEventListener("click", e => {
      if (e.target.classList.contains("editBtn")) {
        const proveedorId = e.target.getAttribute("data-id");
        editarProveedor(proveedorId);
      } else if (e.target.classList.contains("deleteBtn")) {
        const proveedorId = e.target.getAttribute("data-id");
        if (confirm("¿Estás seguro de eliminar este proveedor?")) {
          eliminarProveedor(proveedorId);
        }
      }
    });
  
    // Mostrar el modal de agregar/editar
    modalSubmitBtn.addEventListener("click", () => {
      // ... (código para manejar el modal)
    });
  
    // Cerrar el modal al hacer clic fuera de él
    window.addEventListener("click", event => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
  