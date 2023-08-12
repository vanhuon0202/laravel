<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/product-admin.css') }}">
    </style>
</head>

<body>
    @extends('dashboard')
    @section('content')
    <div class="container">
        <div class="header">
            <h1>Product</h1>
            <div class="add-category-container">
                <button id="addCategoryBtn" class="add-category-btn">Add Product</button>
            </div>
        </div>
        @if (!empty($products))
        <div class="content-category">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Preview</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>

                        <th class="actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td data-id="{{ $product->id }}">{{ $product->id }}</td>
                        <td>a</td>
                        <td class="name" data-id="{{ $product->id }}">{{ $product->name }}</td>
                        <td class="price" data-id="{{ $product->id }}">{{ $product->price }}</td>
                        <td class="description" data-id="{{ $product->id }}">{{ $product->description }}</td>
                        <td class="action-buttons">
                            <form method="POST" action="{{ route('product.delete', ['id' => $product->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure to delete?')"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>No categories found.</p>
        @endif
    </div>

    <!-- Add popup -->
    <div class="popup-overlay" id="addCategoryPopup">
        <div class="popup-content">
            <h3>Add Category</h3>
            <form id="editCategoryForm" action="{{ route('product.save') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-row">
                    <label for="mame">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" required step="0.01">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="brand_id">Brand:</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="">Select a Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="addCategoryPopupBtn" class="add-button">Add Category</button>
            </form>
        </div>
    </div>
    @endsection
    @section('footer')
    <script src="{{ asset('js/category-admin.js') }}"></script>
</body>

</html>