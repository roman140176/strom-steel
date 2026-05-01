$(document).ready(function () {
  $('.js-services-slider')
    .not('.slick-initialized')
    .slick({
      fade: false,
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      speed: 800,
      dots: false,
      arrows: false,
      prevArrow:
        '<div class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><circle opacity="0.6" cx="25" cy="25" r="25" transform="matrix(-1 0 0 1 50 0)" fill="#CCCCCC"/><path d="M18.4697 25.5303C18.1768 25.2374 18.1768 24.7626 18.4697 24.4697L23.2426 19.6967C23.5355 19.4038 24.0104 19.4038 24.3033 19.6967C24.5962 19.9896 24.5962 20.4645 24.3033 20.7574L20.0607 25L24.3033 29.2426C24.5962 29.5355 24.5962 30.0104 24.3033 30.3033C24.0104 30.5962 23.5355 30.5962 23.2426 30.3033L18.4697 25.5303ZM31 25.75H19V24.25H31V25.75Z" fill="black"/></svg></div>',
      nextArrow:
        '<div class="next"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><circle opacity="0.6" cx="25" cy="25" r="25" fill="#CCCCCC"/><path d="M31.5303 25.5303C31.8232 25.2374 31.8232 24.7626 31.5303 24.4697L26.7574 19.6967C26.4645 19.4038 25.9896 19.4038 25.6967 19.6967C25.4038 19.9896 25.4038 20.4645 25.6967 20.7574L29.9393 25L25.6967 29.2426C25.4038 29.5355 25.4038 30.0104 25.6967 30.3033C25.9896 30.5962 26.4645 30.5962 26.7574 30.3033L31.5303 25.5303ZM19 25.75H31V24.25H19V25.75Z" fill="black"/></svg></div>',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            arrows: true,
          },
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            arrows: true,
          },
        },
      ],
    });
  $('.js-services-slider_sm')
    .not('.slick-initialized')
    .slick({
      fade: false,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: false,
      speed: 800,
      dots: false,
      arrows: false,
      prevArrow:
        '<div class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><circle opacity="0.6" cx="25" cy="25" r="25" transform="matrix(-1 0 0 1 50 0)" fill="#CCCCCC"/><path d="M18.4697 25.5303C18.1768 25.2374 18.1768 24.7626 18.4697 24.4697L23.2426 19.6967C23.5355 19.4038 24.0104 19.4038 24.3033 19.6967C24.5962 19.9896 24.5962 20.4645 24.3033 20.7574L20.0607 25L24.3033 29.2426C24.5962 29.5355 24.5962 30.0104 24.3033 30.3033C24.0104 30.5962 23.5355 30.5962 23.2426 30.3033L18.4697 25.5303ZM31 25.75H19V24.25H31V25.75Z" fill="black"/></svg></div>',
      nextArrow:
        '<div class="next"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><circle opacity="0.6" cx="25" cy="25" r="25" fill="#CCCCCC"/><path d="M31.5303 25.5303C31.8232 25.2374 31.8232 24.7626 31.5303 24.4697L26.7574 19.6967C26.4645 19.4038 25.9896 19.4038 25.6967 19.6967C25.4038 19.9896 25.4038 20.4645 25.6967 20.7574L29.9393 25L25.6967 29.2426C25.4038 29.5355 25.4038 30.0104 25.6967 30.3033C25.9896 30.5962 26.4645 30.5962 26.7574 30.3033L31.5303 25.5303ZM19 25.75H31V24.25H19V25.75Z" fill="black"/></svg></div>',
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            arrows: true,
          },
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            arrows: true,
          },
        },
      ],
    });

  // При клике на кнопку "dropdown-button"
  $('.dropdown-button').click(function () {
    // Переключаем видимость выпадающего контейнера
    $('.dropdown-content').toggle();
    // Добавляем/удаляем класс "active" для управления вращением стрелки
    $('.dropdown').toggleClass('active');
  });

  const btn = `<svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
  <path d="M11.248 5.93945L7.49805 9.68945L3.74805 5.93945" stroke="black" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
</svg>`;

  // При клике на элемент списка "dropdown-item"
  $('.dropdown-item').click(function () {
    // Получаем текст выбранного элемента
    var selectedText = $(this).text();
    // Устанавливаем текст кнопки равным выбранному элементу
    $('.dropdown-button').text(selectedText);
    $('.dropdown-button').append(btn);
    // Скрываем выпадающий контейнер
    $('.dropdown-content').hide();
    // Убираем класс "active" для вращения стрелки в исходное положение
    $('.dropdown').removeClass('active');
  });
});
