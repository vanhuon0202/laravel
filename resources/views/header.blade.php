<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="home.php">smart</a></div>
            <div class="spacing"></div>
            <div class="button">
                <ul>
                    <li><a href="home.php">home</a></li>
                    <li><a href="about.php">about</a></li>
                    <li class="dropdown">
                        <a href="meal_user.php" class="dropbtn">collections</a>
                        <div class="dropdown-content">
                            <a href="#" data-meal="lunch">lunch</a>
                            <a href="#" data-meal="regular">Regular</a>
                            <a href="#" data-meal="snacks">snacks</a>
                            <a href="#" data-meal="dessert">dessert</a>
                            <a href="#" data-meal="beverages">beverages</a>
                        </div>
                    </li>
                    <li><a href=""></a>Features</li>
                    <li><a href=""></a>Pricing</li>
                    <li>
                        <a href=""></a>
                    </li>
                    <li>
                        <a href=""></a>
                    </li>
                </ul>
            </div>
            <div class="btn-icon">
                <div class="search"> <i class="fa-solid fa-magnifying-glass"></i></div>
                <div class="cart"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></div>
                <div class="dropdown-user">
                    <button class="dropbtn-user"><i class="fa-solid fa-user"></i></button>
                    <div class="dropdown-login">
                        <a href="login.php" id="loginBtn">Login</a>
                        <a href="logout.php" id="logoutBtn">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>















    <footer class="footer-distributed">

        <div class="footer-left">

            <h3>SMART<span>logo</span></h3>

            <p class="footer-links">
                <a href="#">Home</a>
                ·
                <a href="#">Blog</a>
                ·
                <a href="#">Pricing</a>
                ·
                <a href="#">About</a>
                ·
                <a href="#">Faq</a>
                ·
                <a href="#">Contact</a>
            </p>

            <p class="footer-company-name">Company Name © 2015</p>

            <div class="footer-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>


        </div>

        <div class="footer-right">

            <p>Contact Us</p>

            <form action="#" method="post">

                <input type="text" name="email" placeholder="Email">
                <textarea name="message" placeholder="Message"></textarea>
                <button>Send</button>

            </form>

        </div>

    </footer>



    <script>
    // Lấy danh sách các phần tử bữa ăn
    var mealLinks = document.querySelectorAll('.dropdown-content a[data-meal]');

    // Lặp qua danh sách các phần tử bữa ăn và thêm sự kiện click cho chúng
    for (var i = 0; i < mealLinks.length; i++) {
        mealLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            // Lấy giá trị của thuộc tính "data-meal"
            var meal = this.getAttribute('data-meal');

            // Hiển thị phần tương ứng trên trang "Meal"
            showMeal(meal);
        });
    }

    // Hàm hiển thị phần tương ứng trên trang "Meal"
    function showMeal(meal) {
        // Lấy tất cả các phần tử bữa ăn
        var mealItems = document.querySelectorAll('.meal-item');

        // Lặp qua danh sách các phần tử bữa ăn và kiểm tra bữa ăn tương ứng
        for (var i = 0; i < mealItems.length; i++) {
            var mealItem = mealItems[i];

            // Kiểm tra nếu bữa ăn của phần tử trùng khớp với bữa ăn đã chọn
            if (mealItem.getAttribute('data-meal') === meal) {
                mealItem.style.display = 'block'; // Hiển thị phần tử
            } else {
                mealItem.style.display = 'none'; // Ẩn phần tử
            }
        }
    }

    // Lấy các phần tử liên quan đến login/logout
    var loginBtn = document.getElementById('loginBtn');
    var logoutBtn = document.getElementById('logoutBtn');

    // Kiểm tra xem người dùng đã đăng nhập hay c
    // Ẩn hoặc hiển thị các nút login/logout tương ứng
    if (isLoggedIn) {
        loginBtn.style.display = 'none';
        logoutBtn.style.display = 'block';
    } else {
        loginBtn.style.display = 'block';
        logoutBtn.style.display = 'none';
    }

    // Xử lý sự kiện click cho nút logout
    logoutBtn.addEventListener('click', function(event) {
        event.preventDefault();

        // Chuyển hướng đến trang logout.php để đăng xuất
        window.location.href = 'logout.php';
    });
    </script>

</body>

</html>l