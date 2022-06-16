const drink_url = "https://hongminhdev-pizza-api.herokuapp.com/drinks";

let combo_selected = null;
let typePizza_selected = "";
let drink_selected = "";

const comboPizza = [
    {size: "S", diameter: "20", grilled_ribs: "2", salad: "200", quantity: "2", price: "150.000"},
    {size: "M", diameter: "25", grilled_ribs: "4", salad: "350", quantity: "3", price: "200.000"},
    {size: "L", diameter: "30", grilled_ribs: "8", salad: "500", quantity: "4", price: "250.000"}
]

$(document).ready(function() {
    renderDataComboPizza(comboPizza);
    addEventListenerSelectCombo();
    addEventListenerSelectTypePizza();
    getAllDrinks();

    $('#order-infor').click(() => {
        event.preventDefault();
        handlePageTransition();
    })
});

function handlePageTransition() {
    'use strict'
    if (combo_selected !== null && typePizza_selected !== "") {
        var urlSiteToOpen = "order.html" + "?" + "size=" + combo_selected.size + "&diameter=" + combo_selected.diameter
        + "&grilled_ribs=" + combo_selected.grilled_ribs + "&salad=" + combo_selected.salad + "&quantity=" + combo_selected.quantity
        + "&price=" + combo_selected.price + "&type=" + typePizza_selected + "&drink=" + drink_selected;
        window.location.href = urlSiteToOpen;
    } else {
        Swal.fire({
            title: 'Bạn thích loại pizza nào? \n Vui lòng chọn combo và pizza để tiếp tục đặt hàng!!!',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
        });
    }
}

// Render dữ liệu combo pizza
function renderDataComboPizza(data) {
    'use strict'
    for (let i of data) {
        let htmls = `
            <div class="col-sm-4 mb-5">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center">
                        <h3>${i.size} (small)</h3>
                    </div>
                    <div class="card-body text-center">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Đường kính:</b> ${i.diameter}cm </li>
                            <li class="list-group-item"><b>Sườn nướng:</b> ${i.grilled_ribs} </li>
                            <li class="list-group-item"><b>Salad: </b> ${i.salad}g </li>
                            <li class="list-group-item"><b>Nước ngọt: </b> ${i.quantity} </li>
                            <li class="list-group-item"><h1 class="text-dark"><b> ${i.price} </b></h1> VND </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success w-25 select combo-pizza">
                            Chọn
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#combo-menu').append(htmls);
    }
}
// Gán sự kiện ấn nút chọn combo
function addEventListenerSelectCombo() {
    'use strict'
    $('.combo-pizza').click(function() {
        selectedComboPizza(this, comboPizza);
    });
}
// Xử lý chọn combo
function selectedComboPizza(element, data) {
    'use strict'
    let parent = $(element).closest('.card');
    let size_selected = $(parent).find('h3').text().charAt(0);
    data.forEach(item => item.size === size_selected ? combo_selected = item : null);
}

// Gán sự kiện ấn nút chọn loại pizza
function addEventListenerSelectTypePizza() {
    'use strict'
    $('#type-pizza').on('click', '.type-pizza-selected', function() {
        event.preventDefault();
        selectedTypePizza(this);
    });
}
// Xử lý chọn loại pizza
function selectedTypePizza(element) {
    'use strict'
    let parent = $(element).closest('div');
    typePizza_selected = $(parent).find('h3').text().split(' ')[0].toUpperCase();
}

// Call API lấy dữ liệu đồ uống 
function getAllDrinks() {
    'use strict'
    $.ajax({
        url: drink_url,
        type: "GET",
        dataType: "json",
        success: function(res) {
            renderDataDrink(res);
            addEventListenerSelectDrink();
        }
    });
}
// Render dữ liệu đồ uống ra giao diện
function renderDataDrink(data) {
    'use strict'
    for (let i of data) {
        let htmls = `
            <div class="col-md-4 text-center">
                <div class="menu-wrap">
                    <a href="#" class="menu-img img mb-4" style="background-image: url(images/${i.drink_image});"></a>
                    <div class="text">
                        <h4 style="display: none;">${i.drink_code}</h4>
                        <h3><a href="#">${i.drink_name}</a></h3>
                        <p class="price"><span>⭐️⭐️⭐️⭐️⭐️</span></p>
                        <p><a href="#" class="btn btn-white btn-outline-white drink-selected">Chọn</a></p>
                    </div>
                </div>
            </div>
        `;
        $('#drink-data').append(htmls);
    }
} 
// Gán sự kiện khi ấn nút chọn thức uống
function addEventListenerSelectDrink() {
    $('#drink-data').on('click', '.drink-selected', function() {
        event.preventDefault();
        selectedDrink(this);
    });
}
// Xử lý chọn thức uống
function selectedDrink(element) {
    'use strict'
    let parent = $(element).closest('div');
    drink_selected = $(parent).find('h4').text();
}