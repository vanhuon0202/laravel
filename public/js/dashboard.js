var sidebarToggleBtn = document.getElementById('sidebar-toggle');
var leftSidebar = document.querySelector('.left_sidebar');
var content = document.querySelector('.content');

sidebarToggleBtn.addEventListener('click', function () {
    leftSidebar.classList.toggle('sidebar-hidden');
    if (leftSidebar.classList.contains('sidebar-hidden')) {
        content.style.marginLeft = '0';
        content.style.width = '100%';
    } else {
        content.style.marginLeft = '25%';
        content.style.width = '75%';
    }
});

$(document).ready(function () {
    $('.left_sidebar').on('click', 'a.ajax-link', function (event) {
        event.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#content-container').html(response);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
});