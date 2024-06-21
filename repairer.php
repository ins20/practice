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
    getOrders()

    $.ajax({
        url: 'api/check.php',
        type: 'GET',
        success: function (data) {
            if (JSON.parse(data).role !== 'repairer') {
                location.pathname = `/${JSON.parse(data).role}.php`;
            }
        },
        error: function (data) {
            location.pathname = '';
        }
    })
    function getOrders() {
        $.ajax({
            url: 'api/repairer.php',
            type: 'GET',
            success: function (data) {
                const orders = JSON.parse(data).map(order => (
                    `<tr>
                        <td>${order.description}</td>
                        <td><img src="data:image/png;base64,${order.photo_before}" width="100" alt="Фото доF" /></td>
                        <td>
                    ${order.photo_after ? `<img src="data:image/png;base64,${order.photo_after}" width="100" alt="Фото после" />` : `<label class="uploadFile">
                    <input type="file" ${!order.estimate && 'disabled'} name="photo_after" data-id="${order.id}" style="display:none"/>
                    фото после
                    
                    </label>`}
                        </td>
                        <td> ${order.estimate} </td>
                        <td>${order.review || 'отзыва нет'}</td>
                        <td>${order.created_at}</td>
                        <td>${order.updated_at}</td>
                    </tr>`
                ))
                $('#orders').html(orders);
                $("input[type=file]").on('change', function () {
                    const formData = new FormData();
                    const id = $(this).data('id');
                    formData.append('photo_after', this.files[0]);
                    formData.append('id', id);
                    $.ajax({
                        url: 'api/repairer.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: getOrders
                    });
                });
            },
            error: function (data) {
                $('#orders').html('данные не получены');
            }
        });
    }


</script>

</html>