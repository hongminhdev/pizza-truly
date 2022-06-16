const ORDER_COLS = ['stt', 'id', 'order_code', 'type_pizza', 'size', 'price', 'discount', 
                    'fullname', 'phone', 'status', 'action'];
const NUMBER_COL = 0;
const ORDER_ID_COL = 1;
const ORDER_CODE_COL = 2;
const TYPE_PIZZA_COL = 3; 
const COMBO_COL = 4;
const PRICE_COL = 5;
const DISCOUNT_COL = 6;
const FULLNAME_COL = 7;
const PHONE_COL = 8;
const STATUS_COL = 9;
const ACTION_COL = 10;
let number = 1;
let orderID;

let orderObj = $('#orders-tbl').DataTable({
    columns: [
        { data: ORDER_COLS[NUMBER_COL] },
        { data: ORDER_COLS[ORDER_ID_COL] },
        { data: ORDER_COLS[ORDER_CODE_COL] },
        { data: ORDER_COLS[TYPE_PIZZA_COL] },
        { data: ORDER_COLS[COMBO_COL] },
        { data: ORDER_COLS[PRICE_COL] },
        { data: ORDER_COLS[DISCOUNT_COL] },
        { data: ORDER_COLS[FULLNAME_COL] },
        { data: ORDER_COLS[PHONE_COL] },
        { data: ORDER_COLS[STATUS_COL] },
        { data: ORDER_COLS[ACTION_COL] }
    ],
    columnDefs: [
        {
            targets: NUMBER_COL,
            render: () => number++
        },
        {
            targets: PRICE_COL,
            render: data => data + "đ"
        },
        {
            targets: ACTION_COL,
            defaultContent: `
                <button class="btn btn-primary btn-detail"><i class="fas fa-edit"></i> Chi tiết </button> 
                <button class="btn btn-danger btn-delete"><i class="fas fa-trash"></i> Xóa</button>
            `
        }
    ],
    bDestroy: true
})

function renderOrder(paramData) {
    'use strict'
    orderObj.clear();
    orderObj.rows.add(paramData);
    orderObj.draw();
    $('#orders-tbl tr').find('td:nth-child(2)').css('display', 'none');
    $('#orders-tbl tr').find('td:last-child').css('white-space', 'nowrap');
    addEventListenerTblOrder();
}

function addEventListenerTblOrder() {
    'use strict'
    $('#orders-tbl').on('click', '.btn-detail', function() {
        onBtnOrderDetail(this);
    });
}

function onBtnOrderDetail(element) {
    'use strict'
    var table = $('#orders-tbl').DataTable();
    var rowClick = $(element).closest('tr');
    orderID = table.row(rowClick).data().id;

    console.log(orderID);
    $('#infor-order-modal').modal();
    getOrderById(orderID);
}

function getOrderById(id) {
    'use strict'
    $.ajax({
        url: "https://hongminhdev-pizza-api.herokuapp.com/orders" + "/" + id,
        type: "GET",
        dataType: "json",
        success: function(res) {
            loadDataOrderDetailOnForm(res);
        }
    })
}

function loadDataOrderDetailOnForm(data) {
    'use strict'
    let inputElements = getElementInput('#frm-infor-order');
    for (let i in data) {
        for (let j in inputElements) {
            if (i === j) {
                $(`#${inputElements[j]}`).val(data[i]);
            }
        }
    } 
}


function getElementInput(id) {
    var arrInput = $(id).find('input');
    var objAtts = {};
          
    for (let bKey of arrInput) {
        var bAtts =  bKey.getAttributeNames().reduce( (acc, name) => {
            return {...acc, [name]: bKey.getAttribute(name)}
        }, {});
        objAtts[bAtts.name] = bAtts.id;
    }
    return objAtts;
}

