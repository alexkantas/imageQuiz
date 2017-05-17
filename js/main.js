function loadFaces() {
  var quizData = [];
  var index = -1;
  var $start = $('#start');
  var $end = $('#end');
  var $image = $('#image');
  var $text = $('#text');
  var $name = $('#name');
  var $prev = $('#previous');
  var $next = $('#next');

  $.getJSON("/data/quizData.json", function (data) {
    console.log(data);
    quizData = data;
  })
    .always(function () {
      if (quizData.length < 1) {
        console.log(quizData.length);
        errorAction();
      }
    });

  $next.click(function () {
    index++;
    update();
  });

  $prev.click(function () {
    index--;
    update();
  });

  function errorAction() {
    $("#start-title").text("An error occupied :( Please try to reload the page!");
    $next.hide();
    index = -2;
  }

  function update() {
    if (index === -1) {
      $start.show();
      $text.hide();
      $prev.hide();
      load('', '');
      return;
    }
    if (index === 0) {
      $start.hide();
      $text.show();
      $prev.show();
    }
    if (index === quizData.length - 1) {
      $end.hide();
      $text.show();
      $next.show();
    }
    if (index === quizData.length) {
      $end.show();
      $text.hide();
      $next.hide();
      load('', '');
      return;
    }
    load(quizData[index].image, quizData[index].name);
  }

  function load(image, name) {
    $image.attr('src', '');
    $image.attr('src', image);
    $name.text(name);
  }
}