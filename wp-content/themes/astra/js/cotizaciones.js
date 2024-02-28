document.addEventListener('DOMContentLoaded', function() {
    const botonAgregarProducto = document.getElementById('agregarProducto');
    const botonActualizarProducto = document.getElementById('actualizarProducto'); // Nuevo botón para actualizar producto
    const botonGenerarCotizacion = document.getElementById('submit_cotizacion');
    const tablaProductos = document.getElementById('tablaProductos').getElementsByTagName('tbody')[0];
    
    const productos = []; // Arreglo para almacenar los productos
    let index; // Declarar la variable index aquí

    // Función para actualizar el número de registros y el campo de posición
    function actualizarNumeroRegistros() {
        const numeroRegistros = tablaProductos.rows.length + 1;
        document.getElementById('posicion').value = numeroRegistros;
    }
    actualizarNumeroRegistros();

      botonAgregarProducto.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del botón
        // Obtener los valores de los campos del producto
        //const posicion = numeroRegistros;
        const posicion = document.getElementById('posicion').value;
        const linea = document.getElementById('linea').value;
        const cantidad = document.getElementById('cantidad').value;
        const concepto = document.getElementById('concepto').value;
        const no_parte_cliente = document.getElementById('no_parte_cliente').value;
        const codigo_producto = document.getElementById('codigo_producto').value;
        const proveedor = document.getElementById('proveedor').value;
        const folio_cotizacion = document.getElementById('folio_cotizacion').value;
        const costo_unitario = document.getElementById('costo_unitario').value;
        const precio_unitario = document.getElementById('precio_unitario').value;
        const factor_venta = document.getElementById('factor_venta').value;
        const subtotal = document.getElementById('subtotal').value;
        const iva = document.getElementById('iva').value;
        const total = document.getElementById('total').value;
      
        // Verificar si todos los campos están llenos
        if (!linea || !cantidad || !concepto || !no_parte_cliente 
            || !codigo_producto || !proveedor || !folio_cotizacion || !costo_unitario
             || !precio_unitario || !factor_venta || !subtotal || !iva || !total) {
            alert('Por favor, complete todos los campos del producto.');
            return;
        }
        // Si la posición no está vacía, no la actualizamos (porque podría ser una edición)
        if (!posicion) {
            actualizarNumeroRegistros();
        }
        // Verificar si es una actualización o una inserción
        const index = productos.findIndex(producto => producto.posicion === posicion);
        if (index !== -1) {
            // Actualizar el producto existente
            productos[index] = {
                posicion,
                linea,
                cantidad,
                concepto,
                no_parte_cliente,
                codigo_producto,
                proveedor,
                folio_cotizacion,
                costo_unitario,
                precio_unitario,
                factor_venta,
                subtotal,
                iva,
                total
            };
            // Actualizar la fila correspondiente en la tabla
            const fila = tablaProductos.rows[index];
            fila.cells[0].textContent = posicion;
            fila.cells[1].textContent = linea;
            fila.cells[2].textContent = cantidad;
            fila.cells[3].textContent = concepto;
            fila.cells[4].textContent = no_parte_cliente;
            fila.cells[5].textContent = codigo_producto;
            fila.cells[6].textContent = proveedor;
            fila.cells[7].textContent = folio_cotizacion;
            fila.cells[8].textContent = costo_unitario;
            fila.cells[9].textContent = precio_unitario;
            fila.cells[10].textContent = factor_venta;
            fila.cells[11].textContent = subtotal;
            fila.cells[12].textContent = iva;
            fila.cells[13].textContent = total;
            // Limpiar los campos del producto después de actualizarlo
            limpiarCamposProducto();
            // Cambiar el texto del botón Actualizar Producto a Agregar Producto
            botonAgregarProducto.style.display = 'block';
            botonActualizarProducto.style.display = 'none';
        } else {
            // Crear una nueva fila para el producto
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${posicion}</td>
                <td>${linea}</td>
                <td>${cantidad}</td>
                <td>${concepto}</td>
                <td>${no_parte_cliente}</td>
                <td>${codigo_producto}</td>
                <td>${proveedor}</td>
                <td>${folio_cotizacion}</td>
                <td>${costo_unitario}</td>
                <td>${precio_unitario}</td>
                <td>${factor_venta}</td>
                <td>${subtotal}</td>
                <td>${iva}</td>
                <td>${total}</td>
                <td><button class="editar">Editar</button></td>
                <td><button class="eliminar">Eliminar</button></td>
            `;
            // Agregar la fila a la tabla
            tablaProductos.appendChild(fila);
            // Agregar el producto al arreglo
            productos.push({
                posicion,
                linea,
                cantidad,
                concepto,
                no_parte_cliente,
                codigo_producto,
                proveedor,
                folio_cotizacion,
                costo_unitario,
                precio_unitario,
                factor_venta,
                subtotal,
                iva,
                total
            });

                    
        }
 
        // Limpiar los campos del producto después de agregarlo o actualizarlo
        limpiarCamposProducto();

        // Actualizar el número de registros y el campo de posición después de agregar un nuevo producto
        actualizarNumeroRegistros();
     
    });
  

    botonGenerarCotizacion.addEventListener('click', function(event) {
        if (!camposFormularioLlenos()) {
            event.preventDefault();
            alert('Por favor, complete todos los campos del formulario o agregue al menos un producto.');
        } else {
            // Al generar la cotización, actualizar el campo oculto con los productos
            document.getElementById('productos_ocultos').value = JSON.stringify(productos);
        }
    });

    function camposFormularioLlenos() {
        // Obtener los IDs de los campos del formulario
        const camposFormulario = ['fecha', 'compania', 'vendedor', 'folio', 'cliente', 'contacto', 'correo', 'telefono', 'ubicacion', 'moneda', 'tiempo_entrega', 'condiciones_pago', 'vigencia', 'nota_4', 'firma'];

        // Verificar si todos los campos del formulario están llenos
        for (let campoId of camposFormulario) {
            const campo = document.getElementById(campoId);
            if (!campo.value.trim()) {
                return false;
            }
        }

        return true;
    }

    function limpiarCamposProducto() {
        document.getElementById('posicion').value = '';
        document.getElementById('linea').value = '';
        document.getElementById('cantidad').value = '';
        document.getElementById('concepto').value = '';
        document.getElementById('no_parte_cliente').value = '';
        document.getElementById('codigo_producto').value = '';
        document.getElementById('proveedor').value = '';
        document.getElementById('folio_cotizacion').value = '';
        document.getElementById('costo_unitario').value = '';
        document.getElementById('precio_unitario').value = '';
        document.getElementById('factor_venta').value = '';
        document.getElementById('subtotal').value = '';
        document.getElementById('iva').value = '';
        document.getElementById('total').value = '';
    }

    tablaProductos.addEventListener('click', function(event) {
        const elementoClicado = event.target;
        if (elementoClicado.classList.contains('editar')) {
                    event.preventDefault();

            const filaActual = elementoClicado.parentNode.parentNode;
            index = Array.from(tablaProductos.children).indexOf(filaActual); // Asignar el valor de index aquí

            document.getElementById('posicion').value = filaActual.cells[0].textContent;
            document.getElementById('linea').value = filaActual.cells[1].textContent;
            document.getElementById('cantidad').value = filaActual.cells[2].textContent;
            document.getElementById('concepto').value = filaActual.cells[3].textContent;
            document.getElementById('no_parte_cliente').value = filaActual.cells[4].textContent;
            document.getElementById('codigo_producto').value = filaActual.cells[5].textContent;
            document.getElementById('proveedor').value = filaActual.cells[6].textContent;
            document.getElementById('folio_cotizacion').value = filaActual.cells[7].textContent;
            document.getElementById('costo_unitario').value = filaActual.cells[8].textContent;
            document.getElementById('precio_unitario').value = filaActual.cells[9].textContent;
            document.getElementById('factor_venta').value = filaActual.cells[10].textContent;
            document.getElementById('subtotal').value = filaActual.cells[11].textContent;
            document.getElementById('iva').value = filaActual.cells[12].textContent;
            document.getElementById('total').value = filaActual.cells[13].textContent;

            // Cambiar el texto del botón Agregar Producto a Actualizar Producto
            botonAgregarProducto.style.display = 'none';
            botonActualizarProducto.style.display = 'block';
        } else if (elementoClicado.classList.contains('eliminar')) {
            const filaEliminada = elementoClicado.parentNode.parentNode;
            const index = Array.from(tablaProductos.children).indexOf(filaEliminada);
            tablaProductos.removeChild(filaEliminada);
            productos.splice(index, 1); // Eliminar el producto del arreglo
            document.getElementById('productos_ocultos').value = JSON.stringify(productos); // Actualizar el valor del campo oculto
        // Reasignar los números de posición después de eliminar un registro
        reasignarPosiciones();
        }
    });
        // Función para reasignar los números de posición después de eliminar un registro
        function reasignarPosiciones() {
            const filas = tablaProductos.rows;
            for (let i = 0; i < filas.length; i++) {
                filas[i].cells[0].textContent = i + 1;
            }
            actualizarNumeroRegistros();

        }
    // Manejar clic en el botón Actualizar Producto
    botonActualizarProducto.addEventListener('click', function(event) {
        event.preventDefault();
        
        // Verificar si se encontró el producto
        if (index !== -1) {
            // Actualizar el producto con los nuevos valores
            productos[index] = {
                posicion: document.getElementById('posicion').value,
                linea: document.getElementById('linea').value,
                cantidad: document.getElementById('cantidad').value,
                concepto: document.getElementById('concepto').value,
                no_parte_cliente: document.getElementById('no_parte_cliente').value,
                codigo_producto: document.getElementById('codigo_producto').value,
                proveedor: document.getElementById('proveedor').value,
                folio_cotizacion: document.getElementById('folio_cotizacion').value,
                costo_unitario: document.getElementById('costo_unitario').value,
                precio_unitario: document.getElementById('precio_unitario').value,
                factor_venta: document.getElementById('factor_venta').value,
                subtotal: document.getElementById('subtotal').value,
                iva: document.getElementById('iva').value,
                total: document.getElementById('total').value
            };
            // Actualizar la fila correspondiente en la tabla
            const fila = tablaProductos.rows[index];
            fila.cells[0].textContent = productos[index].posicion;
            fila.cells[1].textContent = productos[index].linea;
            fila.cells[2].textContent = productos[index].cantidad;
            fila.cells[3].textContent = productos[index].concepto;
            fila.cells[4].textContent = productos[index].no_parte_cliente;
            fila.cells[5].textContent = productos[index].codigo_producto;
            fila.cells[6].textContent = productos[index].proveedor;
            fila.cells[7].textContent = productos[index].folio_cotizacion;
            fila.cells[8].textContent = productos[index].costo_unitario;
            fila.cells[9].textContent = productos[index].precio_unitario;
            fila.cells[10].textContent = productos[index].factor_venta;
            fila.cells[11].textContent = productos[index].subtotal;
            fila.cells[12].textContent = productos[index].iva;
            fila.cells[13].textContent = productos[index].total;
            // Limpiar los campos del producto después de actualizarlo
            limpiarCamposProducto();
            // Cambiar el texto del botón Actualizar Producto a Agregar Producto
            botonAgregarProducto.style.display = 'block';
            botonActualizarProducto.style.display = 'none';
        }
    });
});



/*Calcular automáticamente el FV */

document.addEventListener('DOMContentLoaded', function() {
    const costoUnitarioInputs = document.getElementsByName('costo_unitario[]');
    const precioUnitarioInputs = document.getElementsByName('precio_unitario[]');
    const factorVentaInputs = document.getElementsByName('factor_venta[]');

    for (let i = 0; i < costoUnitarioInputs.length; i++) {
        costoUnitarioInputs[i].addEventListener('input', function() {
            calcularFactorVenta(i);
        });
    }

    for (let i = 0; i < precioUnitarioInputs.length; i++) {
        precioUnitarioInputs[i].addEventListener('input', function() {
            calcularFactorVenta(i);
        });
    }

    function calcularFactorVenta(index) {
        const costoUnitario = parseFloat(costoUnitarioInputs[index].value);
        const precioUnitario = parseFloat(precioUnitarioInputs[index].value);
        const factorVenta = precioUnitario / costoUnitario;

        if (!isNaN(factorVenta)) {
            factorVentaInputs[index].value = factorVenta.toFixed(2);
        } else {
            factorVentaInputs[index].value = '';
        }
    }
});

/*Calcular automáticamente el Subtotal, IVA y Total*/

// Obtener referencia a los campos de cantidad, precio unitario, subtotal, iva y total
const cantidadInput = document.getElementById('cantidad');
const precioUnitarioInput = document.getElementById('precio_unitario');
const subtotalInput = document.getElementById('subtotal');
const ivaInput = document.getElementById('iva');
const totalInput = document.getElementById('total');

// Agregar event listener para calcular el subtotal y el IVA cuando se cambia la cantidad o el precio unitario
cantidadInput.addEventListener('input', () => {
    calcularSubtotal();
    calcularIva();
    calcularTotal();
});
precioUnitarioInput.addEventListener('input', () => {
    calcularSubtotal();
    calcularIva();
    calcularTotal();
});

function calcularSubtotal() {
    const cantidad = parseFloat(cantidadInput.value) || 0;
    const precioUnitario = parseFloat(precioUnitarioInput.value) || 0;
    const subtotal = cantidad * precioUnitario;
    subtotalInput.value = subtotal.toFixed(2);
}

function calcularIva() {
    const subtotal = parseFloat(subtotalInput.value) || 0;
    const iva = subtotal * 0.16;
    ivaInput.value = iva.toFixed(2);
}

function calcularTotal() {
    const subtotal = parseFloat(subtotalInput.value) || 0;
    const iva = parseFloat(ivaInput.value) || 0;
    const total = subtotal + iva;
    totalInput.value = total.toFixed(2);
}

/*Check costo de envío */
function toggleCostoEnvio() {
    var checkbox = document.getElementById("habilitarEnvio");
    var campoCostoEnvio = document.getElementById("campoCostoEnvio");

    if (checkbox.checked) {
        campoCostoEnvio.style.display = "block";
    } else {
        campoCostoEnvio.style.display = "none";
    }
}