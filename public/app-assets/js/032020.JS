function getListItemId(url){
    var listItemsId=[];
    var listQuanlity=[];
    var order_id = null;
    var divElement = document.getElementById('cart-table');
    var inputElements = divElement.getElementsByTagName('input');
    for (i = 0; i<inputElements.length; i++){
        if (inputElements[i].type != 'number')
            continue;
        var quanlityItem = inputElements[i].value;
        console.log(quanlityItem);
        if (!isNaN(quanlityItem)){
            listQuanlity.push(quanlityItem);
        }
    }
    for (i = 0; i<inputElements.length; i++){
        if (inputElements[i].type == 'hidden'){
            var idItem = inputElements[i].value;
            console.log(idItem);
            listItemsId.push(idItem);
        }
    }
    if (url=='update-order-item'){
        order_id = document.getElementById('order_id');
    }
    if (typeof listItemsId != "undefined" && listItemsId != null && listItemsId.length != null&& listItemsId.length > 0){
        if (url=='update-order-item'){
            window.location.href = "admin-order/update-order-item/order_id=/"+order_id+"&listItemsId="+listItemsId+"&listQuanlity="+listQuanlity;
        } else if (url=='update-cart') {
            window.location.href = "/update-cart/listItemsId="+listItemsId+"&listQuanlity="+listQuanlity;   
        }
    } else {
        if (url=='update-order-item'){
            window.location.href = "/admin-order/detail-order/"+order_id+"/1";   
        } else if (url=='update-cart'){
            window.location.href = "/view-cart-detail";   
        }
    }
    
}