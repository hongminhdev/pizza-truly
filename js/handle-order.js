const VOUCHER_URL = "https://hongminhdev-pizza-api.herokuapp.com/vouchers";
const ORDER_URL = "https://hongminhdev-pizza-api.herokuapp.com/orders";
let getDataQueryString = {};
let getVoucherCode = {};
let getInforCustomer = {};

let job = {
    "voucher_code": "12332",
    "drink_code": "COCA",
    "type_pizza": "HAWAII",
    "size": "L",
    "diameter": 30,
    "grilled_ribs": 8,
    "salad": 500,
    "quantity": 4,
    "price": 250000,
    "fullname": "Thanh Loc",
    "email": "thanhloc@gmail.com",
    "phone": "0547965782",
    "address": "Vinh Long",
    "message": ""
  
}

$(document).ready( () => {
    onPageOrderLoading();

}); 

function onPageOrderLoading() {
    'use strict'
    const PARAMS = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    getDataQueryString.drink_code = PARAMS.drink;
    getDataQueryString.type_pizza = PARAMS.type;
    getDataQueryString.size = PARAMS.size;
    getDataQueryString.diameter = parseInt(PARAMS.diameter);
    getDataQueryString.grilled_ribs = parseInt(PARAMS.grilled_ribs);
    getDataQueryString.salad = parseInt(PARAMS.salad);
    getDataQueryString.quantity = parseInt(PARAMS.quantity);
    getDataQueryString.price = parseInt(+PARAMS.price + '000');
}

function showInforOrder(percentDiscount) {
    'use strict'
    $('#modal-order').modal();
    let dataObjRequest = getInforOrder();
    let totalPrice = calTotalPrice(dataObjRequest.price, percentDiscount);
    let discount = dataObjRequest.price - totalPrice; 
    loadDataModalFormOrder(dataObjRequest, percentDiscount, discount, totalPrice);
}

function getInforOrder() {
    'use strict'
    getVoucherCode.voucher_code = $('#inp-voucher').val();
    getInforCustomer.fullname = $('#inp-fullname').val();
    getInforCustomer.email = $('#inp-email').val();
    getInforCustomer.phone = $('#inp-phone').val();
    getInforCustomer.address = $('#inp-address').val();
    getInforCustomer.message = $.trim($('#txt-message').val());

    let dataObjRequest = {...getVoucherCode, ...getDataQueryString, ...getInforCustomer};
    return dataObjRequest;
}

function calTotalPrice(paramPrice, paramPercent) {
    'use strict'
    let totalPrice = paramPrice * (100 - paramPercent) / 100;
    return totalPrice;
}

function loadDataModalFormOrder(paramData, paramPercent, paramDiscount, paramTotal) {
    'use strict'
    let element = $('#frm-infor-order').find('p[id], div[id]');
    let discount = paramDiscount.toLocaleString(undefined);
    let total = paramTotal.toLocaleString(undefined);
    let dataObj = {...paramData, ...{percent_discount: paramPercent}, ...{discount: discount}, ...{total_price: total}};

    for (let i in dataObj) {
        for (let j of element) {
            if (i === j.id) {
                $(`#${j.id}`).html(dataObj[i]);
            }
        }
    }
    handleUnit();
}

function handleUnit() {
    'use strict'
    $('#size').html( $('#size').html() + " (small)" );
    $('#diameter').html( $('#diameter').html() + "cm" );
    $('#salad').html( $('#salad').html() + "g" );
    $('#percent_discount').html( $('#percent_discount').html() + "%" );
    $('#discount').html( $('#discount').html() + "đ" );
    $('#price').html( parseInt($('#price').html()).toLocaleString(undefined) + "đ" );
    $('#total_price').html( $('#total_price').html() + "đ" );
}

async function postData(url = '', data = {}) {
    const response = await fetch(url, {
        method: "POST",
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    return response.json();
}

function handleFormModal() {
    'use strict'
    $('#modal-order').modal("hide");
    $('#frm-infor-order').find('p[id], div[id]').html('');
}

function resetFormOrder() {
    'use strict'
    $('#frm-order').find('input, textarea').val('');
}



