@push('css')
    <style>
        #input_div{
            display:flex;
            justify-content:space-between;
            gap:10px;
        }

        .add-to-cart, #count{
            width:100px !important;  
        }

        @media screen and (max-width: 767px){
            #input_div{
                gap:10px;
            }

            .add-to-cart, #count{
                width:100% !important;  
            }
        }
    </style>
@endpush
<div class="container py-2">
    <div class="d-lg-block d-sm-block d-none">
        <x-molecules.carts.desktop />
    </div>

    <div class="d-lg-none d-sm-none d-block">
        <x-molecules.carts.mobile />      
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script>
        function update(product_id, quantity){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                type: "POST",
                dataType: "json",
                data: {"_token": "{{ csrf_token() }}", product_id: product_id, quantity : quantity},
                url : '{{ route("clientUpdateCart") }}',
                success: function(data){
                    $(".cart-total").text(data.total);
                }
            })
        }

        function plus(selector){
            let stock = selector.data('stock');
            let quantity = selector.data('quantity');
            let valueStock = selector.parent( "#input_div" ).find("#count");
            const subTotal = selector.parent().parent().parent().find(".product-subtotal");
            let countStock = valueStock.val();
            const id = valueStock.data('id');

            if(countStock < stock){
                countStock++;
                valueStock.val(countStock);
                total = valueStock.data('price') * countStock;
                update(id, countStock);
                subTotal.text(total);
            }
        }

        function minus(selector){
            let valueStock = selector.parent( "#input_div" ).find("#count");
            let countStock = valueStock.val();
            const subTotal = selector.parent().parent().parent().find(".product-subtotal");
            const id = valueStock.data('id');
            if (valueStock.val() > 1) {
                countStock--;
                valueStock.val(countStock);
                total = valueStock.data('price') * countStock;
                update(id, countStock);
                subTotal.text(total);
            }  
        }

        function deleteItem(id, selector, type){
            let removeItem;
            if(type == 'desktop'){
                removeItem = selector.parent().parent();
            }else{
                removeItem = selector.parent();
            }
            
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                type: "POST",
                dataType: "json",
                data: {"_token": "{{ csrf_token() }}", id: id},
                url : '{{ route("clientDeleteCart") }}',
                success: function(data){
                    $(".cart-total").text(data.total);
                    removeItem.remove();
                    $('#cartCount').text(data.cartCount);
                    Toastify({
                        text: "Success Deleted Item From Cart",
                        duration: 3000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                }
            })
        }
    </script>
@endpush