    //нажать посмотреть товар
    $('.showProduct').on('click', function() {

        const productId = $(this).data('index');
        // console.log(productId);

        $.ajax({
            method: "POST",

            //файл на кот передается инфа
            url: "/catalogue/show_info_product",

            //инфа, кот передается на php
            data: {
                product_id: productId,

            }
            // dataType: "json"
            //показать сообщение на экране перед отправкой информации
            // beforeSend: function(){
            //     alert('start sending');
            // }

        }).done(function(resp) {
            if (resp == false) {
                alert('Error!');
            } else {
                const products = JSON.parse(resp);
                console.log(products);
                $('.modal-name-product').text(products[0]['name']);
                $('.modal-image-product').attr('src', products[0]['image']);
                $('.modal-description-product').text(products[0]['description']);
                var newPrice = (products[0]['price'] - ((products[0]['price'] * products[0]['discount']) / 100));

                var oldPrice = (products[0]['price']);

                console.log(oldPrice);
                console.log(newPrice);
                if (newPrice != oldPrice) {
                    $('.modal-old-price-product').text(oldPrice);
                    $('.modal-new-price-product').text(newPrice);
                    $('.modal-sale').text('SALE!');

                } else {
                    $('.modal-old-price-product').text('');
                    $('.modal-new-price-product').text(oldPrice);
                    $('.modal-sale').text('');
                }
                // console.log(products);
            }


        })
    });
