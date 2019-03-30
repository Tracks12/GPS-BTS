/**
 * Author     : CARDINAL Florian
 * File       : script.js
 * Last Modif : 11/03/2019
 * Location   : js/
 */

class anim {
	static startTime(sep) {
		var today = new Date(), delay = 500;
		var h = today.getHours(), m = today.getMinutes(), s;
		if(h < 10) { h = `0${h}`; }
		if(m < 10) { m = `0${m}`; }
		if(!(document.body.clientWidth < 720)) {
			var sep = ":"; s = today.getSeconds();
			if(s < 10) { s = `0${s}`; }
			s = `:${s}`;
		} else { s = ''; delay = 1000; if(sep === ":") { sep = " "; } else { sep = ":"; }}
		$('#time').html(h+sep+m+s);
		setTimeout(function() { anim.startTime(sep); }, delay);
	}
}

class popup {
	static login() {
		var form = '<i id="popupClose" class="fa fa-close"></i>';
		form += '<div class="login">';
		form += '<h2>login</h2>';
		form += '<form id="auth" method="POST">';
		form += '<i class="fa fa-user"></i>';
		form += '<input type="text" name="username" placeholder="utilisateur" maxlength="10" required />';
		form += '<i class="fa fa-key"></i>';
		form += '<input type="password" name="password" placeholder="mot de passe" required />';
		form += '<p class="error"></p>';
		form += '<input type="submit" value="se connecter" />';
		form += '</form>';
		form += '</div>';
		
		$("#popup")
			.html(form)
			.fadeIn();
		
		$("#popupClose").click(function() { popup.close(); });
		$("#auth").submit(function(e) {
			e.preventDefault();
			$("#auth .error").css({ display: 'none' });
			var post = $('#auth').serialize();
			
			$.ajax({
				type: 'POST',
				url: './php/act.php?login',
				data: post,
				dataType: 'json',
				success: function(result) {
					if(result.passed) {
						$("#auth .error")
							.css({ color: 'rgb(0, 150, 0)' })
							.html("connexion...")
							.fadeIn();
						
						$("#auth input[type='submit']").prop({ disabled: true });
						setTimeout(function() { document.location.reload(); }, 1000);
					}
					else {
						$("#auth .error")
							.html(result.error)
							.fadeIn();
					}
				}
			});
		});
	}
	
	static loader() {
		var cl = new CanvasLoader('popup');
		cl.setColor('#EE0000');
		cl.setShape('spiral');
		cl.setDiameter(106);
		cl.setDensity(13);
		cl.setRange(.5);
		cl.setSpeed(1);
		cl.setFPS(35);
		cl.show();
		
		$('#popup')
			.css({ background: 'rgb(238, 238, 238)' })
			.fadeIn();
	}
	
	static close() {
		$('#popup').fadeOut(function() {
			$('#popup')
				.css({ background: '' })
				.html(null);
		});
	}
}

$(document).ready(function() {
	$('nav ul ul').css({ display: 'none' });
	$('nav ul .item .btn').click(function() {
		$('nav ul ul').slideUp();
		$(this)
			.parent('li')
			.find('ul')
			.slideToggle();
	});
	
	$('#map, #pos, #home').click(function() {
		popup.loader();
		$('aside').load("./php/act.php?link="+$(this)[0].id);
	});
	
	$('aside').load("./php/act.php", function() {
		$('#login').click(function() { popup.login(); });
	});
	
	anim.startTime();
	popup.loader();
});

/**
 * END
 */

