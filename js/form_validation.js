                    
    function ValidateStudentRegisterform()
	{
		res = true;

		form = document.register_form;

		var div = document.getElementById("error");
		div.style.color = "red";
		div.style.position = "absolute";
		div.style.marginLeft = "145px";
		div.style.marginTop = "65px";
		div.style.fontFamily = "Arial, Helvetica, sans-serif";
		div.style.fontSize = "14px";
		div.style.fontWeight = "300";

		if(form.username.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Benutzername eingeben!";
			return res;
		}

		/* reg = new RegExp('^([a-zA-Z0-9-._]+)'+ //Name
					'(@)'+ //@-Zeichen
					'([a-zA-Z0-9-.]+)'+ //Domain
					'(.)'+ //Punkt
					'([a-zA-Z]{2,4})$'); //Domainendung
					
		if(reg.test(form.username.value) == false){res = false;}
		if(res == false)
		{
		var div = document.getElementById("error");
		div.style.color = "red";
		div.style.position = "absolute";
		div.style.marginLeft = "145px";
		div.style.marginTop = "65px";
		div.style.fontFamily = "Arial, Helvetica, sans-serif";
		div.style.fontSize = "14px";
		div.style.fontWeight = "300"
		div.textContent = "Die Email ist nicht korrekt!";
		return res;
		}*/

		if(form.password.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte ein Passwort eingeben!";
			return res;
		}

		if(form.password.value != form.passwordRepeat.value){res = false;}
		if(res == false)
		{
			div.textContent = "Die Passwoerter sind unterschiedlich!";
			return res;
		}

		if(form.lastname.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Nachnamen eingeben!";
			return res;
		}

		if(form.firstname.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Vornamen eingeben!";
			return res;
		}

		if(form.birthdate.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte ein Datum angeben!";
			return res;
		}


		regdate = new RegExp('^([0-9]{2})'+ //Tag
					'(.)'+ //Trennzeichen
					'([0-9]{2})'+ //Monat
					'(.)'+ //Trennzeichen
					'([0-9]{4})$'); //Jahr


		if(regdate.test(form.birthdate.value) == false){res = false;}
		if(res == false)
		{
			div.textContent = "Das Datum ist nicht korrekt!";
			return res;
		}

		var date = form.birthdate.value;
		var dateday = date .slice(0, 2);
		var datemonth = date .slice(3, 5);
		var dateyear = date .slice(6, 10);

		form.birthdate.value = dateyear+'-'+datemonth+'-'+dateday;

		if(form.title[0].checked == false && form.title[1].checked == false){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte eine Anrede auswaehlen!";
			return res;
		}

		return res;
	}
	
	function ValidateInstructorRegisterform()
	{
		res = true;

		form = document.register_form;

		var div = document.getElementById("error");
		div.style.color = "red";
		div.style.position = "absolute";
		div.style.marginLeft = "145px";
		div.style.marginTop = "65px";
		div.style.fontFamily = "Arial, Helvetica, sans-serif";
		div.style.fontSize = "14px";
		div.style.fontWeight = "300";

		if(form.username.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Benutzername eingeben!";
			return res;
		}

		if(form.password.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte ein Passwort eingeben!";
			return res;
		}

		if(form.password.value != form.passwordRepeat.value){res = false;}
		if(res == false)
		{
			div.textContent = "Die Passwoerter sind unterschiedlich!";
			return res;
		}
		
		if(form.title[0].checked == false && form.title[1].checked == false){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte eine Anrede auswaehlen!";
			return res;
		}

		if(form.lastname.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Nachnamen eingeben!";
			return res;
		}

		if(form.firstname.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Vornamen eingeben!";
			return res;
		}

		return res;
	}
	
	 function ValidateAdminRegisterform()
	{
		res = true;

		form = document.register_form;

		var div = document.getElementById("error");
		div.style.color = "red";
		div.style.position = "absolute";
		div.style.marginLeft = "145px";
		div.style.marginTop = "65px";
		div.style.fontFamily = "Arial, Helvetica, sans-serif";
		div.style.fontSize = "14px";
		div.style.fontWeight = "300";

		if(form.username.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte einen Benutzername eingeben!";
			return res;
		}

		if(form.password.value == ''){res = false;}
		if(res == false)
		{
			div.textContent = "Bitte ein Passwort eingeben!";
			return res;
		}

		if(form.password.value != form.passwordRepeat.value){res = false;}
		if(res == false)
		{
			div.textContent = "Die Passwoerter sind unterschiedlich!";
			return res;
		}

		return res;
	}
	
	