

let dropMenu = document.getElementById("drop-menu");
let bars = document.getElementById("bars");

bars.addEventListener("click", () => {
    if (dropMenu.style.display === "flex") {
        dropMenu.style.display = "none";
    } else {
        dropMenu.style.display = "flex";
    }
});

document.addEventListener("DOMContentLoaded", function() {

    const slider = document.getElementById('slider');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');


    const cards = Array.from(slider.children);
    cards.forEach(card => {
        const clone = card.cloneNode(true);
        slider.appendChild(clone);
    });

    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth + 20;
    const totalCards = slider.children.length;

    function updateSliderPosition() {
        slider.style.transition = "transform 0.3s ease-in-out";
        slider.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
    }

    function resetSliderPosition() {
        slider.style.transition = "none";
        slider.style.transform = "translateX(0px)";
        currentIndex = 0;
    }

    nextButton.addEventListener('click', () => {
        currentIndex++;
        updateSliderPosition();

        if (currentIndex >= totalCards / 2) {
            setTimeout(resetSliderPosition, 300);
        }
        
    });

    prevButton.addEventListener('click', () => {
        if (currentIndex === 0) {
            currentIndex = totalCards / 2;
            slider.style.transition = "none";
            slider.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
        }
        currentIndex--;
        setTimeout(updateSliderPosition, 0);
    });

});



function changeImage(thumbnail) {

    var mainImage = document.getElementById("mainImage");
    
    mainImage.src = thumbnail.src;

    var thumbnails = document.querySelectorAll(".thumbnails-container img");
    thumbnails.forEach(function(thumb) {
        thumb.classList.remove("selected"); 
    });
    thumbnail.classList.add("selected"); 
}

document.addEventListener("DOMContentLoaded", function() {
    var firstThumbnail = document.querySelector(".thumbnails-container img");
    firstThumbnail.classList.add("selected");
});


// animation 


ScrollReveal().reveal('.banner , .nosproducts .row .btn', { interval: 16, reset: true ,delay: 400 });

ScrollReveal().reveal('.nosproducts .row .prd , .productsPages .row .col , .collection_prd_Pages .row .col , .collectionPage .row .col_1 , .nousoffrons .row .card',
    { interval: 16, reset: true ,delay: 500 , distance: '-70px', origin:'top' });

ScrollReveal().reveal('.title , .serum h1 , .related_product', {
	interval: 16,
	reset: true,
    distance: '50px',
    delay: 200
});
ScrollReveal().reveal('.bar-grad:first-child , .cart_shopping .col_1', {
	interval: 16,
	reset: false,
    distance: '-70px',
    origin: 'right',
    delay: 300
});
ScrollReveal().reveal('.bar-grad:last-child , .cart_shopping .col_2', {
	interval: 16,
	reset: false,
    distance: '-70px',
    origin: 'left',
    delay: 300
});

