/*jslint esnext:true, browser:true*/
class Grille {
	static recomposer() {
		this.domaine = document.querySelector("div.grille");
		this.compiler();
		var resultat = document.createElement("table");
		var tbody = resultat.appendChild(document.createElement("tbody"));
		var elements = Array.from(this.domaine.children);
		elements.forEach(function (e) {
			tbody.appendChild(this.rangee(e));
		}, this);
		this.domaine.appendChild(resultat);
	}
	static zzzrecomposer() {
		this.domaine = document.querySelector("div.grille");
		var elements = Array.from(this.domaine.children);
		elements.forEach(function (e) {
			for (let i=0; i<10; i++) {
				var span = document.createElement("span");
				span.innerHTML = "2";
				span.setAttribute("data-valeur", e.getAttribute("data-valeur"));
				e.parentNode.insertBefore(span, e.nextSibling);
			}
		}, this);
	}
	static getValeur(element) {
		if (!element) {
			return false;
		}
		var resultat = parseFloat(element.getAttribute("data-valeur"));
		if  (isNaN(resultat)) {
			return false;
		}
		return resultat;
	}
	static compiler() {
		var elements = Array.from(this.domaine.children);
		while (elements.length > 1) {
			let ptr = 0;
			while (ptr < elements.length) {
				while (this.getValeur(elements[ptr]) === false) {
					ptr += 1;
				}
				let total = 0;
				while (this.getValeur(elements[ptr]) !== false) {
					let valeur = this.getValeur(elements[ptr]);
					total += valeur;
					elements.splice(ptr, 1);
				}
				elements[ptr-1].setAttribute("data-valeur", total);
				elements[ptr-1].classList.add("compile");

			}
		}
	}
	static rangee(element) {
		var resultat = document.createElement("tr");
		var th = resultat.appendChild(document.createElement("th"));
		th.appendChild(element);
		var localName = element.localName;
		resultat.classList.add(element.localName);
		for (let i = 0; i < 1; i += 1) {
			let td = resultat.appendChild(document.createElement("td"));
			let dataValeur = element.getAttribute("data-valeur");
			if (element.classList.contains("compile")) {
				td.setAttribute("data-valeur", dataValeur);
			} else {
				td.appendChild(this.cochesValeur(dataValeur));
			}
		}
		return resultat;
	}
	static cochesValeur(val) {
		var resultat = document.createElement("span");
		resultat.classList.add("cochesValeur");
		resultat.setAttribute("data-valeur", val);
		for (let i = 0; i <= val; i += 1) {
			let span = resultat.appendChild(document.createElement("span"));
			span.innerHTML = i;
		}
		return resultat;
	}

	static load() {
		this.recomposer();
		var b = document.querySelector("div.body");
		b.appendChild(b.firstElementChild.cloneNode(true));
	}
	static init() {
		window.addEventListener("load", function () {
			Grille.load();
		});
	}
}
Grille.init();
