<!DOCTYPE html>
<html>

<head>
    <title>Product</title>
    <style>
    /* CSS để ẩn các phần tử có lớp "hidden" */
    .hidden {
        display: none;
    }

    /* Thẻ cha của popup */
    .product-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    /* Nội dung của popup */
    .product-popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 400px;
        /* Độ rộng của popup */
    }

    /* Nút đóng popup */
    .close-popup {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    /* Căn giữa theo chiều ngang */
    .product-popup-content h2,
    .product-popup-content img,
    .product-popup-content p {
        text-align: center;
        margin: 10px auto;
    }

    /* Nút Add to Cart */
    .add-to-cart-btn {
        display: block;
        margin: 10px auto;
        padding: 10px 20px;
        background-color: #3490dc;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-to-cart-btn:hover {
        background-color: #2779bd;
    }
    </style>
</head>

<body>
    <h1>Product Items</h1>
    <ul class="product-list">
        @foreach ($products as $product)
        <li class="product-item">
            <h2>{{ $product->name }}</h2>
            <img src="{{ $product->image }}" alt="{{ $product->name }}" width="200">
            <p>Price: {{ $product->price }}</p>
            <p class="hidden">Description: {{ $product->description }}</p>
            <p class="hidden">Brand: {{ $product->brand->name }}</p>
            <p class="hidden">Category: {{ $product->category->name }}</p>
            <button class="view-product-btn" data-product-id="{{ $product->id }}">View</button>
        </li>
        @endforeach
    </ul>

    <div class="product-popup" id="productPopup">
        <div class="product-popup-content">
            <form class="add-to-cart-form" action="{{ route('cart.add', ['product_id' => $product->id]) }}"
                method="POST" enctype="multipart/form-data">>
                @csrf
                @method('POST')
                <span class="close-popup">&times;</span>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <h2 class="popup-product-name">{{ $product->name }}</h2>
                <img class="popup-product-image" src="{{ $product->image }}" alt="{{ $product->name }}" width="200">
                <p class="popup-product-price">{{ $product->price }}</p>
                <p class="popup-product-description">{{ $product->description }}</p>
                <p class="popup-product-brand">{{ $product->brand->name }}</p>
                <p class="popup-product-category">{{ $product->category->name }}</p>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
            </form>

        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const viewButtons = document.querySelectorAll(".view-product-btn");
        const popup = document.getElementById("productPopup");

        viewButtons.forEach(button => {
            button.addEventListener("click", function() {
                const productId = button.dataset.productId;

                fetch(`/api/products/${productId}`)
                    .then(response => response.json())
                    .then(product => {
                        const popupProductName = popup.querySelector(".popup-product-name");
                        const popupProductImage = popup.querySelector(
                            ".popup-product-image");
                        const popupProductPrice = popup.querySelector(
                            ".popup-product-price");
                        const popupProductDescription = popup.querySelector(
                            ".popup-product-description");
                        const popupProductBrand = popup.querySelector(
                            ".popup-product-brand");
                        const popupProductCategory = popup.querySelector(
                            ".popup-product-category");
                        const addToCartForm = popup.querySelector(".add-to-cart-form");
                        const quantityInput = addToCartForm.querySelector("#quantity");

                        popupProductName.textContent = product.name;
                        popupProductImage.src = product.image;
                        popupProductPrice.textContent = "Price: " + product.price;
                        popupProductDescription.textContent = "Description: " + product
                            .description;
                        popupProductBrand.textContent = "Brand: " + product.brand;
                        popupProductCategory.textContent = "Category: " + product.category;

                        // addToCartForm.addEventListener("submit", function(event) {
                        //     event.preventDefault();
                        //     const quantity = quantityInput.value;
                        //     // Gửi thông tin lên server hoặc xử lý tương ứng
                        //     console.log("Add to cart:", product.name, "Quantity:",
                        //         quantity);
                        // });

                        popup.style.display = "block";
                    });
            });
        });

        const closePopup = popup.querySelector(".close-popup");
        closePopup.addEventListener("click", function() {
            popup.style.display = "none";
        });
    });
    </script>
</body>

</html>