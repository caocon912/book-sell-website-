
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
        order_id = document.getElementById('order_id').value;
    }
    if (typeof listItemsId != "undefined" && listItemsId != null && listItemsId.length != null&& listItemsId.length > 0){
        if (url=='update-order-item'){
            window.location.href = "/admin-order/update-order-item/order_id="+order_id+"&listItemsId="+listItemsId+"&listQuanlity="+listQuanlity;
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
function loadProductByCategoryId(){
    var category_id = document.getElementById('categories').value;
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById('product').innerHTML = xmlhttp.responseText;
        }
    }
    // var url = "{{route('get-product-ajax1',[':category_id'])}}";
    // url = url.replace(':category_id',category_id);
    xmlhttp.open('GET','/ajax/get-product/c_id='+category_id,true);
    //xmlhttp.open('GET',url,true);
    xmlhttp.send();

}
function addProductIntoOrder(){
    var product_id = document.getElementById('product').value;
    if (product_id == "" || product_id == " " || product_id == null){
        alert("Chưa chọn sản phẩm thêm!");
    } else {
    // AJAX request
        $.ajax({
            url: '/ajax/add-product/p_id='+product_id,
            type: 'get',
            data: {"_token": $('meta[name="csrf-token"]').attr('content')},
            success: function(response){ 
                    document.getElementById('product_table').innerHTML = response;
            }
        });
    }   
}

function deleteOrderItem(p_id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById('product_table').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open('GET','/ajax/delete-product/p_id='+p_id,true);
    xmlhttp.send();
}
function loadCategoryInfo(c_id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById('editModalBody').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open('GET','/ajax/get-category/c_id='+c_id,true);
    xmlhttp.send();
}
