@extends('portal.layouts.page')
@section('contentClass', 'payment')
@section('content')
    <style>
        .payment {
            background: linear-gradient(60deg,#3498db,#00e5d0);
            padding: 100px;
        }

        .preloader {
            display: none;
        }

        .price-plan {
            width: calc(100% / 4);
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 40px rgba(0,0,0,0.14);
            padding: 40px 20px;
            flex-shrink: 0;
            color: #152d3d;
            transition: box-shadow .3s ease;
            will-change: box-shadow;
        }

        .price-plan .title {
            font-size: 1.2rem;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
        }

        .price-plan .price {
            margin: 30px 0;
            text-align: center;
            font-size: 3.6rem;
            font-weight: 600;
            letter-spacing: -5px;
            line-height: 1;
            color: #3498db;
        }

        .price-plan .price .currency {
            letter-spacing: 0;
            font-size: 1.8rem;
            position: relative;
            bottom: 18px;
        }

        .price-plan .price .price-container {
            margin: 0 -5px;
        }

        .price-plan .price .period {
            letter-spacing: 0;
            font-size: 1.4rem;
        }

        .price-plan .starting-at {
            text-align: center;
            font-size: .933333rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: -.7px;
            margin-bottom: 50px;
        }

        .price-plan .features {
            margin-bottom: 110px;
            position: relative;
        }

        .price-plan .features ul {
            padding: 0 20px;
        }

        .price-plan .button-wrap {
            position: absolute;
            bottom: 50px;
            left: 50px;
            width: calc(100% - 100px);
        }

        .price-plan .button-wrap .button {
            width: 100%;
            text-align: center;
            color: #fff;
        }

        .price-plan .price-plan-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: -1;
        }
    </style>

    <div class="price-plan-wrapper" data-ce-key="209" style="display: flex; margin: auto; margin-top: 100px; max-width: 1000px;">
        <div class="price-plan price0" data-ce-key="212" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 6px 30px 0px;">
            <div class="title" data-ce-key="213" style="opacity: 1; transform: translateX(0px);">Free</div>
            <div class="price" data-ce-key="214" style="opacity: 1; transform: translateX(0px);"> <span class="currency" data-ce-key="215">€</span> <span class="price-container" data-price-yearly="575" data-price-monthly="60" data-ce-key="216">0</span> <span class="period" data-ce-key="217">/<span class="month" data-ce-key="218">mo</span><span class="year" style="display: none" data-ce-key="219">yr</span></span></div>
            <div class="starting-at" data-ce-key="220" style="opacity: 1; transform: translateX(0px);"> DATA UPDATED DAILY</div>
            <div class="features" data-ce-key="221" style="opacity: 1; transform: translateX(0px);">
                <ul data-ce-key="222">
                    <li data-ce-key="223"><span data-ce-key="224">Daily</span> SEO value in $</li>
                    <li data-ce-key="225"><span data-ce-key="226">10</span> Keywords</li>
                    <li data-ce-key="227"><span data-ce-key="228">1</span> Website</li>
                    <li data-ce-key="229"><span data-ce-key="230">1 month</span> Data History</li>
                    <li data-ce-key="231">Link-analysis (Ahrefs Data)</li>
                    <li data-ce-key="232"><del data-ce-key="233">API</del></li>
                </ul>
            </div>
            <div class="button-wrap" data-ce-key="237" style="opacity: 1; transform: translateX(0px);">
                @if (!$subscription || $subscription->subscription_template_id == 1)
                    <a class="button" data-product="free">Current Plan</a>
                @else
                    <a class="button btn-product-cancel" data-product="free">downgrade</a>
                @endif
            </div>
            <div class="price-plan-bg" data-ce-key="239" style="width: 100%;"></div>
        </div>
        <div class="price-plan price0" data-ce-key="212" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 6px 30px 0px;">
            <div class="title" data-ce-key="213" style="opacity: 1; transform: translateX(0px);">Lite</div>
            <div class="price" data-ce-key="214" style="opacity: 1; transform: translateX(0px);"> <span class="currency" data-ce-key="215">€</span> <span class="price-container" data-price-yearly="575" data-price-monthly="60" data-ce-key="216">60</span> <span class="period" data-ce-key="217">/<span class="month" data-ce-key="218">mo</span><span class="year" style="display: none" data-ce-key="219">yr</span></span></div>
            <div class="starting-at" data-ce-key="220" style="opacity: 1; transform: translateX(0px);"> DATA UPDATED DAILY</div>
            <div class="features" data-ce-key="221" style="opacity: 1; transform: translateX(0px);">
                <ul data-ce-key="222">
                    <li data-ce-key="223"><span data-ce-key="224">Daily</span> SEO value in $</li>
                    <li data-ce-key="225"><span data-ce-key="226">250</span> Keywords</li>
                    <li data-ce-key="227"><span data-ce-key="228">5</span> Websites</li>
                    <li data-ce-key="229"><span data-ce-key="230">1 year</span> Data History</li>
                    <li data-ce-key="231">Link-analysis (Ahrefs Data)</li>
                    <li data-ce-key="232"><del data-ce-key="233">API</del></li>
                </ul>
            </div>
            <div class="button-wrap" data-ce-key="237" style="opacity: 1; transform: translateX(0px);">
                @if (!$subscription)
                    <a href='#' class="button" data-fsc-action="Add,Checkout" data-fsc-item-path-value="lite">START BETA</a>
                @elseif ($subscription->subscription_template_id == 1)
                    <a class="button btn-product-update" data-product="lite">upgrade</a>
                @elseif ($subscription->subscription_template_id == 2)
                    <a class="button" data-product="lite">Current Plan</a>
                @else
                    <a class="button btn-product-update" data-product="lite">downgrade</a>
                @endif
            </div>
            <div class="price-plan-bg" data-ce-key="239" style="width: 100%;"></div>
        </div>
        <div class="price-plan price1" data-ce-key="240" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 6px 30px 0px;">
            <div class="title" style="opacity: 1; transform: translateX(0px);" data-ce-key="241">Standard</div>
            <div class="price" style="opacity: 1; transform: translateX(0px);" data-ce-key="242"> <span class="currency" data-ce-key="243">€</span> <span class="price-container" data-price-yearly="815" data-price-monthly="85" data-ce-key="244">85</span> <span class="period" data-ce-key="245">/<span class="month" data-ce-key="246">mo</span><span class="year" style="display: none" data-ce-key="247">yr</span></span></div>
            <div class="starting-at" style="opacity: 1; transform: translateX(0px);" data-ce-key="248"> Data updated daily</div>
            <div class="features" style="opacity: 1; transform: translateX(0px);" data-ce-key="249">
                <ul data-ce-key="250">
                    <li data-ce-key="251"><span data-ce-key="252">Daily</span> SEO Value in $</li>
                    <li data-ce-key="253"><span data-ce-key="254">1000</span> Keywords</li>
                    <li data-ce-key="255"><span data-ce-key="256">50</span> Websites</li>
                    <li data-ce-key="257"><span data-ce-key="258">∞ infinite</span> Data History</li>
                    <li data-ce-key="259">Link-analysis (Ahrefs Data)</li>
                    <li data-ce-key="260"><del data-ce-key="261">API</del></li>
                </ul>
            </div>
            <div class="button-wrap" style="opacity: 1; transform: translateX(0px);" data-ce-key="265">
                @if (!$subscription)
                    <a href='#' class="button" data-fsc-action="Add,Checkout" data-fsc-item-path-value="standard">START BETA</a>
                @elseif ($subscription->subscription_template_id == 4)
                    <a class="button btn-product-update" data-product="standard">downgrade</a>
                @elseif($subscription->subscription_template_id == 3)
                    <a class="button" data-product="standard">Current Plan</a>
                @else
                    <a class="button btn-product-update" data-product="standard">upgrade</a>
                @endif
            </div>
            <div class="price-plan-bg" style="width: 100%;" data-ce-key="267"></div>
        </div>
        
        <div class="price-plan price2" data-ce-key="268" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 6px 30px 0px;">
            <div class="title" data-ce-key="269" style="opacity: 1; transform: translateX(0px);">Pro</div>
            <div class="price" data-ce-key="270" style="opacity: 1; transform: translateX(0px);"> <span class="currency" data-ce-key="271">€</span> <span class="price-container" data-price-yearly="1440" data-price-monthly="150" data-ce-key="272">150</span> <span class="period" data-ce-key="273">/<span class="month" data-ce-key="274">mo</span><span class="year" style="display: none" data-ce-key="275">yr</span></span></div>
            <div class="starting-at" data-ce-key="276" style="opacity: 1; transform: translateX(0px);"> DATA UPDATED DAILY</div>
            <div class="features" data-ce-key="277" style="opacity: 1; transform: translateX(0px);">
                <ul data-ce-key="278">
                    <li data-ce-key="279"><span data-ce-key="280">Daily</span> SEO Value in $</li>
                    <li data-ce-key="281"><span data-ce-key="282">5000</span> Keywords</li>
                    <li data-ce-key="283"><span data-ce-key="284">200</span> Websites</li>
                    <li data-ce-key="285"><span data-ce-key="286">∞ infinite</span> Data History</li>
                    <li data-ce-key="287">Link-analysis (Ahrefs Data)</li>
                    <li data-ce-key="288">API</li>
                </ul>
            </div>
            <div class="button-wrap" data-ce-key="292" style="opacity: 1; transform: translateX(0px);">
                @if (!$subscription)
                    <a href='#' class="button" data-fsc-action="Add,Checkout" data-fsc-item-path-value="pro">START BETA</a>
                @elseif ($subscription->subscription_template_id == 4)
                    <a class="button" data-product="pro">Current Plan</a>
                @else
                    <a class="button btn-product-update" data-product="pro">upgrade</a>
                @endif
            </div>
            <div class="price-plan-bg" data-ce-key="294" style="width: 100%;"></div>
        </div>
    </div>

    <?php
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    ?>

    <form id="subscriptionForm" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" id="subscription" name="subscription">
    </form>

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        function webHookReceived(res) {
            var baseUrl = '/morningscore/public/api/portal/subscriptions/create';

            console.log(res);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-XSRF-TOKEN': '{{ $encrypted_token }}'
                },
                data: {
                    subscriptionId: res.items[0].subscription,
                    product: res.items[0].product,
                    price: res.items[0].subtotal,
                },
                url: baseUrl,
                success: function(res) {

                }
            });
        }

        $('body').on('click', '.btn-product-update', function() {
            if(confirm('Do you want to ' + $(this).text() + '?')) {
                $.ajax({
                    type: 'POST',
                    data: {
                        subscriptions: [
                            {
                                subscription: '{{ $subscription ? $subscription->subscription_id : '' }}',
                                product: $(this).data('product'),
                                quantity: 1
                            }
                        ]
                    },
                    url: '/morningscore/public/api/portal/subscriptions/update',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-XSRF-TOKEN': '{{ $encrypted_token }}'
                    },
                    success: function(res) {
                        var data = JSON.parse(res);
                        console.log(data);
                        console.log(res);
                        if (data.subscriptions[0].result === 'success')
                            alert('Successfully updated subscription. It will be applied in a few minutes.');
                    }
                })
            }
        });

        $('body').on('click', '.btn-product-cancel', function() {
            if(confirm('Do you want to cancel subscription?')) {
                $.ajax({
                    type: 'POST',
                    data: {
                        subscription: '{{ $subscription ? $subscription->subscription_id : '' }}'
                    },
                    url: '/morningscore/public/api/portal/subscriptions/cancel',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-XSRF-TOKEN': '{{ $encrypted_token }}'
                    },
                    success: function(res) {
                        var data = JSON.parse(res);
                        console.log(res);
                        console.log(data);
                        if (data.subscriptions[0].result === 'success')
                            alert('Successfully cancelled subscription. It will be applied in a few minutes.');
                    }
                })
            }
        });
    </script>

    <script
            id="fsc-api"
            src="https://d1f8f9xcsvx3ha.cloudfront.net/sbl/0.7.6/fastspring-builder.min.js"
            type="text/javascript"
            data-storefront="morningscore.test.onfastspring.com/popup-morningscore"
            data-popup-webhook-received="webHookReceived"
    >
    </script>
@stop
