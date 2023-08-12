<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/category-admin.css') }}">
    </style>
</head>

<body>
    @extends('dashboard')
    @section('content')
    <div class="container">
        <div class="header">
            <h1>Category</h1>
            <div class="add-category-container">
                <button id="addCategoryBtn" class="add-category-btn">Add Category</button>
            </div>
        </div>
        @if (!empty($categories))
        <div class="content-category">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td data-id="{{ $category->id }}">{{ $category->id }}</td>
                        <td class="name" data-id="{{ $category->id }}">{{ $category->name }}</td>
                        <td class="action-buttons">
                            <form method="POST" action="{{ route('category.delete', ['id' => $category->id]) }}">
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
            <form id="editCategoryForm" action="{{ route('category.save') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-row">
                    <label for="categoryName">Category Name:</label>
                    <input type="text" id="categoryName" name="name" required>
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