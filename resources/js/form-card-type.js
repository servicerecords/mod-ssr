const valid = require('card-validator');

const form = document.getElementById('card-details');
const acceptedCards = form.querySelector('.accepted-cards');
const cardInput = form.querySelector('#card-no');
const cards = Array.prototype.slice.call(acceptedCards.querySelectorAll('li'));
const cvcInput = form.querySelector('#cvc');
const amexCvcTip = form.querySelector('.amex-cvc');
const genericCvcTip = form.querySelector('.generic-cvc');

const showCardType = (event) => {
    if (event.target.value.length < 1) {
        acceptedCards.classList.add('field-empty');
    }
    var validCard = valid.number(event.target.value);
    console.log(validCard);
    if (validCard.card !== null) {
        //console.log(validCard.card.type);
        cards.forEach(function (card) {
            //console.log(card.classList.contains(validCard.type));
            if (card.classList.contains(validCard.card.type)) {
                acceptedCards.classList.remove('field-empty');
                card.classList.add('selected')
            } else {
                card.classList.remove('selected');
            }
        });

        if (validCard.card.type === 'american-express') {

        }
    }
}

cardInput.addEventListener('keyup', showCardType, false);


// exports.listenInputKeyUp = () => {
// 	const form = document.getElementById('card-details');
// 	const acceptedCards = form.querySelector('.accepted-cards');
// 	const cardInput = form.querySelector('#card-no');
// 	const cards = Array.prototype.slice.call(acceptedCards.querySelectorAll('li'));
//
// 	acceptedCards.classList.add('field-empty');
// 	console.log(cards);
// 	// cardInput.addEventListener('blur', unselectIfNotAvailable, false);
// 	cardInput.addEventListener('keyup', showCardType, false);
//
// 	const showCardType = (event) => {
// 		var name = valid.number(event.target.value);
// 		cards.forEach(function (card) {
// 			if (card.classList.contains(name)) {
// 				card.classList.add('selected')
// 			}
// 		})
// 	}
// }

