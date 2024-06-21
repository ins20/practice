<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <a href="./login.php" class="profile">
    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path
          d="M12.12 12.78C12.05 12.77 11.96 12.77 11.88 12.78C10.12 12.72 8.71997 11.28 8.71997 9.50998C8.71997 7.69998 10.18 6.22998 12 6.22998C13.81 6.22998 15.28 7.69998 15.28 9.50998C15.27 11.28 13.88 12.72 12.12 12.78Z"
          stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path
          d="M18.74 19.3801C16.96 21.0101 14.6 22.0001 12 22.0001C9.40001 22.0001 7.04001 21.0101 5.26001 19.3801C5.36001 18.4401 5.96001 17.5201 7.03001 16.8001C9.77001 14.9801 14.25 14.9801 16.97 16.8001C18.04 17.5201 18.64 18.4401 18.74 19.3801Z"
          stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path
          d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
          stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
      </g>
    </svg>
  </a>

  <main>
    <h2>Услуги</h2>
    <div class="services">
      <div class="service">
        <img width="200" src="https://stroyipoy.ru/_files/blog/image/sovremennyj-dizajn-molodezhnoj-komnaty7.jpg"
          alt="">
        <p class="title">Комната</p>
      </div>
      <div class="service">
        <img width="200" src="https://mos-kapital.ru/wp-content/uploads/2020/07/remont-zala.jpg" alt="">

        <p class="title">Кваритра</p>
      </div>
      <div class="service">
        <img width="200" src="https://mig.pics/uploads/posts/2021-03/1617211615_2-p-dom-v-sovremennom-stile-2.jpg"
          alt="">

        <p class="title">Дом</p>
      </div>
      <div class="service">
        <img width="200"
          src="https://bigfoto.name/uploads/posts/2022-02/1643705512_34-bigfoto-name-p-garazh-v-kottedzhe-v-interere-71.jpg"
          alt="">

        <p class="title">Гараж</p>
      </div>

    </div>
    <h2>Отзывы</h2>
    <div>

      <div id="reviews" class="reviews">

      </div>
    </div>
  </main>
</body>
<script>
  $.ajax({
    url: 'api/review.php',
    type: 'GET',
    success: function (orders) {
      const reviews = JSON.parse(orders).map(order => (
        `<div class="review">
        <div class="info" >
          <p>${order.login}</p>
          <p>${order.review}</p>
        </div>
        <div class="photos">
          <div class="photo">
 <img width='200' height='200' class='photoBefore' src="data:image/png;base64,${order.photo_before}" alt="фото до" width="100">
 <p class='titleBefore title'>${new Date(order.created_at).toLocaleDateString()}</p>         
 </div>
        <div class="photo">
         <img width='200' height='200' class='photoAfter' src="data:image/png;base64,${order.photo_after}" alt="фото после" width="100">
         <p class='titleAfter title'>${new Date(order.updated_at).toLocaleDateString()}</p>         

         </div>
        </div>
      </div>`
      ));
      $('#reviews').append(reviews);
    }
  })
</script>

</html>