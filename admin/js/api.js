const DRINKS_URL = 'https://hongminhdev-pizza-api.herokuapp.com/drinks';
const VOUCHERS_URL = 'https://hongminhdev-pizza-api.herokuapp.com/vouchers';
const ORDERS_URL = 'https://hongminhdev-pizza-api.herokuapp.com/orders';

function getAllDrinks() {
    return $.ajax({
        method: "GET",
        url: DRINKS_URL
    });
}

function getAllVouchers() {
    return $.ajax({
        method: "GET",
        url: VOUCHERS_URL
    });
}

function getAllOrders() {
    return $.ajax({
        method: "GET",
        url: ORDERS_URL
    });
}

function updateDrink(url, drink) {
    return $.ajax({
        method: "PUT",
        url: url + DRINKS_URL + "/" + drink.id,
        data: drink
    });
}