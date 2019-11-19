(function() {
    //* Select images to work with
    const curImage = document.querySelector('#curImage');
    const extraImages = document.querySelectorAll('.product-section-thumbnail');

    //* Handle click event
    extraImages.forEach(element => {
        element.addEventListener('click', thumbnailClick);
    });

    function thumbnailClick(e) {
        curImage.classList.remove('active');

        curImage.addEventListener('transitionend', () => {
            curImage.src = this.querySelector('img').src;
            curImage.classList.add('active');
        });

        extraImages.forEach(element => element.classList.remove('selected'));
        this.classList.add('selected');
    }
})();
