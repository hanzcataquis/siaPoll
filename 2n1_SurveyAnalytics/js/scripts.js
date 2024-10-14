function loadProducts(category) {
    const productContainer = document.getElementById('product-container');
    productContainer.innerHTML = ''; 

    if (category) {
        fetch(`get_products.php?category=${encodeURIComponent(category)}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                if (data.length > 0) {
                    data.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.className = 'col-4 mb-3'; 
                        const imagePath = `../uploads/${product.image}`; 
                        console.log(`Image path: ${imagePath}`); 
                        productDiv.innerHTML = `
                            <img src="${imagePath}" class="img-fluid product-image" alt="${product.name}" data-name="${product.name}" data-image="${product.image}">
                            <p class="text-center">${product.name}</p>
                        `;
                        productContainer.appendChild(productDiv);
                    });

                    const productImages = document.querySelectorAll('.product-image');
                    productImages.forEach(img => {
                        img.addEventListener('click', function() {
                            selectProduct(this.getAttribute('data-name'), this.getAttribute('data-image'));
                        });
                    });
                } else {
                    productContainer.innerHTML = '<p>No products available.</p>';
                }
            })
            .catch(error => console.error('Error loading products:', error));
    } else {
        productContainer.innerHTML = '<p>Select a category to see products.</p>';
    }
}

function selectProduct(name, image) {
    const selectedProductDisplay = document.getElementById('selected-product');
    selectedProductDisplay.innerHTML = `
        <img src="../uploads/${image}" class="img-fluid selected-image" alt="${name}">
        <p>You selected: ${name}</p>
    `;
    document.getElementById('selected-product-name').value = name; 

    const selectedImage = document.querySelector('.selected-image');
    selectedImage.style.maxWidth = '100%'; 
    selectedImage.style.height = 'auto'; 
}

document.getElementById('surveyForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const formData = new FormData(this);

    fetch('submit_survey.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('Survey submitted successfully!'); 
        this.reset(); 
        const modal = bootstrap.Modal.getInstance(document.getElementById('surveyModal'));
        modal.hide(); 
    })
    .catch(error => console.error('Error submitting survey:', error));
});
