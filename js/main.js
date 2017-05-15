var quizData = [
  { id: 0,
    image: "images/emma.jpg",
    name: "Emma"},
  { id: 1,
    image: "images/albert.jpg",
    name: "Albert" },
  { id: 3,
    image: "images/portrait.jpg",
    name: "Natalie"}
];
var index = -1;
var $start = $('#start');
var $end = $('#end');
var $image = $('#image');
var $text = $('#text');
var $name = $('#name');
var $prev = $('#previous');
var $next = $('#next');

function update(){
  if(index===-1){
    $start.show();
    $text.hide();
    load('','');
    return;
  }
  if(index===0){
    $start.hide();
    $text.show();
  }
  if(index===quizData.length-1){
    $end.hide();
    $text.show();
  }
  if(index===quizData.length){
    $end.show();
    $text.hide();
    load('','');
    return;
  }
  load(quizData[index].image,quizData[index].name);
}

function load(image,name){
  $image.attr('src',image);
  $name.text(name);
}

$next.click(function(){
  console.log(index);
  if(index===quizData.length){
    return;
  }
  index++;
  update();
});

$prev.click(function(){
  if(index===-1){
    return;
  }
  index--;
  update();
});