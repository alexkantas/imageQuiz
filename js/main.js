		var i = 0, images = ["images/emma.jpg",
			"images/albert.jpg",
			"images/portrait.jpg"];

		function mySlide(param) {
			if (param === 'next') {
				i++;
				if (i === images.length) { i = images.length - 1; }
			} else {
				i--;
				if (i < 0) { i = 0; }
			}

			document.getElementById('slide').src = images[i];
		}