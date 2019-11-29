(function() {
    const className = document.querySelectorAll(".quantity");

    Array.from(className).forEach(element => {
        element.addEventListener("change", async () => {
            const id = element.getAttribute("data-id");
            const quantity = element.getAttribute("data-quantity");
            try {
                const { data } = await axios.put(`cart/${id}`, {
                    valueQuantity: element.value,
                    productQuantity: quantity
                });

                console.log(data);

                //* Refresh back after update cart quantity
                window.location.href = "/cart";
            } catch (err) {
                console.log(err);

                //* Refresh back after update cart quantity
                window.location.href = "/cart";
            }
        });
    });
})();
