(function() {
    const className = document.querySelectorAll('.quantity');

    Array.from(className).forEach(element => {
        element.addEventListener('change', async () => {
            const id = element.getAttribute('data-id');
            try {
                const { data } = await axios.put(`cart/${id}`, {
                    quantity: element.value
                });

                console.log(data);

                //* Refresh back after update cart quantity
                window.location.href = "/cart"
            } catch (err) {
                console.log(err);
                
                //* Refresh back after update cart quantity
                window.location.href = "/cart"
            }
        });
    });
})();
