@php
    use App\Classes\LanguageHandler;


       $language= new  LanguageHandler();
      if($mailData['data']['deliveryType'] == 1){
         $deliveryType = 'Vitra Logistics';
      }  elseif($mailData['data']['deliveryType'] == 2) {
          $deliveryType = 'Nova Poshta';
      } else {
         $deliveryType = 'Ridicare din magazin';
      }

     if($mailData['data']['paymentType'] == 1){
         $paymentType = 'Achitare cu cardul bancar';
         $description = $language->replace('În cazul în care ați optat pentru livrare, aceasta va fi expediată conform metodei selectate. <br> Iar dacă ați selectat ridicarea comenzii personal, vă așteptăm cu drag la sediul nostru de pe Str. Uzinelor 4, Chișinău. Suntem deschiși de luni până vineri între 09:00 și 18:00, iar sâmbăta între 09:00 și 15:00. Vă așteptăm cu drag!',
          'Если вы выбрали доставку, она будет отправлена в соответствии с выбранным методом.<br>Если вы предпочли самовывоз, мы с радостью ждём вас по адресу: ул. Узинелор, 4, Кишинёв. Мы работаем с понедельника по пятницу с 09:00 до 18:00, и в субботу с 09:00 до 15:00. Ждём вас с нетерпением!',
          'If you have chosen delivery, it will be shipped according to the selected method.<br>If you opted for pick-up, we look forward to welcoming you at our office located at Str. Uzinelor 4, Chișinău. We are open from Monday to Friday between 09:00 and 18:00, and on Saturdays from 09:00 to 15:00. We look forward to seeing you!');
      }  elseif($mailData['data']['paymentType'] == 2) {
          $paymentType = 'Achitare prin transfer';
              $description = $language->replace('În cazul în care ați optat pentru livrare, aceasta va fi expediată conform metodei selectate. <br> Iar dacă ați selectat ridicarea comenzii personal, vă așteptăm cu drag la sediul nostru de pe Str. Uzinelor 4, Chișinău. Suntem deschiși de luni până vineri între 09:00 și 18:00, iar sâmbăta între 09:00 și 15:00. Vă așteptăm cu drag!',
              'Если вы выбрали доставку, она будет отправлена в соответствии с выбранным методом.<br>Если вы выбрали самовывоз, мы с нетерпением ждём вас по адресу: ул. Узинелор 4, Кишинёв. Мы работаем с понедельника по пятницу с 09:00 до 18:00, и в субботу с 09:00 до 15:00. Ждём вас с нетерпением!',
              'If you have chosen delivery, it will be shipped according to the selected method.<br>If you opted for in-store pick-up, we look forward to welcoming you at our office located at Str. Uzinelor 4, Chișinău. We are open Monday to Friday from 09:00 to 18:00, and on Saturday from 09:00 to 15:00. We look forward to seeing you!');

      } else {
         $paymentType = 'Achitare în numerar';
          $description = $language->replace('Pentru a ridica comanda, vă așteptăm cu drag la sediul nostru de pe Str. Uzinelor 4, Chișinău. Suntem deschiși de luni până vineri între 09:00 și 18:00, iar sâmbăta între 09:00 și 15:00. Vă așteptăm cu drag!',
           'Для того чтобы забрать заказ, мы с радостью ждём вас по адресу: ул. Узинелор 4, Кишинёв. Мы работаем с понедельника по пятницу с 09:00 до 18:00, и в субботу с 09:00 до 15:00. Ждём вас с нетерпением!',
           'To pick up your order, we warmly invite you to our office located at Str. Uzinelor 4, Chișinău. We are open from Monday to Friday between 09:00 and 18:00, and on Saturday from 09:00 to 15:00. We look forward to seeing you!');

      }

@endphp



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vitra</title>
    <style >
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        ul li {
            list-style: none;
        }

        @media only screen and (max-device-width: 480px) {
            .title {
                font-size: 14px !important;
            }
            .description {
                font-size: 14px !important;
            }
            .products_item {
                display: block !important;
            }
            .product_name {
                font-size: 14px !important;
            }
            .product_code {
                font-size: 14px;
            }

            .product_quantity {
                font-size: 13px;
            }
            .product_price {
                font-size: 14px;
            }
            .product_image {
                width: 100% !important;
                height: auto !important;

            }
            .container {
                margin: 0 !important;
            }
            .footer_title {
                font-size: 14px;
                text-align: center;
            }
            .footer_information {
                font-size: 13px;
            }
            .information_item_title {
                font-size: 13px;
            }
            .information_item_description {
                font-size: 13px;
            }
            .order_data {
                display: block !important;

            }
            .order_list {
                width: 100% !important;
            }

            .order_data_name {
                font-size: 13px;
            }
            .order_data_value {
                font-size: 13px;
            }
            .products_title {
                font-size: 15px;
            }
        }


        .container {
            max-width: 620px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(245, 241, 241, 0.7);
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 17px;
            color: #000 !important;
        }


        .message {
            padding: 20px;
            /*background-color: #ffffff;*/
        }
        .message p {
            margin-top: 0;
        }

        .image_container {
         display: flex;
            justify-content: center;
        }
        .logo_image {
            max-width: 258px;
            margin-bottom: 20px;
        }
        .description {
            text-align: center;
            margin-bottom: 40px;
            font-size: 17px;
            color: #000 !important;
        }
        .separation_line {
            width: 100%;
            height: 1px;
            background-color: #606060;
            margin-bottom: 20px;
        }
        .order_data {
            display: flex;
            justify-content: space-between;
        }
        /*.order_list {*/
        /*    width: 40%;*/
        /*}*/
        .order_item {
            margin-bottom: 15px;
        }
        .order_data_name {
            margin-bottom: 5px;
            font-size: 15px;
            font-weight: bold;
            color: #000 !important;
        }
        .order_data_value {
            margin-top: 0;
            font-size: 15px;
            color: #000 !important;
        }


        .products_block {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .products_title {
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 20px;
            color: #000 !important;
        }
        .products_list {
            margin-bottom: 20px;
            padding-left: 0;
        }
        .products_item {
            display: flex;
            padding: 10px 20px 10px 0;
            border-bottom: 1px #C7C7C7 solid;
        }
        .product_image_block {
            padding-right: 30px;

        }
        .product_image {
            width: 120px;
            height: 120px;
            margin-bottom: 0;
            object-fit: cover;

        }
        .product_content_block {
            width: 100%;
            padding-left: 10px;
        }
        .product_name {
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 15px;
            color: #000 !important;
        }
        .product_code {
            margin-top: 0;
            font-size: 15px;
            color: #000 !important;
        }
        .product_quantity_price {

            color: #000 !important;
        }
        .product_quantity {
            font-size: 17px;
            color: #000 !important;
        }
        .product_price {
            font-size: 15px;
            color: #000 !important;
        }
        .product_currency {
            font-size: 12px;
            margin-left: 4px;
            color: #000 !important;
        }
        .product_total_container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 30px;
        }
        .product_total_name {
            font-size: 17px;
            font-weight: bold;
        }
        .product_total_value {
            font-size: 17px;
            font-weight: bold;
        }
        .product_total_currency {
            font-size: 14px;
            margin-left: 6px;
        }

        .information_block {
            margin-bottom: 30px;
            padding: 20px 30px;
            border-radius: 10px;
            background-color: rgba(217, 217, 217, 0.3);
        }
        .information_image_block {
            margin-bottom: 10px;
        }
        .information_image {
            width: 50px;
        }
        .information_item {
            margin-bottom: 20px;
        }
        .information_item_title {
            margin-bottom: 5px;
            font-size: 15px;
            color: #00A861;
        }
        .information_item_description {
            font-size: 15px;
            color: #000 !important;
        }
        .footer_block {
            /*display: flex;*/
            /*flex-direction: column;*/
            /*align-items: center;*/

        }
        .footer_title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .social_block {
            width: 100%;
            max-width: 275px;
            margin: 0 auto;

        }
        .footer_information {
            text-align: center;
            font-size: 15px;
            margin-bottom: 30px;
        }
        .footer_address_block {
            /*display: flex;*/
            /*justify-content: space-between;*/
            /*flex-wrap: wrap;*/
            font-size: 11px;
            width: 100%;
            max-width: 500px;
        }
        .footer_address_text {
            font-size: 11px;
            color: #000;
            margin-bottom: 8px;

        }






    </style>
</head>

<body>
<div class="container">

    <div class="message">
        <table width="100%" align="center" >
            <tr>
                <th >
                    <div class="" style="text-align: center; margin: 0 auto">
                        <img align="center" class="logo_image" src="{{$mailData['url'].'/images/logo-black.png'}}" alt="Vitra logo">
                    </div>
                </th>
            </tr>
        </table>


        <p class="title"> {{$language->replace('Stimate/Stimată', 'Уважаемый/ая','Dear'). ' '.$mailData['data']['name'].' '.$mailData['data']['surname']}}</p>
        <div class="description">
            <p>{{$language->replace('Vă mulțumim pentru comanda plasată la ViTRA! Suntem bucuroși să vă confirmăm că am primit comanda dvs. și aceasta este în curs de procesare.', 'Благодарим вас за заказ в ViTRA! Мы рады подтвердить, что ваш заказ был получен и находится в процессе обработки.','Thank you for placing an order with ViTRA! We are pleased to confirm that we have received your order and it is being processed.')}} </p>
            <p>{!! $description !!} </p>
            <p>{{$language->replace('Mai jos găsiți detaliile complete ale comenzii dvs.', 'Ниже приведены полные детали вашего заказа','Below are the complete details of your order.')}} </p>
        </div>


        <div class="separation_line"></div>

        <div class="order_data">
            <ul class="order_list">
                <li class="order_item">
                    <p class="order_data_name">{{$language->replace('Numarul comenzii:', 'Номер заказа:','Order number:')}}</p>
                    <p class="order_data_value">{{$mailData['data']['order_number']}}</p>
                </li>
                <li class="order_item">
                    <p class="order_data_name">{{$language->replace('Data comenzii:', 'Дата заказа:','Order data:')}}</p>
                    <p class="order_data_value">{{$mailData['date'] }}</p>
                </li>
                @if(isset($mailData['data']['address']))
                <li class="order_item">
                    <p class="order_data_name">{{$language->replace('Adresa livrării:', 'Адрес доставки:','Delivery address:')}}</p>
                    <p class="order_data_value">{{$mailData['data']['address']}}</p>
                </li>
                 @endif
            </ul>
            <ul class="order_list">
                <li class="order_item">
                    <p class="order_data_name">{{$language->replace('Mod de livrare:', 'Тип доставки:','Delivery type:')}}</p>
                    <p class="order_data_value">{{$deliveryType}}</p>
                </li>
                @if(isset($mailData['data']['address']))
                <li class="order_item">
                    <p class="order_data_name">{{$language->replace('Cost livrare:', 'Стоимость доставки:','Delivery price')}}</p>
                    <p class="order_data_value">{{$mailData['data']['priceDelivery'] >0 ? $mailData['data']['priceDelivery'].' MDL': $language->replace('Gratuit', 'Бесплатно','Free') }}</p>
                </li>
                @endif
                <li class="order_item">
                    <p class="order_data_name">{{$language->replace('Metoda de plata:', 'Метод оплаты','Payment type')}}</p>
                    <p class="order_data_value">{{$paymentType}}</p>
                </li>

            </ul>
        </div>

        <div class="separation_line"></div>


        <div class="products_block">
            <p class="products_title">{{$language->replace('Detalii despre produse', 'Детали продуктов','Products details')}}</p>

            <ul class="products_list">
                @foreach($mailData['products'] as $item)

                <li class="products_item">
                    <div class="product_image_block">
                        <img class="product_image" src="{{$mailData['url'].'/storage/'.$item->product->image_preview}} " alt="{{$item->product->name_ro}}">
                    </div>
                    <div class="product_content_block">
                        <div>
                            <p class="product_name">{{$item->product->name_ro}}</p>
                            <p class="product_code">{{$language->replace('Cod Produs:', 'Код продукта','Product\'s code')}} {{$item->product->code_1c}}</p>
                        </div>

                        <table class="product_quantity_price" >
                            <tr>
                                <td style="text-align: left">
                                    <p class="product_quantity">{{$item->quantity>1 ? $item->quantity.' produse': '' }}</p>
                                </td>
                                <td style="text-align: right">
                                    <div class="product_price">
                                        <span>{{$item->quantity *$item->product->price}}</span>
                                        <span class="product_currency">MDL</span>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </li>
                @endforeach
            </ul>

            <div class="product_total_container">
                <p class="product_total_name">{{trans('labels.total_order')}}:</p>
                <p class="product_total_value">
                  <span>{{$mailData['data']['priceTotal']}}</span>
                    <span class="product_total_currency">MDL</span>
                </p>
            </div>

        </div>

        <div class="information_block">
            <table width="100%" align="center" >
                <tr>
                    <th >
                        <div class="information_image_block" style="text-align: center; margin: 0 auto">
                            <img align="center" src="{{$mailData['url']}}/images/mail/shield.png" alt="information-image" class="information_image">
                        </div>

                    </th>
                </tr>
            </table>


            <div class="information_item">
                <p class="information_item_title">{{$language->replace('Important', 'Важно','Important')}} </p>
                <p class="information_item_description">
                    {{$language->replace(' Fiți atenți și evitați frauda. ViTRA nu solicită niciodată plata unor taxe suplimentare prin SMS sau e-mail. Vă recomandăm să nu răspundeți la astfel de mesaje și să nu accesați linkuri care nu conțin „vitra.md” în adresa site-ului.',
                     'Будьте внимательны и избегайте мошенничества. ViTRA никогда не запрашивает оплату дополнительных сборов через SMS или электронную почту. Рекомендуем не отвечать на такие сообщения и не переходить по ссылкам, не содержащим «vitra.md» в адресе сайта.',
                     'Please be cautious and avoid fraud. ViTRA never requests payment for additional fees via SMS or email. We strongly recommend not responding to such messages and not clicking on links that do not contain "vitra.md" in the website address.')}}

                </p>
            </div>
            <div class="information_item">
                <p class="information_item_title">{{$language->replace('Plăți sigure', 'Безопасные платежи','Secure Payments')}} </p>
                <p class="information_item_description">
                    {{$language->replace('Cu noi, informațiile dumneavoastră de plată sunt în siguranță. ViTRA garantează confidențialitatea datelor dumneavoastră bancare.',
                    'С нами ваши платежные данные находятся в безопасности. ViTRA гарантирует конфиденциальность ваших банковских данных.',
                    'With us, your payment information is safe. ViTRA ensures the confidentiality of your banking details.')}}
                </p>
            </div>
            <div class="information_item">
                <p class="information_item_title">{{$language->replace('Criptarea datelor', 'Шифрование данных','Data Encryption')}} </p>
                <p class="information_item_description">
                    {{$language->replace('Acordăm o mare importanță protecției confidențialității dumneavoastră. Informațiile dumneavoastră sunt protejate și nu vor fi compromise. Nu dezvăluim datele dumneavoastră personale și le folosim doar conform Politicii noastre de Confidențialitate.',
                        'Мы придаём большое значение защите вашей конфиденциальности. Ваша информация защищена и не будет скомпрометирована. Мы не раскрываем ваши личные данные и используем их только в соответствии с нашей Политикой конфиденциальности.',
                        'We place great importance on protecting your privacy. Your information is securely protected and will not be compromised. We do not disclose your personal data and use it only in accordance with our Privacy Policy.')}}

                </p>
            </div>
            <div class="information_item">
                <p class="information_item_title">{{$language->replace('Siguranța achizițiilor', 'Безопасность покупок','Purchase Security')}} </p>
                <p class="information_item_description">
                    {{$language->replace('Puteți face cumpărături în siguranță cu ViTRA, știind că vă vom susține dacă apar probleme cu comanda dumneavoastră.',
                        'Вы можете делать покупки в ViTRA с уверенностью, зная, что мы поддержим вас в случае возникновения проблем с вашим заказом.',
                        'You can shop with confidence at ViTRA, knowing that we will support you if there are any issues with your order.')}}

                </p>
            </div>
            <div class="information_item">
                <p class="information_item_title">{{$language->replace('Politica de returnare', 'Политика возврата','Return Policy')}} </p>
                <p class="information_item_description">
                    {{$language->replace('Sperăm că veți fi mulțumit de achizițiile dumneavoastră. Dacă, din orice motiv, aveți nevoie să returnați produsul, îl puteți face în starea sa inițială.',
                    'Мы надеемся, что вы будете довольны вашими покупками. Если по каким-либо причинам вам нужно вернуть товар, вы можете сделать это в его первоначальном виде.',
                    'We hope you are satisfied with your purchases. If for any reason you need to return the product, you may do so in its original condition.')}}

                </p>
            </div>
        </div>

        <div class="footer_block" style="">
            <p class="footer_title">{{$language->replace('Ne puteți găsi pe platformele.', 'Вы можете найти нас на платформах','You can find us on platforms.')}}</p>
            <div class="social_block">
                <a href="https://www.facebook.com/vitra.shop" class="social_link" target="_blank">
                    <img src="{{$mailData['url']}}/images/mail/icon-facebook.png" alt="icon-facebook" class="social_icon">
                </a>
                <a href="https://www.instagram.com/vitra.md/?fbclid=IwAR0GTZbjRmQB4nAbajVRHdMbwNM06M_1-bzP4dAMatH1PRCIJSShqYtfza4" class="social_link" target="_blank">
                    <img src="{{$mailData['url']}}/images/mail/icon-instagram.png" alt="icon-instagram" class="social_icon">
                </a>
                <a href="https://t.me/vitramd1" class="social_link" target="_blank">
                    <img src="{{$mailData['url']}}/images/mail/telegram.png" alt="telegram" class="social_icon">
                </a>
                <a href="https://www.youtube.com/@vitramoldova" class="social_link" target="_blank">
                    <img src="{{$mailData['url']}}/images/mail/icon-youtube.png" alt="icon-youtube" class="social_icon">
                </a>
                <a href="https://www.linkedin.com/company/10047444/admin/notifications/all" class="social_link" target="_blank">
                    <img src="{{$mailData['url']}}/images/mail/linkedin.png" alt="linkedin" class="social_icon">
                </a>
            </div>
            <p class="footer_information">{{$language->replace('Acest e-mail a fost trimis automat. Vă rog să nu răspundeți.', 'Это письмо было отправлено автоматически. Пожалуйста, не отвечайте на него.','This email was sent automatically. Please do not reply.')}}</p>
            <table class="footer_address_block" align="center">
                <tr>
                    <td >
                        <p class="footer_address_text">Depozit-Producere Str. Industrială 5, Chișinău</p>
                    </td>
                    <td >
                        <p class="footer_address_text">Showroom-Oficiu Str. Uzinelor 4, Chișinău</p>
                    </td>
                </tr>
            </table>
            <table class="footer_address_block" align="center">
                <tr>
                    <td >
                        <a href="{{$mailData['url']}}" target="_blank" class="footer_address_text">www.vitra.md</a>
                    </td>
                    <td >
                        <a href="tel:+37322944955" target="_blank" class="footer_address_text">+373 (22) 944 955</a>
                    </td>
                    <td >
                        <a href="mailto:info@vitra.md" target="_blank" class="footer_address_text">info@vitra.md</a>
                    </td>
                    <td >
                        <a href="{{$mailData['url']}}/policy" target="_blank" class="footer_address_text">{{trans('labels.policy')}}</a>
                    </td>
                </tr>
            </table>

{{--            <div class="footer_address_block" style="display: flex; justify-content: space-between">--}}
{{--                <p class="footer_address_text">Depozit-Producere Str. Industrială 5, Chișinău</p>--}}
{{--                <p class="footer_address_text">Showroom-Oficiu Str. Uzinelor 4, Chișinău</p>--}}
{{--            </div>--}}
{{--            <div class="footer_address_block" style="display: flex; justify-content: space-between; flex-wrap: wrap">--}}
{{--                <a href="{{$mailData['url']}}" target="_blank" class="footer_address_text">www.vitra.md</a>--}}
{{--                <a href="tel:+37322944955" target="_blank" class="footer_address_text">+373 (22) 944 955</a>--}}
{{--                <a href="mailto:info@vitra.md" target="_blank" class="footer_address_text">info@vitra.md</a>--}}
{{--                <a href="{{$mailData['url']}}/policy" target="_blank" class="footer_address_text">{{trans('labels.policy')}}</a>--}}
{{--            </div>--}}
        </div>
    </div>

</div>
</body>

</html>
