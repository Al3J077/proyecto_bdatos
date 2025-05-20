// scripts.js
document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
                button.addEventListener('click', () => {
                            const productId = button.dataset.productId;
                                        fetch(`add_to_cart.php?id=${productId}`, {
                                                        method: 'POST'
                                                                    })
                                                                                .then(response => response.json())
                                                                                            .then(data => {
                                                                                                            if (data.success) {
                                                                                                                                alert('Producto agregado al carrito');
                                                                                                                                                } else {
                                                                                                                                                                    alert('Error al agregar al carrito');
                                                                                                                                                                                    }
                                                                                                                                                                                                })
                                                                                                                                                                                                            .catch(error => console.error('Error:', error));
                                                                                                                                                                                                                    });
                                                                                                                                                                                                                        });
                                                                                                                                                                                                                        });