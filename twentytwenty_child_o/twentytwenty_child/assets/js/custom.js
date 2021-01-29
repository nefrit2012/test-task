jQuery(document).ready(function($) {
			$(".colorH1").on("click",function(){
				let r = Math.floor(Math.random() * 254);
				let g = Math.floor(Math.random() * 254);
				let b = Math.floor(Math.random() * 254);
				$(this).css('background-color', 'rgba(' + r +', '+ g + ', '+ b +')');
				console.log("Color changed");
			});
});
