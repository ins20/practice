<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
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
  <form id="login">
    <input type="text" placeholder="Логин" />
    <input type="password" placeholder="Пароль" />
    <button>Войти</button>
    <a href="register.php">Регистрация</a>
  </form>

</body>
<script>
  $('#login').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: 'GET',
      url: 'api/auth.php',
      data: {
        login: $('#login input[type="text"]').val(),
        password: $('#login input[type="password"]').val()
      },
      success: function (data) {
        location.pathname = `/${JSON.parse(data).role}.php`;
      },
      error: function (data) {
        alert(data);
      }
    });
  })
</script>

</html>