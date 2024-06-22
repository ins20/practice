<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <svg class="back" id="logout" style="cursor:pointer" fill="#000000" width="30px" height="30px" viewBox="0 0 32 32"
        version="1.1" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
            <path
                d="M3.651 16.989h17.326c0.553 0 1-0.448 1-1s-0.447-1-1-1h-17.264l3.617-3.617c0.391-0.39 0.391-1.024 0-1.414s-1.024-0.39-1.414 0l-5.907 6.062 5.907 6.063c0.196 0.195 0.451 0.293 0.707 0.293s0.511-0.098 0.707-0.293c0.391-0.39 0.391-1.023 0-1.414zM29.989 0h-17c-1.105 0-2 0.895-2 2v9h2.013v-7.78c0-0.668 0.542-1.21 1.21-1.21h14.523c0.669 0 1.21 0.542 1.21 1.21l0.032 25.572c0 0.668-0.541 1.21-1.21 1.21h-14.553c-0.668 0-1.21-0.542-1.21-1.21v-7.824l-2.013 0.003v9.030c0 1.105 0.895 2 2 2h16.999c1.105 0 2.001-0.895 2.001-2v-28c-0-1.105-0.896-2-2-2z">
            </path>
        </g>
    </svg>
    <table>
        <thead>
            <tr>
                <th>Описание</th>
                <th>Фото до</th>
                <th>Фото после</th>
                <th>Смета</th>
                <th>Отзыв</th>
                <th>Дата создания</th>
                <th>Дата обновления</th>
            </tr>
        </thead>
        <tbody id="orders">

        </tbody>
    </table>
</body>
<script>
    $('#logout').on('click', function () {
        $.ajax({
            url: 'api/logout.php',
            type: 'GET',
            success: function (data) {
                location.pathname = '/';
            },
            error: function (data) {
                // location.pathname = '/';
            }
        })

    })
    getOrders()

    $.ajax({
        url: 'api/check.php',
        type: 'GET',
        success: function (data) {
            if (JSON.parse(data).role !== 'estimator') {
                location.pathname = `/${JSON.parse(data).role}.php`;
            }
        },
        error: function (data) {
            location.pathname = '';
        }
    })

    function addEstimate(e, id) {
        e.preventDefault();
        const form = e.target;
        const estimate = form.querySelector('textarea').value;

        const formData = new FormData();

        formData.append('estimate', estimate);
        formData.append('id', id);

        $.ajax({
            url: 'api/estimator.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                getOrders()
            },
            processData: false,
            contentType: false,

        });
    }

    function getOrders() {
        $.ajax({
            url: 'api/estimator.php',
            type: 'GET',
            success: function (data) {
                const orders = JSON.parse(data).map(order => (
                    `<tr>
                        <td>${order.description}</td>
                        <td><img src="data:image/png;base64,${order.photo_before}" width="100" alt="Фото доF" /></td>
                        <td><img src="${order.photo_after}" alt="Фото после еще не загружено" /></td>
                        <td>
                            <form onsubmit="addEstimate(event, ${order.id})">
                            <textarea required name="estimate" rows="4" cols="50" defaultValue="${order.estimate || ''}" placeholder="${order.estimate || 'Введите смету'}"></textarea>
                            <button >Сохранить</button>
                            </form>
                        </td>
                        <td>${order.review}</td>
                        <td>${order.created_at}</td>
                        <td>${order.updated_at}</td>
                    </tr>`
                ))
                $('#orders').html(orders);
            },
            error: function (data) {
                $('#orders').html('данные не получены');
            }
        });
    }


</script>

</html>