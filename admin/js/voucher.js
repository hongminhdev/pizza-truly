/*** VOUCHERS */
const VOUCHER_COL = ['stt', 'id', 'voucher_code', 'percent_discount', 'create_at', 'update_at', 'action'];
const NUMBER_COL = 0;
const VOUCHER_ID_COL = 1;
const VOUCHER_CODE_COL = 2;
const VOUCHER_PERCENT_COL = 3;
const VOUCHER_CREATE_COL = 4;
const VOUCHER_UPDATE_COL = 5;
const VOUCHER_ACTION_COL = 6;
let number = 1;

let voucherObj = $('#vouchers-tbl').DataTable({
    columns: [
        { data: VOUCHER_COL[NUMBER_COL] },
        { data: VOUCHER_COL[VOUCHER_ID_COL] },
        { data: VOUCHER_COL[VOUCHER_CODE_COL] },
        { data: VOUCHER_COL[VOUCHER_PERCENT_COL] },
        { data: VOUCHER_COL[VOUCHER_CREATE_COL] },
        { data: VOUCHER_COL[VOUCHER_UPDATE_COL] },
        { data: VOUCHER_COL[VOUCHER_ACTION_COL] }
    ],
    columnDefs: [
        {
            targets: NUMBER_COL,
            render: () => number++
        },
        {
            targets: VOUCHER_PERCENT_COL,
            render: data => data + "%"
        },
        {
            targets: VOUCHER_UPDATE_COL,
            render: data => !data ? "Chưa cập nhật" : data
        },
        {
            targets: VOUCHER_ACTION_COL,
            defaultContent: `
                <button class="btn btn-primary edit-voucher"><i class="fas fa-edit"></i> Sửa </button> 
                <button class="btn btn-danger delete-voucher"><i class="fas fa-trash"></i> Xóa</button>
            `
        }
    ],
    bDestroy: true
})

function renderVoucher(paramData) {
    'use strict'
    voucherObj.clear();
    voucherObj.rows.add(paramData);
    voucherObj.draw();
    $('#vouchers-tbl tr').find('td:nth-child(2)').css('display', 'none');
    $('#vouchers-tbl tr').find('td:last-child').css('white-space', 'nowrap');
    addEventListenerTblVoucher();
}

function addEventListenerTblVoucher() {
    'use strict'
    $('#vouchers-tbl').on('click', '.edit-voucher', function() {
        onBtnEditDrink(this);
    });

    $('#vouchers-tbl').on('click', '.delete-voucher', function() {
        onBtnTrashDrink(this);
    });
}