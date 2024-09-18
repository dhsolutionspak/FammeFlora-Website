<!DOCTYPE html>
<html dir="@if($language_code == 'ar') rtl @else ltr @endif" lang="{{$language_code}}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>{{ __('invoice')['title']}}</title>
  <base href="{{url('/')}}" />
  <link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid mt-5">
    <div style="page-break-after: always;">
      <h1 style="color:black !important">{{$orderData->invoice_prefix}} #{{$orderData->invoice_no}}</h1>
      <div class="table-responsive">
        <table class="table table-bordered align-items-center table-flush">
          <thead>
            <tr>
              <td colspan="2">{{ __('invoice')['order_details']}}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width: 50%;">
                <address>
                  <strong>{{config('settingConfig.config_store_name')}}</strong><br />
                  {{ __('invoice')['address_1']}}
                </address>
                <b>{{ __('invoice')['telephone']}}</b> {{$orderData->telephone}}<br />
                <b>{{ __('invoice')['Email']}}</b> {{$orderData->email}}<br />
                <b>{{ __('invoice')['website']}}:</b> <a href="{{url('/')}}">{{url('/')}}</a>
              </td>
              <td style="width: 50%;"><b>{{ __('invoice')['order_date']}}</b> {{$orderData->order_date}}<br />
                <b>{{ __('invoice')['order_id']}}:</b> {{$orderData->id}}<br />
                <b>{{ __('invoice')['payment_method']}}</b> {{$orderData->payment_method}}<br />
                <b>{{ __('invoice')['shipping_method']}}</b> {{$orderData->shipping_method}}<br />
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-bordered">
          <thead>
            <tr>
              <td style="width: 50%;"><b>{{ __('invoice')['payment_address']}}</b></td>
              <td style="width: 50%;"><b>{{ __('invoice')['shipping_address']}}</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <address>
                  {{$orderData->firstname}}<br />{{$orderData->shipping_address_1}},{{$orderData->shipping_address_2}}<br />{{$orderData->city}}
                  {{$orderData->shipping_postcode}}<br />{{$orderData->orderCountry?->name}}
                </address>
              </td>
              <td>
                <address>
                  {{$orderData->firstname}}<br />{{$orderData->shipping_address_1}},{{$orderData->shipping_address_2}}<br />{{$orderData->city}}
                  {{$orderData->shipping_postcode}}<br />{{$orderData->orderCountry?->name}}
                </address>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-bordered">
          <thead>
            <tr>
              <td><b>#</b></td>
              <td><b>{{ __('invoice')['name']}}</b></td>
              <td class="text-right"><b>{{ __('invoice')['quantity']}}</b></td>
              <td class="text-right"><b>{{ __('invoice')['unit_price']}}</b></td>
              <td class="text-right"><b>{{ __('invoice')['total']}}</b></td>
            </tr>
          </thead>
          <tbody>
            @php $subTotal = 0; @endphp
            @foreach($orderProducts as $value)
            <tr>
              <td> <img src="{{asset('uploads')}}/product/{{$value['image']}}" alt="" height="60" width="60"> </td>
              <td>{{$value['name']}}

              </td>
              <td class="text-right">{{$value['quantity']}}</td>
              <td class="text-right">{{config('settingConfig.config_currency')}}{{number_format($value['price'],2) }}
              </td>
              <td class="text-right">{{config('settingConfig.config_currency')}}{{number_format( $value['total'] ,2)}}
              </td>
            </tr>
            @php $subTotal += $value['total'] ; @endphp
            @endforeach
            <tr>
              <td class="text-right" colspan="4"><b>{{ __('invoice')['sub_total']}}</b></td>
              <td class="text-right">{{config('settingConfig.config_currency')}}{{number_format( $subTotal ,2)}}</td>
            </tr>
            <tr>
              <td class="text-right" colspan="4"><b>{{ __('invoice')['shipping']}} {{$orderData->shipping_method}}</b>
              </td>
              <td class="text-right">{{config('settingConfig.config_currency')}}{{$orderData->shipping_charge}}</td>
            </tr>
            @forelse($orderTaxes as $tax)
            <tr>
              <td class="text-right" colspan="4"><b>{{$tax->tax_name}}</b></td>
              <td class="text-right">{{config('settingConfig.config_currency')}}{{number_format($tax->tax_amount,2) }}
              </td>
            </tr>
            @empty
            @endforelse
            <tr>
              <td class="text-right" colspan="4"><b>Discount</b></td>
              <td class="text-right">{{config('settingConfig.config_currency')}}{{number_format($orderData->discount,2)
                }}
              </td>
            </tr>
            <tr>
              <td class="text-right" colspan="4"><b>{{ __('invoice')['total']}}</b></td>
              <td class="text-right">
                <b>{{config('settingConfig.config_currency')}}{{number_format($orderData->grand_total,2)}}</b>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
<style>
  * {
    font-family: DejaVu Sans, sans-serif;
  }
</style>