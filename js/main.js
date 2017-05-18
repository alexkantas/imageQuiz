function loadFaces(url) {
  var quizData = [];
  var index = -1;
  var $start = $('#start');
  var $end = $('#end');
  var $image = $('#image');
  var $text = $('#text');
  var $name = $('#name');
  var $prev = $('#previous');
  var $next = $('#next');

  $.getJSON(url, function (data) {
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

function showAll(url) {
  var $questionList = $("#questionList");
  var $actionButtons;
  $('#delete-modal').modal();

  var questionBlockTemplate = '<li class="collection-item avatar">' +
        '<img src="{image}" alt="" class="circle">' +
        '<span class="title">Id <span>{id}</span></span>' +
        '<p>{name}</p>' +
        '<p>level <span>{level}</span></p>' +
        '<a quetionId="{id}" questionName="{name}" class="secondary-content delete-button"><i class="material-icons">delete</i></a>' +
        '</li>';

  $.getJSON(url, function (data) {
    data.forEach(function (question) {
      questionBlock = questionBlockTemplate
      .replace(/{image}/g, question.image)
      .replace(/{id}/g, question.id)
      .replace(/{name}/g, question.name)
      .replace(/{level}/g, question.level);
      $questionList.append(questionBlock);
    });
    $actionButtons = $('.delete-button');
    $actionButtons.click(function () {
    var questionId = $(this).attr('quetionId');
    $('#confirm-message').text('Delete the image with id ' + questionId + ' and name ' + $(this).attr('questionName') + ' ?');
    $('#inputdata').attr('value',questionId);
    $('#delete-modal').modal('open');
  });
  })
    .fail(function () {
      $questionList.text("An error occupied :( Please try to reload the page!");
    })
    .always(function(){
      $('#preloader').hide();
    });
}