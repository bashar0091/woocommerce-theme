jQuery(function ($) {
  $(document).delegate(".pos_category select", "change", function () {
    var cat = $("#product_category").val();

    var data = {
      action: "filter_products",
      cat: cat,
    };

    $.ajax({
      url: variables.ajax_url,
      type: "POST",
      data: data,

      success: function (response) {
        $(".js-products").html(response);
      },
    });
  });
});




// jQuery(function ($) {
//   // alert("123");
//   var myVariable = false
//   $(".pos_field select").on("change", function () {
//     var customarName = $("#select_customer").val();
//     var productSku = $("input[name='product_sku']").val();
//     var orderDate = $("input[name='order_date']").val();

//     var data = {
//       action: "add_products",
//       productSku: productSku,
//       customarName: customarName,
//       orderDate: orderDate,
//     };

//     $.ajax({
//       url: variables.ajax_url,
//       type: "POST",
//       data: data,

//       success: function (response) {
//         myVariable = true;
//         $(".pos_data_product").html(response);
//       },
//     });
//   });
// });

// jQuery(document).ready(function ($) {
//   // alert("kamrul");
//   $(document).delegate(".product-item", "click", function () {
//     var productSku = $(this)
//       .find(".product-sku")
//       .text()
//       .trim()
//       .replace("SKU: ", "");

//     var data = {
//       action: "add_products",
//       productSku: productSku,
//     };

//     // alert(data);

//     $.ajax({
//       url: variables.ajax_url,
//       type: "POST",
//       data: data,

//       success: function (response) {
//         $(".pos_data_product").append(response);
//       },
//     });
//   });
// });

jQuery(function ($) {
  var myVariable = false;

  $(".pos_field select").on("change", function () {
    var customarName = $("#select_customer").val();
    var productSku = $("input[name='product_sku']").val();
    var orderDate = $("input[name='order_date']").val();

    var data = {
      action: "add_products",
      productSku: productSku,
      customarName: customarName,
      orderDate: orderDate,
    };

    $.ajax({
      url: variables.ajax_url,
      type: "POST",
      data: data,

      success: function (response) {
        myVariable = true;
        $(".pos_data_product").html(response);
      },
    });
  });

  var addedProducts = [];

  $(document).delegate(".product-item", "click", function () {
    var productSku = $(this)
      .find(".product-sku")
      .text()
      .trim()
      .replace("SKU: ", "");

    if (addedProducts.includes(productSku)) {
      alert("Product already added");
      return;
    }

    var data = {
      action: "add_products",
      productSku: productSku,
    };

    if (myVariable) {
      $.ajax({
        url: variables.ajax_url,
        type: "POST",
        data: data,
        success: function (response) {
          $(".pos_data_product").append(response);

          addedProducts.push(productSku);
        },
      });
    } else {
      alert("Select a customer first");
    }
  });
});

jQuery(document).ready(function ($) {
  $(document).delegate(".product-quantity", "input", function () {
    var row = $(this).closest(".product-row");
    var productId = row.data("product-id");
    var quantity = $(this).val();
    var productPrice = $(this).data("product-price");
    var totalPrice = quantity * productPrice;

    var data = {
      action: "update_total_price",
      productId: productId,
      totalPrice: totalPrice,
    };

    $.ajax({
      url: variables.ajax_url,
      type: "POST",
      data: data,
      success: function (response) {
        row.find(".total_price").html(response);
      },
    });
  });
});



jQuery(document).ready(function ($) {
  // alert("kamrul");
  $("#select_customer").select2();
  $('.select2_products').select2();
});

 
jQuery(document).ready(function() { 
  jQuery('.examplessss').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copyHtml5',
            {
                  extend: 'excelHtml5',
                  title: 'Project Report - ' + new Date().toJSON().slice(0,10).replace(/-/g,'-')
              },
          'csvHtml5',
          'pdfHtml5'
      ]
  } );
} );



jQuery(document).ready(function ($) {

  $('.search_product_for_purchase').on('keypress', function (event) {
      if (event.which === 13) {
          event.preventDefault();

          var inputValue = $(this).val();

          var data = {
              action: "search_product_for_purchase",
              product_sku: inputValue,
          };

          $.ajax({
              url: variables.ajax_url,
              type: "POST",
              data: data,
              success: function (response) {
                  if (response.error) {
                      alert(response.error);
                  } else {
                      var productName = response.product_name;
                      var purchasePrice = response.purchase_price;
                      var product_id = response.product_id;
                      
                      // Create a new row with the retrieved data
                      var newRow = '<tr>' +
                          '<td>1</td>' +
                          '<td>' + productName + '</td>' +
                          '<input type="hidden" name="productid[]" value="' + product_id + '" class="product-id">' +
                          '<td> <input type="number" name="rate[]" value="' + purchasePrice + '" class="rate-input"> </td>' +
                          '<td> <input type="number" name="quantity[]" value="1" class="quantity-input"> </td>' +
                          '<input type="hidden" name="subtotal[]" value="' + purchasePrice + '" class="subtotal-price">' +
                          '<td class="subtotal">' + purchasePrice + '</td>' +
                          '<td>Delete</td>' +
                          '</tr>';

                      // Append the new row to the table
                      $(".widefat tbody").append(newRow);

                      // Add event listener for quantity change
                      $('.quantity-input').on('input', function () {
                          updateSubtotalsAndGrandTotal();
                      });

                      // Add event listener for rate change
                      $('.rate-input').on('input', function () {
                          updateSubtotalsAndGrandTotal();
                      });

                      // Calculate and display initial grand total
                      updateSubtotalsAndGrandTotal();
                  }
              },
          });
      }
  });

  // Function to update subtotals and grand total
  function updateSubtotalsAndGrandTotal() {
      var grandTotal = 0;

      $('.rate-input').each(function () {
          var rate = parseFloat($(this).val());
          var quantity = parseInt($(this).closest('tr').find('.quantity-input').val());
          var subtotal = quantity * rate;

          grandTotal += subtotal;

          $(this).closest('tr').find('.subtotal').text(subtotal.toFixed(2));
          $(this).closest('tr').find('.subtotal-price').val(subtotal.toFixed(2));
      });

      // Update the grand total field
      $('.grand-total').text(grandTotal.toFixed(2));
      $('.payable_amount').text(grandTotal.toFixed(2));
      $('.due_amount').text(grandTotal.toFixed(2));

      // Set grandTotal value to input fields
      $('input[name="payable"]').val(grandTotal.toFixed(2));
      $('input[name="due"]').val(grandTotal.toFixed(2));

  }


function updateDue() {
    var payable = parseFloat($('input[name="payable"]').val());
    var paid = parseFloat($('input[name="paid"]').val());
    var due = payable - paid;
    $('input[name="due"]').val(due.toFixed(2));
    $('.due_amount').text(due.toFixed(2));
}

// Call updateDue() when the page loads
updateDue();

// Call updateDue() when the "paid" input field changes
$('input[name="paid"]').on('input', function() {
    updateDue();
});


});






// purchase product  
jQuery(function ($) {

$('#purchase_product').submit(function (event) {
  event.preventDefault();



  var ajax_url = variables.ajax_url;     
  // Get the educational certificate files

  alert(ajax_url) ; 

  var form = $('#purchase_product').serialize();
  alert(form) ; 

  var formData = new FormData ;  
  formData.append('action','purchase_product') ; 
  formData.append('purchase_product', form ) ;

  $.ajax({
      url: ajax_url,
      data: formData,
      processData:false,
          contentType:false,
          type:'post',
      // data: data,
      
      success: function(response){
        // alert('successfully store data') ; 

        // window.location.href = response;
    
        // $("#sslcomerze-pay").removeAttr("style");
        // $("#sslcomerze-pay").attr("href", response);
        // $("manual_submit").attr('disabled');
          

      }
  });

  

});

});
