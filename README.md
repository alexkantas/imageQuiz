# Image Quiz Game

Web based game developed with Javascript, MaterializeCSS and PHP

You can play [here](https://projects.kantas.net/imageQuiz)

## Introduction

The game shows variοus images with faces of people.
The player should memorize the faces

The time and number of tips a player use to answer is recorded and sent back to server

Admin can upload photos, locally or fetch an extrernal URL, and set the attributes as name and level 

## Game Start

The game start in `index.html` file.
The `loadFaces(url,level)` should be call for the initialization of the game

The `level` agrument is used for POST to server witch level questions we need

The `url` should sent a JSON response like this

```json
[
  { "id": "0",
    "image": "/images/emma.jpg",
    "level": "1",
    "name": "Emma"},
  { "id": "1",
    "image": "/images/albert.jpg",
    "level": "1",
    "name": "Albert" }
]
```

## Game On

After player memorize the the faces, he direct's to `gameOn.hmtl`
The `startGame(url,level)` should be call for the initialization

Player's answers: question, number of help clicks, and time are stored in a JSON locally and posted to server at the end

## Upload an image

In `admin\upload.html` you can upload an image from your computer or fetch from an exteral URL.
`actions\upload.php` checks if the file/URL is valid and saves it.

## Database set up

To run this application you should deploy to PHP server with Mysql/MariaDB running
Setup the `data\configDB.php` with your database crendentials
Crete the table below
```sql
CREATE TABLE `questions` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`image` VARCHAR(500) NOT NULL,
	`level` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
)
```

## Run without back-end

You can run the `index.html` , `gameOn.html` ,`admin\dashboard.html` by providing a url of a static JSON file in a format as stated above at `loadFaces` `startGame` `showAll` javascript functons
Although you should still run this from a http server cause the cross origin policies
