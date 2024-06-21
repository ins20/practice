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
<a href="/" class="back">
    <svg width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#000000">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <defs>
          <style>
            .cls-1 {
              fill: none;
              stroke: #000000;
              stroke-linecap: round;
              stroke-linejoin: round;
              stroke-width: 20px;
            }
          </style>
        </defs>
        <g data-name="Layer 2" id="Layer_2">
          <g data-name="E416, back, Media, media player, multimedia, player"
            id="E416_back_Media_media_player_multimedia_player">
            <circle class="cls-1" cx="256" cy="256" r="246"></circle>
            <polyline class="cls-1" points="333.82 100.37 178.18 256 333.82 411.63"></polyline>
          </g>
        </g>
      </g>
    </svg>
  </a>
    <form id="order">
        <textarea name="description" id="description" placeholder="Описание" required></textarea>
        <label for="photo_before" class="uploadFile">
            <input type="file" name="photo_before" id="photo_before" style="display: none;" required>
            Фото до
        </label>
        <button>Отправить</button>
    </form>
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

    $.ajax({
        url: 'api/check.php',
        type: 'GET',
        success: function (data) {
            if (JSON.parse(data).role !== 'client') {
                location.pathname = `/${JSON.parse(data).role}.php`
            }
        },
        error: function (data) {
            location.pathname = '';
        }
    })

    getOrders()

    function createReview(e, id) {
        e.preventDefault();
        const review = e.target.querySelector('textarea').value;
        const formData = new FormData();
        formData.append('review', review);
        formData.append('id', id);
        $.ajax({
            url: 'api/review.php',
            type: 'POST',
            data: formData,
            success: getOrders,
            processData: false,
            contentType: false,

        })
    }

    $('#order').on('submit', function (e) {
        e.preventDefault();


        // Получаем файл изображения
        const photo_before = $('#photo_before')[0].files[0];
        const description = $('#description').val();
        // Создаем объект данных формы
        const formData = new FormData();
        formData.append('photo_before', photo_before);
        formData.append('description', description);
        $.ajax({
            url: 'api/client.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: getOrders
        });
    });

    function getOrders() {
        $.ajax({
            url: '/api/client.php',
            type: 'GET',
            data: {
                id: 1
            },
            success: function (data) {
                const orders = JSON.parse(data).map(order => (
                    `<tr>
                        <td>${order.description}</td>
                        <td><img src="data:image/png;base64,${order.photo_before}" width="100" alt="Фото до" /></td>
                        <td><img src="data:image/png;base64,${order.photo_after}"  width="100" alt="Фото после еще не загружено" /></td>
                        <td>${order.estimate}</td>
                        <td>
                        <form onsubmit="createReview(event, ${order.id})">
                        <textarea ${!order.photo_after && 'disabled'} defaultValue="${order.review || ''}" placeholder="${order.review || 'Нет отзыва'}"></textarea>
                        <button ${!order.photo_after && 'disabled'}>Отправить</button>
                        </form>
                        </td>
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