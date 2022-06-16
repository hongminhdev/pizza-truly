let percent;
async function isValidate() {
    'use strict'
    let isValid = true;
    const openDiv = '<div id="name-error" class="error text-danger font-weight-light font-italic mt-1">';
    const closeDiv = '</div>';

    $('.error').remove();

    const nameElement = $('#inp-fullname')
    if ( $.trim(nameElement.val()) === '' ) {
        isValid = false;
        nameElement.after(openDiv + "Vui lòng nhập họ tên" + closeDiv)
    }

    const emailElement = $('#inp-email');
    const emailRegex = /^[a-zA-Z0-9.!#$%&â€™*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if ( $.trim(emailElement.val()) === '') {
        isValid = false;
        emailElement.after(openDiv + "Vui lòng nhập email" + closeDiv);
    }
    
    if (emailElement.val() !== '' && emailRegex.test(emailElement.val()) === false) {
        isValid = false;
        emailElement.after(openDiv + "Email không hợp lệ" + closeDiv);
    }

    const phoneElement = $('#inp-phone');
    if ( $.trim(phoneElement.val()) === '' ) {
        isValid = false;
        phoneElement.after(openDiv + "Số điện thoại không để trống" + closeDiv);
    }

    const addressElement = $('#inp-address');
    if ( $.trim(addressElement.val()) === '' ) {
        isValid = false;
        addressElement.after(openDiv + "Vui lòng nhập địa chỉ" + closeDiv);
    }

    const voucherElement = $('#inp-voucher');
    if ( voucherElement.val() !== "" && percent == -1 ) {
        isValid = false;
        Swal.fire({
            title: 'Mã voucher không chính xác \n Vui lòng kiểm tra lại mã!',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
        });
    } 

    return isValid;
}

async function getPercentDiscount() {
    'use strict'
    const voucherElement =$('#inp-voucher');
    percent = await existVoucher(voucherElement.val());
    
    return ( voucherElement.val() !== "" && percent != -1 ) ? percent: percent = 0;
}

async function existVoucher(paramVoucher) {
    let response = await fetch(VOUCHER_URL + "/" + paramVoucher);
    let data = await response.json();
    return data.percent_discount;
}






