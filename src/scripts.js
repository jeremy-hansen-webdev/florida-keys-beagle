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
    // getting the amount of rows per image set by dividing color buttons to images in image gallary
    const number_of_rows_images = count_images / count_color_buttons;

    // Setting all images to display none except for first color row
    list_items_images.forEach((img, idx) => {
        img.style.display = idx < number_of_rows_images ? 'block' : 'none';
    });



    // When page loads set event listener to show images based on color of button you select
    list_items_color_buttons.forEach((item, colorIdx) => {
        item.addEventListener('click', () => {
            list_items_color_buttons.forEach(li => li.classList.remove('selected'));
            item.classList.add('selected');

            // Calculate the start and end index for images of this color
            const startIdx = colorIdx * number_of_rows_images;
            const endIdx = startIdx + number_of_rows_images;

            list_items_images.forEach((img, imgIdx) => {
                img.style.display = (imgIdx >= startIdx && imgIdx < endIdx) ? 'block' : 'none';
            });
        });
    });

    // progress bar on cart and checkout page
    const currentPathname = window.location.pathname;
    const pathSegments = currentPathname.split('/').filter(segment => segment.length > 0);
    let slug = '';
    if (pathSegments.length > 0) {
        slug = pathSegments[pathSegments.length - 1];
    }

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
    // Creating colors for color buttons on single product page
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
            }
            color_indx = color_indx + Math.ceil(number_of_rows_images);
        }
    }).catch((error) => {
        console.error('Error fetching hex colors:', error);
    });


    let test_num = 0;
    // Creating color picker for color buttons on all product page
    const woocommerce_thumbnail_images = document.querySelectorAll('.woocommerce-product-gallery-thumbnails .product-gallery-thumbnail');
    const colorOptionsAllProducts = document.querySelectorAll('.color-swatch');
    if (woocommerce_thumbnail_images.length > 0) {
        const imagesLoaded = Array.from(woocommerce_thumbnail_images).map(img => {
            return new Promise((resolve, reject) => {
                if (img.complete && img.naturalHeight !== 0) {
                    resolve();
                } else {
                    img.onload = () => resolve();
                    img.onerror = () => reject(new Error('Failed to load image: ' + img.src));
                }
            });
        });

        Promise.all(imagesLoaded).then(() => {
            woocommerce_thumbnail_images.forEach((img, idx) => {
                const imgSrc = img.src;
                let image = new Image();
                image.src = imgSrc + '?cache_buster=' + new Date().getTime();
                image.onload = () => {
                    const hexColor = get_hex_colors(image);
                    img.style.backgroundColor = hexColor;
                    if (colorOptionsAllProducts[idx]) {
                        colorOptionsAllProducts[idx].style.backgroundColor = hexColor;

                    }
                };
                image.onerror = () => {
                    console.error('Failed to load image: ' + imgSrc);
                };
            });
        }).catch(error => {
            console.error('Error waiting for images to load:', error);
        });
    }



    // when you click on a color swatch it changes the main image to that color and provides size options
    let productMainImage = document.querySelectorAll('#main > ul > li > a> img');
    const productImages = document.querySelectorAll('.product-gallery-thumbnail')
    const colorSwatches = document.querySelectorAll('.color-swatch');
    const colorSwatchesContainer = document.querySelector('.color-swatch-container');

    if (productMainImage.length > 0 && productImages.length > 0 && colorSwatches.length > 0) {
        const imagesLoaded = Array.from(productImages).map(img => {
            return new Promise((resolve, reject) => {
                if (img.complete && img.naturalHeight !== 0) {
                    resolve();
                } else {
                    img.onload = () => resolve();
                    img.onerror = () => reject(new Error('Failed to load image: ' + img.src));
                }
            });
        });

        Promise.all(imagesLoaded).then(() => {
            colorSwatches.forEach((swatch, index) => {
                swatch.addEventListener('click', () => {
                    if (productMainImage[swatch.id]) {
                        productMainImage[Number(swatch.id)].src = productImages[index + Number(swatch.id) + 1].src;
                        const allSwatches = document.querySelectorAll('.color-swatch');
                        const allSizeOptionsContainers = document.querySelectorAll('.size-option');
                        const allSizeText = document.querySelectorAll('.swatch-size-text');
                        allSizeText.forEach(t => t.innerHTML = '');
                        allSizeOptionsContainers.forEach(container => container.classList.remove('selected'));
                        allSwatches.forEach(s => s.classList.remove('selected'));

                        swatch.classList.add('selected');
                        let color_selected = document.querySelector('.color-swatch.selected');
                        document.querySelector('.add-to-cart-color').innerHTML = '<p class="swatch-color-text">' + color_selected.getAttribute('title') + '</p>';


                        const sizeOptionContainers = document.querySelectorAll(`.size-options-container.product-index-${swatch.id}`)

                        sizeOptionContainers.forEach(my_option => {
                            let my_selector = color_selected.getAttribute('title') + swatch.id;
                            if (my_option.id == my_selector) {
                                my_option.title = 'selected';
                            } else {
                                my_option.title = 'non-selected';

                            }
                        });
                    }

                });
            });
        }).catch(error => {
            console.error('Error waiting for product images to load:', error);
        });
    }

    const sizeOptions = document.querySelectorAll('.size-options-container .size-option');
    sizeOptions.forEach(option => {
        option.addEventListener('click', () => {
            sizeOptions.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            document.querySelector('.add-to-cart-size').innerHTML = '<p class="swatch-size-text">' + option.id + '</p>';
        });
    });

    // Ajax add to cart functionality for color and size variants
    const myAjaxButton = document.querySelector('.ajax-add-to-cart');


    myAjaxButton.addEventListener('click', () => {
        const color_selected_elem = document.querySelector('.swatch-color-text');
        const size_selected_elem = document.querySelector('.swatch-size-text');
        const productIdElem = document.querySelector('.product-id-text');
        const productId = productIdElem.value;

        const color_selected_value = color_selected_elem ? color_selected_elem.textContent : '';
        const size_selected_value = size_selected_elem ? size_selected_elem.textContent : '';
        myData = {
            product_id: productId,
            quantity: 1,
            variation_data: {
                attribute_colors: color_selected_value,
                attribute_sizes: size_selected_value,
            }
        }

        if (myData['variation_data']['attribute_colors'] && myData['variation_data']['attribute_sizes']) {
            jQuery.ajax({
                type: "post",
                url: `${window.location.origin}/wp-admin/admin-ajax.php`,
                data: {
                    action: "custom_add_to_cart",
                    ajax_data: myData
                },
                complete: function (response) {
                    // After successful add to cart
                    jQuery.ajax({
                        url: myAjax.ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'get_cart_count'
                        },
                        success: function (response) {
                            if (response.success) {
                                jQuery('#cart > span').text(response.data);
                            }
                        }
                    });

                }
            });
        } else if (!myData['variation_data']['attribute_colors']) {

            const selectWarning = document.querySelector('.error-message-color');
            if (selectWarning) {
                selectWarning.style.display = 'block';
                setTimeout(() => {
                    selectWarning.style.display = 'none';
                }, 3000); // Hide after 3 seconds
            }

        } else if (!myData['variation_data']['attribute_sizes']) {
            const selectWarning = document.querySelector('.error-message-size');
            if (selectWarning) {
                selectWarning.style.display = 'block';
                setTimeout(() => {
                    selectWarning.style.display = 'none';
                }, 3000); // Hide after 3 seconds
            }
        }
    });



});


