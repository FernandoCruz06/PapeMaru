document.addEventListener("DOMContentLoaded", function () {
  const productList = document.getElementById("productList");
  const addProductBtn = document.getElementById("addProductBtn");
  const modal = document.getElementById("modal");
  const modalTitle = document.getElementById("modalTitle");
  const modalForm = document.getElementById("modalForm");
  const modalSubmitBtn = document.getElementById("modalSubmitBtn");
  const providerSelect = document.getElementById("proveedor_id");

  let editingProductId = null;

  function loadProducts() {
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Angela/obtener_productos.php")
      .then(response => response.json())
      .then(data => {
        productList.innerHTML = "";
        data.forEach(product => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.nombre}</td>
            <td>${product.precio}</td>
            <td>${product.cantidad_inventario}</td>
            <td>${product.proveedor}</td>
            <td>
              <button class="editBtn" data-id="${product.id}">Editar</button>
              <button class="deleteBtn" data-id="${product.id}">Eliminar</button>
            </td>
          `;
          productList.appendChild(row);
        });
      });
  }

  function loadProviders() {
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Angela/obtener_proveedores.php")
      .then(response => response.json())
      .then(data => {
        providerSelect.innerHTML = "";
        data.forEach(provider => {
          const option = document.createElement("option");
          option.value = provider.id;
          option.textContent = provider.nombre;
          providerSelect.appendChild(option);
        });
      });
  }

  loadProducts();
  loadProviders();

  addProductBtn.addEventListener("click", () => {
    modalTitle.textContent = "Agregar Producto";
    modalSubmitBtn.textContent = "Agregar";
    modalForm.reset();
    editingProductId = null;
    modal.style.display = "block";
  });

  productList.addEventListener("click", e => {
    if (e.target.classList.contains("editBtn")) {
      const productId = e.target.getAttribute("data-id");
      editingProductId = productId;
      modalTitle.textContent = "Editar Producto";
      modalSubmitBtn.textContent = "Guardar Cambios";

      fetch(`http://localhost/servicioREST_Papeleria/Servicios_Angela/obtener_producto.php?id=${productId}`)
        .then(response => response.json())
        .then(product => {
          modalForm.nombre.value = product.nombre;
          modalForm.precio.value = product.precio;
          modalForm.cantidad_inventario.value = product.cantidad_inventario;
          modalForm.proveedor_id.value = product.proveedor_id; // Cambio de proveedor a proveedor_id
          modal.style.display = "block";
        });
    } else if (e.target.classList.contains("deleteBtn")) {
      const productId = e.target.getAttribute("data-id");
      if (confirm("¿Estás seguro de eliminar este producto?")) {
        deleteProduct(productId);
      }
    }
  });

  modalForm.addEventListener("submit", event => {
    event.preventDefault();
    const formData = new FormData(modalForm);
    const formObject = {};
    formData.forEach((value, key) => {
      formObject[key] = value;
    });

    if (editingProductId) {
      formObject.id = editingProductId;
      editProduct(formObject);
    } else {
      addProduct(formObject);
    }

    loadProviders();
    modal.style.display = "none";
  });

  function addProduct(productData) {
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Angela/insertar.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: new URLSearchParams(productData)
    })
    .then(response => response.text())
    .then(message => {
      alert(message);
      loadProducts();
    });
  }

  function editProduct(productData) {
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Angela/modificar.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: new URLSearchParams(productData)
    })
    .then(response => response.text())
    .then(message => {
      alert(message);
      loadProducts();
    });
  }

  function deleteProduct(productId) {
    fetch("http://localhost/servicioREST_Papeleria/Servicios_Angela/eliminar.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: `id=${productId}`
    })
    .then(response => response.text())
    .then(message => {
      alert(message);
      loadProducts();
    });
  }

  window.addEventListener("click", event => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});
