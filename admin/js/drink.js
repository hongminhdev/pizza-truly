/*** DRINKS */
const DRINKS_COL = ['stt', 'id', 'drink_code', 'drink_name', 'drink_price', 'drink_image', 'create_at', 'update_at', 'action'];
const NUMBER_COL = 0;
const DRINK_ID_COL = 1;
const DRINK_CODE_COL = 2;
const DRINK_NAME_COL = 3;
const DRINK_PRICE_COL = 4;
const DRINK_IMAGE_COL = 5;
const DRINK_CREATE_COL = 6; 
const DRINK_UPDATE_COL = 7;
const DRINK_ACTION = 8;
let number = 1;
let drinkId;

let drinkObj = $('#drinks-tbl').DataTable({
        columns: [
            { data: DRINKS_COL[NUMBER_COL] },
            { data: DRINKS_COL[DRINK_ID_COL] },
            { data: DRINKS_COL[DRINK_CODE_COL] },
            { data: DRINKS_COL[DRINK_NAME_COL] },
            { data: DRINKS_COL[DRINK_PRICE_COL] },
            { data: DRINKS_COL[DRINK_IMAGE_COL] },
            { data: DRINKS_COL[DRINK_CREATE_COL] },
            { data: DRINKS_COL[DRINK_UPDATE_COL] },
            { data: DRINKS_COL[DRINK_ACTION] }
        ],
        columnDefs: [   
            {
                targets: NUMBER_COL,
                render: function() {
                    return number++;
                }
            },
            {
                targets: DRINK_IMAGE_COL,
                render: function(data) {
                    return `<img class="img-thumbnail" src="../images/${data}">`;
                }
            },
            {
                targets: DRINK_UPDATE_COL,
                render: data => !data ? "Chưa cập nhật" : data
            },
            {
                targets: DRINK_ACTION,
                defaultContent: `
                    <button class="btn btn-primary btn-edit"><i class="fas fa-edit"></i> Sửa </button> 
                    <button class="btn btn-danger btn-trash"><i class="fas fa-trash"></i> Xóa</button>
                `
            }
        ],
        bDestroy: true
});

function renderDrink(paramData) {
    'use strict'
    drinkObj.clear();
    drinkObj.rows.add(paramData);
    drinkObj.draw();
    $('#drinks-tbl tr').find('td:nth-child(2)').css('display', 'none');
    $('#drinks-tbl tr').find('td:last-child').css('white-space', 'nowrap');
    addEventListenerTblDrink();
}

function addEventListenerTblDrink() {
    'use strict'
    $('#drinks-tbl').on('click', '.btn-edit', function() {
        onBtnEditDrink(this);
    });

    $('#drinks-tbl').on('click', '.btn-trash', function() {
        onBtnTrashDrink(this);
    });
}

function onBtnEditDrink(element) {
    'use strict'
    var table = $('#drinks-tbl').DataTable();
    var rowClick = $(element).closest('tr');
    var dataObj = table.row(rowClick).data();
    drinkId = table.row(rowClick).data().id;
    
    $('#update-drink-modal').modal();
    loadDataFormUpdate(dataObj);
}

function loadDataFormUpdate(data) {
    'use strict'
    let objInput = getElementInput('#frm-update-drink');
    for (let i in data) {
        for (let j in objInput) {
            if (i === j && j !== "drink_image") {
                $(`#${objInput[j]}`).val(data[i]);
            }
        }
    }
}

function getDataUpdateDrink() {
    'use strict'
    let drink = {
        id: drinkId,
        drink_code : $('#update-drink-code').val(),
        drink_name : $('#update-drink-name').val(),
        drink_price : $('#update-drink-price').val(),
        drink_image : $('#update-drink-image').val()
    }

    return drink;
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
