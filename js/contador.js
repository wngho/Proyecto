let quantity = 1;
        const quantityInput = document.getElementById('quantity');
        
        function increment() {
            quantity++;
            updateQuantity();
        }
        
        function decrement() {
            if (quantity > 1) {
                quantity--;
                updateQuantity();
            }
        }
        
        function updateQuantity() {
            quantityInput.value = quantity;
            // Aquí puedes agregar cualquier otra lógica que necesites
            // cuando cambia la cantidad, como actualizar precios, etc.
            console.log("Cantidad actual:", quantity);
        }
        
        // También puedes escuchar cambios manuales en el input
        quantityInput.addEventListener('change', function() {
            const value = parseInt(this.value);
            if (!isNaN(value) && value >= 1) {
                quantity = value;
            } else {
                this.value = quantity;
            }
        });

        