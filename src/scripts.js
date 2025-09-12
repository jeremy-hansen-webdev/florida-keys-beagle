// handles hamburger menu toggle


const menuToggle = document.querySelector('.hamburger-icon');
const menu = document.querySelector('.main-menu-mobile');

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        const mobileMenuContainer = document.querySelector('.mobile-menu-container');
        if (mobileMenuContainer) {
            if (mobileMenuContainer.style.display === 'none' || getComputedStyle(mobileMenuContainer).display === 'none') {
                mobileMenuContainer.style.display = 'block';
            } else {
                mobileMenuContainer.style.display = 'none';
            }
        }
        console.log('Hamburger menu toggled');
    });
}

// handles carousel navigation products on home page

const carousel = document.querySelector('#page>section.shopping>div.carousel-container>div>div>ul');
const buttonPrev = document.querySelector('.carousel-control-prev');
const buttonNext = document.querySelector('.carousel-control-next');

if (carousel && buttonPrev && buttonNext) {
    buttonPrev.addEventListener('click', () => {
        carousel.scrollBy({ left: -312, behavior: 'smooth' });
    });
    buttonNext.addEventListener('click', () => {
        carousel.scrollBy({ left: 312, behavior: 'smooth' });
    });
}

const carousel2 = document.querySelector('#page > section.shopping > div:nth-child(4) > div > div > ul');
const buttonPrev2 = document.querySelector('.carousel-container:nth-child(4) .carousel-control-prev');
const buttonNext2 = document.querySelector('.carousel-container:nth-child(4) .carousel-control-next');

if (carousel2 && buttonPrev2 && buttonNext2) {
    buttonPrev2.addEventListener('click', () => {
        carousel2.scrollBy({ left: -312, behavior: 'smooth' });
    });
    buttonNext2.addEventListener('click', () => {
        carousel2.scrollBy({ left: 312, behavior: 'smooth' });
    });
}

const carousel3 = document.querySelector('#page > section.shopping > div:nth-child(6) > div > div > ul');
const buttonPrev3 = document.querySelector('.carousel-container:nth-child(6) .carousel-control-prev');
const buttonNext3 = document.querySelector('.carousel-container:nth-child(6) .carousel-control-next');

if (carousel3 && buttonPrev3 && buttonNext3) {
    buttonPrev3.addEventListener('click', () => {
        carousel3.scrollBy({ left: -312, behavior: 'smooth' });
    });
    buttonNext3.addEventListener('click', () => {
        carousel3.scrollBy({ left: 312, behavior: 'smooth' });
    });
}

const storyButtons = document.querySelectorAll('[data-carousel-button]');

storyButtons.forEach(button => {
    button.addEventListener('click', () => {
        const offset = button.dataset.carouselButton === 'next' ? 1 : -1;
        const carouselElement = button.closest('[data-carousel]');
        if (!carouselElement) return;
        const slides = carouselElement.querySelector('[data-slides]');
        if (!slides) return;
        const activeSlide = slides.querySelector('[data-active]');
        if (!activeSlide) return;

        let newIndex = [...slides.children].indexOf(activeSlide) + offset;

        if (newIndex < 0) newIndex = slides.children.length - 1;
        if (newIndex >= slides.children.length) newIndex = 0;

        slides.children[newIndex].dataset.active = true;
        delete activeSlide.dataset.active;
    });
});


// Product Page Image Selector

// getting color buttons

// add on load event listener to ensure images are loaded
window.addEventListener('load', () => {

    const productImage = document.querySelector('.product-image');

    // grabbing all images and button then setting to variable
    const list_items_images = document.querySelectorAll('.flex-control-nav>li>img');
    const count_images = list_items_images.length;

    const list_items_color_buttons = document.querySelectorAll('ul[data-attribute_name="attribute_colors"]>li');
    const count_color_buttons = list_items_color_buttons.length;

    // testing counts
    // console.log('count_color_buttons:', count_color_buttons);
    // console.log('count_images:', count_images);

    // getting the amount of rows per image set by dividing color buttons to images in image gallary
    const number_of_rows_images = count_images / count_color_buttons;

    console.log('number_of_rows_images:', number_of_rows_images);

    // Setting all images to display none except for first color row
    list_items_images.forEach((img, idx) => {
        img.style.display = idx < number_of_rows_images ? 'block' : 'none';
    });



    // When page loads set event listener to show images based on color of button you select
    list_items_color_buttons.forEach((item, index) => {
        item.addEventListener('click', () => {
            list_items_color_buttons.forEach(li => li.classList.remove('selected'));
            item.classList.add('selected');
            // console.log('Selected color option index:', index);
            const image_selector_start = (number_of_rows_images * (1 + index)) - number_of_rows_images;
            const image_selector_end = image_selector_start + number_of_rows_images;
            // console.log(image_selector_end);
            // console.log(image_selector_start);

            list_items_images.forEach((img, index) => {
                img.style.display = index >= image_selector_start && index < image_selector_end ? 'block' : 'none';
            })
        });
    });

    // progress bar on cart and checkout page
    const currentPathname = window.location.pathname;
    const pathSegments = currentPathname.split('/').filter(segment => segment.length > 0);
    let slug = '';
    if (pathSegments.length > 0) {
        slug = pathSegments[pathSegments.length - 1];
    }
    console.log('Current Slug:', slug);
    const progress_bar_1 = document.querySelector('#page > div > main > div > div > article > div > div.progress_bar_container > div:nth-child(1) > div');
    const progress_bar_2 = document.querySelector('#page > div > main > div > div > article > div > div.progress_bar_container > div:nth-child(2) > div');
    const progress_bar_3 = document.querySelector('#page > div > main > div > div > article > div > div.progress_bar_container > div:nth-child(3) > div');

    if (slug === 'checkout') {
        if (progress_bar_1) {
            progress_bar_1.classList.remove('progress_bar_active');
            progress_bar_1.classList.add('progress_bar');
        }
        if (progress_bar_2) {
            progress_bar_2.classList.remove('progress_bar');
            progress_bar_2.classList.add('progress_bar_active');
        }
        if (progress_bar_3) {
            progress_bar_3.classList.remove('progress_bar_active');
            progress_bar_3.classList.add('progress_bar');
        }
    } else if (slug === 'cart') {
        if (progress_bar_1) {
            progress_bar_1.classList.remove('progress_bar');
            progress_bar_1.classList.add('progress_bar_active');
        }
        if (progress_bar_2) {
            progress_bar_2.classList.remove('progress_bar_active');
            progress_bar_2.classList.add('progress_bar');
        }
        if (progress_bar_3) {
            progress_bar_3.classList.remove('progress_bar_active');
            progress_bar_3.classList.add('progress_bar');
        }
    } else {
        if (progress_bar_1) {
            progress_bar_1.classList.remove('progress_bar_active');
            progress_bar_1.classList.add('progress_bar');
        }
        if (progress_bar_2) {
            progress_bar_2.classList.remove('progress_bar_active');
            progress_bar_2.classList.add('progress_bar');
        }
        if (progress_bar_3) {
            progress_bar_3.classList.remove('progress_bar');
            progress_bar_3.classList.add('progress_bar_active');
        }
    }
    const colorOptions = document.querySelectorAll('ul[data-attribute_name="attribute_colors"]>li');
    function get_hex_array() {
        // create colors swatches to provide options for color products
        return new Promise((resolve, reject) => {
            const hexColor = [];
            //  loop through src and console log each one
            list_items_images.forEach((img, idx) => {
                let image = new Image();
                image.src = img.src + '?cache_buster=' + new Date().getTime(); // Adding cache buster to ensure fresh load
                image.onload = () => {
                    hexColor.push(get_hex_colors(image));
                    if (hexColor.length === list_items_images.length) {
                        resolve(hexColor);
                    }
                }
                image.onerror = () => {
                    reject(new Error('Failed to load image: ' + img.src));
                }
            });
        });
    }

    function get_hex_colors(image) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = image.naturalWidth;
        canvas.height = image.naturalHeight;
        ctx.drawImage(image, 0, 0);

        const centerX = Math.floor(image.width / 2);
        const centerY = Math.floor(image.height - (image.height / 4));

        const pixelData = ctx.getImageData(centerX, centerY, 1, 1).data;
        const r = pixelData[0];
        const g = pixelData[1];
        const b = pixelData[2];

        const hexColor = `#${(1 << 24 | r << 16 | g << 8 | b).toString(16).slice(1)}`;

        return hexColor;
    }


    get_hex_array().then((hexColor) => {
        let color_indx = 1;
        for (let i = 0; i < hexColor.length; i++) {
            if (hexColor[color_indx]) {
                colorOptions[i].style.backgroundColor = hexColor[color_indx];
                console.log(`index number` + i + ' index color: ' + hexColor[color_indx]);
            }
            color_indx = color_indx + Math.ceil(number_of_rows_images);
        }
    }).catch((error) => {
        console.error('Error fetching hex colors:', error);
    });

});




// A helper function to convert RGB to a hex string


