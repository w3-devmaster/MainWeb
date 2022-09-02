<script>
    AOS.init();

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    var myCarousel = document.querySelector('#main-slide')
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 5000,
        wrap: true
    })

    const popup = (url, name, windowWidth, windowHeight) => {
        myleft = (screen.width) ? (screen.width - windowWidth) / 2 : 100;
        mytop = (screen.height) ? (screen.height - windowHeight) / 2 : 100;
        properties = "width=" + windowWidth + ",height=" + windowHeight;
        properties += ",scrollbars=yes,resizable=0, top=" + mytop + ",left=" + myleft;
        window.open(url, name, properties);
    }
</script>
