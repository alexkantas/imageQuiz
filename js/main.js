/**
Copyright 2017 Kantas.net

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
 */

function startGame(url, level) {
  var quizData = [];
  var index = -1;
  var $answer = $('#answer');
  var $levelText = $('#level');
  var $start = $('#start');
  var $image = $('#image');
  var $end = $('#end');
  var $seconds = $('#seconds');
  var $help = $('#help');
  var $next = $('#next');
  var startTime;
  var timeInterval;
  var userAnswers = [];
  var currentAnswer;
  var Answer = function (id) {
    return {
      id: id,
      helps: 0,
      time: 0
    }
  };


  $.ajax({
    type: "POST",
    url: url,
    dataType: "JSON",
    data: { "level": level }
  })
    .done(function (data) {
      quizData = data;
      $levelText.text(level);
      $next.focus();
    })
    .always(function () {
      if (quizData.length < 1) {
        console.log(quizData.length);
        errorAction();
      }
    });

  function errorAction() {
    $("#start").text("An error occupied :( Please try to reload the page!");
    $next.hide();
    index = -2;
  }

  $next.click(function () {
    index++;
    update();
  });

  function update() {

    if (index === 0) {
      $start.hide();
      $next.addClass('pulse');
      startQuestion();
      return;
    }

    if (index === quizData.length) {
      $end.show();
      $next.hide();
      $seconds.text('');
      $answer.val('');
      load('');
      $('#dataSend').val(JSON.stringify(userAnswers));
      $('#results-button').focus();
      return;
    }

    startQuestion();
  }

  function load(image) {
    $image.attr('src', '');
    $image.attr('src', image);
  }

  function startTimer() {
    startTime = Date.now();
    updateClock();
    timeInterval = setInterval(updateClock,1000);
  }

  function updateClock(){
    $seconds.text(Math.round((Date.now()-startTime)/1000));
  }

  function addListeners(name) {
    $answer.on('change', function () {
      var value = $(this).val().trim().toLowerCase();
      if (value === name.toLowerCase()) {
        completeQuestion();
      }
    });

    $help.on('click', function () {
      if (currentAnswer.helps !== name.length - 1) {
        currentAnswer.helps++ ;
      }
      var tip = name.substr(0, currentAnswer.helps);
      Materialize.toast('Name starts with: ' + tip, 5000);
      $answer.val(tip);
    });
  }

  function removeListeners() {
    $answer.off('change');
    $help.off('click');
  }

  function startQuestion() {
    $next.removeClass('scale-in');
    load(quizData[index].image);
    addListeners(quizData[index].name);
    currentAnswer = Answer(quizData[index].id);
    $answer.val('');
    $answer.focus();
    startTimer();
  }

  function completeQuestion() {
    clearInterval(timeInterval);
    removeListeners();
    Materialize.toast('Thats Right!', 4000);
    currentAnswer.time = $seconds.text();
    userAnswers.push(currentAnswer);
    $next.addClass('scale-in');
    $next.focus();
    console.log(userAnswers);
  }
}


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
      $('#inputdata').attr('value', questionId);
      $('#delete-modal').modal('open');
    });
  })
    .fail(function () {
      $questionList.text("An error occupied :( Please try to reload the page!");
    })
    .always(function () {
      $('#preloader').hide();
    });
}