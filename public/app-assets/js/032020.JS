function getListItemId(){
    var listItemsId=[];
    var listQuanlity=[];
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
    if (typeof listItemsId != "undefined" && listItemsId != null && listItemsId.length != null&& listItemsId.length > 0){
        window.location.href = "/update-cart/listItemsId="+listItemsId+"&listQuanlity="+listQuanlity;
    } else {
        window.location.href = "/view-cart-detail";
    }
    
}